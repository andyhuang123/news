<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::any('wechat', 'Api\WeChat@serve');

Route::post('duoyou/login', 'Api\Project@getduologin')->name('duoyou.login');//小程序登录

Route::post('project', 'Api\Project@getprojectlist')->name('project');//活动列表
 
Route::post('addsubscribe', 'Api\Project@addsubscribe')->name('addsubscribe'); //订阅消息 

Route::get('link', 'Api\Project@getlink')->name('link'); //更多小程序

Route::get('search_mini', 'Api\Project@searchmini')->name('searchmini'); //提交收录小程序页面
 

Route::get('openmini', 'Api\Project@sysconfig')->name('openmini');

Route::group(['middleware'=>'throttle:60,1'],function(){
    Route::any('douyin', 'Api\Videos@douyin')->name('douyin'); //视频去水印  
}); 
Route::get('taoke_list', 'Api\Project@getdatalist')->name('taoke_list'); 

//京东联盟接口
Route::get('jd_jingfen_goods', 'Api\Jdgoods@queryJingfenGoods')->name('jd_jingfen_goods'); //京粉精选商品
Route::get('jd_activty_list', 'Api\Jdgoods@jd_activty_list')->name('jd_activty_list'); //活动查询接口
Route::get('jd_link_url', 'Api\Jdgoods@getlinkurl')->name('jd_link_url'); //获取通用推广链接
 