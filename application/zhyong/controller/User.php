<?php

namespace app\zhyong\controller;

use think\Controller;
use think\Db;
use think\Request;

class User extends Father
{
    public function _initialize(){
        parent::index();
        $this->assign('gl', 3);//顶部菜单高亮判断标志
    }
    /**
     * 显示后端文章列表
     * @author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function index()
    {
        $list=Db::table('user')
            ->where('is_black=0')
            ->order('add_time desc')
            ->paginate(10);
        $page = $list->render();
        $this->assign('page',$page);
        $this->assign('list',$list);

        
        return $this->fetch();
    }

    /**
     * 保存新建的资源
     *@author 勇☆贳&卟☆莣
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request,$type=0)
    {
        if($request->isAjax()){
            $data=$request->post();
            if($data['data']['img']){
                $img=uploadPIC($data['data']['img']);
                if($img){$data['data']['img']=$img;}else{$this->error('网络出错啦！');};
            }else{
                unset($data['data']['img']);
            }
            if(!$data['data']['author']) unset($data['data']['author']);
            $data['data']['add_time']=time();
            $data['data']['type']=2;
            $data['data']['status']=1;
            if($type==3){
                if(Db::table('copy_web')->insert($data['data'])){
                    $this->success('添加成功');
                }else{
                    $this->error('网络出错啦！');
                }
            }else{
                if(Db::table('article')->insert($data['data'])){
                    $this->success('添加成功');
                }else{
                    $this->error('网络出错啦！');
                }
            }

        };
        $arr=['','后端文章','前端文章','随笔'];
        $kind['id']=$type;
        $kind['name']=$arr[$type];
        $label=Db::table('label')->where('kid',$type)->select();
        $this->assign('label',$label);
        $this->assign('kind',$kind);
        return $this->fetch();
    }
    /**
     * 显示编辑资源表单页.
     *@author 勇☆贳&卟☆莣
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        if(request()->isAjax()){
            $data=request()->post();
            $articleimg=Db::table('article')->where('id',$id)->value('img');
            if($data['data']['img']){
                $img=uploadPIC($data['data']['img']);
                if($img){$data['data']['img']=$img;}else{$this->error('网络出错啦！');};
                @unlink($articleimg);
            }else{
                unset($data['data']['img']);
            }
            if(!$data['data']['author']) unset($data['data']['author']);
            if(Db::table('article')->update($data['data'])){
                $this->success('修改成功');
            }else{
                $this->error('网络出错啦！');
            }
        }
        $article_edit=Db::table('article')->find($id);
        $label=Db::table('label')->where('kid',$article_edit['kind'])->select();
        $this->assign('label',$label);

        if(strstr($article_edit['img'],'http')==false){
            $article_edit['img']=request()->domain().'/'.$article_edit['img'];
        }
        $this->assign('article_edit',$article_edit);
        return $this->fetch();
    }


    /**
     * 显示随笔文章列表
     * @author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function gossip()
    {
        $type=request()->get('type','2');
        if($type) $where['type']=$type;
        $this->assign('type',$type);
        $article=Db::table('copy_web')->where('status=1')->order('add_time desc')->where($where)->select();
        $count=Db::table('copy_web')->where('status=1')->where($where)->count();
        $pagesize=10;
        $url=$this->request->domain().'/zhyong/Tables/gossip';
        if(isset($_GET['page'])){
            $p = $_GET['page']?$_GET['page']:1;
        }else{
            $p =1;
        }
        $data=page_array($pagesize,$p,$article,0);
        $countpage=ceil($count/$pagesize);
        $page = show_array($countpage,$url);
        $this->assign('article',$data);
        $this->assign('page',$page);
        return $this->fetch();
    }
    /**
     * 显示编辑随笔
     *@author 勇☆贳&卟☆莣
     * @param  int  $id
     * @return \think\Response
     */
    public function gossipedit($id)
    {
        if(request()->isAjax()){
            $data=request()->post();
            $articleimg=Db::table('copy_web')->where('id',$id)->value('img');
            if($data['data']['img']){
                $img=uploadPIC($data['data']['img']);
                if($img){$data['data']['img']=$img;}else{$this->error('网络出错啦！');};
                @unlink($articleimg);
            }else{
                unset($data['data']['img']);
            }
            if(!$data['data']['author']) unset($data['data']['author']);
            if(Db::table('copy_web')->update($data['data'])){
                $this->success('修改成功');
            }else{
                $this->error('网络出错啦！');
            }
        }
        $article_edit=Db::table('copy_web')->find($id);
        $label=Db::table('label')->where('kid',$article_edit['kind'])->select();
        $this->assign('label',$label);

        if(strstr($article_edit['img'],'http')==false){
            $article_edit['img']=request()->domain().'/'.$article_edit['img'];
        }
        $this->assign('article_edit',$article_edit);
        return $this->fetch();
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
    public function del_article(){
        if(Db::table('article')->delete($_POST['id'])){
            $this->success();
        }else{
            $this->error();
        }
    }
    /*
     * 标签列表
     * @author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function pid($type)
    {

        $page=\request()->get('page',1);
        $limit=\request()->get('limit',10);
        $list=Db::table('label')->where('kid',$type)->page($page,$limit)->order('add_time desc')->select();
        $array=['','后端','前端','随笔'];
        foreach($list as &$val){
            $val['kid']=$array[$type];
        }
        //分页
        $count=Db::table('label')->where('kid',$type)->order('add_time desc')->count();
        $pagesize=$limit;
        $url=$this->request->domain().'/zhyong/Tables/pid/type/'.$type;
        $countpage=ceil($count/$pagesize);
        $pagee = show_array($countpage,$url);
        $this->assign('list',$list);
        $this->assign('page',$pagee);
        $this->assign('type',$type);
        return $this->fetch();
    }
    /*
     * 标签添加
     * @author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function pidadd($type)
    {
        if($this->request->isAjax()){
            $data=$_POST['data'];
            $data['add_time']=time();
            if(Db::table('label')->insert($data)){
                $this->success('添加成功');
            }else{
                $this->error('网络错误');
            }
        }

        $this->assign('type',$type);
        return $this->fetch();
    }
    /*
     * 标签编辑
     * @author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function pidedit($type,$id)
    {
        if($this->request->isAjax()){
            $data=$_POST['data'];
            $data['add_time']=time();
            if(Db::table('label')->insert($data)){
                $this->success('添加成功');
            }else{
                $this->error('网络错误');
            }
        }
        $info=Db::table('label')->where('kid',$type)->find($id);
        $this->assign('info',$info);
        $this->assign('type',$type);
        return $this->fetch();
    }
    public function dellabel(){
        if(Db::table('label')->delete($_POST['id'])){
            $this->success();
        }else{
            $this->error();
        }
    }

}
