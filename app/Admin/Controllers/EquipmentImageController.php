<?php

namespace App\Admin\Controllers;

use App\Models\equipmentImagesModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class EquipmentImageController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'equipmentImagesModel';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new equipmentImagesModel());

        $grid->column('equipment_image_id', __('Equipment image id'));
        $grid->column('equipment_image_path', __('Equipment image path'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('equipment_id', __('Equipment id'));

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
        $show = new Show(equipmentImagesModel::findOrFail($id));

        $show->field('equipment_image_id', __('Equipment image id'));
        $show->field('equipment_image_path', __('Equipment image path'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('equipment_id', __('Equipment id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new equipmentImagesModel());

        $form->text('equipment_image_path', __('Equipment image path'));
        $form->number('equipment_id', __('Equipment id'));

        return $form;
    }
}
