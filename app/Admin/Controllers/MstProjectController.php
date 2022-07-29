<?php

namespace App\Admin\Controllers;

use App\Models\MstSap;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\MstWitel;
use Encore\Admin\Widgets;
use App\Models\MstProject;
use App\Admin\Forms\addPlan;
use App\Models\TranBaseline;
use Illuminate\Http\Request;
use App\Models\TranSupervisi;
use App\Admin\Forms\AccProject;
use App\Models\RefListActivity;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Auth\Permission;
use App\Admin\Actions\Project\Acc;
use App\Admin\Forms\importProject;
use Illuminate\Support\Facades\DB;
use App\Admin\Actions\Post\Replicate;
use App\Admin\Forms\BaselineActivity;
use App\Admin\Actions\Project\Baseline;
use App\Admin\Actions\Project\BatchRestore;
use App\Admin\Actions\Project\ActualActivity;
use App\Admin\Actions\Project\Plan;
use App\Models\MstWaspangUt;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Controllers\AdminController;

class MstProjectController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'TABLE PROJECT';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new MstProject());
        $grid->model()->orderBy('id', 'desc');
        $grid->fixColumns(3, -1);
        if (Admin::user()->inRoles(['mitra'])) {
            $grid->model()->where('mitra_id', '=', Admin::user()->name);
            $grid->disableCreateButton();
            //$grid->model()->where('status_project', '=', 'DONE DRM');
        }

        if (Admin::user()->inRoles(['witel'])) {
            $grid->model()->where('witel_id', '=', Admin::user()->name);
        }

        if (Admin::user()->inRoles(['hd-ped', 'witel', 'administrator'])) {
            $grid->tools(function ($tools) {
                $tools->append('<a href="/ped-panel/import-project" class="btn btn-danger btn-sm"><i class="fa fa-file-excel-o"></i>  Import Project</a>');
                $tools->append('<a href="/uploads/template_excel/PROJECT.xlsx" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-file-excel-o"></i>  Template Excel</a>');
            });
        }

        $grid->actions(function ($actions) {
            if (Admin::user()->isRole('mitra', 'waspang', 'tim-ut')) {
                $actions->disableEdit();
                $actions->disableDelete();
            }
        });
        $grid->batchActions(function ($batch) {

            if (\request('_scope_') == 'trashed') {
                $batch->add(new BatchRestore());
            }
        });

        $grid->filter(function ($filter) {
            // Remove the default id filter
            $filter->disableIdFilter();
            // Range filter, call the model's `onlyTrashed` method to query the soft deleted data.
            $filter->scope('trashed', 'Recycle Bin')->onlyTrashed();
            $filter->column(1 / 2, function ($filter) {
                $filter->like('lop_site_id', 'LOP / SITE ID');
                $filter->in('status_project', 'STATUS PROJECT')->multipleSelect(['USULAN' => 'USULAN', 'DONE DRM' => 'DONE DRM', 'PELIMPAHAN' => 'PELIMPAHAN', 'PO' => 'PO/SP', 'DROP' => 'DROP']);
                $filter->like('witel_id', 'WITEL');
                $filter->like('mitra_id', 'MITRA');
            });

            $filter->column(1 / 2, function ($filter) {
               
                $filter->between('start_date', 'START DATE')->date();
                $filter->between('end_date', 'END DATE')->date();
            });
        });
        $grid->rows(function (Grid\Row $row) {
            if ($row->status_project == 'USULAN') {
                $row->setAttributes(['style' => 'color:red;']);
            }
        });
        //$grid->fixColumns(3, -2);
        $grid->column('tipe_project', __('TIPE PROJECT'))->width(200)->hide();
        $grid->column('tematik', __('TEMATIK'))->sortable();


        $grid->column('witel_id', __('WITEL'))->sortable();
        $grid->column('sto_id', __('STO'))->sortable();
        $grid->column('lop_site_id', __('LOP / SITE ID'))->sortable();
        $grid->column('odp_port', __('PORT'))->sortable();

        //$grid->column('rab_total', __('TOTAL RAB'))->sortable();
       // $grid->column('nilai_capex_per_port', __('NILAI CAPEX PER PORT'))->width(350)->sortable();
        $grid->column('rab_total')->display(function ($rab_total) {

            return separator($rab_total);
        
        })->sortable();
        $grid->column('nilai_capex_per_port')->display(function ($nilai_capex_per_port) {

            return separator($nilai_capex_per_port);
        
        })->sortable();
        $grid->column('mitra_id', __('MITRA'))->sortable();
        $grid->column('waspang_id', __('WASPANG'))->sortable()->hide();
        $grid->column('status_project', __('STATUS PROJECT'))->width(250)->sortable();
        $grid->column('start_date', __('START DATE'))->sortable();
        $grid->column('end_date', __('END DATE'))->sortable();
      

        Admin::style('                
          .table th {
            text-transform: uppercase;
            background-color: #ee99a0;            
          }');



        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $data = MstProject::findOrFail($id);
        $supervisi = TranSupervisi::where('project_id', $id)->first();
        return view('admin.modul_project.detail', [
            'data' => $data,
            'supervisi' => $supervisi
        ]);
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {

        $form = new Form(new MstProject());

        $form->tab('Info', function (Form $form) {
            $form->hidden('id');
            $form->text('tipe_project', __('Tipe project'));
            $form->text('tematik', __('Tematik'));
            $form->text('nde_permintaan', __('Nde permintaan'));
            $form->text('perihal_nde', __('Perihal nde'));
            $form->text('tgl_nde', __('Tgl nde'));
            $form->text('nilai_permintaan', __('Nilai permintaan'));
            if (Admin::user()->inRoles(['administrator', 'hd-ped'])) {                  
                $form->select('witel_id', 'Witel')->options(
                    Administrator::join('admin_role_users', 'admin_users.id', '=', 'admin_role_users.user_id')
                        ->where('admin_role_users.role_id', '3')
                        ->pluck('name', 'name')
                );
            }
            if (Admin::user()->inRoles(['witel'])) {                  
                $form->select('witel_id', 'Witel')->options(
                    Administrator::join('admin_role_users', 'admin_users.id', '=', 'admin_role_users.user_id')
                        ->where('admin_role_users.role_id', '3')
                        ->where('name', Admin::user()->name)
                        ->pluck('name', 'name')
                );
            }
            if ($form->isCreating()) {                    
                $form->select('mitra_id', 'Mitra')->options(
                    Administrator::join('admin_role_users', 'admin_users.id', '=', 'admin_role_users.user_id')
                        ->where('admin_role_users.role_id', '4')
                        ->pluck('name', 'name')
                );
            }
            if ($form->isEditing()) {                    
                $form->display('mitra_id', __('Mitra'));
            }
           
            $form->text('sto_id', __('Sto id'));
            $form->text('lop_site_id', __('Lop site id'));
        })->tab('Feeder', function (Form $form) {
            $form->text('feeder_ku_kap_12', __('Feeder ku kap 12'));
            $form->text('feeder_ku_kap_24', __('Feeder ku kap 24'));
            $form->text('feeder_ku_kap_48', __('Feeder ku kap 48'));
            $form->text('feeder_ku_kap_96', __('Feeder ku kap 96'));
            $form->text('feeder_kt_kap_24', __('Feeder kt kap 24'));
            $form->text('feeder_kt_kap_48', __('Feeder kt kap 48'));
            $form->text('feeder_kt_kap_96', __('Feeder kt kap 96'));
            $form->text('feeder_kt_kap_144', __('Feeder kt kap 144'));
            $form->text('feeder_kt_kap_288', __('Feeder kt kap 288'));
        })->tab('Dsitribusi', function (Form $form) {
            $form->text('distribusi_ku_kap_24_scpt', __('Distribusi ku kap 24 scpt'));
            $form->text('distribusi_ku_kap_12_scpt', __('Distribusi ku kap 12 scpt'));
            $form->text('distribusi_ku_kap_8_scpt', __('Distribusi ku kap 8 scpt'));
            $form->text('distribusi_kt_kap_24_scpt', __('Distribusi kt kap 24 scpt'));
            $form->text('distribusi_kt_kap_12_scpt', __('Distribusi kt kap 12 scpt'));
            $form->text('distribusi_kt_kap_8_scpt', __('Distribusi kt kap 8 scpt'));
        })->tab('ODP', function (Form $form) {
            $form->text('odp_odp_8', __('Odp odp 8'));
            $form->text('odp_odp_16', __('Odp odp 16'));
            $form->text('odp_spl_1_8', __('Odp spl 1 8'));
            $form->text('odp_spl_1_16', __('Odp spl 1 16'));
            $form->text('odp_port', __('Odp port'));
            $form->text('catuan_jenis', __('Catuan jenis'));
            $form->text('catuan_nama', __('Catuan nama'));
        })->tab('ODC', function (Form $form) {
            $form->text('odc_odc_48', __('Odc odc 48'));
            $form->text('odc_odc_96', __('Odc odc 96'));
            $form->text('odc_odc_144', __('Odc odc 144'));
            $form->text('odc_odc_288', __('Odc odc 288'));
            $form->text('odc_576', __('Odc 576'));
            $form->text('odc_total', __('Odc total'));
        })->tab('Summary & RAB', function (Form $form) {
            $form->text('panjang_feeder', __('Panjang feeder'));
            $form->text('panjang_dist', __('Panjang dist'));
            $form->text('tiang_baru', __('Tiang baru'));
            $form->text('jarak_ke_sto', __('Jarak ke sto'));
            $form->text('jml_home_pass', __('Jml home pass'));
            $form->text('rab_material', __('Rab material'));
            $form->text('rab_survey', __('Rab survey'));
            $form->text('rab_total', __('Rab total'));
            $form->text('nilai_capex_per_port', __('Nilai capex per port'));
        })->tab('ACC Project', function (Form $form) {
            $form->text('sap.status_sap', 'Status SAP')->help('Nilai diambil dari Tabel SAP')->readonly();
            $form->text('sap.kontrak', 'Nomor Kontrak')->help('Nilai diambil dari Tabel SAP')->readonly();
            $form->text('nde_pelimpahan', __('Nde pelimpahan'))->help('Nilai diambil dari Tabel SAP')->readonly();

            if (Admin::user()->inRoles(['administrator', 'hd-ped'])) {
                $form->divider('Update Admin');
                $form->select('mitra_id', 'Mitra')->options(
                    Administrator::join('admin_role_users', 'admin_users.id', '=', 'admin_role_users.user_id')
                        ->where('admin_role_users.role_id', '4')
                        ->pluck('name', 'name')
                );
                if ($form->isEditing()) {                    
                    $form->select('status_project', __('Status Project'))->options(['USULAN' => 'USULAN', 'DONE DRM' => 'DONE DRM', 'PELIMPAHAN' => 'PELIMPAHAN', 'PO' => 'PO/SP',  'DROP' => 'DROP']);
                    $form->dateRange('start_date', 'end_date', 'Date range Project');
                }
            }
            Admin::script(
                '
                console.log("hello world");
                var status = document.getElementById("my_status_project").value;
                if(status == "USULAN" || status == "DROP"){               
                    document.getElementById("start_date").disabled  = true;
                    document.getElementById("end_date").disabled  = true;
                    } else {
                     document.getElementById("start_date").disabled  = false;
                     document.getElementById("end_date").disabled  = false;
                    }
               
               
                document.getElementById("my_status_project").onchange = function(){
                   
                    if(this.value == "USULAN" || this.value == "DROP"){               
                       document.getElementById("start_date").disabled  = true;
                       document.getElementById("end_date").disabled  = true;
                       document.getElementById("start_date").value = "";
                       document.getElementById("end_date").value = "";
                       } else {
                        document.getElementById("start_date").disabled  = false;
                        document.getElementById("end_date").disabled  = false;
                       }
                    };
                '
            );
        });

        // Save to supervisi jika DONE DRM
        $form->saved(function (Form $form) {
            $check = TranSupervisi::where('project_id', '=', $form->id)->exists();
            $witel_id = MstWaspangUt::where('name', '=', $form->witel_id)->first();
            $mitra_id = MstWaspangUt::where('name', '=', $form->mitra_id)->first();
            if ($form->status_project == 'USULAN') {
                admin_warning('title', 'Status tidak boleh usulan atau drop');
            } else {
                if ($check == 0) {
                    $supervisi = TranSupervisi::create([
                        'project_id' => $form->id,
                        'project_name' => $form->lop_site_id,
                        'mitra_id' => $mitra_id->id,
                        'witel_id' =>  $witel_id->id,
                        'task' => 'CREATE BASELINE',
                        'plan_nilai' => $form->rab_total,
                        'plan_port' => $form->odp_port,
                    ]);
                    $supervisi->save();
                }
                if ($check == 1) {
                    TranSupervisi::where("project_id", $form->id)
                        ->update([
                            'plan_nilai' => $form->rab_total,
                            'plan_port' => $form->odp_port,
                        ]);
                }
            }
        });

        return $form;
    }

    public function importProject(Content $content)
    {
        return $content
            ->title('Import Project')
            ->body(new importProject());
    }

    public function witel(Request $request)
    {

        $q = $request->get('q');

        //return MstWitel::where('name', $provinceId)->get(['id', DB::raw('name as text')]);
        $witel = Administrator::where('name', 'like', "%$q%")
            //->where('roles.id', '3')
            ->paginate(null, [DB::raw('id as id'), DB::raw('name as text')]);
        $users = Administrator::join('admin_role_users', 'admin_users.id', '=', 'admin_role_users.user_id')
            //->get(['admin_users.*', 'admin_role_users.role_id']);
            ->where('admin_role_users.role_id', '3')
            ->where('admin_users.name', 'like', "%$q%")
            ->paginate(null, [DB::raw('admin_users.id as id'), DB::raw('name as text')]);


        return $users;
    }
}
