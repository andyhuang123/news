<?php 
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/bbs', 'TopicsController@index')->name('bbs.index');

Route::resource('topics', 'TopicsController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);

Route::resource('categories', 'CategoriesController', ['only' => ['show']]);

Route::post('upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');

Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');

Route::resource('replies', 'RepliesController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);

Route::resource('replies', 'RepliesController', ['only' => ['store', 'destroy']]);
//消息提醒
Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);
//github登录
Route::get('login/github', 'LoginController@redirectToProvider')->name('github.login');
//github回调
Route::get('oauth/redirect', 'LoginController@handleProviderCallback')->name('github.callback');

#tool工具api
Route::match(['get', 'post'],'api/douyin_url', 'HomeController@getdouyinvideo')->name('douyin.url');
 
Route::match(['get', 'post'],'api/settingsurl', 'HomeController@getAdsetting')->name('douyin.adurl');
 
Route::post('api/aiui', 'HomeController@getaicontent')->name('aiui');

Route::post('api/elmdata', 'HomeController@getelmdata')->name('elmdata'); //活动接口

Route::post('api/activitylist', 'HomeController@gethuodonglist')->name('elmdata.list'); //活动列表

Route::any('api/hello', 'HomeController@gethello')->name('api.hello'); //回调URL

Route::get('jd_activity_list', 'JdController@jdactivtylist')->name('jd.jdactivtylist');//jd联盟活动列表
//优惠券
Route::post('search/all', 'CouponController@getCoupon')->name('coupon');
//淘口令
Route::post('tpwd/create', 'CouponController@getpassword')->name('tpwd');
//获取链接
Route::get('newlist','HomeController@getlist')->name('newlist');
//登录
Route::match(['get', 'post'], '/login', 'LoginController@index')->name('login');
//注册
Route::match(['get', 'post'], '/register', 'LoginController@register')->name('register');
//退出
Route::post('/logout', 'LoginController@logout')->name('logout');
 
//导航
Route::get('/nav', 'NavController@index')->name('nav');
//爬虫 
Route::get('paspider', 'SpiderController@flushOnce')->name('spider.once'); 
 
 

//配置网站前台路由规则
Route::middleware(['laravel_pjax'])->name('home.')->group(function (){
 
    Route::get('/','Home\ArticleController@index')->name('index'); 
    Route::match(['get','post'],'article/{nav_id?}','Home\ArticleController@index')->name('article'); 
     
    Route::get('about','Home\AboutController@index')->name('about');
    Route::get('friends','Home\FriendsController@index')->name('friends');
    Route::get('article_details/{aid}.html','Home\ArticleDetailController@index')->name('article_details');
    Route::get('article_details/{aid}','Home\ArticleDetailController@index')->name('article_details_as');
    Route::get('photo/{nav_id?}','Home\PhotoController@index')->name('photo');
    Route::get('photo_details/{pid}','Home\PhotoController@photo_details')->name('photo_details');
    Route::get('music/{nav_id?}','Home\MusicController@index')->name('music');
    Route::get('music_details/{mid}','Home\MusicController@music_details')->name('music_details');
    Route::get('video/{nav_id?}','Home\VideoController@index')->name('video');
    Route::get('video_details/{vid}','Home\VideoController@video_details')->name('video_details');
    Route::get('card1/{nav_id?}','Home\CardOneController@index')->name('card1');
    Route::get('card2/{nav_id?}','Home\CardTwoController@index')->name('card2');
    Route::get('message','Home\MessageController@index')->name('message');
    Route::get('line','Home\LineController@index')->name('line');
    Route::get('good','Home\GoodController@index')->name('good');
    Route::get('laboratory','Home\Laboratory@index')->name('laboratory');
    
    Route::get('newindex/{nav_id?}','Home\VideoController@newindex')->name('new_video');

    Route::get('center', 'UsersController@index')->middleware('checklogin')->name('center'); 
      
});

//留言
Route::name('home.')->group(function(){
  
    Route::post('message_msg','Home\MessageController@message_msg')->name('message_msg');
    Route::post('video_msg','Home\VideoController@video_msg')->name('video_msg');
    Route::post('friends_store','Home\FriendsController@store')->name('friends_store');
    Route::post('subscribe','Home\ArticleController@subscribe')->name('subscribe');
    Route::post('article_msg','Home\ArticleDetailController@article_msg')->name('article_msg'); 
     
    Route::middleware('throttle:60,1')->group(function () {
       Route::post('article_like','Home\ArticleDetailController@article_like')->name('article_like');
    });
    
    Route::post('article_favorite','Home\ArticleDetailController@article_favorite')->name('article_favorite');
    
    Route::post('article_sub','Home\ArticleDetailController@article_sub')->name('article_sub');
  
});


// Wiki 首页
Route::get('/wiki', 'WikiController@index');
// 获取指定文档内容
Route::get('wiki/content/{project_id}/{doc_id}', 'WikiController@getContent')
    ->name('wiki.document.content')
    ->where('project_id', '[0-9]+')
    ->where('doc_id', '[0-9]+');
// 文档列表展示
Route::get('wiki/detail/{project_id}', 'WikiController@detail')
    ->name('wiki.document.detail')
    ->where('project_id', '[0-9]+');
 
 
