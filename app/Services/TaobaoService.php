<?php
namespace App\Services;

use Illuminate\Http\Request; 
use TopClient; 
use TbkDgOptimusMaterialRequest;
use TbkDgMaterialOptionalRequest;
use TbkTpwdCreateRequest;
use TbkActivityInfoGetRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

/**
 *  获取淘宝客服务
 */
class TaobaoService 
{ 

    public function system_config()
    {
        $config_result = DB::table('admin_config')->pluck('value', 'name');
        return $config_result;
    }
    /**
     * 实时热销榜
     * 
     */
    public function hotwuliao($page="1",$pagesize="10"){ 
        $configs =  $this->system_config();
        $c = new TopClient;
        $c->appkey = $configs['base.taobao_key'];
        $c->secretKey=$configs['base.taobao_secretKey'];

        $c->format= 'json';
        $req = new TbkDgOptimusMaterialRequest;
        $req->setPageSize($pagesize);
        $req->setPageNo($page);
        $req->setAdzoneId("110840800102"); 
        $req->setMaterialId("28027");  
        $resp = $c->execute($req); 
        if(isset($resp->result_list)){
            return $resp->result_list->map_data; 
        } 
        return []; 
   }
   
   public function newhotwuliao($page="1",$pagesize="10",$materialId="28027"){ 
        $configs =  $this->system_config();
        $c = new TopClient;
        $c->appkey = $configs['base.taobao_key'];
        $c->secretKey=$configs['base.taobao_secretKey'];

        $c->format= 'json';
        $req = new TbkDgOptimusMaterialRequest;
        $req->setPageSize($pagesize);
        $req->setPageNo($page);
        $req->setAdzoneId("110840800102"); 
        $req->setMaterialId($materialId);  
        $resp = $c->execute($req);   
        $data=[];
        if(isset($resp->result_list)){ 
            
            $data['data'] = $resp->result_list->map_data; 

            if(isset($resp->sub_code) && $resp->sub_code ==="50001"){
                $data['data'] = [];
            } 
               
            
        }else{
            $data['data'] = [];
        }
       
        return $data; 
    }

    /**
     * 搜索
     * 排序_des（降序），排序_asc（升序），销量（total_sales），淘客佣金比率（tk_rate）， 累计推广量（tk_total_sales），总支出佣金（tk_total_commi），价格（price）
     * @return array
     */
     public function getsearch($page=1,$pagesize="10",$search="手机保护壳",$sort="tk_total_sales",$platform="1"){
        $configs =  $this->system_config();
        $c = new TopClient;
        $c->appkey = $configs['base.taobao_key'];
        $c->secretKey=$configs['base.taobao_secretKey']; 
        $req = new TbkDgMaterialOptionalRequest;
        $req->setStartDsr("10");
        $req->setPageSize($pagesize);
        $req->setPageNo($page);
        $req->setPlatform($platform);
        $req->setEndPrice("10");
        $req->setStartPrice("10"); 
        $req->setSort($sort); 
        $req->setQ($search);
        $req->setMaterialId("17004"); 
        $req->setAdzoneId("110840800102");  
        $req->setDeviceType("IMEI"); 
        $resp = $c->execute($req); 
        if(isset($resp->result_list)){ 
            return $resp;  
            if(isset($resp->sub_code) && $resp->sub_code ==="50001"){
               return []; 
            }  

        }else{
            return []; 
        }
        
      
        
     }


     /**
      * 获取相关物料
      * @param $page        第几页
      * @param $pagesize    页数
      * @param $material_id 物料id
      * @return array
      */ 
      public function getwuliaomax($page="1",$pagesize="4",$material_id="13256"){
        $configs =  $this->system_config(); 
        $c = new TopClient;
        $c->appkey = $configs['base.taobao_key'];
        $c->secretKey=$configs['base.taobao_secretKey'];
        $c->format= 'json';
        $req = new TbkDgOptimusMaterialRequest;
        $req->setPageSize($pagesize);
        $req->setPageNo($page);
        $req->setAdzoneId("110840800102"); 
        $req->setMaterialId($material_id);  
        $resp = $c->execute($req); 
        if(isset($resp->result_list)){
            return  $resp->result_list->map_data; 
        } 
        return  [];
         
         
    }
    /**
     * ①获得选品库列表
     */
    public function getxuanpinlist($page="1",$pagesize="10",$material_id="3759"){
        $configs =  $this->system_config(); 
        $c = new TopClient;
        $c->appkey = $configs['base.taobao_key'];
        $c->secretKey=$configs['base.taobao_secretKey'];
        $c->format= 'json';
        $req = new TbkDgOptimusMaterialRequest;
        $req->setPageSize($pagesize);
        $req->setPageNo($page);
        $req->setAdzoneId("110840800102"); 
        $req->setMaterialId($material_id);  
        $resp = $c->execute($req);  
        return $resp;
    }

    /**
     * ②获得具体某个选品库内的商品
     * 
     */
    public function getxuanpinku($page="1",$pagesize="4",$material_id="31539",$favorites_id){
        $configs =  $this->system_config(); 
        $c = new TopClient;
        $c->appkey = $configs['base.taobao_key'];
        $c->secretKey=$configs['base.taobao_secretKey'];
        $c->format= 'json';
        $req = new TbkDgOptimusMaterialRequest;
        $req->setPageSize($pagesize);
        $req->setPageNo($page);
        $req->setAdzoneId("110840800102"); 
        $req->setMaterialId($material_id); 
        $req->setFavoritesId($favorites_id);
        $resp = $c->execute($req); 
        return $resp;
    }

    /**
      * 大额券
      * 特色：大面额折扣超高佣金，每单赚更多
      *
      * 物料id：
      *  
      * 综合	女装	食品	美妆个护	家居家装	母婴
      * 27446	27448	27451	27453	27798	27454
      *
      */
      public function getcouponlist($page="1",$pagesize="4",$material_id="27446"){
        $configs =  $this->system_config(); 
        $c = new TopClient;
        $c->appkey = $configs['base.taobao_key'];
        $c->secretKey=$configs['base.taobao_secretKey'];
        $c->format= 'json';
        $req = new TbkDgOptimusMaterialRequest;
        $req->setPageSize($pagesize);
        $req->setPageNo($page);
        $req->setAdzoneId("110840800102"); 
        $req->setMaterialId($material_id);  
        $resp = $c->execute($req); 
        if(isset($resp->result_list)){ 
            return $resp->result_list->map_data;  
            if(isset($resp->sub_code) && $resp->sub_code ==="50001"){
               return []; 
            }  

        }else{
            return []; 
        }
      }

      /**
       * 淘宝客-公用-淘口令生成
       * 
       */
      public function getkouling($text='',$url=''){
            $configs =  $this->system_config(); 
            $c = new TopClient;
            $c->appkey = $configs['base.taobao_key'];
            $c->secretKey=$configs['base.taobao_secretKey']; 
            $req = new TbkTpwdCreateRequest; 
            $req->setText($text);
            $req->setUrl($url); 
            $resp = $c->execute($req); 
            return $resp->data; 
      }
  
    /**
     * 淘宝客官方活动转链
     * 饿了么活动ID：20150318019998877
     *   
     */
     public function elmhoudong($activity_material_id,$adzoneid){ 
        $c = new TopClient;
        $c->appkey = "32025037"; 
        $c->secretKey= "984bdcf8afa1dd4490ebb49f20ec0934"; 
        $req = new TbkActivityInfoGetRequest;
        $req->setAdzoneId($adzoneid);  
        $req->setSubPid("mm_32834967_2159300288_111028650057");
        $req->setActivityMaterialId($activity_material_id); 
        $resp = $c->execute($req);
        return $resp->data;
     }
 }