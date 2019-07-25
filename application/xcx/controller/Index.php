<?php
namespace app\xcx\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\cache\driver\Redis;
use wechat\WXBizDataCrypt;

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
    public function GetUserInfo(Request $request)
    {
        if(!$request->isGet()) return self::json([],403);
        $code          = $_GET['code'];
        $iv            = $_GET['iv'];
        $encryptedData = $_GET['encryptedData'];
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
        if ($errCode == 0) {
            $data=json_decode($data,true);
            /*存入数据库*/
            $u['phone']=$data['phoneNumber'];
            if($u_info=Db::table('user')->where('phone',$u['phone'])->find()){
                return self::json($u_info);
            }else{
                $u['add_time']=time();
                if($id=Db::table('user')->insertGetId($u)){
                    $u_info=Db::table('user')->find($id);
                    return self::json($u_info);
                }else{
                    return self::json($data,199);
                }
            }
        } else {
            return self::json($errCode,199);
        }

    }
}
