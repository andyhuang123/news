<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * jd联盟控制
 * 
 */

class JdController extends Controller
{
    
    public function jdactivtylist(Request $request){

        return view('jd.list');

    }


}
