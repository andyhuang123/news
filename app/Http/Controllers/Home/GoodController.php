<?php

namespace App\Http\Controllers\Home;

 
use App\Http\Controllers\Controller;
use App\Models\Goods; 
use App\Services\TaobaoService; 
use Illuminate\Support\Facades\Cache;

class GoodController extends Controller
{
    /**
     * 福利
     */
    public function index()
    { 
        $list = Goods::where('closed',1)->paginate(8);

        $page = rand(1,5); 
        
        $tabo = new TaobaoService; 

        // $hotads = Cache::remember('taobao_key_goods_'.$page, 60, function () use($tabo,$page) {
        //     return $tabo->hotwuliao($page,"99");  //500款商品
        // });
        $hotads = $tabo->hotwuliao($page,"99");  //500款商品
        return view('home.good.index',compact('list','hotads'));
    }
    
}
