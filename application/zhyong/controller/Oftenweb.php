<?php

namespace app\zhyong\controller;

use think\Controller;
use think\Request;
use think\Db;

class Oftenweb extends Father
{
    public function _initialize(){
        parent::index();
        $this->assign('gl', 3);//顶部菜单高亮判断标志
    }
    /**
     * 常用网站列表
     * @author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function web()
    {
        //
        /*$type=request()->get('type','2');
        if($type) $where['type']=$type;
        $this->assign('type',$type);*/
        $web=Db::table('web')->where('status=1')->order('sort desc,add_time desc')->select();//数据
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
        
        return $this->fetch();
    }
    /**
     * 添加常用网站列表
     * @author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function add()
    {
        if(request()->isAjax()){
            $data=$_POST['data'];
            if($data['img']){
                $img=uploadPIC($data['img']);
                if($img){$data['img']='http://www.zhyong.top/'.$img;}else{$this->error('网络出错啦！');};
            }
            $data['add_time']=time();
            $data['status']=1;
            if(Db::table('web')->insert($data)){
                $this->success('添加成功');
            }else{
                $this->error('添加失败');
            }
        }
        return $this->fetch();
    }
    /**
     * 编辑常用网站列表
     * @author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function edit($id)
    {
        if(request()->isAjax()){
            $data=$_POST['data'];
            $pic=Db::table('web_info')->where('id',$id)->value('img');
            if($data['img']){
                @unlink($pic);
                $img=uploadPIC($data['img']);
                if($img){$data['img']='http://www.zhyong.top/'.$img;}else{$this->error('网络出错啦！');};
            }else{
                unset($data['img']);
            }
            $data['add_time']=time();
            $data['status']=1;
            $data['id']=$id;
            if(Db::table('web')->update($data)){
                $this->success('修改成功');
            }else{
                $this->error('修改失败');
            }
        }
        $web_edit=Db::table('web')->find($id);
        if(strstr($web_edit['img'],'http')==false){
            $web_edit['img']=request()->domain().'/'.$web_edit['img'];
        }
        $this->assign('web_edit',$web_edit);
        return $this->fetch();
    }
    /**
     * 软删除常用网站列表
     *@author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function del_web(){
        $_POST['status']=2;
        if(Db::table('web')->update($_POST)){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }

}
