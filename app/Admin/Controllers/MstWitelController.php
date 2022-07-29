<?php

namespace App\Admin\Controllers;

use App\Models\MstWitel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MstWitelController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Data WITEL';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new MstWitel());

        $grid->column('code', __('Code'));
        $grid->column('name', __('Name'))->sortable();      
       // $grid->column('active', __('Active'));
        $grid->column('active')->icon([
            0 => 'toggle-off',
            1 => 'toggle-on',
        ], $default = '');
        
       

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
        $show = new Show(MstWitel::findOrFail($id));

        $show->field('code', __('Code'));
        $show->field('name', __('Name'));
        $show->field('desc', __('Desc'));
        $show->field('active', __('Active'));
        

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new MstWitel());

        $form->text('code', __('Code'));
        $form->text('name', __('Name'));
        $form->textarea('desc', __('Desc'));        
        $form->radio('active',  __('Active'))->options(['0' => 'NO', '1'=> 'YES'])->default('1');

        return $form;
    }
}
