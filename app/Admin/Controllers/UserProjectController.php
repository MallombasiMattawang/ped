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

//use Illuminate\Http\Request;
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
use App\Admin\Actions\Project\Administrasi;
use App\Admin\Forms\addApproveAdministrasi;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Controllers\AdminController;
use App\Admin\Extensions\Tools\GridView;
use Illuminate\Support\Facades\Request;


class UserProjectController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'MANAJEMEN PROJECT';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TranSupervisi);
        if (Admin::user()->inRoles(['mitra'])) {
            $grid->model()->where('mitra_id', '=', Admin::user()->id);
            $grid->model()->where('task', '!=', 'CREATE BASELINE');
        }
        if (Admin::user()->inRoles(['waspang'])) {

            $grid->model()->where('waspang_id', '=', Admin::user()->id);
        }
        if (Admin::user()->inRoles(['tim-ut'])) {

            $grid->model()->where('tim_ut_id', '=', Admin::user()->id);
        }
        $grid->filter(function ($filter) {
            // Remove the default id filter
            $filter->disableIdFilter();

            $filter->column(1 / 2, function ($filter) {
                $filter->like('project_name', 'LOP / SITE ID');
                $filter->like('supervisi_project.witel_id', 'WITEL');
                $filter->like('supervisi_project.mitra_id', 'MITRA');
                //$filter->in('supervisi_project.status_project', 'STATUS PROJECT')->multipleSelect(['USULAN' => 'USULAN', 'DONE DRM' => 'DONE DRM', 'PELIMPAHAN' => 'PELIMPAHAN', 'PO' => 'PO/SP', 'DROP' => 'DROP']);
            });

            $filter->column(1 / 2, function ($filter) {
                $filter->like('supervisi_sap.kontrak', 'NO. SP TELKOM');
                // $filter->between('supervisi_project.start_date', 'START DATE')->date();
                // $filter->between('supervisi_project.end_date', 'END DATE')->date();
            });
        });
        $grid->column('supervisi_project.tematik', __('TEMATIK'));
        $grid->column('supervisi_project.witel_id', __('WITEL'));
        $grid->column('supervisi_project.sto_id', __('STO'));
        $grid->column('project_name', __('LOP/SITE ID'))->limit(30);
        $grid->column('supervisi_project.mitra_id', __('MITRA'))->limit(30);
        $grid->column('supervisi_sap.kontrak', __('NO. SP TELKOM'))->limit(30);
        $grid->column('supervisi_waspang.name', __('WASPANG'));
        $grid->column('supervisi_tim_ut.name', __('TIM UT'));
        $grid->column('status_const', __('STATUS CONSTS'))->limit(15);
        $grid->column('progress_actual', 'PROGRESS ACTUAL')->display(function ($progress_actual) {

            return "<span style='color:blue'>$progress_actual %</span>";
        });
        $grid->column('progress_plan', 'PROGRESS PLAN')->display(function ($progress_plan) {
            $today = date('Y-m-d');
            $project_id = $this->project_id;
            $start_date = MstProject::select('start_date')
                ->where('id', $this->project_id)
                ->first();
            $progress_plan = TranBaseline::where('project_id', $project_id)
                ->whereBetween('plan_finish', [$start_date->start_date, $today])
                ->sum('bobot');
            return "<span style='color:blue'>$progress_plan %</span>";
        });

        $grid->tools(function ($tools) {
            $tools->append(new GridView());
        });

        if (Request::get('view') !== 'table') {
            $grid->setView('admin.grid.card_user');
        }

        $grid->disableCreateButton();
        $grid->disableRowSelector();
        $grid->disableColumnSelector();
        $grid->actions(function ($actions) {

            $actions->disableEdit();
            $actions->disableDelete();
            $actions->disableView();
            if (Admin::user()->inRoles(['administrator', 'hd-ped'])) {
                $actions->add(new Baseline);
                if ($actions->row->task == 'PENGISIAN ACTUAL' || $actions->row->getOriginal('task') == 'ADMINISTRASI' || $actions->row->getOriginal('status_doc') == 'FINISH') {
                    $actions->add(new Actual);
                }
                if ($actions->row->getOriginal('status_doc') == 'ADMINISTRASI' || $actions->row->getOriginal('status_doc') == 'FINISH') {
                    $actions->add(new Administrasi);
                }
            }
            if (Admin::user()->inRoles(['waspang'])) {
                if ($actions->row->task == 'PENGISIAN ACTUAL' || $actions->row->getOriginal('task') == 'ADMINISTRASI' || $actions->row->getOriginal('status_doc') == 'FINISH') {
                    $actions->add(new Actual);
                }
            }
            if (Admin::user()->inRoles(['tim-ut'])) {
                if ($actions->row->task == 'PENGISIAN ACTUAL' || $actions->row->getOriginal('task') == 'ADMINISTRASI' || $actions->row->getOriginal('status_doc') == 'FINISH') {
                    $actions->add(new Actual);
                }
            }
            if (Admin::user()->inRoles(['mitra'])) {

                //if ($actions->row->getOriginal('supervisi_project.status_plan') == '1') {
                $actions->add(new Plan);
                //}
                if ($actions->row->getOriginal('task') == 'PENGISIAN ACTUAL' || $actions->row->getOriginal('task') == 'ADMINISTRASI' || $actions->row->getOriginal('status_doc') == 'FINISH') {
                    $actions->add(new Actual);
                }

                if ($actions->row->getOriginal('status_doc') == 'ADMINISTRASI' || $actions->row->getOriginal('status_doc') == 'FINISH') {
                    $actions->add(new Administrasi);
                }
                //dd($actions->row->getOriginal('status_doc'));



            }
        });
        //$grid->fixColumns(4, -1);
        // Admin::style('.table {

        //   }


        //   .table th {
        //     text-transform: uppercase;

        //     background-color: #ffffd5;
        //   }');
        return $grid;
    }
}
