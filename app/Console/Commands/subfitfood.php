<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Jobs\SendToFood;

class subfitfood extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sub:food';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '定时推送优惠券';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //获取订阅的用户
        $list = User::where('is_sub',1)->get();
        if($list){
            foreach ($list as $key => $value) {
                $job = (new SendToFood($value));
                dispatch($job);//分发任务到队列
            }
        }
       
       
    }

  
}
