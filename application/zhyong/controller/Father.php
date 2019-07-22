<?php

namespace app\zhyong\controller;

use think\Controller;
use think\Db;
use think\Request;

class Father extends Controller
{
    /**
     * 显示资源列表
     * @author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function index()
    {
        if(!session('admin_id')){
            header('location:'.request()->domain().'/Zhyong/Login/login');
            die;
        }
        //获取用户管理权限
        $role=Db::table('admin')->where('id',session('admin_id'))->value('role');
        $menu=get_menu($role);
        $http=request()->domain().'/';
        $this->assign('menu',$menu);
        $this->assign('http',$http);
//        dump(session('admin_user_info'));die;
        $img=request()->domain().'/'.session('admin_user_info')['img'];
        $this->assign('admin_user_info',session('admin_user_info'));
        $this->assign('img',$img);
        /*判断是否有权限查看*/
        $user_controller=request()->controller();//控制器名
        $user_action=request()->action();//方法名
        $menu_id=db('admin_menu')
            ->where('controller',$user_controller)
            ->where('function',$user_action)->value('id');
        $rolearr=explode(',',$role);
//        dump($user_action);die;
        if($user_controller!='Index' && $user_action!='pid' && $user_action!='pidadd' && $user_action!='pidedit'){
            if(!in_array($menu_id,$rolearr)){
                echo    "<script>
                            alert('抱歉你没有权利查看！');
                            history.back(-1);
                        </script>";
                die;
            }
        }


    }
}
