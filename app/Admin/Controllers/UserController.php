<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '用户列表';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('Id'));
        $grid->column('username', __('姓名'));
        $grid->column('email', __('邮箱')); 
        $grid->column('location', __('地址'));
        $grid->column('lastloginip', __('最后登录ip')); 
        $grid->column('lastlogintimename', __('最后登录时间'));
        $grid->column('had_not_login_days', __('未登录天数'));
        
        $grid->disableCreateButton();
        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableView();
            $actions->disableEdit();
            $actions->disableDelete();
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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('username', __('Username'));
        $show->field('password', __('Password'));
        $show->field('remember_token', __('Remember token'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('token', __('Token'));
        $show->field('lastloginip', __('Lastloginip'));
        $show->field('lastlogintime', __('Lastlogintime'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User());

        $form->text('username', __('Username'));
        $form->password('password', __('Password'));
        $form->text('remember_token', __('Remember token'));
        $form->text('token', __('Token'));
        $form->text('lastloginip', __('Lastloginip'));
        $form->number('lastlogintime', __('Lastlogintime'));

        return $form;
    }
}
