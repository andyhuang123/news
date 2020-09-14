<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GatewayWorker\BusinessWorker;
use GatewayWorker\Gateway;
use GatewayWorker\Register;
use Workerman\Worker;

class GatewayWorkerServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature =  'gateway-worker:server {action} {--d}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'GatewayWorker Server';

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
        global $argv;
        $action = $this->argument('action');
        if(!in_array($action,['start','stop','restart'])){
            $this->error('Error action');
        }

        $argv[0] = 'gateway-worker:server';
        $argv[1] = $action;
        $argv[2] = $this->option('d') ? '-d' : '';

        $this->start();
    }
    //开启服务
    private function start()
    {
        $this->startGateWay();
        $this->startBusinessWorker();
        $this->startRegister();
        Worker::runAll();
    }


    //启动Register服务，用于gateway-worker内部通讯
    private function startRegister()
    {
        new Register('text://0.0.0.0:1236');
    }



    //启动gateway进程，用于暴露给客户端让其连接
    private function startGateWay()
    {
        $gateway = new Gateway("websocket://0.0.0.0:2346");   //0.0.0.0 监听本机所有网卡（内网、外网、都可以访问）
        $gateway->name                 = 'Gateway';                         //Gateway进程的名称
        $gateway->count                = 1;                                 //进程的数量=cup核心数。优化好linux内核，安装event扩展 每个进程可以维持上万的并发连接，否则只能1024个。
        $gateway->lanIp                = '127.0.0.1';                       //内网ip,多服务器分布式部署的时候需要填写真实的内网ip
        $gateway->startPort            = 2300;                              //监听本机端口的起始端口
        $gateway->pingInterval         = 30;                                //心跳检测时间间隔 单位：秒。如果设置为0代表不做任何心跳检测。
        $gateway->pingNotResponseLimit = 0;                                 //客户端连续n次$pingInterval时间内不发送任何数据则断开链接，并触发onClose。0表示不发送（由服务端发送）
        $gateway->pingData             = '{"mode":"heart"}';                //服务端定时给客户端发送的心跳数据
        $gateway->registerAddress      = '127.0.0.1:1236';                 //注册服务地址
    }


    //启动BusinessWorker进程，用于运行业务逻辑
    private function startBusinessWorker()
    {
        $worker                  = new BusinessWorker();
        $worker->name            = 'BusinessWorker';                        //BusinessWorker进程的名称
        $worker->count           = 2;                                       //BusinessWorker进程的数量 = cup核心数的1-3倍
        $worker->registerAddress = '127.0.0.1:1236';                       //注册服务地址
        $worker->eventHandler    = \App\GateWayWorker\Event::class;        //设置使用哪个类来处理业务
    }
}
