<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Db;
use QL\QueryList;


// 前端公共文件
/**
 * 获取用户真实ip
 * @author 勇☆贳&卟☆莣
 * */
    function getIp(){
//        var_dump(getenv("HTTP_CLIENT_IP"));die;
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
        {$ip = getenv("HTTP_CLIENT_IP");}

        else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
        {$ip = getenv("HTTP_X_FORWARDED_FOR");}
        else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
        {$ip = $_SERVER['REMOTE_ADDR'];}
        else{$ip = "127.1.1.1";}



        return ($ip);
    }

//数据库多图片取第一张路径,图片路径已‘，’隔开；
function firstPic($img){
    $pic='';
    if($img){
        $pic=explode(',',$img);
        if(isset($pic[0])){
            return $pic[0];
        }else{
            return $pic;
        }
    }else{
        return $pic;
    }
}