<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;
class Oftenweb extends Father
{
    public function _initialize(){
        parent::index();
    }
    /**
     * 显示常用网站列表
     *@author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function web()
    {
        $obj=Db::table('web')->where('status=1')
            ->order('sort desc')
            ->order('add_time desc')
            ->paginate(16);
        $page = $obj->render();
        $this->assign('page', $page);
        $data=$obj->toArray();
        $list=$data['data'];
        foreach($list as &$val){
            if(strstr($val['img'],'http')==false){
                $val['img']=request()->domain().'/'.$val['img'];
            }
        }
        $this->assign('list',$list);
        //最新文章
        $new_article=Db::table('article')->where('status=1 AND type=2')
            ->limit(8)
            ->order('add_time desc')->select();
        $this->assign('new_article',$new_article);
        //点击排行
        $read_more=Db::table('article')->where('status=1 AND type=2')
            ->limit(5)
            ->order('read_num desc')->select();
        $this->assign('read_more',$read_more);
        $this->assign('gl', 5);//顶部菜单高亮判断标志
        return $this->fetch();
    }
    /**
     * 显示前端列表
     *@author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function htmlOption()
    {
        $obj=Db::table('article')->where('status=1 AND type=2 AND kind=2')
            ->limit(5)
            ->order('add_time desc')
            ->paginate(6);
        $page = $obj->render();
        $this->assign('page', $page);
        $data=$obj->toArray();
        $list=$data['data'];
        foreach($list as &$val){
            if(strstr($val['img'],'http')==false){
                $val['img']=request()->domain().'/'.$val['img'];
            }
        }
        $this->assign('list',$list);
        //最新文章
        $new_article=Db::table('article')->where('status=1 AND type=2')
            ->limit(8)
            ->order('add_time desc')->select();
        $this->assign('new_article',$new_article);
        //点击排行
        $read_more=Db::table('article')->where('status=1 AND type=2')
            ->limit(5)
            ->order('read_num desc')->select();
        $this->assign('read_more',$read_more);
        $this->assign('gl', 3);//顶部菜单高亮判断标志
        return $this->fetch();
    }
    public function ajax_seach()
    {   $data=input('post.title','');
        $map=[];
        if($data){
            $map['title']=array('like','%'.$data.'%');
        }
        $info=Db::table('article')->where($map)->select();
        foreach($info as &$val){
            if(strstr($val['img'],'http')==false){
                $val['img']=request()->domain().'/'.$val['img'];
            }
        }
        $this->assign('list',$info);
        $html=$this->fetch('ajax_seach');
        $this->success($html);
    }
}
