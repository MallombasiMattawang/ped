<?php

namespace App\Admin\Controllers;

use App\Models\Planning;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PlanningController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Planning';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Planning());

        $grid->column('id', __('Id'));
        $grid->column('tematik', __('Tematik'));
        $grid->column('witel', __('Witel'));
        $grid->column('sto', __('Sto'));
        $grid->column('sitename', __('Sitename'));
        $grid->column('port_odp', __('Port odp'));
        $grid->column('total', __('Total'));
        $grid->column('value_capex_perport', __('Value capex perport'));
        $grid->column('mitra', __('Mitra'));
        $grid->column('status_project', __('Status project'));
        $grid->column('start_date', __('Start date'));
        $grid->column('end_date', __('End date'));
       

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
        $show = new Show(Planning::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('tematik', __('Tematik'));
        $show->field('witel', __('Witel'));
        $show->field('sto', __('Sto'));
        $show->field('sitename', __('Sitename'));
        $show->field('port_odp', __('Port odp'));
        $show->field('total', __('Total'));
        $show->field('value_capex_perport', __('Value capex perport'));
        $show->field('mitra', __('Mitra'));
        $show->field('status_project', __('Status project'));
        $show->field('start_date', __('Start date'));
        $show->field('end_date', __('End date'));
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
        $form = new Form(new Planning());

        $form->text('tematik', __('Tematik'));
        $form->text('witel', __('Witel'));
        $form->text('sto', __('Sto'));
        $form->text('sitename', __('Sitename'));
        $form->text('port_odp', __('Port odp'));
        $form->text('total', __('Total'));
        $form->text('value_capex_perport', __('Value capex perport'));
        $form->text('mitra', __('Mitra'));
        $form->text('status_project', __('Status project'));
        $form->date('start_date', __('Start date'))->default(date('Y-m-d'));
        $form->date('end_date', __('End date'))->default(date('Y-m-d'));

        return $form;
    }
}
