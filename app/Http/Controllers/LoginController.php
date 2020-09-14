<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\User;  
use Socialite; 
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * 登录
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function index(Request $request)
    {
        if (!$request->isMethod('post')) {
            return view('login.index');
        } else {
            $input = [
                'username' => $request->input('username'),
                'password' => $request->input('password')
            ];

            // 过滤
            Validator::make($input, [
                'username'   => ['required', 'max:20'],
                'password'   => ['required', 'max:40'],
            ])->validate();
            
            // 校验
            $user = User::where('username', $input['username'])->first();
            if (!$user) {
                return back()->withErrors($input['username']." doesn't exist.");
            } else if (md5($input['password']) != $user->password) {
                return back()->withErrors("Password is invalid.");
            }
            Auth::login($user); // 注册的用户让其进行登陆状态
            // 记录
            session(['uid'    => $user->token]);
            session(['uname'  => $input['username']]);
            session(['avatar' => $user->avatar]);
            
            return redirect('/');
        }
    }

    /**
     * 注册
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function register(Request $request)
    {
        
        if (!$request->isMethod('post')) {
            return view('login.register');
        } else {
            $input = [
                'username' => $request->input('username'),
                'password' => $request->input('password'),
                'email' => $request->input('email'),
            ];

            // 过滤
            Validator::make($input, [
                'username'   => ['required', 'max:20'],
                'password'   => ['required', 'max:40'],
                'email'   => ['required', 'email'],
            ])->validate();
            
            // 剔重
            if (User::where('username', $input['username'])->count()) {
                return back()->withErrors('User '.$input['username'].' has existed.');
            }
            if (User::where('email', $input['email'])->count()) {
                return back()->withErrors('User '.$input['email'].' has existed.');
            }

            // 入库
            User::create([
                'username' => $input['username'],
                'email' => $input['email'],
                'password' => md5( $input['password'] ),
                'token'    => md5( $input['username'].time().mt_rand(1000, 9999) ),
                'lastloginip' => $request->ip(),
                'lastlogintime' => time()
            ]);

            return redirect()->route('login');
        }
    }
    
     /**
     * 退出登录
     * @return [type] [description]
     */
    public function logout()
    { 
       
        session(['uid' => null]);
        session(['uname' => null]);
        session(['avatar' => null]); 
        Auth::logout();// 注册的用户让其进行退出状态
        return redirect('/');
    }
    
     /**
     * 将用户重定向到 GitHub 的授权页面
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }  

    /**
     * 从 GitHub 获取用户信息
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
      
        $user = Socialite::driver('github')->user();  
        if($user){
             $info = User::where('email',$user->email)->first();
             if(!$info){
                  $res = User::create([
                        'username'=> $user->name,
                        'nickname'=> $user->nickname,
                        'avatar'=> $user->avatar,
                        'email'=> $user->email,
                        'token'=> $user->token,
                        'location'=> $user->user['location'],
                        'lastloginip' => request()->ip(),
                        'lastlogintime' => time()
                    ]);
                    // 记录
                    session(['uid'    => $user->token]);
                    session(['uname'  => $user->name]);
                    session(['avatar' => $user->avatar]);
                   
            }else{
                session(['uid'    => $info->token]);
                session(['uname'  => $info->username]);
                session(['avatar' => $info->avatar]);
               
            }
            Auth::login($info); // 注册的用户让其进行登陆状态
            return redirect('/');
               
        }else{
            return redirect('/login'); 
        }
       
         
    }
    
    
    
    
    
}
