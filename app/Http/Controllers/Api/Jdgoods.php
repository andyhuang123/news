<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
/**
 * 京东联盟接口
 * 
 */
class Jdgoods extends Controller
{
     protected $jdapp;

     public function __construct(Request $request){
        $config = [
            'appkey' => '373d6e190ca14300093be85a213083d4', // AppId （京东联盟的appkey）
            'appSecret' => 'c1384c25dabb42718c8cf6073eb511a6', // 密钥 （京东联盟的appSecret）
            'unionId' => '1003378682', // 联盟ID （如果使用京东联盟的，填京东联盟的，使用京佣的填京佣的）
            'positionId' => '3003367538', // 推广位ID （如果使用京东联盟的，填京东联盟的，使用京佣的填京佣的）
            'siteId' => '4100300604', // 网站ID, （如果使用京东联盟的，填京东联盟的，使用京佣的填京佣的）
            'apithId' => '',  // 第三方网站Apith的appid （可选，不使用apith的，可以不用填写）
            'apithKey' => '', // 第三方网站Apith的appSecret (可选，不使用apith的，可以不用填写)
            'jyCode' => '', // 京东京佣的API授权调用code (可选，不使用京佣的，可以不用填写)
            'isCurl' => true // 设置为true的话，强制使用php的curl，为false的话，在swoole cli环境下自动启用 http协程客户端
        ]; 
        $this->jdapp = new \JdMediaSdk\JdFatory($config);
       
     }
     /**
      * 获取京粉精选商品查询接口
      * 频道ID:1-好券商品,2-精选卖场,10-9.9包邮,15-京东配送,22-实时热销榜,23-为你推荐,24-数码家电,25-超市,26-母婴玩具,27-家具日用,28-美妆穿搭,30-图书文具,31-今日必推,32-京东好物,33-京东秒杀,34-拼购商品,40-高收益榜,41-自营热卖榜,108-秒杀进行中,109-新品首发,110-自营,112-京东爆品,125-首购商品,129-高佣榜单,130-视频商品,153-历史最低价商品榜，210-极速版商品，238-新人价商品
      * @return void
      */
     public function queryJingfenGoods(Request $request){
        $eliteId = $request->input('eliteId')??1;
        $pageIndex = $request->input('pageIndex')??1;
        $pageSize = $request->input('pageSize')??50;
        $sortName = $request->input('sortName')??'price';
        $sort = $request->input('sort')??'desc';

        $result = $this->jdapp->good->jingfen($eliteId = 1, $pageIndex = 1, $pageSize = 50, $sortName = 'price', $sort = 'desc');
        if ($result == false ) { 
           $data = $this->jdapp->getError();
           return response()->json($data); 
        }
        
       return response()->json($result); 
     }

     /**
      * 京东活动列表
      *
      * @return void
      */
     public function jd_activty_list(Request $request){
      
        $pageIndex = $request->input('start');
        $pageSize = 50;
        $result = $this->jdapp->activity->query($pageIndex, $pageSize);
        if ($result == false ) { 
            $data = $this->jdapp->getError();
            return response()->json($data); 
         } 
        return response()->json($result);
     }

     /**
      * 网站/app获取通用推广链接
      *
      */
      public function getlinkurl(Request $request){
        $url = $request->input('url');
        $params = $request->input('params')??[];
        $result = $this->jdapp->link->get($url,$params);
        return response()->json($result);

      }
   
}
