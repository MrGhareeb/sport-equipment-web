<?php

namespace App\Admin\Controllers;

use App\Models\EquipmentTypeModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class EquipmentTypeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'EquipmentTypeModel';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new EquipmentTypeModel());

        $grid->column('equipment_type_id', __('Equipment type id'));
        $grid->column('equipment_type_value', __('Equipment type value'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(EquipmentTypeModel::findOrFail($id));

        $show->field('equipment_type_id', __('Equipment type id'));
        $show->field('equipment_type_value', __('Equipment type value'));
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
        $form = new Form(new EquipmentTypeModel());

        $form->number('equipment_type_id', __('Equipment type id'));
        $form->text('equipment_type_value', __('Equipment type value'));

        return $form;
    }
}
