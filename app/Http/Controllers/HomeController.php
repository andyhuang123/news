<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\BlogNavArticle;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    
    public function getlist(){
        
        $article_model = new BlogNavArticle();
        $list = $article_model->where(['article_show'=> 1])->get()->toArray();
        foreach ($list as $value){
            echo 'http://www.seedblog.cn/article_details/'.$value['id'].'.html</br>';
           
        }
    }
}
