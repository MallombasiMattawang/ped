<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\MstWitel;
//use Encore\Admin\Admin;
use App\Models\LogActual;
use App\Models\MstProject;
use App\Admin\Forms\addPlan;
use App\Models\MstWaspangUt;
use App\Models\TranBaseline;
use Encore\Admin\Layout\Row;

use Illuminate\Http\Request;
use App\Models\TranSupervisi;
use Encore\Admin\Widgets\Box;
use App\Admin\Forms\addActual;
use App\Admin\Forms\addApprove;
use App\Models\RefListActivity;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Facades\DB;
use App\Admin\Actions\Project\Plan;
use App\Admin\Forms\addAdministrasi;
use App\Admin\Actions\Project\Actual;
use App\Admin\Actions\Project\Baseline;
use App\Admin\Actions\Project\ActualActivity;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Controllers\AdminController;

class TranSupervisiController extends AdminController
{
  /**
   * Title for current resource.
   *
   * @var string
   */
  protected $title = 'TABLE SUPERVISI';

  /**
   * Make a grid builder.
   *
   * @return Grid
   */
  protected function grid()
  {

    $grid = new Grid(new TranSupervisi());
    if (Admin::user()->inRoles(['mitra'])) {
      $grid->model()->where('mitra_id', '=', Admin::user()->id);
      // $grid->model()->where('task', '=', 'PENGISIAN ACTUAL');
      // $grid->model()->orwhere('task', '=', 'PENGISIAN PLAN BY MITRA');
    }
    if (Admin::user()->inRoles(['waspang'])) {

      $grid->model()->where('waspang_id', '=', Admin::user()->id);
    }
    if (Admin::user()->inRoles(['tim-ut'])) {

      $grid->model()->where('tim_ut_id', '=', Admin::user()->id);
    }
    $grid->disableCreateButton();
    $grid->disableRowSelector();
    $grid->disableColumnSelector();
    $grid->actions(function ($actions) {

      $actions->disableEdit();
      $actions->disableDelete();
      $actions->disableView();
      if (Admin::user()->inRoles(['mitra'])) {

        if ($actions->row->task == 'PENGISIAN PLAN BY MITRA' || $actions->row->task == 'PENGISIAN ACTUAL') {
          $actions->add(new Plan);
          if ($actions->row->task == 'PENGISIAN ACTUAL') {
            $actions->add(new Actual);
          }
        }
      }
      if (Admin::user()->inRoles(['waspang'])) {
        if ($actions->row->task == 'PENGISIAN ACTUAL') {
          $actions->add(new Actual);
        }
      }
      if (Admin::user()->inRoles(['tim-ut'])) {
        if ($actions->row->task == 'PENGISIAN ACTUAL') {
          $actions->add(new Actual);
        }
      }

      if (Admin::user()->inRoles(['administrator', 'hd-ped'])) {
        $actions->add(new Baseline);

        $actions->add(new Actual);
      }
    });
    $grid->fixColumns(4, -1);


    $grid->column('supervisi_project.tematik', __('Tematik'))->help('This column is...');
    $grid->column('supervisi_project.witel_id', __('Witel'));
    $grid->column('supervisi_project.sto_id', __('STO'));
    $grid->column('project_name', __('Project name'));
    $grid->column('supervisi_project.mitra_id', __('Mitra'));
    $grid->column('supervisi_sap.kontrak', __('NO. SP TELKOM'));
    $grid->column('supervisi_waspang.name', __('Waspang id'));
    $grid->column('supervisi_tim_ut.name', __('TIM UT'));
   

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
    $show->field('project_id', __('Project id'));
    $show->field('project_name', __('Project name'));
    $show->field('waspang_id', __('Waspang id'));
    $show->field('tim_ut_id', __('Tim ut id'));
    $show->field('edc', __('Edc'));
    $show->field('toc', __('Toc'));
    $show->field('material_bast_1', __('Material bast 1'));
    $show->field('jasa_bast_1', __('Jasa bast 1'));
    $show->field('total_bast_1', __('Total bast 1'));
    $show->field('total_akhir', __('Total akhir'));
    $show->field('plan_homepass', __('Plan homepass'));
    $show->field('real_homepass', __('Real homepass'));
    $show->field('status_const', __('Status const'));
    $show->field('remarks', __('Remarks'));
    $show->field('progress_const', __('Progress const'));
    $show->field('tgl_selesai_ct', __('Tgl selesai ct'));
    $show->field('tgl_selesai_ut', __('Tgl selesai ut'));
    $show->field('tgl_rekon', __('Tgl rekon'));
    $show->field('tgl_bast_1', __('Tgl bast 1'));
    $show->field('durasi_ct', __('Durasi ct'));
    $show->field('durasi_rekon', __('Durasi rekon'));
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
    $show->field('status_doc', __('Status doc'));
    $show->field('posisi_doc', __('Posisi doc'));
    $show->field('progress_doc', __('Progress doc'));
    $show->field('created_at', __('Created at'));
    $show->field('updated_at', __('Updated at'));

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

    $form->number('project_id', __('Project id'));
    $form->text('project_name', __('Project name'));
    $form->number('waspang_id', __('Waspang id'));
    $form->number('tim_ut_id', __('Tim ut id'));
    $form->text('edc', __('Edc'));
    $form->text('toc', __('Toc'));
    $form->text('material_bast_1', __('Material bast 1'));
    $form->text('jasa_bast_1', __('Jasa bast 1'));
    $form->text('total_bast_1', __('Total bast 1'));
    $form->text('total_akhir', __('Total akhir'));
    $form->text('plan_homepass', __('Plan homepass'));
    $form->text('real_homepass', __('Real homepass'));
    $form->text('status_const', __('Status const'));
    $form->text('remarks', __('Remarks'));
    $form->text('progress_const', __('Progress const'));
    $form->text('tgl_selesai_ct', __('Tgl selesai ct'));
    $form->text('tgl_selesai_ut', __('Tgl selesai ut'));
    $form->text('tgl_rekon', __('Tgl rekon'));
    $form->text('tgl_bast_1', __('Tgl bast 1'));
    $form->text('durasi_ct', __('Durasi ct'));
    $form->text('durasi_rekon', __('Durasi rekon'));
    $form->text('status_gl_sdi', __('Status gl sdi'));
    $form->text('ket_gl_sdi', __('Ket gl sdi'));
    $form->text('status_abd', __('Status abd'));
    $form->text('id_sw', __('Id sw'));
    $form->text('id_imon', __('Id imon'));
    $form->text('odp_8', __('Odp 8'));
    $form->text('odp_16', __('Odp 16'));
    $form->text('ps_1_8', __('Ps 1 8'));
    $form->text('ps_1_16', __('Ps 1 16'));
    $form->text('odp_port', __('Odp port'));
    $form->text('nama_odp', __('Nama odp'));
    $form->text('plan_golive', __('Plan golive'));
    $form->text('real_golive', __('Real golive'));
    $form->text('status_doc', __('Status doc'));
    $form->text('posisi_doc', __('Posisi doc'));
    $form->text('progress_doc', __('Progress doc'));

    return $form;
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

  public function baseLineActivity(Content $content)
  {
    return Admin::content(function (Content $content) {

      $id = $_GET['id'];
      $project = MstProject::where("id", $id)->first();
      if ($project->status_project != 'DONE DRM') {
        return abort(404);
      }
      $checkBaseline = TranBaseline::where("project_id", $id)->exists();
      $content->header('Basline Activity Project');
      $content->description('');

      if ($checkBaseline == 1) {
        $lists = TranBaseline::where("project_id", $id)->get();
        $supervisi = TranSupervisi::where("project_id", $id)->first();
        $waspang = MstWaspangUt::join('admin_role_users', 'admin_users.id', '=', 'admin_role_users.user_id')->where('role_id', '=',  5)->get();
        $tim_ut = MstWaspangUt::join('admin_role_users', 'admin_users.id', '=', 'admin_role_users.user_id')->where('role_id', '=',  6)->get();
        $countBase = TranBaseline::where("project_id", $id)->where('bobot', '>=', '1')->count();
        $sumBase = TranBaseline::where("project_id", $id)->where('bobot', '>=', '1')->sum('bobot');
        $countPlan = TranBaseline::where("project_id", $id)->where('plan_durasi', '>=', '1')->count();
        $sumDurasi = TranBaseline::where("project_id", $id)->where('plan_durasi', '>=', '1')->sum('plan_durasi');
        $content->body(view('admin.modul_baseline.update', [
          'project' => $project,
          'countBase' => $countBase,
          'sumBase' => $sumBase,
          'countPlan' => $countPlan,
          'sumDurasi' =>  $sumDurasi,
          'lists' => $lists,
          'id' => $id,
          'waspang' => $waspang,
          'tim_ut' => $tim_ut,
          'supervisi' => $supervisi
        ]));
      } else {
        $lists = RefListActivity::all();
        $supervisi = TranSupervisi::where("project_id", $id)->first();
        $deliveryKabel = $project->panjang_feeder + $project->panjang_dist;
        $deliveryTiang = $project->tiang_baru;
        $deliveryOdp =  $project->odp_odp_8 + $project->odp_odp_16;
        $deliveryOdc =  $project->odc_total;
        $penarikanFeeder = $project->panjang_feeder;
        $penarikanDist = $project->panjang_dist;
        $countBase = 0;
        $countPlan = 0;
        $sumDurasi = 0;
        $content->body(view('admin.modul_baseline.generate', [
          'project' => $project,
          'deliveryKabel' => $deliveryKabel,
          'deliveryTiang' => $deliveryTiang,
          'deliveryOdp' => $deliveryOdp,
          'deliveryOdc' => $deliveryOdc,
          'penarikanFeeder' => $penarikanFeeder,
          'penarikanDist' => $penarikanDist,
          'countBase' => $countBase,
          'countPlan' => $countPlan,
          'sumDurasi' =>  $sumDurasi,
          'lists' => $lists,
          'supervisi' => $supervisi
          //'id' => $id,

        ]));
      }
    });
  }

  public function baseLineActivityAdd(Request $request)
  {

    $request->validate([
      'volume.*' => 'required|numeric|gt:0',
      'bobot.*' => 'required|numeric|gt:0',
      'total_bobot' => 'required|numeric|min:100|max:100'
    ]);

    foreach ($_POST['activity_id'] as $row => $value) {

      $tranBaseline = TranBaseline::create([
        'project_id' => $request->project_id,
        'activity_id' => $_POST['activity_id'][$row],
        'category_id' => $_POST['category_id'][$row],
        'list_activity' => $_POST['list_activity'][$row],
        'bobot' => $_POST['bobot'][$row],
        'volume' => $_POST['volume'][$row],
        'satuan' => $_POST['satuan'][$row],

      ]);

      $tranBaseline->save();

      TranSupervisi::where("project_id", $request->project_id)
        ->update([
          'task' =>  'PENENTUAN WASPANG DAN TIM UT'
        ]);
    }

    admin_success('Baseline Activity Project Updated');
    admin_toastr('Baseline Activity Project Updated', 'success');
    return back();
  }

  public function baseLineActivityUpdate(Request $request)
  {
    $request->validate([
      'volume.*' => 'required|numeric|gt:0',
      'bobot.*' => 'required|numeric|gt:0',
      'total_bobot' => 'required|numeric|min:100|max:100',
      'waspang_id' =>  'required',
      'tim_ut_id' =>  'required',
    ]);

    TranSupervisi::where("project_id", $request->project_id)
      ->update([
        'waspang_id' =>  $request->waspang_id,
        'tim_ut_id' =>  $request->tim_ut_id,
        'task' =>  'PENGISIAN PLAN BY MITRA'
      ]);
    foreach ($_POST['activity_id'] as $row => $value) {
      TranBaseline::where("id", $_POST['activity_id'][$row])
        ->update([
          'bobot' => $_POST['bobot'][$row],
          'volume' => $_POST['volume'][$row],
          'satuan' => $_POST['satuan'][$row],

        ]);
    }

    admin_success('Baseline Activity Project Updated');
    admin_toastr('Baseline Activity Project Updated', 'success');
    return back();
  }

  public function planActivity(Content $content)
  {
    return Admin::content(function (Content $content) {

      $id = $_GET['id'];
      $project = MstProject::where("id", $id)->first();
      $supervisi = TranSupervisi::where("project_id", $id)->first();
      if ($supervisi->mitra_id != Admin::user()->id) {
        return abort(404);
      }
      //$checkBaseline = TranBaseline::where("project_id", $id)->exists();
      $content->header('Create Plan Activity Project');
      $content->description('');

      //if ($checkBaseline == 1) {
      $lists = TranBaseline::where("project_id", $id)->get();

      $waspang = MstWaspangUt::join('admin_role_users', 'admin_users.id', '=', 'admin_role_users.user_id')->where('role_id', '=',  5)->get();
      $tim_ut = MstWaspangUt::join('admin_role_users', 'admin_users.id', '=', 'admin_role_users.user_id')->where('role_id', '=',  6)->get();
      $countBase = TranBaseline::where("project_id", $id)->where('bobot', '>=', '1')->count();
      $sumBase = TranBaseline::where("project_id", $id)->where('bobot', '>=', '1')->sum('bobot');
      $countPlan = TranBaseline::where("project_id", $id)->where('plan_durasi', '>=', '1')->count();
      $sumDurasi = TranBaseline::where("project_id", $id)->where('plan_durasi', '>=', '1')->sum('plan_durasi');
      $content->body(view('admin.modul_plan.update', [
        'project' => $project,
        'countBase' => $countBase,
        'sumBase' => $sumBase,
        'countPlan' => $countPlan,
        'sumDurasi' =>  $sumDurasi,
        'lists' => $lists,
        'id' => $id,
        'waspang' => $waspang,
        'tim_ut' => $tim_ut,
        'supervisi' => $supervisi
      ]));
      //}
    });
  }



  public function addPlan(Content $content)
  {
    return $content
      ->title('Plan Activity')
      ->body(new addPlan());
  }



  public function submitPlan(Request $request)
  {
    MstProject::where("id", $request->id)
      ->update([
        'status_plan' => '1',
      ]);

    TranSupervisi::where("project_id", $request->id)
      ->update([
        'task' => 'PENGISIAN ACTUAL',
      ]);
    admin_success('Submit Plan Success!');
    admin_toastr('Submit Plan Success!', 'success');
    return back();
  }


  public function actualActivity(Content $content)
  {
    return Admin::content(function (Content $content) {

      $id = $_GET['id'];
      $project = MstProject::where("id", $id)->first();
      $supervisi = TranSupervisi::where("project_id", $id)->first();
      if (Admin::user()->inRoles(['mitra'])) {
        if ($supervisi->mitra_id != Admin::user()->id) {
          return abort(404);
        }
      }

      if (Admin::user()->inRoles(['waspang'])) {
        if ($supervisi->waspang_id != Admin::user()->id) {
          return abort(404);
        }
      }


      $content->header('Lembar Kerja');
      $content->description('Create Actual Activity Project');


      $lists = TranBaseline::where("project_id", $id)->get();


      $waspang = MstWaspangUt::join('admin_role_users', 'admin_users.id', '=', 'admin_role_users.user_id')->where('role_id', '=',  5)->get();
      $tim_ut = MstWaspangUt::join('admin_role_users', 'admin_users.id', '=', 'admin_role_users.user_id')->where('role_id', '=',  6)->get();
      $countBase = TranBaseline::where("project_id", $id)->where('bobot', '>=', '1')->count();
      $sumBase = TranBaseline::where("project_id", $id)->where('bobot', '>=', '1')->sum('bobot');
      $countPlan = TranBaseline::where("project_id", $id)->where('plan_durasi', '>=', '1')->count();
      $sumDurasi = TranBaseline::where("project_id", $id)->where('plan_durasi', '>=', '1')->sum('plan_durasi');
      $countActual = TranBaseline::where("project_id", $id)->where('actual_finish', '>=', '1')->count();

      $cek_last_preparing = TranBaseline::select('actual_finish')
        ->where('project_id', $id)
        ->where('activity_id', 2)
        ->first();
      $cek_all_delivery = TranBaseline::select('actual_finish')
        ->where('project_id', $id)
        ->whereBetween('activity_id', [3, 9])->count();

      $cek_all_delivery_finish = TranBaseline::select('actual_finish')
        ->where('project_id', $id)
        ->whereNotNull('actual_finish')
        ->whereBetween('activity_id', [3, 9])->count();

      $cek_all_installasi = TranBaseline::select('actual_finish')
        ->where('project_id', $id)
        ->whereBetween('activity_id', [10, 19])->count();

      $cek_all_installasi_finish = TranBaseline::select('actual_finish')
        ->where('project_id', $id)
        ->whereNotNull('actual_finish')
        ->whereBetween('activity_id', [10, 19])->count();

      $cek_commisioning_tes = TranBaseline::select('actual_finish')
        ->where('project_id', $id)
        ->whereNotNull('actual_finish')
        ->where('activity_id', 20)->exists();

      $cek_ut = TranBaseline::select('actual_finish')
        ->where('project_id', $id)
        ->whereNotNull('actual_finish')
        ->where('activity_id', 21)->exists();

      $cek_rekon = TranBaseline::select('actual_finish')
        ->where('project_id', $id)
        ->whereNotNull('actual_finish')
        ->where('activity_id', 22)->exists();

      $content->body(view('admin.modul_actual.update', [
        'project' => $project,
        'countBase' => $countBase,
        'sumBase' => $sumBase,
        'countPlan' => $countPlan,
        'countActual' => $countActual,
        'sumDurasi' =>  $sumDurasi,
        'lists' => $lists,
        'id' => $id,
        'waspang' => $waspang,
        'tim_ut' => $tim_ut,
        'supervisi' => $supervisi,
        'cek_last_preparing' => $cek_last_preparing,
        'cek_all_delivery' => $cek_all_delivery,
        'cek_all_delivery_finish' => $cek_all_delivery_finish,
        'cek_all_installasi' => $cek_all_installasi,
        'cek_all_installasi_finish' => $cek_all_installasi_finish,
        'cek_commisioning_tes' => $cek_commisioning_tes,
        'cek_ut' => $cek_ut,
        'cek_rekon' => $cek_rekon,

      ]));
    });
  }

  public function addActual(Content $content)
  {
    return $content
      ->title('Actual Activity')
      ->body(new addActual());
  }

  // public function addApprove(Content $content)
  // {
  //   return $content
  //     ->title('Approval Activity')
  //     ->body(new addApprove());
  // }

  public function addApprove(Content $content)
  {
    return $content
      ->title('Approval Actual')
      ->row(function (Row $row) {
        $id = $_GET['id'];
        $log = LogActual::where('tran_baseline_id', $id)->get();
        $baseline = TranBaseline::findOrFail($id);
        $supervisi = TranSupervisi::where('project_id', $baseline->project_id)->first();
        $approvalBy = 'WASPANG';
        if ($baseline->activity_id == 21) {
          $approvalBy = 'TIM UT';
        }
        $data = view('admin.modul_actual.approval', [
          'log' => $log,
          'baseline' => $baseline,
          'supervisi' => $supervisi,
          'approvalBy' => $approvalBy
        ]);
        $row->column(12, new Box('Approval By ' . $approvalBy, $data));
      });
  }

  public function saveApprove(Request $request)
  {
    print_r($_POST);
    $waspangBy = NULL;
    $tim_utBy = NULL;
    $approval_waspang = '';
    $approval_ut = '';

    $log = LogActual::where('id', $request->id)->first();
    $baseline = TranBaseline::where('id', $log->tran_baseline_id)->first();
    $supervisi = TranSupervisi::where('project_id', $baseline->project_id)->first();

    if ($baseline->activity_id >= 1 && $baseline->activity_id <= 20) {
      $approval_waspang = $request->approval;
      $waspangBy = Admin::user()->id;
    }
    if ($baseline->activity_id == 21) {
      $approval_ut = $request->approval;
      $tim_utBy = Admin::user()->id;
    }

    //INITIAL VARIABEL
    $actual_status = $log->actual_status;
    $actual_start =  $log->actual_start;
    $actual_finish = null;
    $actual_durasi = null;
    $actual_progress = $log->actual_progress;
    $actual_volume = $log->actual_volume;

    $status_const = $supervisi->status_const;
    $status_doc = $supervisi->status_doc;

    //STATUS CONSTS BELUM
    if ($actual_status == 'belum') {
      $actual_start = date('Y-m-d');
      $actual_task = 'NEED UPDATED';
    }
    //STATUS CONSTS SELESAI
    if ($actual_status == 'selesai') {
      if ($actual_start == null) {
        $actual_start = date('Y-m-d');
      }
      $actual_finish = date('Y-m-d');
      $actual_task = 'APPROVED';
      $actual_progress = 100;
      $start = strtotime($actual_start);
      $finish = strtotime($actual_finish);

      $jarak = $finish - $start;
      $actual_durasi = $jarak / 60 / 60 / 24;
      $actual_durasi = $actual_durasi + 1;

      // CARI STATUS CONST

      if ($baseline->activity_id >= 3 && $baseline->activity_id <= 9) {
        $cek_const = TranBaseline::select('actual_start, actual_finish')
          ->where('project_id', $baseline->project_id)
          ->whereBetween('activity_id', [3, 9])->count();
        $cek_const_actual = TranBaseline::select('actual_start, actual_finish')
          ->where('project_id', $baseline->project_id)
          ->whereNotNull('actual_start')
          ->whereBetween('activity_id', [3, 9])->count();
        if ($cek_const_actual == $cek_const) {
          $status_const = "MATERIAL DELIVERY ON SITE";
        }
      }

      if ($baseline->activity_id >= 10 && $baseline->activity_id <= 19) {
        $cek_const = TranBaseline::select('actual_start, actual_finish')
          ->where('project_id', $baseline->project_id)
          ->whereBetween('activity_id', [10, 19])->count();
        $cek_const_actual = TranBaseline::select('actual_start, actual_finish')
          ->where('project_id', $baseline->project_id)
          ->whereNotNull('actual_start')
          ->whereBetween('activity_id', [10, 19])->count();
        if ($cek_const_actual == $cek_const) {
          $status_const = 'INSTALL DONE';
        }
      }
      if ($baseline->activity_id == 20) {
        $status_const = 'SELESAI CT';
      }
      if ($baseline->activity_id == 21) {
        $status_const = 'SELESAI UT';
      }


      //CARI STATUS DOC 
      //$status_doc = '';
      if ($baseline->activity_id >= 1 && $baseline->activity_id <= 21) {
        $status_doc = 'KONSTRUKSI';
      }
      if ($baseline->activity_id >= 22 && $baseline->activity_id <= 23) {
        $status_doc = 'ADMINISTRASI';
      }
    }
    // UPDATE LOG ATUAL
    LogActual::where("id", $log->id)
      ->update([
        'approval_waspang' => $approval_waspang,
        'approval_tim_ut' => $approval_ut,
        'approval_message' =>  $request->approval_message,
        'actual_start' => $actual_start,
        'actual_finish' => $actual_finish,
        'actual_progress' =>  $actual_progress,
        'actual_volume' =>  $actual_volume,
        'actual_durasi' => $actual_durasi,
        'waspang_by' => $waspangBy,
        'tim_ut_by' => $tim_utBy,
      ]);
    //JIKA DIREJECT
    if ($approval_waspang == 'reject' || $approval_ut == 'reject') {
      $actual_start = null;
      $actual_finish = null;
      $actual_task = 'REJECTED';

      // UPDATE LOG ATUAL
      LogActual::where("tran_baseline_id", $baseline->id)->where('approval_waspang', NULL)
        ->update([
          'approval_waspang' => $approval_waspang,
          'approval_tim_ut' => $approval_ut,
          'approval_message' =>  $request->approval_message,
          'waspang_by' => $waspangBy,
          'tim_ut_by' => $tim_utBy,
        ]);

      // UPDATE ACTUAL DI TRANSBASELINE    
      $log = LogActual::where('tran_baseline_id', $baseline->id)->where('approval_waspang', 'approve')->orderBy('id', 'DESC')->first();
      //   print_r($log);
      // die();
      $baseline = TranBaseline::where('id', $log->tran_baseline_id)->first();
      TranBaseline::where("id", $baseline->id)
        ->update([
          'approval_waspang' => $log->approval_waspang,
          'approval_tim_ut' => $log->approval_tim_ut,
          'approval_message' =>  $log->approval_message,
          'actual_start' => $log->actual_start,
          'actual_finish' => $log->actual_finish,
          'actual_task' =>  'NEED UPDATED',
          'actual_progress' =>  $log->actual_progress,
          'actual_volume' =>  $log->actual_volume,
          'actual_durasi' => $log->actual_durasi,
          'waspang_by' => $log->waspang_by,
          'tim_ut_by' => $log->tim_ut_by,
        ]);
    } else if ($approval_waspang == 'approve' || $approval_ut == 'approve') {
      // UPDATE ACTUAL DI TRANSBASELINE    
      TranBaseline::where("id", $baseline->id)
        ->update([
          'approval_waspang' => $approval_waspang,
          'approval_tim_ut' => $approval_ut,
          'approval_message' =>  $request->approval_message,
          'actual_start' => $actual_start,
          'actual_finish' => $actual_finish,
          'actual_task' =>  $actual_task,
          'actual_progress' =>  $actual_progress,
          'actual_volume' =>  $actual_volume,
          'actual_durasi' => $actual_durasi,
          'waspang_by' => $waspangBy,
          'tim_ut_by' => $tim_utBy,
        ]);

      //update dokumen di supervisi
      $posisi_doc = '';
      $progress_doc = '';
      if ($approval_ut == 'approve') {
          $status_doc = 'ADMINISTRASI';
          $posisi_doc = 'MITRA AREA';
          $progress_doc = 'PEMBUATAN DOC';
      }
      TranSupervisi::where("project_id", $baseline->project_id)
        ->update([
          'status_const' => $status_const,
          'status_doc' => $status_doc,
          'posisi_doc' => $posisi_doc,
          'progress_doc' => $progress_doc
        ]);
    }





    admin_success('Processed successfully.');

    return redirect()->back();
    //return redirect('/ped-panel/actual-generate?id=' . $baseline->project_id);
  }


  public function addAdministrasi(Content $content)
  {
    return $content
      ->title('Administrasi Activity')
      ->body(new addAdministrasi());
  }
}
