<?php

namespace App\Admin\Controllers;

use App\Models\ListActivity;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ListActivityController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ListActivity';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ListActivity());

        $grid->column('id', __('Id'));
        $grid->column('category_id', __('Category id'));
        $grid->column('kode', __('Kode'));
        $grid->column('list_activity', __('List activity'));
       

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
        $show = new Show(ListActivity::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('category_id', __('Category id'));
        $show->field('kode', __('Kode'));
        $show->field('list_activity', __('List activity'));
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
        $form = new Form(new ListActivity());

        $form->number('category_id', __('Category id'));
        $form->text('kode', __('Kode'));
        $form->text('list_activity', __('List activity'));

        return $form;
    }
}
