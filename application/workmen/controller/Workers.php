<?php

namespace app\workmen\controller;

use think\worker\Server;
use think\Db;
class Workers extends Server
{
    protected $socket = 'websocket://127.0.0.1:2346';
    /**
     * 收到信息
     * @param $connection
     * @param $data
     */
    public function onMessage($connection, $data)
    {
        //仿微信更改状态
        $sql='select status from admin where id=1';
        $info=Db::query($sql);
        $connection->send($info[0]['status']);
        self::onClose();
    }

    /**
     * 当连接建立时触发的回调函数
     * @param $connection
     */
    public function onConnect($connection)
    {

    }

    /**
     * 当连接断开时触发的回调函数
     * @param $connection
     */
    public function onClose($connection)
    {
        $connection->send('已关闭');
    }

    /**
     * 当客户端的连接上发生错误时触发
     * @param $connection
     * @param $code
     * @param $msg
     */
    public function onError($connection, $code, $msg)
    {
        echo "error $code $msg\n";
    }

    /**
     * 每个进程启动
     * @param $worker
     */
    public function onWorkerStart($worker)
    {

    }




}
