<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable; 
use Illuminate\Support\Facades\Log;
use EasyWeChat\Factory;
use App\Models\User;
/**
 * 发送订阅消息
 */
class SendToFood implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user= $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $app = $this->miniapp();
        $res = $app->subscribe_message->send([
            'touser' => $this->user->mini_openid,
            'template_id' => $this->user->template_id,
            'page' => 'pages/index/index',
            'form_id' => 'form-id',
            'data' => [
                'thing1' => ['value'=>'外卖优惠券'],
                'thing2' => ['value'=>'又到了吃饭时间，快来领优惠券吧！'],
                'thing3' => ['value'=>'多优券'],
                'thing4' => ['value'=>'红包天天领，叫外卖能省就省！']
            ]
        ]); 
        if($res){ 
            $user_info = User::find($this->user->id);
            $user_info->is_sub = 0;
            $user_info->save();
        }
    }
    protected function miniapp(){
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
}
