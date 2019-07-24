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

/*自定义微信常量*/
$wx = \think\Config::get('wxconfig');
if($wx){
    define('WXAPPID',$wx['AppID']);
    define('WXAPPSECRET',$wx['AppSecret']);
}else{
    define('WXAPPID','');
    define('WXAPPSECRET','');
}
// 应用公共文件
/**
 * 上传菜单图标base64
 * @author 勇☆贳&卟☆莣
 * $pic 经base64压缩后的一段字符串
 * */
function menuImg($pic){
    $imageName = date("His", time()) . "_" . rand(1000000, 9999999) . '.png';
    $image = $pic;
    if (strstr($image, ",")) {
        $image = explode(',', $image);
        $image = $image[1];
    }
    $path = "menuimg";
    if (!is_dir($path)) { //判断目录是否存在 不存在就创建
        mkdir($path, 0777, true);
    }
    $imageSrc = $path . "/" . $imageName;
    $r = file_put_contents($imageSrc, base64_decode($image));
    if (!$r) {
        return false;
    } else {
        return $imageSrc;
    }
}
/**
 * base64上传图片
 * @author 勇☆贳&卟☆莣
 * $pic 经base64压缩后的一段字符串
 * */
function uploadPIC($pic){
    $imageName = date("His", time()) . "_" . rand(1000000, 9999999) . '.png';
    $image = $pic;
    if (strstr($image, ",")) {
        $image = explode(',', $image);
        $image = $image[1];
    }
    $path = "uploads/" . date("Ymd", time());
    if (!is_dir($path)) { //判断目录是否存在 不存在就创建
        mkdir($path, 0777, true);
    }
    $imageSrc = $path . "/" . $imageName;
    $r = file_put_contents($imageSrc, base64_decode($image));
    if (!$r) {
        return false;
    } else {
        return $imageSrc;
    }
}
/**
 * 二维数组根据字段进行排序
 * @params array $array 需要排序的数组
 * @params string $field 排序的字段
 * @params string $sort 排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
 */
function arraySequencedesc($array, $field, $sort = 'SORT_DESC')
{
    $arrSort = array();
    foreach ($array as $uniqid => $row) {
        foreach ($row as $key => $value) {
            $arrSort[$key][$uniqid] = $value;
        }
    }
    array_multisort($arrSort[$field], constant($sort), $array);
    return $array;
}

/**  * 分页及显示函数
 * $countpage 全局变量，照写
 * $url 当前url
 * 输出：
 *  $web=Db::table('web')->where('status=1')->order('sort desc,add_time desc')->select();//数据
        foreach($web as &$val){
            $val['img']=request()->domain().'/'.$val['img'];
        }
        $count =Db::table('web')->where('status=1')->order('sort desc,add_time desc')->count();//总条数
        $pagesize=10;
        $url=$this->request->domain().'/zhyong/Oftenweb/web';
        if(isset($_GET['page'])){
            $p = $_GET['page']?$_GET['page']:1;
        }else{
            $p =1;
        }
        $data=page_array($pagesize,$p,$web,0);
        $countpage=ceil($count/$pagesize);
        $article = show_array($countpage,$url);
        $this->assign('web',$data);
        $this->assign('article',$article);
 *  *  */
function show_array($countpage,$url,$num=6){
    $page=empty($_GET['page'])?1:$_GET['page'];
    if($page > 1){
        $uppage=$page-1;
    }else{
        $uppage=1;
    }
    if($page < $countpage){
        $nextpage=$page+1;
    }else{
        $nextpage=$countpage;
    }
    if($countpage){
        $str='<div style="border:1px; width:100%; height:30px; color:#fff">';
//    $str.="<span style=''><a href='javascript:;'>共 {$countpage} 页 / 第 {$page} 页</a></span>";
        $str.="<span style=''><a href='$url?page=1'>   首页  </a></span>";
//    $str.="<span style=''><a href='$url?page={$uppage}'> 上一页  </a></span>";
        $str.=pagebar($countpage, $page,$num,$url);
//    $str.="<span style=''><a href='$url?page={$nextpage}'>下一页  </a></span>";
        $str.="<span style=''><a href='$url?page={$countpage}'>尾页  </a></span>"; $str.='</div >';
    }else{
        $str="";
    }
    return $str;
}
/**
 * $count 总页数
 * $page 当前页号
 * $num 显示的页码数
 * $url 链接地址
 **/
function pagebar($count, $page, $num,$url) {
    $num = min($count, $num); //处理显示的页码数大于总页数的情况
    if($page > $count || $page < 1) return; //处理非法页号的情况
    $end = $page + floor($num/2) <= $count ? $page + floor($num/2) : $count; //计算结束页号
    $start = $end - $num + 1; //计算开始页号
    if($start < 1) { //处理开始页号小于1的情况
        $end -= $start - 1;
        $start = 1;
    }
    $str="";
    for($i=$start; $i<=$end; $i++) { //输出分页条，请自行添加链接样式
        if($i == $page)
            $str.= "<span><a style='background-color:#e8ecff;' href='$url?page={$i}'> {$i}  </a></span>";
        else
            $str.= " <span><a href='$url?page={$i}'> {$i}  </a></span> ";
    }
    return $str;
}
/**
 * 数组分页函数  核心函数  array_slice
 * 用此函数之前要先将数据库里面的所有数据按一定的顺序查询出来存入数组中
 * $count   每页多少条数据
 * $page   当前第几页
 * $array   查询出来的所有数组
 * order 0 - 不变     1- 反序
 */
function page_array($count,$page,$array,$order){
    global $countpage; #定全局变量
    $page=(empty($page))?'1':$page; #判断当前页面是否为空 如果为空就表示为第一页面
    $start=($page-1)*$count; #计算每次分页的开始位置
    if($order==1){
        $array=array_reverse($array);
    }
    $totals=count($array);
    $countpage=ceil($totals/$count); #计算总页面数
    $pagedata=array();
    $pagedata=array_slice($array,$start,$count);
    return $pagedata;  #返回查询数据
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