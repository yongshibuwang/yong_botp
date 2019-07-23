<?php
use think\Db;
/**
 * 获得后台管理菜单
 * @author 勇☆贳&卟☆莣
 **/
/*获得登陆者所拥有的权限菜单*/
function get_menu($data){
    $list= db('admin_menu')->where('id in ('.$data.')')->order('id asc')->select();
    //查询下面所有的子菜单
    foreach($list as $key => $v){
        if(!$v['pid']){
            $childlist=db('admin_menu')->where('pid',$v['id'])->where('id in('.$data.')')->order('id asc')->select();
            $list[$key]['child_menu']=$childlist;
        }else{
            unset($list[$key]);
        }
    }
    return $list;
}
/**
 * 获得后台管理菜单
 * @author 勇☆贳&卟☆莣
 **/
/*获得登陆者所拥有的权限菜单*/
function get_allmenu(){
    $list= db('admin_menu')->order('id asc')->select();
    //查询下面所有的子菜单
    foreach($list as $key => $v){
        if(!$v['pid']){
            $childlist=db('admin_menu')->where('pid',$v['id'])->order('id asc')->select();
            $list[$key]['child_menu']=$childlist;
            foreach($childlist as $ckey => $cv){
                if(!$v['pid']){
                    $childlists=db('admin_menu')->where('pid',$cv['id'])->order('id asc')->select();
                    $list[$key]['child_menu'][$ckey]['childs_menu']=$childlists;
                }else{
                    unset($list[$key]);
                }
            }
        }else{
            unset($list[$key]);
        }
    }
    return $list;
}
function parent_menu(){
    //一级分类
    $list= db('admin_menu')->where('pid',0)->order('id asc')->select();
    //二级分类
    foreach($list as $ak=>$av){
        $childlist=db('admin_menu')->where('pid',$av['id'])->order('id asc')->select();
        $list[$ak]['child_menu']=$childlist;
    }
    return $list;
}
/**
 * 无限级分类,获取菜单
 * @author 勇☆贳&卟☆莣
 * */
function getTrees($arr,$pid,$step = 0){
    global $tree;
    foreach($arr as $val){
        if($val['pid'] == $pid) {
            $flag = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$step);
            $val['menu_name'] = $flag.'<span class="span_depart ">'.$val['menu_name'].'<span>';
            if($val['pid']){
                $val['pid']=Db::table('admin_menu')->where('id',$val['pid'])->value('menu_name');
            }
            $tree[] = $val;
            getTrees($arr , $val['id'] ,$step+1);
        }
    }
    return $tree;
}
/**
 * [writeArr 写入配置文件方法]
 * @param  [type] $arr      [要写入的数据]
 * @param  [type] $filename [文件路径]
 * @return [type]           [description]
 */
function w_wxconfig($arr, $filename) {
    $txt="<?php \r\n 
// +---------------------------------------------------------------------- 
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  勇☆贳&卟☆莣 <1329939330@qq.com>
// +----------------------------------------------------------------------
  \r\n  return " . var_export($arr, true) . ";";
    return file_put_contents($filename, $txt);
}









