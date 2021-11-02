<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogNavArticle;
use App\Services\AiUi;
use App\Services\TaobaoService;
use App\Models\Activity;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

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

    public function gethello(Request $request){
        $all = $request->all();
        Log::info('Showing user profile for user: '.$all);
        echo true;
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
     /**
     * 返回无水印播放地址
     * @desc 使用方法 域名url=视频的分享地址
     */  
    public function getdouyinvideo(Request $request)
    {
        // 通过 url 获取到 解析后的地址
        $url = $request->input('url') ?? '';
        if(empty($url)){
            echo false;die;
        }
        $res = $this->curl_http_exec($url);
        preg_match('/href="(.*?)">Found/', $res, $matches);
         
        $url_share = $matches[1];
        // 根据解析后的地址获取到 item_ids
        preg_match('/video\/(.*?)\//', $url_share, $matches);
        $item_ids = $matches[1];
        // 根据 item_ids 获取播放地址
        $arr = json_decode($this->curl_http_exec('https://www.iesdouyin.com/web/api/v2/aweme/iteminfo/?item_ids=' . $matches[1]), true);
         
        $url_play = $arr['item_list'][0]["video"]["play_addr"]["url_list"][0];
        // 根据播放地址 获取到无水印播放地址
        $url_play_remove_mark = str_replace('playwm', 'play', $url_play);
        preg_match('/href="(.*?)">Found/', $this->curl_http_exec($url_play_remove_mark), $matches);
        $videoUrl = str_replace('&', '&', $matches[1]); 
        
        $data['mp4'] = $videoUrl;
        $data['item_list'] =  $arr['item_list'];
        return response()->json($data);
    }

    /**
     * 获取地址中的内容
     * @param $url
     * @return bool|string
     */
    public function curl_http_exec($url)
    {
        // $Header = array("User-Agent:Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1");
        $Header = array("User-Agent:Mozilla/5.0 (Linux; U; Android 2.2; en-us; Nexus One Build/FRF91) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1");
        $con = curl_init((string)$url);
        curl_setopt($con, CURLOPT_HEADER, false); # 启用时会将头文件的信息作为数据流输出。
        curl_setopt($con, CURLOPT_SSL_VERIFYPEER, false); # 禁用后cURL将终止从服务端进行验证。
        curl_setopt($con, CURLOPT_RETURNTRANSFER, true); # 将curl_exec()获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($con, CURLOPT_HTTPHEADER, $Header); # 用来设置HTTP头字段的数组
        curl_setopt($con, CURLOPT_TIMEOUT, 5000); # 设置cURL允许执行的最长秒数。
        $result = curl_exec($con); # 抓取URL并把它传递给浏览器
        curl_close($con); # //关闭cURL资源，并且释放系统资源
        return $result;
    }

    /**
     * aiui询问,文本格式
     * 
     */
     public function getaicontent(Request $request,AiUi $aiui){
        
        $text = $request->input('text'); 
        if(empty($text)){
           echo 'text参数错误';die;
        }
        $aiui = new AiUi();
        $res = $aiui->testWebaiui($text); 
        return response()->json($res);

     }

     /**
      * 广告配置 
      *
      */
      public function getAdsetting(){ 
            $data['promotion_video'] = false;
            $data['promotion_video_delay_hours'] = 12;
            $data['interstitialAd'] = false;
            $data['interstitialAd_delay_minutes'] = 30;

            return response()->json($data);
     
      }

    // 官方活动ID，从官方活动页获取。点击查看官方活动
     
    // 饿了么聚合页CPS推广活动ID：20150318019998877 

    // 饿了么活动ID：1571715733668

    // 饿了么餐饮页面物料ID：1579491209717

    // 饿了么果蔬商超活动：1585018034441

    // 口碑主会场活动ID：1583739244161

    // 生活服务分会场活动ID：1583739244162

     public function gethuodonglist(){
         $activity = new Activity;
         $data = Cache::remember('activity_list', 120, function () use($activity) {
             return $activity->where(['is_open'=>1])->orderBy('order','desc')->get();  
         }); 
         if($data){
            $data = $data->toArray();
         }else{ 
            $data = [];
         }
         
         return response()->json($data); 
     }
    // wx_qrcode_url	String	https://img.alicdn.com/xxx	【本地化】微信推广二维码地址
    // click_url	String	https://s.click.xx.xx/xxx?xx	淘客推广长链
    // short_click_url	String	https://s.click.xx.xx/xxx?xx	淘客推广短链
    // terminal_type	String	1	投放平台, 1-PC 2-无线
    // material_oss_url	String	http://xxx.xxx.xxx	物料素材下载地址
    // page_name	String	活动会场A	会场名称
    // page_start_time	String	2020-02-27	活动开始时间
    // page_end_time	String	2020-02-27	活动结束时间
    // wx_miniprogram_path	String	pages/sharePid/web/index?scene=https://xxx	【本地化】微信小程序路径
    // https://mos.m.taobao.com/union/material/focus
    /**
     * 饿了么活动ID：20150318019998877
     */
    public function getelmdata(Request $request){
        $ad_id = $request->input('ad_id');
        if($ad_id){
            $elm_id = $ad_id;
            $adzoneid = "111028650057";
            $tabo = new TaobaoService;   
            $res = $tabo->elmhoudong($elm_id,$adzoneid);   
        }else{
            
            $res['wx_miniprogram_path'] =  'ele-recommend-price/pages/guest/index?inviterId=560a3db';
        } 
         
        return response()->json($res); 
    }


}
