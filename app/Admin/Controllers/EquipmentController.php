<?php

namespace App\Admin\Controllers;

use App\Models\EquipmentModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class EquipmentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'EquipmentModel';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new EquipmentModel());

        $grid->column('equipment_id', __('Equipment id'));
        $grid->column('equipment_name', __('Equipment name'));
        $grid->column('equipment_description', __('Equipment description'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('user_id', __('User id'));
        $grid->column('equipment_status_id', __('Equipment status id'));
        $grid->column('equipment_type_id', __('Equipment type id'));

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
        $show = new Show(EquipmentModel::findOrFail($id));

        $show->field('equipment_id', __('Equipment id'));
        $show->field('equipment_name', __('Equipment name'));
        $show->field('equipment_description', __('Equipment description'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('user_id', __('User id'));
        $show->field('equipment_status_id', __('Equipment status id'));
        $show->field('equipment_type_id', __('Equipment type id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new EquipmentModel());

        $form->text('equipment_name', __('Equipment name'));
        $form->text('equipment_description', __('Equipment description'));
        $form->number('user_id', __('User'));
        $form->number('equipment_status_id', __('Equipment status'));
        $form->number('equipment_type_id', __('Equipment type'));

        return $form;
    }
}
