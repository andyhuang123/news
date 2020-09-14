<?php

namespace App\Http\Controllers\Home;

 
use App\Http\Controllers\Controller;
use App\Models\Goods;

class Laboratory extends Controller
{
    /**
     * 实验室
     */
    public function index()
    { 
       
        
        return view('home.laboratory.index');
    }
    
}
