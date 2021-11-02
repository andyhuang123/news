<?php

namespace App\Http\Controllers\Api;

 
use Illuminate\Http\Request;   
use App\Http\Controllers\Controller;  
use Illuminate\Support\Facades\DB;
use Smalls\VideoTools\VideoManager; //需要引入控制器的包地址

class Videos extends Controller
{ 

    public function douyin(Request $request){
        $url = $request->input('url');
        if(empty($url)){
            return [
                'status'  => false,
                'data' => '您输入链接！'
            ];
        }
        try {
            if (strpos($url, "douyin.com") || strpos($url, "iesdouyin.com")) {
                $result = VideoManager::DouYin()->start($url); 
            } elseif (strpos($url, "huoshan.com")) {
                $result = VideoManager::HuoShan()->start($url);
            } elseif (strpos($url, "ziyang.m.kspkg.com") || strpos($url, "kuaishou.com") || strpos($url, "gifshow.com") || strpos($url, "chenzhongtech.com")) {
                $result = VideoManager::KuaiShou()->start($url);
            } elseif (strpos($url, "www.pearvideo.com")) {
                $result = VideoManager::LiVideo()->start($url);
            } elseif (strpos($url, "www.meipai.com")) {
                $result = VideoManager::MeiPai()->start($url);
            } elseif (strpos($url, "immomo.com")) {
                $result = VideoManager::MoMo()->start($url);
            } elseif (strpos($url, "ippzone.com")) {
                $result = VideoManager::PiPiGaoXiao()->start($url);
            } elseif (strpos($url, "pipix.com")) {
                $result = VideoManager::PiPiXia()->start($url);
            } elseif (strpos($url, "longxia.music.xiaomi.com")) {
                $result = VideoManager::QuanMingGaoXiao()->start($url);
            } elseif (strpos($url, "shua8cn.com")) {
                $result = VideoManager::ShuaBao()->start($url);
            } elseif (strpos($url, "toutiaoimg.com") || strpos($url, "toutiaoimg.cn")) {
                $result = VideoManager::TouTiao()->start($url);
            } elseif (strpos($url, "weishi.qq.com")) {
                $result = VideoManager::WeiShi()->start($url);
            } elseif (strpos($url, "mobile.xiaokaxiu.com")) {
                $result = VideoManager::XiaoKaXiu()->start($url);
            } elseif (strpos($url, "xigua.com")) {
                $result = VideoManager::XiGua()->start($url);
            } elseif (strpos($url, "izuiyou.com")) {
                $result = VideoManager::ZuiYou()->start($url);
            } else {
                return [
                    'status'  => false,
                    'data' => '您输入的链接错误！'
                ];
            }
            if (!$result) {
                return [
                    'status'  => false,
                    'data' => '您输入的链接错误！'
                ];
            }
 
            return [
                'status'  => true,
                'data' => $result
            ];
        } catch (\Exception $e) {
         
            return [
                'status'  => false,
                'data' => $e->getMessage()
            ];
        }
    }



}