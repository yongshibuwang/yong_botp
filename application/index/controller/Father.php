<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class Father extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function father()
    {




        /*$arr=['小红','小明','小里','小猪','小菜','小花','小树'];

        $p=['1','2','3','4','5','6','7','8','11','111','112','113','131','132','133','136','138'];
//        dump($pid);die;
        for($i=0;$i<100000;$i++){
            $name=$arr[array_rand($arr,1)];
            $pid=$p[array_rand($p,1)];
            $sql="insert into zceshi(name,add_time,pid) values('".$name.$i."','".(time()-$i)."','".$pid."')";
            Db::query($sql);
        }
        die;*/
//        die;
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
        if($id=Db::table('access')->where('ip',$user_ip['ip'])->find()){
            if(date('Ymd',$id['access_time'])!=date('Ymd',time())){
                Db::table('access')->where('id',$id['id'])->setInc('access_num');
                Db::table('access')->where('id',$id['id'])->update(['access_time'=>time()]);
            }
        }else{
            Db::table('access')->insert($user_ip);
        }
        /**************************添加访问人end***************************/
        //最近访客（今日）
        $access=Db::table('access')
            ->where('access_date',date('Ymd',time()))
            ->order('access_num desc')->order('access_time desc')->select();
        foreach($access as &$ac){
            if(strstr($ac['img'],'http')==false){
                $ac['img']=request()->domain().$ac['img'];
            }
        }
        $this->assign('accessNum',count($access));
        $this->assign('access',$access);
        //获取网站信息
        $selfWebInfo=Db::table('web_info')->find(1);
        if(strstr($selfWebInfo['img'],'http')==false){
            $selfWebInfo['img']=request()->domain().'/'.$selfWebInfo['img'];
        }
        $this->assign('selfWebInfo',$selfWebInfo);

        /*判断今日是否抓取*/
        if(session('time')){
            if(session('time')<date('Ymd')){
                $z_time=Db::table('copy_web')->where('kind=4')->order('add_time desc')->select();
                session('time',date('Ymd',$z_time[0]['add_time']));
                if(date('Ymd',$z_time[0]['add_time'])<date('Ymd')){
                    $end=wangzherongyaonews();
                }
            }
        }else{
            $z_time=Db::table('copy_web')->where('kind=4')->order('add_time desc')->select();
            if($z_time){
                session('time',date('Ymd',$z_time[0]['add_time']));
                if(date('Ymd',$z_time[0]['add_time'])<date('Ymd')){
                    $end=wangzherongyaonews();
                }
            }else{
                $end=wangzherongyaonews();
            }
        }
        /*删除抓取超过30天的网络文章*/
        delEt30(30);
    }
    /**
     * 是否是移动端访问
     * @desc 判断是否是移动端进行访问
     * @方法一：判断是否有HTTP_X_WAP_PROFILE，有则一定是移动设备。
     * @return bool
     * @author 勇☆贳&卟☆莣
     */
    function isMobile() {
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
            return true;
        }
        // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        if (isset($_SERVER['HTTP_VIA'])) {
            // 找不到为flase,否则为true
            return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
        }
        // 脑残法，判断手机发送的客户端标志,兼容性有待提高。其中'MicroMessenger'是电脑微信
        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $clientkeywords = array('nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile','MicroMessenger');
            // 从HTTP_USER_AGENT中查找手机浏览器的关键字
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
                return true;
            }
        }
        // 协议法，因为有可能不准确，放到最后判断
        if (isset ($_SERVER['HTTP_ACCEPT'])) {
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
                return true;
            }
        }
        return false;
    }

}
