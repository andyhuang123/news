<?php
namespace App\Services;

use Hhxsv5\LaravelS\Swoole\WebSocketHandlerInterface;
use Swoole\Http\Request;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;
use Illuminate\Support\Facades\Redis;
/**
 * @see https://wiki.swoole.com/#/start/start_ws_server
 */
class WebSocketService implements WebSocketHandlerInterface
{
     
    // 声明没有参数的构造函数
    public function __construct()
    {
       // Redis::set('foo',0); 
    }
    
    public function onOpen(Server $server, Request $request)
    {
        // 在触发onOpen事件之前，建立WebSocket的HTTP请求已经经过了Laravel的路由，
        // 所以Laravel的Request、Auth等信息是可读的，Session是可读写的，但仅限在onOpen事件中。
        \Log::info('New WebSocket connection', [$request->fd, request()->all(), session()->getId(), session('xxx'), session(['yyy' => time()])]);  
         Redis::incr('foo');  
         $server->push($request->fd, Redis::get('foo'));
        // throw new \Exception('an exception');// 此时抛出的异常上层会忽略，并记录到Swoole日志，需要开发者try/catch捕获处理
    }
    public function onMessage(Server $server, Frame $frame)
    {
         \Log::info('Received message', [$frame->fd, $frame->data, $frame->opcode, $frame->finish]);
          $server->push($frame->fd, date('Y-m-d H:i:s'));
        // throw new \Exception('an exception');// 此时抛出的异常上层会忽略，并记录到Swoole日志，需要开发者try/catch捕获处理
    }
    public function onClose(Server $server, $fd, $reactorId)
    {
        // 客户端关闭时，连接数-1 
         Redis::decr('foo'); 
         \Log::info('over message', [$fd,$reactorId,Redis::get('foo')]);
         
        // throw new \Exception('an exception');// 此时抛出的异常上层会忽略，并记录到Swoole日志，需要开发者try/catch捕获处理
    }
}