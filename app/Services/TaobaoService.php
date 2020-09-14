<?php
namespace App\Services;

use Illuminate\Http\Request; 
use TopClient; 
use TbkDgOptimusMaterialRequest;
 
/**
 *  获取淘宝客服务
 */
class TaobaoService 
{ 

    /**
     * 物料综合热销
     * 
     */
    public function hotwuliao($page="1",$pagesize="10"){ 
        $c = new TopClient;
        $c->appkey = '31269612';
        $c->secretKey='***********';
        $c->format= 'json';
        $req = new TbkDgOptimusMaterialRequest;
        $req->setPageSize($pagesize);
        $req->setPageNo($page);
        $req->setAdzoneId("110840800102"); 
        $req->setMaterialId("28026"); //物料综合热销
        $resp = $c->execute($req);
        if(!$resp){
            return []; 
        }  
        return $resp->result_list->map_data; 
   }

     /**
      * 获取相关物料
      * @param $page        第几页
      * @param $pagesize    页数
      * @param $material_id 物料id
      * @return array
      */ 
      public function getwuliaomax($page="1",$pagesize="4",$material_id="13256"){

        $c = new TopClient;
        $c->appkey = '31269612';
        $c->secretKey='ff614c43bb9818dd8f877ea73319751d';
        $c->format= 'json';
        $req = new TbkDgOptimusMaterialRequest;
        $req->setPageSize($pagesize);
        $req->setPageNo($page);
        $req->setAdzoneId("110840800102"); 
        $req->setMaterialId($material_id); 
        $resp = $c->execute($req); 
        if($resp){
            return  $resp->result_list->map_data; 
        }else{
            return  [];
        }
         
    }
     
}