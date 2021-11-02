<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller; 
use Encore\Admin\Facades\Admin; 
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;
use App\Services\BlogArticle;
  
class SpiderController extends Controller
{
    public function index(Request $request)
    {
      
        return Admin::content(function (Content $content) use($request) {
            $content->header('爬取文章');
            // body 方法可以接受 Laravel 的视图作为参数
            $param = $request->all(); 
            $url = isset($param['url']) ? $param['url'] : '' ; 
     
            if(!empty($url)){
                
                $crawler = new BlogArticle();
                $res =  $crawler->getcontent($url);

                $data = ['content'=>$res];
            }else{
                $data = ['content'=>''];
            }

            $content->body(view('admin.spider.show',compact('data')));
        });
    }
    
}
