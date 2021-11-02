<?php

namespace App\Http\Controllers\home;

use App\Models\BlogNavShareOne;
use App\Models\BlogNav;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\TaobaoService;

class CardOneController extends Controller
{
    /**
     * 卡片列表
     */
    public function index(Request $request)
    {
        $nav_id    = $request->route('nav_id');
        $cardModel = new BlogNavShareOne();
        if ($nav_id) {
            $nav = BlogNav::find($nav_id); //nav_title

            $result_list = $cardModel::where('share_show', 1)->where('nav_id', $nav_id)->orderBy('share_sort', 'desc')->orderBy('id', 'desc')->paginate(8);
        } else {
            $nav = (object)[];
            $nav->nav_title = '';
            $result_list = $cardModel::where('share_show', 1)->orderBy('share_sort', 'desc')->orderBy('id', 'desc')->paginate(8);
            
        }
        
        // $tabo = new TaobaoService; 
        // $page =  $page = rand(1,5); 
        // $ads = $tabo->getwuliaomax($page,"8","34616"); //淘抢购商品库 34616

        return view('home.card1.index',compact('result_list','nav'));
    }
}
