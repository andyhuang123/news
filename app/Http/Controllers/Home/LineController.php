<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\BlogNavArticle;
use App\Services\TaobaoService;

class LineController extends Controller
{
    /**
     * 时间轴
     */
    public function index()
    { 
        $show_article   = [];
        
        $article_model = new BlogNavArticle();
        //获取所有文章
        $show_article = $article_model::where('article_show', 1)->orderBy('id', 'desc')->paginate(15);
        //ads 
        $page = rand(1,5); 
        
        $tabo = new TaobaoService;

        $ads = $tabo->getwuliaomax($page,"5","34616"); //淘抢购商品库 34616

        $hotads = $tabo->hotwuliao($page,"18"); 
        
        return view('home.line.index',compact('show_article','ads','hotads'));
    }

   
}
