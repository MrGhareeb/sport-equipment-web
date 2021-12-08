<?php

namespace App\Admin\Controllers;

use App\Models\EquipmentStatusModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class EquipmentStatusController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'EquipmentStatusModel';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new EquipmentStatusModel());

        $grid->column('equipment_status_id', __('Equipment status id'));
        $grid->column('equipment_status_value', __('Equipment status value'));
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
        $show = new Show(EquipmentStatusModel::findOrFail($id));

        $show->field('equipment_status_id', __('Equipment status id'));
        $show->field('equipment_status_value', __('Equipment status value'));
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
        $form = new Form(new EquipmentStatusModel());

        $form->text('equipment_status_value', __('Equipment status value'));

        return $form;
    }
}
