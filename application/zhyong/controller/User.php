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
     * 显示用户列表
     * @author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function userlist()
    {
        $name=$this->request->get('name','');
        $type=$this->request->get('type','');
        $where=[];
        if($name){
            if(is_numeric($name)){
                $where['link_phone']=$name;
            }else{
                $where['wechat']=['like',$name.'%'];
            }
        }
        if($type){
            $where['vip']=$type;
        }elseif ($type == '0'){
            $where['vip']=0;
        }
        $list=Db::table('user')
            ->where($where)
            ->order('money desc')
            ->order('add_time desc')
            ->paginate(10);
        $arr=$list->toArray();
        $data=$arr['data'];
        foreach ($data as $dkey=>$dval){
            $data[$dkey]['total_money']=Db::table('user_money')->where('uid',$dval['id'])->where('type=2')->sum('money');
        }
        $page = $list->render();
        $this->assign('page',$page);
        $this->assign('list',$list);
        $this->assign('name',$name);
        $this->assign('data',$data);
        return $this->fetch();
    }
    /*
     * 成为VIP
     * */
    public function returnVip(){
        $id = $_POST['id'];
        // 启动事务
        Db::startTrans();
        try{
            //该用户变成vip
            $uinfo = Db::table('user')->where('id',$id)->field('name,fid,wechat')->find();
            $up_user=Db::table('user')->where('id',$id)->update(['vip'=>2]);
            /*上级用户余额*/
            $umoney = Db::table('user')->where('id',$uinfo['fid'])->value('money');

            if($up_user){
                //该用户上级在金额变化表增加记录
                $money=3;
                $uid=$uinfo['fid'];
                $data['remark']=$uinfo['name'].'注册成为会员';
                $data['type']=1;/*加钱1减钱2*/
                $data['add_time']=time();
                $data['wechat']=$uinfo['wechat'];
                $data['total_money']=$umoney*1+$money;
                $data['money']='+'.$money;
                $data['uid']=$uid;//该用户的父id
//                $data['aid']=$uid;//该用户的父id
                $res=Db::table('user_money')->insert($data);
                if(!$res){
                    throw new \Exception('添加失败');
                }else{
                    /*该用户的上级增加金额*/
                    $inc=Db::table('user')->where('id',$uid)->setInc('money',$money);
                    if(!$inc){
                        throw new \Exception('上级增加金额失败');
                    }
                }
            }else{
                throw new \Exception('更新vip失败');
            }
            // 提交事务
            Db::commit();
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            $this->error($e->getMessage());
        }
        $this->success();

    }
    /*
     * 提现，已经在微信端发放红包
     * */
    public function withdraw($id){
        // 启动事务
        if(\request()->isAjax()){
//            dump($_POST);die;
            $info=$_POST['data'];
            Db::startTrans();
            try{
                //该用户金额
                $umoney = Db::table('user')->where('id',$id)->value('money');

                //该用户在金额变化表增加记录
                $money=$info['money'];
                $data['remark']='每月1-10号余额自动提现（红包发放1元起发）';
                $data['type']=2;/*加钱1减钱2*/
                $data['add_time']=time();
                $data['wechat']=$info['wechat'];
                $data['total_money']=($umoney*1)-$info['money'];
                $data['money']='-'.$info['money'];
                $data['uid']=$info['id'];//该用户id
                $res=Db::table('user_money')->insert($data);
                if(!$res){
                    throw new \Exception('添加失败');
                }else{
                    /*该用户减去提现金额*/
                    $inc=Db::table('user')->where('id',$info['id'])->setDec('money',$money);
                    if(!$inc){
                        throw new \Exception('上级减去金额失败');
                    }
                }
                // 提交事务
                Db::commit();
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
                $this->error($e->getMessage());
            }
            $this->success();
        }
        $list=Db::table('user')->field('id,name,wechat,money')->find($id);
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
