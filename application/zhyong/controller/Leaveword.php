<?php

namespace app\zhyong\controller;

use think\Controller;
use think\Request;
use think\Db;

class Leaveword extends Father
{
    public function _initialize(){
        parent::index();
        $this->assign('gl', 3);//顶部菜单高亮判断标志
    }
    /**
     * 显示用户留言列表
     *@author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function user_leavewrod()
    {
        //
        $type=request()->get('type','2');
        if($type) $where['type']=$type;
        $this->assign('type',$type);
        $leave=Db::table('user_leaveword')->where('status=1')->select();
        $count =Db::table('user_leaveword')->where('status=1')->count();//总条数
        $pagesize=10;
        $url=$this->request->domain().'/zhyong/Leaveword/user_leavewrod';
        if(isset($_GET['page'])){
            $p = $_GET['page']?$_GET['page']:1;
        }else{
            $p =1;
        }
        $data=page_array($pagesize,$p,$leave,0);
        $countpage=ceil($count/$pagesize);
        $page = show_array($countpage,$url);
        $this->assign('leave',$data);
        $this->assign('page',$page);
        return $this->fetch();
    }
    /**
     * 删除用户留言
     *@author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function del_admin(){
        if(Db::table('admin')->delete($_POST['id'])){
            $this->success();
        }else{
            $this->error();
        }
    }

}
