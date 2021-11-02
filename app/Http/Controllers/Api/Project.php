<?php

namespace App\Http\Controllers\Api;

use App\Models\Activity; 
use Illuminate\Http\Request;  
use Illuminate\Support\Facades\Cache; 
use App\Http\Controllers\Controller;
use EasyWeChat\Factory;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Services\TaobaoService;

class Project extends Controller
{ 
    //系统配置项
    public function systemconfigs()
    {
        $sys = DB::table('admin_config')->pluck('value', 'name');
        $is_show = $sys['base.is_show'] ? true : false ;
        return $is_show;
    }

    public function sysconfig(){
        $sys = DB::table('admin_config')->pluck('value', 'name');
        $data = $sys['base.is_show'] ? true : false ;
        $res['data'] = $data;
        return response()->json($res); 
    }

    public function getprojectlist(){ 
        
        $data = Activity::select('id','appId','activity_id','activity_title','image','is_open','mini_path','order','money','surplus')->where(['is_open'=>1])->orderBy('order','desc')->get();  
      
        if($data){
           $data = $data->toArray();  
        }else{ 
           $data = [];
       
        } 
        return response()->json($data); 
    }
    /**
     * 实例小程序
     *
     * @return void
     */
    protected function miniapps():object{  
        $config = [
            'app_id' => 'wx08459290cbc494a0',
            'secret' => 'd37c928564ffc3ee022b1bddfa0dfa6d', 
            // 下面为可选项
            // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
            'response_type' => 'array', 
            'log' => [
                'level' => 'debug',
                'file' => storage_path('logs/wechat.log'), 
            ],
        ];
        
        $app = Factory::miniProgram($config);
        return $app;
    }
    /**
     * 小程序登录
     * 
     */
    public function getduologin(Request $request){
        $code = $request->input('code'); 
        $app = $this->miniapps();
        $info = $app->auth->session($code);
        $is_show = $this->systemconfigs(); 
        $userinfo = User::where(['mini_openid'=>$info['openid']])->first(); 
        if($userinfo){
            $userinfo->is_show = $is_show;
            $data['user']= $userinfo;
            $data['token']= $userinfo->api_token;
        }else{
            $save['mini_openid'] = $info['openid'];
            $save['api_token'] = $info['session_key'];
            $user = User::create($save); //存进数据库
            $user->is_show = $is_show;
            $data['user'] = $user;
            $data['token'] = $user->api_token;
            
        }
        $data['code'] = 1;
        
        return response()->json($data); 

    }

    /**
     * 消息订阅
     *
     * @return void
     */
    public function  addsubscribe(Request $request){ 
        $template_id = $request->input('template_id'); 
        $token = $request->input('token'); 
        $info = User::where('api_token', $token)->first();
        if($info){
            //更新用户订阅模板id
            $info->template_id=$template_id;
            $info->is_sub= 1;
            $info->save();
            
            $data['msg'] = '预定成功';
            return response()->json($data); 
        }else{
            $data['msg'] = '预定失败';
            return response()->json($data); 
        }
        
    }

    /**
     * 更多小程序
     * 
     */
    public function getlink(){

        $data=[
            ['app_id'=>'wx220078343b98c827','app_name'=>'垃圾分类识别','logo'=>'http://www.seedblog.cn/uploads/images/b59f19d46e2728054246b41b3baf90cb.jpg','description'=>'垃圾分类识别','url'=>'pages/sort/sort'],
            ['app_id'=>'wx6180a99a9f70b5e9','app_name'=>'网络搬运工','logo'=>'https://tva1.sinaimg.cn/mw690/b6559090gy1gl5y5j0d0nj203o03o744.jpg','description'=>'网络搬运工','url'=>'pages/index/index'],
            ['app_id'=>'wxa598b0d2c3f2ca22','app_name'=>'万能实用工具箱','logo'=>'https://tva1.sinaimg.cn/mw690/b6559090gy1gl5y0yv5krj203o03oa9w.jpg','description'=>'万能实用工具箱','url'=>'pages/index/index'],
            ['app_id'=>'wxeb24626d2b9dcc76','app_name'=>'单词游记','logo'=>'http://www.seedblog.cn/uploads/images/72c9e9716a2e24dff4544a7267470810.png','description'=>'记忆单词','url'=>'pages/home/home']
        ];

        return response()->json($data); 
    }

    /**
     * 小程序搜索提交收录接口
     * 
     */
    public function searchmini(){

        $app = $this->miniapps();
        $pages = [
                [ 
                    "path"=> "pages/home/home" 
                ],
                [ 
                    "path"=> "pages/index/index" 
                ],
                [
                    "path"=> "pages/user/user"
                ],
                [
                    "path"=> "pages/link/link"
                ]
        ];
        $info  =$app->search->submitPage($pages);
        return response()->json($info); 

    }

    public function getdatalist(){
        $tabo = new TaobaoService; 
        $ads = $tabo->getcouponlist("1","5","34616"); //淘抢购商品库 34616

        return response()->json($ads); 
    }
    
    /**
     * 小程序内容安全 图片检测
     */
    public function checkimge(Request $request){
        $imgurl= $request->input('imgurl');//所传参数为要检测的图片文件的绝对路径
        
        $app = $this->miniapps();
        // 所传参数为要检测的图片文件的绝对路径，图片格式支持PNG、JPEG、JPG、GIF, 像素不超过 750 x 1334，同时文件大小以不超过 300K 为宜，否则可能报错
        $result = $app->content_security->checkImage($imgurl);
        dd($result);
        // return response()->json($result);
        // 正常返回 0
        // {
        //     "errcode": "0",
        //     "errmsg": "ok"
        // }

        // 当图片文件内含有敏感内容，则返回 87014
        // {
        //     "errcode": 87014,
        //     "errmsg": "risky content"
        // }
    }

}
