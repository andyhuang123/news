<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([ 
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'), 
    'middleware'    => config('admin.route.middleware'),
    
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->resource('blog-navs', BlogNavController::class);
    $router->resource('blog-nav-articles', BlogNavArticleController::class);
    $router->resource('blog-nav-photos', BlogNavPhotoController::class);
    $router->resource('blog-nav-musics', BlogNavMusicController::class);
    $router->resource('blog-nav-videos', BlogNavVideoController::class);
    $router->resource('blog-nav-share-ones', BlogNavShareOneController::class);
    $router->resource('blog-nav-share-twos', BlogNavShareTwoController::class);
    $router->resource('blog-upload-files', BlogUploadFileController::class);
    $router->resource('blog-messages', BlogMessageController::class);
    $router->resource('blog-friends', BlogFriendsController::class);
    $router->resource('blog-notices', BlogNoticeController::class);
    $router->resource('blog-abouts', BlogAboutController::class);
    $router->resource('blog-about-articles', BlogAboutArticleController::class);
    $router->resource('blog-about-card-ones', BlogAboutCardOneController::class);
    $router->resource('blog-about-card-twos', BlogAboutCardTwoController::class);
    $router->resource('blog-subscribes', BlogSubscribeController::class);
    $router->resource('goods', GoodsController::class);
    $router->resource('users', UserController::class);
    $router->resource('categories', CategoryController::class);
    $router->resource('sites', SiteController::class);
    $router->resource('activities', ActivityController::class);
    //抓取微信文章
    $router->get('/spiders', "SpiderController@index");
 

    $router->resource('wikis', WikiProjectController::class);
   
    // Wiki 编辑页面
    $router->get('wiki/edit/{id}', 'WikiDocumentController@edit')
        ->name('wiki.document.edit')
        ->where('id', '[0-9]+');
    // 新建文件、文件夹
    $router->post('wiki/edit/create/{project_id}', 'WikiDocumentController@create')
        ->name('wiki.document.create')
        ->where('project_id', '[0-9]+');;
    // 文档排序
    $router->post('wiki/sort/{project_id}', 'WikiDocumentController@sort')
        ->name('wiki.document.sort')
        ->where('project_id', '[0-9]+');
    // 文档重命名
    $router->post('wiki/rename/{project_id}/{doc_id}', 'WikiDocumentController@rename')
        ->name('wiki.document.rename')
        ->where('project_id', '[0-9]+')
        ->where('doc_id', '[0-9]+');
    // 文档删除
    $router->post('wiki/delete/{project_id}', 'WikiDocumentController@delete')
        ->name('wiki.document.delete')
        ->where('project_id', '[0-9]+');
    // 文档保存
    $router->post('save/{project_id}', 'WikiDocumentController@save')
        ->name('wiki.document.save')
        ->where('project_id', '[0-9]+');
    // 图片附件上传
    $router->post('wiki/upload/img', 'WikiAssetUploadController@uploadImg')
        ->name('wiki.document.upload.img');
    // 文件附件上传
    $router->post('wiki/upload/file', 'WikiAssetUploadController@uploadFile')
        ->name('wiki.document.upload.file');  
   
 
    
});

