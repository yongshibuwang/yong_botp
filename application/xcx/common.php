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
    function wangzherongyaonews(){
    /**************************抓取文章***************************/
        // 采集王者荣耀文章列表中所有[文章]的超链接和超链接文本内容
        $data = QueryList::get('https://pvp.qq.com/webplat/info/news_version3/15592/24091/24092/m20041/list_1.shtml')
            ->rules([
                'link' =>  ['a.art_word','href','',function($cont){ return 'https://pvp.qq.com'.$cont;}],
                'title' => ['a.art_word','text'],
                'time' =>  ['span.art_day','text'],
            ])->range('.art_l_list .art_lists li')->encoding('UTF-8','GBK')->query()->getData();

        $data=$data->all();
        foreach ($data as $key=>$val){
            $info['pid']=18;
            $info['time']=strtotime($val['time']);
            $info['add_time']=time();
            $info['title']=$val['title'];
            $info['describe']=$val['title'];
            $info['link']=$val['link'];
            $info['type']=2;
            $info['author']='腾讯官网';
            $info['kind']=4;
            if(Db::table('copy_web')->where('title',$info['title'])->count()){
                continue;
            }else{
                Db::table('copy_web')->insert($info);
            }
        }
            return '更新成功！';
    /**************************抓取文章（END）***************************/
    }
    /*******************************删除抓取时间超过30天的数据*************************************/
    function delEt30($day){
        $day_num=$day*24*3600;
        $time=(int)time()-(int)$day_num;
        $sql='select id from copy_web where kind=4 AND add_time < '.$time;
        $data=Db::query($sql);
        foreach ($data as $dkey=>$dval){
            Db::table('copy_web')->where('id',$dval['id'])->delete();
        }
        $sql1='select id from ling where add_time < '.$time;
        $data1=Db::query($sql1);
        foreach ($data1 as $dkey1=>$dval1){
            Db::table('ling')->where('id',$dval1['id'])->delete();
        }
    }
    /*******************************删除抓取时间超过30天的数据*************************************/