<?php
namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use App\Models\WikiProject; 
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content; 
use Encore\Admin\Show;
use App\Admin\Actions\Post\GoEdit;
/***
 * Wiki 管理控制器
 * Class WikiProjectController
 * @ 
 */
class WikiProjectController extends AdminController
{
    
    /**
     * 首页，显示Wiki 项目列表
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content->title('Wiki管理')
            ->body($this->grid());

    }
 
    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(WikiProject::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('项目名称'));
        $show->field('description', __('项目描述'));
        $show->field('doc_count', __('文档数量'));
       

        return $show;
    }

    /**
     * Wiki项目列表
     */
    private function grid()
    {
        $grid = new Grid(new WikiProject());

        $grid->id('项目ID');
        $grid->name('项目名称');
        $grid->description('项目描述');
        $grid->doc_count('文档数量');
        $grid->type('类型')->display(function ($type) {
            switch ($type) {
                case WikiProject::$TYPE_PRIVATE:
                    return "<span class='label label-danger'>私密</span>";
                case WikiProject::$TYPE_PUBLIC:
                    return "<span class='label label-success'>公开</span>";
                default:
                    return "<span class='label label-default'>未知-非法</span>";
            }
        });
        $grid->sync_to_blog('同步到博客')->display(function ($sync) {
            if ($sync) {
                return "<span class='label label-success'>同步</span>";
            } else {
                return "<span class='label label-danger'>不同步</span>";
            }
        });
        $grid->thumb('封面图')->gallery(['width' => 30, 'height' => 20]);
        $grid->created_at('创建时间')->date('Y-m-d');
        $grid->updated_at('修改时间')->date('Y-m-d');
 
        $grid->actions(function ($actions) {
            $actions->disableView();
            $actions->add(new GoEdit);
        });
         
        $grid->disableFilter();
        $grid->disableRowSelector();
        $grid->disableExport();
        $grid->disableColumnSelector();
        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new WikiProject());

        $form->text('name', "项目名称")->required();
        $form->textarea('description', "项目描述")->required();
        $form->radio('type', "类型")
            ->options([WikiProject::$TYPE_PUBLIC => '公开', WikiProject::$TYPE_PRIVATE => '私密'])
            ->default(WikiProject::$TYPE_PUBLIC)
            ->required();

        $form->radio("sync_to_blog", "同步到博客")
            ->options([true => '同步', false => '不同步'])
            ->help("此选项只对公开项目有效")
            ->default(true)
            ->required();

        $form->cropper('thumb', '封面图')
            ->cRatio(300, 200)
            ->help('图片尺寸需要 300*200')
            ->uniqueName();
        // cropper() 添加 required() 有问题，原因未知

        $form->footer(function ($footer) {
            // 去掉`查看`checkbox
            $footer->disableViewCheck();

            // 去掉`继续编辑`checkbox
            $footer->disableEditingCheck();

            // 去掉`继续创建`checkbox
            $footer->disableCreatingCheck();
        });

        return $form;
    }
}
