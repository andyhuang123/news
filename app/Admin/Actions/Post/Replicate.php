<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use App\Services\TaobaoService;

class Replicate extends RowAction
{
    public $name = '同步path';

    public function handle(Model $model)
    {
        //实例化服务
        $taobao = new TaobaoService;
        if($model->activity_id){
            $adzoneid = "111028650057";
            $data = $taobao->elmhoudong($model->activity_id,$adzoneid);
            if($data){
                $model->mini_path= $data->wx_miniprogram_path;
                $model->save();
            }else{
                return $this->response()->warning('淘宝api返回数据失败...');
            }
        }else{
            return $this->response()->warning('活动无效,需手动输入...');
        }
 
        return $this->response()->success('同步成功')->refresh();
    }

}