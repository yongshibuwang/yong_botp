<?php

namespace app\zhyong\controller;

use think\Controller;
use think\Request;
use think\Db;

class Set extends Father
{
    public function _initialize(){
        parent::index();
        $this->assign('gl', 3);//顶部菜单高亮判断标志
    }
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function info()
    {
        if($this->request->isAjax()){
            $data=$_POST['data'];
            $paycode=Db::table('web_info')->where('id=1')->value('img');
            if($data['img']){
                @unlink($paycode);
                $img=uploadPIC($data['img']);
                if($img){$data['img']=$img;}else{$this->error('网络出错啦！');};
            }else{
                unset($data['img']);
            }
            $data['add_time']=time();
            $data['id']=1;
            if(Db::table('web_info')->update($data)){
                $this->success('修改成功');
            }else{
                $this->error('修改失败');
            }
        }
        $web_edit=Db::table('web_info')->find(1);
        if(strstr($web_edit['img'],'http')==false){
            $web_edit['img']=request()->domain().'/'.$web_edit['img'];
        }
        $this->assign('web_edit',$web_edit);
        return $this->fetch();
        //
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
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
