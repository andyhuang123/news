<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TaobaoService;

class CouponController extends Controller
{
    /**
     * 获取优惠券
     *  
     * 综合	    女装	 食品	 美妆个护	家居家装	母婴
     * 27446	27448	27451	27453	  27798	      27454
     * 
     */
    public function getCoupon(Request $request){
         $pageNo = $request->input('pageNo') ? $request->input('pageNo') : 1 ;
         $material_id = $request->input('id') ? $request->input('id') : 27446;
         $me_arr = ['27446','27448','27451','27453','27798','27454']; 
         $pagesize = 10;
        
         $taobao = new TaobaoService;
         $resp = $taobao->getcouponlist($pageNo,$pagesize,$material_id);
     
         if(count($resp)>0){
               $data['data'] = $resp;
               $data['code'] = 0;
         }else{
                $data['data'] = [];
                $data['code'] = 1;
         }
         return response()->json($data);
         
    }

    /**
     * 口令
     */
    public function getpassword(Request $request){
        $text = $request->input('text');
        $url = $request->input('url');
        $taobao = new TaobaoService;
        $resp = $taobao->getkouling($text,$url);
        $data['data'] = $resp;
        $data['code'] = 1;
        return response()->json($data);

    }

}