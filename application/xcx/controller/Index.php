<?php
namespace app\xcx\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\cache\driver\Redis;

class Index extends Father
{
    public function _initialize(){
        parent::father();
    }
    /**
     * 显示首页
     *@author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function index($mobile=0)
    {
        dump(111);
    }
    /**
     * 获取用户信息
     *@author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function Getuserinfo(Request $request)
    {
        if(!$request->isGet()) return self::json([],403);
        dump(111);

    }
}
