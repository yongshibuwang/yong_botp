<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;

//引入自动加载文件
require '../vendor/autoload.php';
use QL\QueryList;
class Article extends Father
{
    public function _initialize(){
        parent::father();
    }
    /**
     * 显示后端列表
     *@author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function phpOption($pid=0)
    {
        /**************************end***************************/
        $this->assign('gl', 1);//顶部菜单高亮判断标志
        $page=\request()->get('page',1);
        $limit=\request()->get('limit',6);
        $where=[];
        if($pid){
            $where['pid']=$pid;
        }
        $list=Db::table('article')->alias('co')
            ->join('label la','co.pid=la.id')
            ->field('co.*,la.name as laname')
            ->order('co.add_time desc')
            ->where('status=1 AND type=2 AND kind=1')
            ->where('is_hot=1')
            ->where($where)
            ->page($page,$limit)
            ->select();
        $array=['','后端','前端','随笔'];
        foreach($list as &$val){
            $val['kind']=$array[$val['kind']];
            if(strstr($val['img'],'http')==false){
                $val['img']=request()->domain().'/'.$val['img'];
            }
        }
        //分页
        $count=Db::table('article')->alias('co')
            ->join('label la','co.pid=la.id')
            ->field('co.*,la.name as laname')
            ->order('co.add_time desc')
            ->where('status=1 AND type=2 AND kind=1')
            ->where('is_hot=1')
            ->where($where)->count();
        $pagesize=$limit;
        $url=$this->request->domain().'/index/article/phpOption/pid/'.$pid;
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
        $label=Db::table('label')->where('kid=1')->select();//后端数目
        $this->assign('label',$label);
        /**************************end***************************/
        $this->assign('gl', 2);//顶部菜单高亮判断标志
        return $this->fetch();
    }
    /**
     * 显示前端列表
     *@author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function htmlOption($pid=0)
    {
        /**************************end***************************/
        $this->assign('gl', 1);//顶部菜单高亮判断标志
        $page=\request()->get('page',1);
        $limit=\request()->get('limit',6);
        $where=[];
        if($pid){
            $where['pid']=$pid;
        }
        $list=Db::table('article')->alias('co')
            ->join('label la','co.pid=la.id')
            ->field('co.*,la.name as laname')
            ->order('co.add_time desc')
            ->where('status=1 AND type=2 AND kind=2')
            ->where('is_hot=1')
            ->where($where)
            ->page($page,$limit)
            ->select();
        $array=['','后端','前端','随笔'];
        foreach($list as &$val){
            $val['kind']=$array[$val['kind']];
            if(strstr($val['img'],'http')==false){
                $val['img']=request()->domain().'/'.$val['img'];
            }
        }
        //分页
        $count=Db::table('article')->alias('co')
            ->join('label la','co.pid=la.id')
            ->field('co.*,la.name as laname')
            ->order('co.add_time desc')
            ->where('status=1 AND type=2 AND kind=2')
            ->where('is_hot=1')
            ->where($where)->count();
        $pagesize=$limit;
        $url=$this->request->domain().'/index/article/htmlOption/pid/'.$pid;
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
        //标签云（默认为前端标签）
        $label=Db::table('label')->where('kid=2')->select();//后端数目
        $this->assign('label',$label);
        /**************************end***************************/
        $this->assign('gl', 3);//顶部菜单高亮判断标志
        return $this->fetch();
    }
    /**
     * 显示文章随笔
     *@author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function gossip($pid=0)
    {
        $where=[];
        if($pid){
            $where['pid']=$pid;
        }
        /**************************end***************************/
        $this->assign('gl', 1);//顶部菜单高亮判断标志
        $page=\request()->get('page',1);
        $limit=\request()->get('limit',6);
        $list=Db::table('copy_web')->alias('co')
            ->join('label la','co.pid=la.id')
            ->field('co.*,la.name as laname')
            ->order('co.add_time desc')
            ->where('status=1')
            ->where($where)
            ->page($page,$limit)
            ->select();
        $array=['','后端','前端','随笔','游戏','资讯'];
        foreach($list as &$val){
            $val['kind']=$array[$val['kind']];
            if(strstr($val['img'],'http')==false){
                $val['img']=request()->domain().'/'.$val['img'];
            }
        }
        //分页
        $count=Db::table('copy_web')->alias('co')
            ->join('label la','co.pid=la.id')
            ->field('co.*,la.name as laname')
            ->order('co.add_time desc')
            ->where('status=1')
            ->where($where)->count();
        $pagesize=$limit;
        $url=$this->request->domain().'/index/article/gossip/pid/'.$pid;
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
        $s_article=Db::table('copy_web')->where('type=2')->count();//随笔数目
        $w_web=Db::table('web')->count();//网站数目
        $this->assign('p_article',$p_article);
        $this->assign('w_article',$w_article);
        $this->assign('s_article',$s_article);
        $this->assign('w_web',$w_web);
        /**************************end***************************/
        //标签云（默认为后端标签）
        $label=Db::table('label')->where('kid=3')->select();//后端数目
        $this->assign('label',$label);
        $this->assign('gl', 6);//顶部菜单高亮判断标志
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
    public function ling(){
        //最近访客（今日）
        $access=Db::table('access')
            ->where('access_date',date('Ymd',time()))
            ->order('access_num desc')->order('access_time desc')->select();
        foreach($access as &$ac){
            if(strstr($ac['img'],'http')==false){
                $ac['img']=request()->domain().$ac['img'];
            }
        }
        $this->assign('accessNum',count($access));
        $this->assign('access',$access);
        //获取网站信息
        $selfWebInfo=Db::table('web_info')->find(1);
        if(strstr($selfWebInfo['img'],'http')==false){
            $selfWebInfo['img']=request()->domain().'/'.$selfWebInfo['img'];
        }
        $this->assign('selfWebInfo',$selfWebInfo);
        //获取逗媳妇的段子
        $list=Db::table('ling')
            ->order('add_time desc')
            ->select();
        //分页
        $count=Db::table('ling')
            ->order('add_time desc')->count();
        $pagesize=30;
        $url=$this->request->domain().'/index/Article/ling';
        if(isset($_GET['page'])){
            $p = $_GET['page']?$_GET['page']:1;
        }else{
            $p =1;
        }
        $data=page_array($pagesize,$p,$list,0);
        $countpage=ceil($count/$pagesize);
        $page = show_array($countpage,$url,4);
        $this->assign('list',$data);
        $this->assign('page',$page);
        return $this->fetch();
    }
    public function refresh(){
        /**************************抓取文章***************************/
        // 采集捧腹网页面文章列表中所有[文章]的超链接和超链接文本内容
        for($i=1;$i<=6;$i++){
            $data = QueryList::get('https://www.pengfue.com/xiaohua_'.$i.'.html')
                ->rules([
                'link' => ['dl>dt>a','href'],
                'head_img' => ['dl>dt>a>img','src'],
                'name' => ['dl>dd>p>a','text'],
                'title' => ['dl>dd>h1>a','text'],
                'text' => ['dl>dd>div.content-img','text']
            ])->range('.list-item')->query()->getData();
            $data=$data->all();
            foreach ($data as $dkey=>$dval){
                $dval['add_time']=time()+$dkey;
                $arr['title']=$dval['title'];
                $arr['name']=$dval['name'];
                $arr['link']=$dval['link'];
                if(Db::table('ling')->where($arr)->find()){
                    $this->success('更新抓取成功！');
                    break;
                }else{
                    Db::table('ling')->insert($dval);
                }
            }
        }
        $this->success('更新抓取成功！');
        /**************************抓取文章（END）***************************/
    }

}
