<?php


namespace wechat;


class getCord
{
    private $appid;
    private $secret;
    private $id;
    private $width;
    public function __construct($appid,$secret,$id = 0,$width = '300'){
        $this->appid = $appid;
        $this->secret = $secret;
        $this->id = $id;
        $this->width = $width;
    }
    //获取access_token
    public function get_access_token()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->appid."&secret=".$this->secret;
        return $data = $this->curl($url);
    }

//    public function curl_get($url) {
//        $curl = curl_init();
//        curl_setopt($curl, CURLOPT_URL, $url);
//        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//        $data = curl_exec($curl);
//        $err = curl_error($curl);
//        curl_close($curl);
//        return $data;
//    }

    //获得二维码
    public function get_qrcode() {
        //header('content-type:image/gif');
        //header('content-type:image/png');格式自选，不同格式貌似加载速度略有不同，想加载更快可选择jpg
        header('content-type:image/jpg');
        $id = $this->id;
        $data = array();
        $data['scene'] = "id=".$id;
        $data['page'] = "pages/goods/goodsi/info";  //参数跳转到product/show，产品详情
        $data['width'] = $this->width;
        $data = json_encode($data);
        $access = json_decode($this->get_access_token(),true);
        $access_token= $access['access_token'];
        $url = "https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=" . $access_token;
        $da = $this->curl($url,'post',$data);
        return $da;
    }
    public function get_http_array($url,$post_data) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   //没有这个会自动输出，不用print_r();也会在后面多个1
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $output = curl_exec($ch);
        curl_close($ch);
        $out = json_decode($output);
        return $out;
    }

    /**
     * 万能curl
     * 默认get提交
     * $url   请求路径
     * $type   请求方式
     */
    function curl($url,$type='get',$post_data=''){
        //curl模拟GET请求
        //1.初始curl
        $curl=curl_init();
        //2.设置参数
        //设置要请求的url地址
        curl_setopt($curl,CURLOPT_URL,$url);
        //设置请求到的内容不在浏览器中直接显示，而是以文档流的方式返回
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
        if($type=='post'){
            //设置curl提交的方式为post类型
            curl_setopt($curl,CURLOPT_POST,1);
            //设置post要提交的数据
            curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
        }
        //3.执行curl
        $res=curl_exec($curl);
        //4.关闭curl
        curl_close($curl);
        //返回结果
        return $res;
    }

}