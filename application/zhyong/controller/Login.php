<?php

namespace app\zhyong\controller;

use think\Controller;
use think\Db;
use think\Request;
use think\Session;

class Login extends Father
{
    /**
     * 显示资源列表
     * @author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function login()
    {
        if(request()->isAjax()){
            if($admin_info=Db::table('admin')->where('name',$_POST['name'])->find()){
                if($admin_info['password']==md5(md5($_POST['password']))){
                    Session::set('admin_id',$admin_info['id']);
                    Session::set('admin_user_info',$admin_info);
                    if(session('admin_id') &&session('admin_user_info')){
                        $this->success('登录成功！',url('Index/index'));
                    }
                }else{
                    $this->error('用户密码错误！');
                }
            }else{
                $this->error('用户名错误！');
            }
        }
        return $this->fetch();
    }

    /**
     * 退出登陆
     * @author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function loginOut()
    {
        if($_POST['id']==1){
            session('admin_id',0);
            session('admin_user_info',0);
            $this->success('退出成功！');
        }
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
