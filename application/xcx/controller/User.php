<?php
namespace app\xcx\controller;
use offen\OffenFunction;
use think\Controller;
use think\Db;
use think\Request;
use think\cache\driver\Redis;
use wechat\WXBizDataCrypt;

class User extends Father
{
    public function _initialize(){
        parent::father();
    }
    /**
     * 获取用户信息
     *@author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function uinfo(Request $request)
    {
        if(!$request->isGet()) return self::json([],403);
        //产品
        $ginfo=Db::table('goods')->where('status=1')
            ->where('uid',$_GET['uid'])->field('title,id,price,other,pic,uid')->select();
        foreach ($ginfo as $gkey=>$gval){
            $ginfo[$gkey]['pic'] = firstPic($gval['pic']);
        }
        //个人信息
        $uinfo=Db::table('user')->find($_GET['uid']);
        $uinfo['img'] = firstPic($uinfo['pic']);
        $uinfo['pic']=explode(',',$uinfo['pic']);

        if($uinfo){
            return self::json(['gi'=>$ginfo,'ui'=>$uinfo]);
        }else{
            return self::json('',199);
        }
    }
    /**
     * 获取用户信息
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
     * 获取用户信息
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
            if($id=Db::table('user')->insertGetId($data)){
                $uinfo=Db::table('user')->find($id);
                return self::json($uinfo);
            }else{
                return self::json('失败',199);
            }
        }

    }

    /**
     * 获取用户手机号
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
     * 获取用户提交的用户的修改信息
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
        if(Db::table('user')->update($data)){
            $uinfo=model('User')->find($data['id']);
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

}
