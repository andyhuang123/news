<?php

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

Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);

 
Route::get('login/github', 'LoginController@redirectToProvider')->name('github.login');

Route::get('oauth/redirect', 'LoginController@handleProviderCallback')->name('github.callback');

// Route::namespace('Auth')->prefix('auth')->group(function (){
//     Route::get('github','SocialitesController@github');
//     Route::get('callback','SocialitesController@callback');
// });
Route::get('blog', 'BlogController@index')->name('blog.index');

Route::get('show/{id}', 'BlogController@show')->name('blog.show');

Route::get('newlist','HomeController@getlist')->name('newlist');

Route::match(['get', 'post'], '/login', 'LoginController@index')->name('login');

Route::match(['get', 'post'], '/register', 'LoginController@register')->name('register');

Route::post('/logout', 'LoginController@logout')->name('logout');

Route::get('/roomlogout', 'LoungeController@logout')->name('roomlogout');

//广告

//Route::get('taobao', 'Taobao@wuliao')->name('taobao.ads'); //淘宝客 综合热销
 
Route::group(['middleware' => ['checklogin']], function () {
    Route::get('/lounge', 'LoungeController@index');
    Route::match(['get', 'post'], '/create', 'LoungeController@create');
    Route::get('/room/{id}', 'RoomController@index');
    Route::post('/bind', 'RoomController@bind');
    Route::post('/say', 'RoomController@say');
    Route::post('/flush', 'RoomController@flush');
    Route::get('/leave', 'RoomController@leave');
    Route::post('/music', 'RoomController@music');
    //用户中心
    Route::get('/center', 'UsersController@index')->name('center');
    
});
 
 
//配置网站前台路由规则
Route::middleware(['laravel_pjax'])->name('home.')->group(function (){
    //Route::get('/','Home\IndexController@index')->name('index');
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
});


  
Route::name('home.')->group(function(){
    
    // Route::group(['middleware' => ['checklogin']], function () { 
    //   Route::post('message_msg','Home\MessageController@message_msg')->name('message_msg');
    //   Route::post('article_msg','Home\ArticleDetailController@article_msg')->name('article_msg');
    // });
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
 
 
