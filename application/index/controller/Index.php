<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\cache\driver\Redis;

class Index extends Father
{
    public function _initialize(){
        parent::father();

    }
    /**
     * 显示首页
     *@author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function index($mobile=0)
    {
        if(!$mobile){
            if($this->isMobile()){
//            header('header:http://my.com/index/article/gossip.html');
                header("Location: http://we.zhyong.top");
                die;
            }
        }
        //获取用户访问ip
        if(getIp()){
            $user_ip['ip']=getIp();
        }else{
            $user_ip['ip']="127.0.0.1";
        }
        $user_ip['access_time']=time();
        $user_ip['access_date']=date('Ymd',time());
        $user_ip['access_web']="http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
        if($id1=Db::table('access')->where('ip',$user_ip['ip'])->order('access_time desc')->select()){
            if(date('Ymd',$id1[0]['access_time'])==date('Ymd',time())){
                Db::table('access')->where('id',$id1[0]['id'])->setInc('access_num');
                Db::table('access')->where('id',$id1[0]['id'])->update(['access_time'=>time(),"access_web"=>"访问首页"]);
            }else{
                Db::table('access')->insert($user_ip);
            }
        }else{
            Db::table('access')->insert($user_ip);
        }
        $page=\request()->get('page',1);
        $limit=\request()->get('limit',6);
//        $redis = new Redis();//实例化缓存
//        if($redis->get('list')){
//            $list =$redis->get('list');
//            $count =$redis->get('count');
//            $pagesize=$limit;
//            $url=$this->request->domain().'/index/Index/index';
//            $countpage=ceil($count/$pagesize);
//            $pagee = show_array($countpage,$url);
//            $this->assign('list',$list);
//            $this->assign('page',$pagee);
//            /**************************end***************************/
//            //最新文章
//            $new_article=Db::table('article')->where('status=1 AND type=2 AND kind=1')->whereOr('status=1 AND type=2 AND kind=2')
//                ->limit(8)
//                ->order('add_time desc')->select();
//            // dump($new_article);die;
//            $this->assign('new_article',$new_article);
//            /**************************end***************************/
//            //文章分类数目
//            $p_article=Db::table('article')->where('type=2 AND kind=1')->count();//后端数目
//            $w_article=Db::table('article')->where('type=2 AND kind=2')->count();//前端数目
//            $s_article=Db::table('article')->where('type=2 AND kind=3')->count();//随笔数目
//            $w_web=Db::table('web')->count();//网站数目
//            $this->assign('p_article',$p_article);
//            $this->assign('w_article',$w_article);
//            $this->assign('s_article',$s_article);
//            $this->assign('w_web',$w_web);
//            //获取网站信息
//            $selfWebInfo=Db::table('web_info')->find(1);
//            if(strstr($selfWebInfo['img'],'http')==false){
//                $selfWebInfo['img']=request()->domain().'/'.$selfWebInfo['img'];
//            }
//            $this->assign('selfWebInfo',$selfWebInfo);
//            return $this->fetch();
//        }else{
            $list=Db::table('article')
                ->where('status=1 AND type=2 AND kind=1')
                ->whereOr('status=1 AND type=2 AND kind=2')
                ->where('is_hot=1')
                ->page($page,$limit)
                ->order('add_time desc')
                ->select();
            $array=['','后端','前端','随笔'];
            foreach($list as &$val){
                $val['kind']=$array[$val['kind']];
                if(strstr($val['img'],'http')==false){
                    $val['img']=request()->domain().'/'.$val['img'];
                }
            }
            //分页
            $count=Db::table('article')
                ->where('status=1 AND type=2 AND kind=1')
                ->whereOr('status=1 AND type=2 AND kind=2')
                ->where('is_hot=1')
                ->order('add_time desc')->count();
//            $redis->set('list',$list,36000);
//            $redis->set('count',$count,36000);
            $pagesize=$limit;
            $url=$this->request->domain().'/index/Index/index';
            $countpage=ceil($count/$pagesize);
            $pagee = show_array($countpage,$url);
            $this->assign('list',$list);
            $this->assign('page',$pagee);
            /**************************end***************************/
            //最新文章
            $new_article=Db::table('article')->where('status=1 AND type=2 AND kind=1')->whereOr('status=1 AND type=2 AND kind=2')
                ->limit(8)
                ->order('add_time desc')->select();
            // dump($new_article);die;
            $this->assign('new_article',$new_article);
            /**************************end***************************/
            //文章分类数目
            $p_article=Db::table('article')->where('type=2 AND kind=1')->count();//后端数目
            $w_article=Db::table('article')->where('type=2 AND kind=2')->count();//前端数目
            $s_article=Db::table('article')->where('type=2 AND kind=3')->count();//随笔数目
            $w_web=Db::table('web')->count();//网站数目
            $this->assign('p_article',$p_article);
            $this->assign('w_article',$w_article);
            $this->assign('s_article',$s_article);
            $this->assign('w_web',$w_web);
            //获取网站信息
            $selfWebInfo=Db::table('web_info')->find(1);
            if(strstr($selfWebInfo['img'],'http')==false){
                $selfWebInfo['img']=request()->domain().'/'.$selfWebInfo['img'];
            }
            $this->assign('selfWebInfo',$selfWebInfo);
            return $this->fetch();

//        }
        die;
        /**************************若是手机端直接跳到花开成海，思念成灾***************************/
        if(!$mobile){
            if($this->isMobile()){
//            header('header:http://my.com/index/article/gossip.html');
                header("Location: ".request()->domain().url('article/ling'));
                die;
            }
        }
        //页面静态化如果有分页则不进入静态化

        $goods_statis_file = "./HTML/index.html";//对应静态页文件
        $expr = 3600*24*1;//静态文件有效期1天
        if(file_exists($goods_statis_file) && $page==1){
            $file_ctime=filectime($goods_statis_file);//文件创建时间   
            if($file_ctime+$expr>time()){//如果没过期
//                echo "缓存文件";
                echo file_get_contents($goods_statis_file);//输出静态文件内容
                die;
            }else{
                unlink($goods_statis_file);//删除文件
            }
        }
        /**************************end***************************/
        $this->assign('gl', 1);//顶部菜单高亮判断标志

        $list=Db::table('article')
            ->where('status=1 AND type=2 AND kind=1')
            ->whereOr('status=1 AND type=2 AND kind=2')
            ->where('is_hot=1')
            ->page($page,$limit)
            ->order('add_time desc')
            ->select();
        $array=['','后端','前端','随笔'];
        foreach($list as &$val){
            $val['kind']=$array[$val['kind']];
            if(strstr($val['img'],'http')==false){
                $val['img']=request()->domain().'/'.$val['img'];
            }
        }
        //分页
        $count=Db::table('article')
            ->where('status=1 AND type=2 AND kind=1')
            ->whereOr('status=1 AND type=2 AND kind=2')
            ->where('is_hot=1')
            ->order('add_time desc')->count();
        $pagesize=$limit;
        $url=$this->request->domain().'/index/Index/index';
        $countpage=ceil($count/$pagesize);
        $pagee = show_array($countpage,$url);
        $this->assign('list',$list);
        $this->assign('page',$pagee);
        /**************************end***************************/
        //最新文章
        $new_article=Db::table('article')->where('status=1 AND type=2 AND kind=1')->whereOr('status=1 AND type=2 AND kind=2')
            ->limit(8)
            ->order('add_time desc')->select();
            // dump($new_article);die;
        $this->assign('new_article',$new_article);
        /**************************end***************************/
        //文章分类数目
        $p_article=Db::table('article')->where('type=2 AND kind=1')->count();//后端数目
        $w_article=Db::table('article')->where('type=2 AND kind=2')->count();//前端数目
        $s_article=Db::table('article')->where('type=2 AND kind=3')->count();//随笔数目
        $w_web=Db::table('web')->count();//网站数目
        $this->assign('p_article',$p_article);
        $this->assign('w_article',$w_article);
        $this->assign('s_article',$s_article);
        $this->assign('w_web',$w_web);
        /**************************end***************************/
        //标签云（默认为后端标签）
        /**************************end***************************/
        if($page==1){
            ob_start();
            echo $this->fetch();
            $content=ob_get_contents();//把详情页内容赋值给$content变量 
            file_put_contents($goods_statis_file,$content);//写入内容到对应静态文件中   
            ob_end_flush();
        }else{
            return $this->fetch();
        }
//        return $this->fetch();
    }
    /**
     * 显示文章详情
     *@author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function detail($id)
    {
        $info=Db::table('article')->find($id);
        //获取用户访问ip
        if(getIp()){
            $user_ip['ip']=getIp();
        }else{
            $user_ip['ip']="127.0.0.1";
        }
        $user_ip['access_time']=time();
        $user_ip['access_date']=date('Ymd',time());
        $user_ip['access_web']=$info['title'];
        if($id1=Db::table('access')->where('ip',$user_ip['ip'])->order('access_time desc')->select()){
            if(date('Ymd',$id1[0]['access_time'])==date('Ymd',time())){
                Db::table('access')->where('id',$id1[0]['id'])->setInc('access_num');
                Db::table('access')->where('id',$id1[0]['id'])->update(['access_time'=>time(),"access_web"=>$info['title']]);
            }else{
                Db::table('access')->insert($user_ip);
            }
        }else{
            Db::table('access')->insert($user_ip);
        }


        $goods_statis_file = "../HTML/detail_id_".$id.".html";//对应静态页文件
        $expr = 3600*24*1;//静态文件有效期1天
        if(file_exists($goods_statis_file)){
            $file_ctime=filectime($goods_statis_file);//文件创建时间   
            if($file_ctime+$expr>time()){//如果没过期
//                echo "缓存文件";
                echo file_get_contents($goods_statis_file);//输出静态文件内容
                die;
            }else{
                unlink($goods_statis_file);//删除文件
            }
        }
        //更新阅读量
        Db::table('article')->where('id',$id)->setInc('read_num');
        $array=['','后端','前端','随笔'];
        $info['kind']=$array[$info['kind']];
        $this->assign('info',$info);
        //最新文章
        $new_article=Db::table('article')->where('status=1 AND type=2 AND kind=1')->whereOr('status=1 AND type=2 AND kind=2')
            ->limit(10)
            ->order('add_time desc')->select();
        $this->assign('new_article',$new_article);
        ob_start();
        echo $this->fetch();
        $content=ob_get_contents();//把详情页内容赋值给$content变量 
        file_put_contents($goods_statis_file,$content);//写入内容到对应静态文件中   
        ob_end_flush();
//        return $this->fetch();
    }

    /**
     * 显示首页文章详情
     *@author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function info($id)
    {
        $this->assign('gl', 0);//顶部菜单高亮判断标志
        $info=Db::table('article')->find($id);
        if(strstr($info['img'],'http')==false){
            $info['img']=request()->domain().'/'.$info['img'];
        }
        Db::table('article')->where('id',$id)->setInc('read_num');
        //dump($info['content']);die;
        $this->assign('info',$info);
        //最新文章
        $new_article=Db::table('article')->where('status=1 AND type=2')
            ->limit(8)
            ->order('add_time desc')->select();
        $this->assign('new_article',$new_article);
        //点击排行
        $read_more=Db::table('article')->where('status=1 AND type=2')
            ->limit(5)
            ->order('read_num desc')->order('add_time desc')->select();
        $this->assign('read_more',$read_more);
        return $this->fetch();
    }
}
