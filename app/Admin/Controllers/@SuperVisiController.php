<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\MstProject;
use App\Admin\Forms\addActual;
use Encore\Admin\Facades\Admin;
use App\Admin\Actions\Project\Baseline;
use App\Admin\Actions\Project\ActualActivity;
use Encore\Admin\Controllers\AdminController;

class SuperVisiController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Supervisi Project';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new MstProject());
        $grid->model()->where('status_project', '=', 'DONE DRM');
        if (Admin::user()->inRoles(['mitra'])) {
            $grid->model()->where('mitra_id', '=', Admin::user()->name);
           
        }

        if (Admin::user()->inRoles(['witel'])) {
            $grid->model()->where('witel_id', '=', 'SULSELBAR');
            //$grid->model()->where('status_project', '=', 'GRM');
        }

        if (Admin::user()->inRoles(['hd-ped', 'witel'])) {
            $grid->tools(function ($tools) {

                $tools->append('<a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#importExcel"><i class="fa fa-file-excel-o"></i>  Import Project</a>');
                $tools->append('<a href="/uploads/template_excel/PROJECT.xlsx" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-file-excel-o"></i>  Template Excel</a>');
            });
        }

        $grid->actions(function ($actions) {

            $actions->disableEdit();
            $actions->disableDelete();
            $actions->disableView();

            $actions->add(new ActualActivity);
            $actions->add(new Baseline);
        });

        $grid->filter(function ($filter) {
            // Remove the default id filter
            $filter->disableIdFilter();
            $filter->column(1 / 2, function ($filter) {
                $filter->like('lop_site_id', 'LOP / SITE ID');
                $filter->like('tematik', 'TEMATIK');
                $filter->like('witel_id', 'WITEL');
                $filter->like('mitra_id', 'MITRA');
                $filter->like('waspang_id', 'WASPANG');
            });

            $filter->column(1 / 2, function ($filter) {
                $filter->in('status_project', 'STATUS PROJECT')->multipleSelect(['USULAN' => 'USULAN', 'DONE DRM' => 'DONE DRM', 'PELIMPAHAN' => 'PELIMPAHAN', 'PO/SP' => 'PO/SP', 'DROP' => 'DROP']);
                $filter->between('start_date', 'START DATE')->date();
                $filter->between('end_date', 'END DATE')->date();
            });
        });

        $grid->column('tipe_project', __('TIPE PROJECT'))->width(200)->hide();
        $grid->column('tematik', __('TEMATIK'))->width(100)->sortable();


        $grid->column('witel_id', __('WITEL'))->width(200)->sortable();
        $grid->column('sto_id', __('STO'))->width(200)->sortable();
        $grid->column('lop_site_id', __('LOP / SITE ID'))->width(200)->sortable();
        $grid->column('mitra_id', __('MITRA'))->width(200)->sortable();
        
        $grid->column('sap.kontrak', __('NO.SP TELKOM '))->width(200)->sortable();
        $grid->column('waspang_id', __('WASPANG'))->width(200)->sortable();
        $grid->column('tim_ut', __('TIM UT'))->width(200)->sortable();
        $grid->column('status_update', __('STATUS UPDATE'))->width(200)->sortable();
        $grid->column('progress_plan', __('PROGRESS PLAN'))->width(200)->sortable();
        $grid->column('progress_actual', __('PROGRESS ACTUAL'))->width(200)->sortable();



        return $grid;
    }
}
