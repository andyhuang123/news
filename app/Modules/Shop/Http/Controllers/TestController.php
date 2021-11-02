<?php
namespace App\Modules\Shop\Http\Controllers;

use \Illuminate\Http\Request;
use App\Services\TaobaoService; 
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;

class TestController
{

    public function __construct()
    {
    }
    /**
     *  综合	 大服饰	     大快消	      电器美家
     *  28026	 28029	    28027	     28028
     * 
     */
    public function index(Request $request)
    {
        $page = $request->input('page') ? $request->input('page') : 1 ; 

        $materialId = $request->input('materialId') ? $request->input('materialId') : "28026" ; 
 
        $fitter = [
            ['name'=>'综合','value'=>28026],
            ['name'=>'服饰','value'=>28029],
            ['name'=>'快消','value'=>28027],
            ['name'=>'电器美家','value'=>28028]
        ];
        $url = $request->path();
     
        $pagesize= 12; 
        //计算每页分页的初始位置
        $offset = ($page * $pagesize) - $pagesize;

        $tabo = new TaobaoService;  

        $hotads = Cache::remember('taobao_hot_goods_'.$materialId, 60, function () use($tabo,$page,$pagesize,$materialId) {
            return $tabo->newhotwuliao($page,"50",$materialId);  
        });
        $hotads = $hotads['data'];
         
        //实例化LengthAwarePaginator类，并传入对应的参数
        $hotads = new LengthAwarePaginator(array_slice($hotads, $offset,  $pagesize, true), count($hotads), $pagesize,$page, ['path' => 
        '', 'query' => $request->query()]);
        
        
        return view("shop::index.index",compact('hotads','materialId','fitter','url'));
    }
    /**
     *  
     *  
     * 精选天猫超市适合淘宝客推广单品爆款。
     *
     *  猫超1元购凑单	物料id：27162
     *  猫超第二件0元	物料id：27161
     *  猫超单件满减包邮	物料id：27160
     */
    public function jiukuai(Request $request){
 
        $page = $request->input('page') ? $request->input('page') : 1 ; 

        $materialId = $request->input('materialId') ? $request->input('materialId') : "27162" ; 

        $fitter = [
            ['name'=>'1元购','value'=>27162],
            ['name'=>'第二件0元','value'=>27161],
            ['name'=>'单件满减包邮','value'=>27160]
            
        ];

        $url = $request->path();
       
        $pagesize= 12; 
        //计算每页分页的初始位置
        $offset = ($page * $pagesize) - $pagesize;

        $tabo = new TaobaoService;  
        
        $hotads = Cache::remember('taobao_bao_goods_'.$materialId, 60, function () use($tabo,$page,$pagesize,$materialId) {
            return $tabo->newhotwuliao($page,$pagesize,$materialId);  
        });
        $hotads = $hotads['data'];
         
         //实例化LengthAwarePaginator类，并传入对应的参数
        $hotads = new LengthAwarePaginator(array_slice($hotads, $offset,  $pagesize, true), count($hotads), $pagesize,$page, ['path' => 
        '', 'query' => $request->query()]);
        
        return view("shop::index.index",compact('hotads','materialId','fitter','url'));
    }

    /**
     * 搜索
     *
     * @param Request $request
     * @return void
     */
    public function search(Request $request){

        $page = $request->input('page') ? $request->input('page') : 1 ; 

     
        $key = $request->input('s'); 
        if(empty($key)){
           return back();
        }
        $url = $request->path();
       
        $pagesize= 20; 

        //计算每页分页的初始位置
        $offset = ($page * $pagesize) - $pagesize;

        $tabo = new TaobaoService;  

        $res = $tabo->getsearch($page,"500",$key);  

        if(!isset($res->result_list)){

            $hotads['map_data'] = [];
            $total = 0;
        }else{

            $hotads = (array)$res->result_list;

            $total = $res->total_results;
        }
       
        //实例化LengthAwarePaginator类，并传入对应的参数
        $list = new LengthAwarePaginator(array_slice($hotads['map_data'], $offset,  $pagesize, true), count($hotads['map_data']), $pagesize,$page, ['path' => 
        '', 'query' => $request->query()]);
       
        return view("shop::index.search",compact('list','url','total','key'));

    }

 

   

}