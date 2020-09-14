<?php
namespace App\GateWayWorker;

use GatewayWorker\Lib\Gateway;
use Illuminate\Support\Facades\Log;

class Event
{
    // 全局变量，保存当前进程的客户端连接数
    public $connection_count = 0;
    //当businessWorker进程启动时触发。每个进程生命周期内都只会触发一次。
    public static function onWorkerStart($businessWorker)
    {
        echo "BusinessWorker    Start\n";
    }
 
    //当客户端连接上gateway进程时(TCP三次握手完毕时)触发的回调函数
    public static function onConnect($client_id)
    {
        Gateway::sendToClient($client_id, json_encode(['type' => 'init', 'client_id' => $client_id])); 
    } 


    //当客户端连接上gateway完成websocket握手时触发的回调函数。
    public static function onWebSocketConnect($client_id)
    {
        /*可以在处理自己的一些业务逻辑...
        比如在此更新数据库中客户端/设备相关信息、
        进行客户端/设备id与client_id绑定 Gateway::bindUid(string $client_id, mixed $uid)  等...*/
         
        Gateway::sendToClient($client_id, json_encode(['type' => 'init', 'client_id' => $client_id]));
    }


    //当客户端发来数据(Gateway进程收到数据)后触发的回调函数
    public static function onMessage($client_id, $message)
    { 
        //根据接收到的客户端数据的不同模式 进行相应的处理以及回复。
        // $response = ['errcode' => 0, 'msg' => 'ok', 'data' => []];
        // $message = json_decode($message);

        // if (!isset($message->mode)) {
        //     $response['msg'] = 'missing parameter mode';
        //     $response['errcode'] = ERROR_CHAT;
        //     Gateway::sendToClient($client_id, json_encode($response));
        //     return false;
        // }

        // Gateway::sendToClient($client_id, json_encode($response)); 
       
    }


    //客户端与Gateway进程的连接断开时触发。
    public static function onClose($client_id)
    {
        //一般在这里做一些数据清理工作。
        Log::info('close connection' . $client_id);
      
    }

    //当businessWorker进程退出时触发。每个进程生命周期内都只会触发一次。
    public static function onWorkerStop($businessWorker)
    {
        //可以在这里为每一个businessWorker进程做一些清理工作，例如保存一些重要数据等... 
         // 房间广播有连接关闭的信号
        $room_id = $_SESSION['room_id'];
        $uname   = $_SESSION['uname'];

        if (Gateway::getClientCountByGroup($room_id)) {
            Gateway::sendToGroup($room_id, json_encode(array(
                'type'      => 'close',
                'uname'     => $uname
            )));
        }   
    }
}