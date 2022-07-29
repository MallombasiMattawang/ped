<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\MstWaspangUt;
use App\Models\TranBaseline;
use App\Models\TranInventory;
use App\Models\TranSupervisi;
use Encore\Admin\Facades\Admin;
use App\Admin\Actions\Project\Plan;
use App\Admin\Actions\Project\Actual;
use App\Admin\Actions\Project\Baseline;
use Illuminate\Support\Facades\Request;
use App\Admin\Extensions\Tools\GridView;
use App\Models\TranOdp;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Widgets\Table;

class TranInventoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'TranInventory';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {

        $grid = new Grid(new TranSupervisi());
        $grid->model()->where('progress_actual', '>=', 88)->where('progress_actual', '<=', 100);
       //$grid->model()->join('tran_baseline', 'tran_supervisi.project_id', '=', 'tran_baseline.project_id')->where('tran_baseline.activity_id', '=',  19)->where('tran_baseline.actual_finish', '>',  0);
        $grid->disableCreateButton();
        $grid->disableRowSelector();
        $grid->disableColumnSelector();
        $grid->actions(function ($actions) {

            //$actions->disableEdit();
            $actions->disableDelete();
            $actions->disableView();

        });
        $grid->filter(function ($filter) {
            // Remove the default id filter
            $filter->disableIdFilter();

            $filter->column(1 / 2, function ($filter) {
                $filter->like('project_name', 'LOP / SITE ID');
                $filter->like('supervisi_project.witel_id', 'WITEL');
                $filter->like('status_gl_sdi', 'STATUS GL SDI');
               
            });

            $filter->column(1 / 2, function ($filter) {
               
                $filter->between('plan_golive', 'PLAN GOLIVE')->date();
                $filter->between('real_golive', 'REAL GOLIVE')->date();
            });
        });
       // $grid->fixColumns(2, -1);
       $grid->column('supervisi_project.tematik', __('TEMATIK'));
       $grid->column('supervisi_project.witel_id', __('WITEL'));
       $grid->column('supervisi_project.sto_id', __('STO'));
       $grid->column('project_name', __('LOP/SITE ID'))->limit(30);
        //$grid->column('status_gl_sdi', __('Status gl sdi'));
        $grid->column('status_gl_sdi', 'Status gl sdi')->display(function ($status_gl_sdi, $column) {
    
           
            if ($this->status_gl_sdi != null) {
                return $status_gl_sdi;
            } else {
                return "NO DATA";
            }
            
          
        });
        $grid->column('ket_gl_sdi', __('KET GL SDI'));
        $grid->column('status_abd', __('STATUS ABD'));
        $grid->column('id_sw', __('ID SW'));
        $grid->column('id_imon', __('ID IMON'));
        // $grid->column('odp_8', __('Odp 8'));
        $grid->column('odp_8', 'ODP 8')->modal(function ($model) {

            $comments = $model->namaOdp()->where('jenis_odp', 'ODP 8')->take(100)->get()->map(function ($comment) {
                return $comment->only(['nama_odp', 'jenis_odp']);
            });

            return new Table(['Nama ODP', 'Jenis ODP'], $comments->toArray());
        });
        $grid->column('odp_16', 'ODP 16')->modal(function ($model) {

            $comments = $model->namaOdp()->where('jenis_odp', 'ODP 16')->take(100)->get()->map(function ($comment) {
                return $comment->only(['nama_odp', 'jenis_odp']);
            });

            return new Table(['Nama ODP', 'Jenis ODP'], $comments->toArray());
        });
       
        $grid->column('odp_port', __('Odp port'));
      
        $grid->column('plan_golive', __('Plan golive'));
        $grid->column('real_golive', __('Real golive'));
        
        Admin::style('.table {
            #background: #ee99a0;
            border-radius: 0.2rem;
            width: 100%;
            padding-bottom: 1rem;
            color: #212529;
            margin-bottom: 0;
          }
          .table th {
            text-transform: uppercase;
            white-space: nowrap;
            background-color: #ffffd5;
          }');
          $grid->fixColumns(0, -1);
    //     Admin::script('
    //   $("form").on( "submit", function( event ) {
    //          // $.admin.reload();
    //     $(".modal").modal("hide");
    // });
    //   ');
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
        $show = new Show(TranSupervisi::findOrFail($id));

        $show->field('id', __('Id'));

        $show->field('project_name', __('Project name'));
        $show->field('status_gl_sdi', __('Status gl sdi'));
        $show->field('ket_gl_sdi', __('Ket gl sdi'));
        $show->field('status_abd', __('Status abd'));
        $show->field('id_sw', __('Id sw'));
        $show->field('id_imon', __('Id imon'));
        $show->field('odp_8', __('Odp 8'));
        $show->field('odp_16', __('Odp 16'));
        $show->field('ps_1_8', __('Ps 1 8'));
        $show->field('ps_1_16', __('Ps 1 16'));
        $show->field('odp_port', __('Odp port'));
        $show->field('nama_odp', __('Nama odp'));
        $show->field('plan_golive', __('Plan golive'));
        $show->field('real_golive', __('Real golive'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('deleted_at', __('Deleted at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new TranSupervisi());
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
            //$tools->disableList();
        });
        $form->tab('Update Inventory', function (Form $form) {
            $form->hidden('id');
            $form->text('project_name', __('LOP SITE ID'))->readonly();
            $form->select('status_gl_sdi', __('STATUS GL SDI'))
                ->options([
                    'NO DATA' => 'NO DATA',
                    'VALIDASI ABD' => 'VALIDASI ABD',
                    'DRAWING' => 'DRAWING',
                    'INVENTORY' => 'INVENTORY',
                    'TERMINASI UIM' => 'TERMINASI UIM',
                    'GOLIVE PARSIAL' => 'GOLIVE PARSIAL',
                    'GOLIVE' => 'GOLIVE',
                    'KENDALA' => 'KENDALA',
                ])->default('NO DATA');
            $form->textarea('ket_gl_sdi', __('KET GL SDI'))->help('(JIKA STATUS GL nya : KENDALA)');
            //$form->text('status_abd', __('STATUS ABD'));
            $form->select('status_abd', __('STATUS ABD'))
            ->options([
                'NO DATA' => 'NO DATA',
                'COMPLETING ABD' => 'COMPLETING ABD',
                'QE NEEDED' => 'QE NEEDED',
                'OLT NEEDED' => 'OLT NEEDED',
                
            ])->default('NO DATA');
            $form->text('id_sw', __('ID SW'));
            $form->text('id_imon', __('ID IMON'));
            //$form->text('odp_port', __('ODP PORT'));

            $form->date('plan_golive', __('PLAN GOLIVE'));
            $form->date('real_golive', __('REAL GOLIVE'));
        })->tab('Registrasi ODP', function (Form $form) {
            $form->hasMany('namaOdp', 'Nama ODP', function (Form\NestedForm $form) {
                $form->text('nama_odp', 'Nama ODP');
                $form->select('jenis_odp', 'Jenis ODP')->options(['ODP 8' => 'ODP 8', 'ODP 16' => 'ODP 16']);
            });
        });

        // callback after save
        $form->saved(function (Form $form) {
            $countOdp8 = TranOdp::where("supervisi_id", $form->id)->where('jenis_odp', '=', 'ODP 8')->count();
            $countOdp16 = TranOdp::where("supervisi_id", $form->id)->where('jenis_odp', '=', 'ODP 16')->count();
            $rumusOdp8 = $countOdp8 * 8;
            $rumusOdp16 = $countOdp16 * 16;
            TranSupervisi::where("id", $form->id)
                ->update([
                    'odp_8' => $countOdp8,
                    'odp_16' => $countOdp16,
                    'odp_port' => $rumusOdp8 + $rumusOdp16,
                    'real_port' => $rumusOdp8 + $rumusOdp16,
                ]);
        });



        return $form;
    }
}
