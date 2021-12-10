<?php

namespace App\Admin\Controllers;

use App\Models\EquipmentTransferModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class EquipmentTransferController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'EquipmentTransferModel';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new EquipmentTransferModel());

        $grid->column('equipment_transfer_id', __('Equipment transfer id'));
        $grid->column('equipment_transfer_token', __('Equipment transfer token'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('equipment_id', __('Equipment id'));
        $grid->column('user_id', __('User id'));
        $grid->column('new_user_id', __('New user id'));

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
        $show = new Show(EquipmentTransferModel::findOrFail($id));

        $show->field('equipment_transfer_id', __('Equipment transfer id'));
        $show->field('equipment_transfer_token', __('Equipment transfer token'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('equipment_id', __('Equipment id'));
        $show->field('user_id', __('User id'));
        $show->field('new_user_id', __('New user id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new EquipmentTransferModel());

        $form->text('equipment_transfer_token', __('Equipment transfer token'));
        $form->number('equipment_id', __('Equipment id'));
        $form->number('user_id', __('User id'));
        $form->number('new_user_id', __('New user id'));

        return $form;
    }
}
