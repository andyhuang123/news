<?php

namespace App\Admin\Controllers;

use App\Models\Activity;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Actions\Post\Replicate;

class ActivityController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Activity';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Activity());
        $grid->model()->orderBy('order','desc');
        $grid->column('id', __('Id'));
        $grid->column('appId', __('AppId'))->help('小程序appid');
        $grid->column('activity_id', __('Activity id'))->help('官方活动id');
        $grid->column('activity_title', __('活动名称'));
        $grid->column('image', __('活动封面'))->image();
        $grid->column('money', __('金额'))->editable();
        $grid->column('surplus', __('活动进度'))->editable();
        $states = [
            'on'  => ['value' => 1, 'text' => '开启', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '关闭', 'color' => 'danger'],
        ];
        $grid->column('is_open','是否开启')->switch($states);
        $grid->column('order', __('排序'))->editable();
        $grid->column('created_at', __('创建时间'));
        $grid->actions(function ($actions) {
            $actions->add(new Replicate());
            $actions->disableView();
        });
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
        $show = new Show(Activity::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('appId', __('AppId'));
        $show->field('activity_id', __('Activity id'));
        $show->field('activity_title', __('Activity title'));
        $show->field('image', __('Image'));
        $show->field('is_open', __('Is open'));
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
        $form = new Form(new Activity());

        $form->text('appId', __('小程序AppId'));
        $form->text('activity_id', __('活动官方id'));
        $form->text('activity_title', __('活动名称'));
        $form->image('image', __('活动封面'));
        $form->text('mini_path', __('小程序路径'));
        $form->number('money', __('金额'))->default(0);
        $form->number('surplus', __('进度'))->default(0);
        $form->number('order', __('排序'))->default(0);
        
        $isopen = [
            'on'  => ['value' => 1, 'text' => '开启', 'color' => 'info'],
            'off' => ['value' => 0, 'text' => '关闭', 'color' => 'danger'],
        ];
        
        $form->switch('is_open', '是否置顶')->states($isopen)->default(1);
       

        return $form;
    }
}
