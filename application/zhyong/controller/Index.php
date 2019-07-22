<?php

namespace app\zhyong\controller;

use think\Controller;
use think\Db;
use think\Request;

class Index extends Father
{
    public function _initialize(){
        parent::index();
        $this->assign('gl', 1);//顶部菜单高亮判断标志
    }
    /**
     * 显示首页
     * * @author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function index()
    {
        $admin_info=Db::table('admin')->find(session('admin_id'));
        $admin_info['img']=request()->domain().'/'.$admin_info['img'];
        $this->assign('admin_info',$admin_info);
        return $this->fetch();
    }
    public function welcome(){
        $admin_info=Db::table('admin')->find(session('admin_id'));
        $admin_info['img']=request()->domain().'/'.$admin_info['img'];
        $this->assign('admin_info',$admin_info);

        //最近访客（今日）
        $accessNum=Db::table('access')
            ->where('access_date',date('Ymd',time()))
            ->count();
        $this->assign('accessNum',$accessNum);
        //图表
        $sql="select access_date,count('id') as 'num' from access group by access_date order by access_time desc limit 7";
        $accessChart=Db::query($sql);
        $acc['access_time'][]=[];
        $acc['num']=[];
        if($accessChart){
            $accessChart=arraySequencedesc($accessChart,'access_date','SORT_ASC');
            foreach ($accessChart as $k => $v) {
               $acc['access'][]=$v['access_date'];
               $acc['num'][]=$v['num'];
            }
        }
        $accessData['num']="'".implode("','", $acc['num'])."'";
        $accessData['access']="'".implode("','", $acc['access'])."'";
        $this->assign('accessChart',$accessData);
       //最新文章
        $new_article=Db::table('article')->where('status=1 AND type=2')
            ->limit(6)
            ->order('add_time desc')->select();
        $this->assign('new_article',$new_article);

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

            if($admin['img']){
                $admin['img']=uploadPIC($admin['img']);
            }else{
                unset($admin['img']);
            }
            if($admin['password']){
                $admin['password']=md5(md5($admin['password']));
            }else{
                unset($admin['password']);
            }
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

        return $this->fetch();
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
