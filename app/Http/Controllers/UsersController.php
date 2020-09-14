<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;  
use App\Models\BlogNavArticle;
use App\Models\Favorites; 
 

class UsersController extends Controller
{
     
    /**
     * 会员中心首页
     * @param  Request $request [description]
     * @param  id      $id      [description]
     * @return [type]           [description]
     */
    public function index(Request $request)
    {
       $uid = session('uid');
       $info = User::where('token',$uid)->first();
       if(!$info){
           return redirect('login'); 
       }
       
       $favorites = Favorites::with('article')->where('user_id',$info->id)->get();
       

        return view('users.index', [
             'info' => $info ,
             'favorites' => $favorites
        ]);
    }

     
 
}
