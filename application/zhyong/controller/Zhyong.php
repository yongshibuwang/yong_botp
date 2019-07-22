<?php

namespace app\zhyong\controller;

use think\Controller;
use think\Request;
use think\Db;

class Zhyong extends Father
{
    public function _initialize(){
        parent::index();
        $this->assign('gl', 2);//顶部菜单高亮判断标志

    }
    /**
     * 显示管理员列表
     *@author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function index()
    {
        //
        $user=Db::table('admin')->where('status=1')->select();
        $this->assign('user',$user);
        return $this->fetch();
    }
    /**
     * 显示创建资源表单页.
     * @author 勇☆贳&卟☆莣
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function add(Request $request)
    {
        if($request->isAjax()){
            $admin=$_POST;
            if(is_array($admin['ChkTrue'])){
                foreach($admin['ChkTrue'] as $key=>$val){
                    $meau=explode('_',$val);
                    $meau_p[]=$meau[0];
                    $meau_z[]=$meau[1];
                }
                $data['ChkTrue']=array_merge($meau_z,array_unique($meau_p));
            }else{
                $data['ChkTrue']=[];
            }
            if($admin['img']){
                $admin['img']=uploadPIC($admin['img']);
            }
            $admin['add_time']=time();
            $admin['role']=implode(',',$data['ChkTrue']);
            $admin['password']=md5(md5($admin['password']));
            unset($admin['ChkTrue']);
            $result=Db::table('admin') ->insert($admin);
            if($result){
                $this->success('添加成功');
            }else{
                $this->error('网络出错啦！');
            }
        }
        $menu=parent_menu();
        $this->assign('menu',$menu);
        return $this->fetch();
    }

    /**
     * 保存新建的资源
     * @author 勇☆贳&卟☆莣
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        if(request()->isAjax()){
            $admin=$_POST;
            if(is_array($admin['ChkTrue'])){
                foreach($admin['ChkTrue'] as $key=>$val){
                    $meau=explode('_',$val);
                    $meau_p[]=$meau[0];
                    $meau_z[]=$meau[1];
                }
                $data['ChkTrue']=array_merge(array_unique($meau_p),$meau_z);
            }else{
                $data['ChkTrue']=[];
            }
            if($admin['img']){
                $admin['img']=uploadPIC($admin['img']);
            }else{
                unset($admin['img']);
            }

            $admin['role']=implode(',',$data['ChkTrue']);
            if($admin['password']){
                $admin['password']=md5(md5($admin['password']));
            }else{
                unset($admin['password']);
            }
            unset($admin['ChkTrue']);
            $admin['id']=$id;
            $admin['add_time']=time();
            $result=Db::table('admin')->update($admin);
            if($result){
                $this->success('编辑成功');
            }else{
                $this->error('网络出错啦！');
            }
        }
        $admin_info=Db::table('admin')->find($id);
        $admin_info['img']=request()->domain().'/'.$admin_info['img'];
        $this->assign('admin_info',$admin_info);
        $menu_all=get_allmenu();
//        dump($menu_all);die;
        $this->assign('menu_all',$menu_all);

        return $this->fetch();
    }
    public function del_admin(){
        if(Db::table('admin')->delete($_POST['id'])){
            $this->success();
        }else{
            $this->error();
        }
    }
/*****************************************菜单管理************************************/
    /**
     * 显示菜单
     *@author 勇☆贳&卟☆莣
     * @param
     * @return \think\Response
     */
    public function menu()
    {
        $menu_data =Db::table('admin_menu')->order('id asc')->select();
        $count =Db::table('admin_menu')->count();
        $pagesize=15;
        $url=$this->request->domain().'/zhyong/zhyong/menu';
        if(isset($_GET['page'])){
            $p = $_GET['page']?$_GET['page']:1;
        }else{
            $p =1;
        }
        $data= getTrees($menu_data,0,0);
        $menu_info=page_array($pagesize,$p,$data,0);
        $countpage=ceil($count/$pagesize);
        $page = show_array($countpage,$url);
        $this->assign('menu_info',$menu_info);
        $this->assign('page',$page);
        return $this->fetch();
    }
    /**
     * 添加顶级菜单
     *@author 勇☆贳&卟☆莣
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function topmenuadd(Request $request)
    {
        if($request->isAjax()){
            $data=$request->post();
            $data['er']=1;
            if($data['data']['img']){
                $img=menuImg($data['data']['img']);
                if($img){$data['data']['img']=$img;}else{$this->error('网络出错啦！');};
            }else{
                unset($data['data']['img']);
            }
            if(Db::table('admin_menu')->insert($data['data'])){
                $this->success('添加成功');
            }else{
                $this->error('网络出错啦！');
            }
        }
        return $this->fetch();
    }
    /**
     * 添加菜单
     *@author 勇☆贳&卟☆莣
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function menuadd(Request $request,$id=0,$er=3)
    {
        if($request->isAjax()){
            $data=$request->post();
            $data['er']=$er;
            if($data['data']['img']){
                $img=menuImg($data['data']['img']);
                if($img){$data['data']['img']=$img;}else{$this->error('网络出错啦！');};
            }else{
                unset($data['data']['img']);
            }
            if(Db::table('admin_menu')->insert($data['data'])){
                $this->success('添加成功');
            }else{
                $this->error('网络出错啦！');
            }
        }

        if($id){
            $info=Db::table('admin_menu')->find($id);
        }else{
            $info['menu_name']="";
            $info['id']="";
        }
        $this->assign('info',$info);
        $this->assign('er',$er);
        return $this->fetch();
    }
    /**
     * 编辑菜单
     *@author 勇☆贳&卟☆莣
     *  @param  int  $id
     * @return \think\Response
     */
    public function menuedit($id)
    {
        if(request()->isAjax()){
            $data=request()->post();
            if($data['data']['img']){
                $img=menuImg($data['data']['img']);
                if($img){$data['data']['img']=$img;}else{$this->error('网络出错啦！');};
            }else{
                unset($data['data']['img']);
            }
            $data['data']['id']=$id;
            if(Db::table('admin_menu')->update($data['data'])){
                $this->success('修改成功');
            }else{
                $this->error('没有任何更新！');
            }
        }
        $info=Db::table('admin_menu')->find($id);
        if($info['img'] && strstr($info['img'],'http')==false){
            $info['img']=request()->domain().'/'.$info['img'];
        }
        $this->assign('info',$info);
        return $this->fetch();
    }

    /**
     * 删除菜单
     * @return \think\Response
     */
    public function del_menu()
    {
        if(Db::table('admin_menu')->delete($_POST['id'])){
            $this->success();
        }else{
            $this->error();
        }
    }
}
