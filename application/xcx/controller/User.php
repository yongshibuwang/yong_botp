<?php
namespace app\xcx\controller;
use offen\OffenFunction;
use think\Cache;
use think\Controller;
use think\Db;
use think\Request;
use think\cache\driver\Redis;
use wechat\getCord;
use wechat\WXBizDataCrypt;

class User extends Father
{
    public function _initialize(){
        parent::father();
    }
    /**
     * 获取用户及产品信息
     *@author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function uinfo(Request $request)
    {
        if(!$request->isGet()) return self::json([],403);
        //产品
        $ginfo=Cache::store('redis')->get('goodslist'.$_GET['uid']);
        if(!$ginfo){
            $ginfo=Db::table('goods')->where('status=1')
                ->where('uid',$_GET['uid'])->field('title,id,price,other,pic,uid')->select();
            foreach ($ginfo as $gkey=>$gval){
                $ginfo[$gkey]['pic'] = firstPic($gval['pic']);
            }
        }
        //个人信息
        $uinfo=Cache::store('redis')->get('userInfo'.$_GET['uid']);
        if(!$uinfo){
            $uinfo=Db::table('user')->find($_GET['uid']);
            $uinfo['img'] = firstPic($uinfo['pic']);
            $uinfo['pic']=explode(',',$uinfo['pic']);
        }
        if($uinfo){
            return self::json(['gi'=>$ginfo,'ui'=>$uinfo]);
        }else{
            return self::json('',199);
        }
    }
    /*获取用户及下级*/
    public function u_finfo(Request $request)
    {
        if(!$request->isGet()) return self::json([],403);
        //个人信息
        $uinfo=Db::table('user')->field('id,link_people,head_img,money,access') ->find($_GET['uid']);
        $uinfo['wei'] = Db::table('user')->where('fid',$_GET['uid'])
            ->where('vip',0)
            ->count();
        $uinfo['yi'] = Db::table('user')->where('fid',$_GET['uid'])
            ->where('vip',1)
            ->count();
        $uinfo['vip'] = Db::table('user')->where('fid',$_GET['uid'])
            ->where('vip',2)
            ->count();

        if($uinfo){
            return self::json($uinfo);
        }else{
            return self::json('',199);
        }
    }
    /*更新上级fid*/
    public function upfid(Request $request){
        if(!$request->isGet()) return self::json([],403);
        $gid = $request->get('gid','0');
        /*更新及添加访问量*/
        if($_GET['id'] != $_GET['fid']){
            $beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
            $endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
            $accid = Db::table('xcxaccess')
                ->where('uid',$_GET['fid'])
                ->where('aid',$_GET['id'])
                ->where('gid',$gid)
                ->where($beginToday.' <= read_time <='.$endToday)->field('id')->find();
            if($accid){
                if(@Db::table('xcxaccess')->where('id',$accid['id'])->setInc('num')){
                    Db::table('user')->where('id',$_GET['fid'])->setInc('access');
                };
            }else{
                $acc['uid']=$_GET['fid'];
                $acc['aid']=$_GET['id'];
                $acc['gid']=$gid;
                $acc['read_time']=time();
                if(@Db::table('xcxaccess')->insert($acc)){
                    Db::table('user')->where('id',$_GET['fid'])->setInc('access');
                }
                ;
            }
            if(Db::table('user')->where('id',$_GET['id'])->value('fid')){
                return self::json('');
            }else{
                $up['id']=$_GET['id'];
                $up['fid']=$_GET['fid'];
                if(Db::table('user')->update($up)){
                    return self::json('');
                }else{
                    return self::json('',199);
                }
            }
        }else{
            return self::json('',199);
        }

    }
    /**
     * 获取用户首次登陆的code信息
     *@author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function index(Request $request)
    {
        if(!$request->isGet()) return self::json([],403);
        //声明CODE，获取小程序传过来的CODE
        $code = $_GET["code"];
        //配置appid
        $appid = WXAPPID;
        //配置appscret
        $secret = WXAPPSECRET;
        //api接口
        $api = "https://api.weixin.qq.com/sns/jscode2session?appid=".$appid."&secret=".$secret."&js_code=".$code."&grant_type=authorization_code";
        //获取GET请求
        $str = json_decode(curl($api),true);
        $uinfo=model('User')->where('openid',$str['openid'])->find();
        if($uinfo){
            return self::json($uinfo);
        }else{
            $data['session_key']=$str['session_key'];
            $data['openid']=$str['openid'];
            $data['add_time']=time();
            $id=Db::table('user')->insertGetId($data);
            $uinfo=model('User')->find($id);
            return self::json($uinfo,199);
        }
    }
    public function userinfo(Request $request)
    {
        if(!$request->isGet()) return self::json([],403);
        //个人信息
        $uinfo=Db::table('user')->find($_GET['uid']);
        $uinfo['img'] = firstPic($uinfo['pic']);
        $uinfo['pic']=explode(',',$uinfo['pic']);

        if($uinfo){
            return self::json($uinfo);
        }else{
            return self::json('',199);
        }
    }
    /**
     * 获取用户微信信息
     *@author 勇☆贳&卟☆莣
     * @return \think\Response
     */
     public function GetUserInfo(Request $request)
    {
        if(!$request->isPost()) return self::json([],403);
        $data['name']=$_POST['nickName'];
        $data['sex']=$_POST['gender'];
        $data['head_img']=$_POST['avatarUrl'];
        $data['id']=$_POST['id'];
        if($data['id']){
            if(Db::table('user')->update($data)){
                $uinfo=Db::table('user')->find($data['id']);
                return self::json($uinfo);
            }else{
                $uinfo=Db::table('user')->find($data['id']);
                return self::json($uinfo);
            }
        }else{
            unset($data['id']);
            $data['add_time']=time();
            if($id=Db::table('user')->insertGetId($data)){

                $uinfo=Db::table('user')->find($id);
                return self::json($uinfo);
            }else{
                return self::json('失败',199);
            }
        }

    }

    /**
     * 获取用户微信手机号
     *@author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function GetUserPhone(Request $request)
    {
        if(!$request->isGet()) return self::json([],403);
        $code          = $_GET['code'];
        $iv            = $_GET['iv'];
        $encryptedData = $_GET['encryptedData'];
        $openid = $_GET['openid'];
        $appid      = WXAPPID;//小程序唯一标识   (在微信小程序管理后台获取)
        $appsecret  = WXAPPSECRET;//小程序的 app secret (在微信小程序管理后台获取)
        $grant_type = "authorization_code"; //授权（必填）
        $params = "appid=".$appid."&secret=".$appsecret."&js_code=".$code."&grant_type=".$grant_type;
        $url = "https://api.weixin.qq.com/sns/jscode2session?".$params;
        $res = json_decode(curl($url),true);
//json_decode不加参数true，转成的就不是array,而是对象。 下面的的取值会报错  Fatal error: Cannot use object of type stdClass as array in
        $sessionKey = $res['session_key'];//取出json里对应的值
        $pc = new WXBizDataCrypt($appid, $sessionKey);
        $errCode = $pc->decryptData($encryptedData, $iv, $data);
        /*解密*/
        $phone = $data->phoneNumber;
        if($uid=Db::table('user')->where('openid',$openid)->value('id')){
            $u['phone']=$phone;
            $u['id']=$uid;
            Db::table('user')->update($u);
            $u_info=model('User')->find($uid);
            return self::json($u_info);
        }else{
            return self::json($errCode,199);
        }
    }
    /**
     * 获取用户提交的修改信息
     *@author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function GetUserSub(Request $request){
        if(!$request->isPost()) return self::json([],403);
        $data=$_POST;
        $adress = $data['city'].$data['county'].$data['address'];
        $url = "https://apis.map.qq.com/ws/geocoder/v1/?address=".$adress."&key=5GPBZ-W6DKX-KF64X-7IF6L-J32IQ-XEBOU";
        $result =json_decode(curl($url),true) ;
        if($result['status'] == 0){
            $data['lng'] = $result['result']['location']['lng'];
            $data['lat'] = $result['result']['location']['lat'];
        }
        if(!$data['pic']){
            unset($data['pic']);
        }

        //            获取二维码
        $id = $data['id'];
        $uid = $data['id'];
        $path = "pages/goods/goodsh/index";
        $code = new getCord(WXAPPID,WXAPPSECRET,$id,100,$path,$uid);
        /*删除指定日期前的文件*/
        $dir = 'goods';
        if (!is_dir($dir)) { //判断目录是否存在 不存在就创建
            mkdir($dir, 0777, true);
        }
        if(is_file($dir.'/user_'.$id.'.png')){
            @unlink($dir.'/user_'.$id.'.png');
        }
        $file_path = $dir.'/user_'.$id.'.png';
        file_put_contents($file_path, $code->get_qrcode());//保存二维码
        $data['er_code'] = $request->domain().'/'.$file_path;

        if(Db::table('user')->update($data)){
            $uinfo=model('User')->find($data['id']);
            if($uinfo['vip']!==2){
                $vip['vip']= 1;
                $vip['id']= $data['id'];
                Db::table('user')->update($vip);
            }
            /*写入缓存*/
            //个人信息
            $userinfo=Db::table('user')->find($data['id']);
            if($userinfo['pic']){
                $userinfo['img'] = firstPic($userinfo['pic']);
                $userinfo['pic']=explode(',',$userinfo['pic']);
            }
            Cache::store('redis')->set('userInfo'.$data['id'],$userinfo);
            return self::json($uinfo);
        }else{
            return self::json($data);
        }
    }
    /*
     * 获取用户提交的轮播图图片
     * */
    public function GetUserImg(Request $request){
        $file = request()->file('file');
        if ($file) {
            $path = "uploads/";
            $info = $file->move($path);
            if ($info) {
                $file = $info->getSaveName();
                $file=str_replace('\\','/',$file);
                $filepath=$request->domain().'/'.$path.$file;
                return $filepath;
            }
        }
    }
    /*
     * 删除图片
     * */
    public function DelImg(Request $request){
        if(!$request->isPost()) return self::json([],403);
        $table=$_POST['table'];
        $img = $_POST['img'];
        $id = $_POST['id'];
        $field = $_POST['field'];
        $function=new OffenFunction();
        $info = $function->delImg($table,$id,$field,$img);
        if($info){
            $uinfo=Db::table($table)->find($id);
            return self::json($uinfo);
        }else{
            return self::json('删除失败',199);
        }
    }
    /*
     * 访问记录
     * */
    public function AccEss(Request $request){
        if(!$request->isGet()) return self::json([],403);
        $id = $_GET['id'];
        $data = Db::table('xcxaccess')->alias('x')
            ->join('user u','u.id=x.aid')
            ->field('x.read_time,x.gid,x.num,u.name,u.phone')
            ->where('uid',$id)
            ->order('read_time desc')
            ->select();
        $father=Db::table('user')->field('vip,color')->find($id);
        foreach ($data as &$val){
            $val['read_time'] = date('Y-m-d H:i',$val['read_time']);
            if($father['vip'] !=2){
                $val['phone'] = substr_replace($val['phone'], '****', 3, 4);
            }
            $val['color']=$father['color'];
            $val['vip']=$father['vip'];
        }
        return self::json($data);
    }

    /*
     * 用户金额
     * */
    public function uMoney(Request $request){
        if(!$request->isGet()) return self::json([],403);
        $id = $_GET['id'];
        $data = Db::table('user_money')->alias('x')
            ->join('user u','u.id=x.uid')
            ->field('x.*,u.color,u.vip')
            ->where('uid',$id)
            ->order('add_time desc')
            ->select();
        foreach ($data as &$val){
            $val['add_time'] = date('Y-m-d H:i',$val['add_time']);
            if($val['vip'] !=2){
                $val['wechat'] = "******";
            }
        }
        return self::json($data);
    }
    /*
     * 用户发展的小程序
     * */
    public function develop(Request $request){
        if(!$request->isGet()) return self::json([],403);
        $data['fid'] = $_GET['id'];
        $data['vip'] = $_GET['vip'];
        $father=Db::table('user')->field('vip,color')->find($data['fid']);
        $data = Db::table('user')
            ->field('link_people,phone,wechat,add_time')
            ->where($data)
            ->order('id desc')
            ->select();
        foreach ($data as &$val){
            $val['add_time'] = date('Y-m-d H:i',$val['add_time']);
            if($father['vip'] !=2){
                $val['wechat'] = "******";
                $val['phone'] = substr_replace($val['phone'], '****', 3, 4);
            }
            $val['color']=$father['color'];
            $val['vip']=$father['vip'];
        }
        return self::json($data);
    }


}
