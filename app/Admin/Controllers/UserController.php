<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\DB;
use Encore\Admin\Widgets\Box;
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
        $grid->model()->orderBy('id','desc');
        $grid->header(function ($query) {

            $gender = $query->select(DB::raw('count(mini_openid) as count, is_sub'))
                ->groupBy('is_sub')->get()->pluck('count', 'is_sub')->toArray();
            if(!isset($gender['1'])){
                $gender['1'] =0;
            }
            $doughnut = view('admin.chart.sub', compact('gender'));
        
            return new Box('订阅比例', $doughnut);
        });
        $grid->column('id', __('Id'))->sortable();
        $grid->column('username', __('姓名'));
        $grid->column('mini_openid', __('小程序openid'));
        $grid->column('is_sub', __('是否订阅消息'))->display(function($is_sub){
            return $is_sub?'已订阅':'未订阅';
        })->sortable();
        $grid->column('created_at', __('创建时间'));

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
