<?php

namespace App\Http\Controllers\Home;

 
use App\Http\Controllers\Controller;
use App\Models\Goods;

class GoodController extends Controller
{
    /**
     * 福利
     */
    public function index()
    { 
        $list = Goods::where('closed',1)->paginate(8);
        
        return view('home.good.index')->with('list', $list);
    }
    
}
