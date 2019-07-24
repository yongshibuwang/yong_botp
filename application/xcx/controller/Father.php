<?php

namespace app\xcx\controller;

use think\Controller;
use think\Db;
use think\Request;

class Father extends Controller
{
    /**
     * 用户访问统计
     *
     * @return \think\Response
     */
    public function father()
    {
        /**************************添加访问人***************************/
        //获取用户随机图像
        $img_array = glob("./public/userimg/*.{gif,jpg,png}",GLOB_BRACE);
        if($img_array){
            $img = array_rand($img_array);
            $user_ip['img']=ltrim($img_array[$img], ".");
        }else{
            $user_ip['img']="./public/static/index/images/photos1.jpg";
        }

        //获取用户访问ip
        if(getIp()){
            $user_ip['ip']=getIp();
        }else{
            $user_ip['ip']="127.0.0.1";
        }
        $user_ip['access_time']=time();
        $user_ip['access_date']=date('Ymd',time());
        $user_ip['access_web']='访问小程序';
        if($id=Db::table('access')->where('ip',$user_ip['ip'])->find()){
            if(date('Ymd',$id['access_time'])!=date('Ymd',time())){
                Db::table('access')->where('id',$id['id'])->setInc('access_num');
                Db::table('access')->where('id',$id['id'])->update(['access_time'=>time()]);
            }
        }else{
            Db::table('access')->insert($user_ip);
        }
        /**************************添加访问人end***************************/
    }
    /**
     * 返回 JSON 格式
     *
     * @param array  $data
     * @param int    $code
     * @param string $msg
     * @return \think\response\Json
     */
    public function json($data = [], $code = 200, $msg = 'success')
    {
        switch($code){
            case 403:
                $msg = '非法请求'; break;
            case 500:
                $msg = '请求参数不合法或TOKEN验证失败！'; break;
            default:
                break;
        }
        /*199为未存入数据库*/
        return json([ 'code' => $code, 'msg'  => $msg, 'list' => $data]);
    }

}
