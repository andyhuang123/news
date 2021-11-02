<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\BlogAbout;
use App\Services\TaobaoService;
class AboutController extends Controller
{
    /**
     * Desc:关于我个人信息展示
     * Date:2019/9/3/003
     */
    public function index(BlogAbout $blogAbout)
    {
        $about_data = $blogAbout::with([
            'article' => function ($query) {
                $query->where('article_show', '=', 1);
            },
            'card1'   => function ($query) {
                $query->where('card_show', '=', 1)->orderBy('card_sort','desc')->orderBy('id', 'desc');
            },
            'card2'   => function ($query) {
                $query->where('card_show', '=', 1)->orderBy('card_sort','desc')->orderBy('id', 'desc');
            },
        ])->where('about_show', 1)->get();
        //淘宝客  
        //2017100133 选品库
        // $page = rand(1,4);
        // $favorites_id = "2017100133";
        // $info = $tabo->getxuanpinku($page,"3","31539",$favorites_id);
        // if(isset($info->result_list)){
        //     $ads = $info->result_list->map_data;
        // }else{
        //     $ads = [];
        // }  
        $page = rand(1,15);  
        $tabo = new TaobaoService; 
        $ads = $tabo->getwuliaomax($page,"5","13369"); //数码家电 
       
        return view('home.about.index',compact('about_data','ads'));
    }
}
