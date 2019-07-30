<?php
namespace app\xcx\controller;
use offen\OffenFunction;
use think\Controller;
use think\Db;
use think\Request;
use think\cache\driver\Redis;
use wechat\WXBizDataCrypt;

class Goods extends Father
{
    public function _initialize(){
        parent::father();
    }
    /*上传轮播图*/
   public function GetGoodsPic(Request $request){
        $gid=$_GET['gid'];
        $uid=$_GET['uid'];
       $file = request()->file('file');
       if ($file) {
           $path = "uploads/";
           $info = $file->move($path);
           if ($info) {
               $file = $info->getSaveName();
               $file=str_replace('\\','/',$file);
               $filepath=$request->domain().'/'.$path.$file;
               if($gid){
                   $g_info = Db::table('goods')->find($gid);
                   if($g_info['pic']){
                       $datra['pic']=$g_info['pic'].','.$filepath;
                   }else{
                       $datra['pic']=$filepath;
                   }
                   $datra['id']=$gid;
                   if(Db::table('goods')->update($datra)){
                       return self::json($datra);
                   }else{
                       return self::json('未加入数据库',199);
                   }
               }else{
                   $data['pic']=$filepath;
                   $data['uid']=$uid;
                   if($data['id']=Db::table('goods')->insertGetId($data)){
                       return self::json($data);
                   }else{
                       return self::json('未加入数据库',199);
                   }
               }

           }
       }
   }
   /*上传详情图片*/
    public function GetGoodsImg(Request $request){
        $gid=$_GET['gid'];
        $uid=$_GET['uid'];
        $file = request()->file('file');
        if ($file) {
            $path = "uploads/";
            $info = $file->move($path);
            if ($info) {
                $file = $info->getSaveName();
                $file=str_replace('\\','/',$file);
                $filepath=$request->domain().'/'.$path.$file;
                if($gid){
                    $g_info = Db::table('goods')->find($gid);
                    if($g_info['imgs']){
                        $datra['imgs']=$g_info['imgs'].','.$filepath;
                    }else{
                        $datra['imgs']=$filepath;
                    }
                    $datra['id']=$gid;
                    if(Db::table('goods')->update($datra)){

                        return self::json($datra);
                    }else{
                        return self::json('未加入数据库',199);
                    }
                }else{
                    $data['imgs']=$filepath;
                    $data['uid']=$uid;
                    if($data['id']=Db::table('goods')->insertGetId($data)){
                        return self::json($data);
                    }else{
                        return self::json('未加入数据库',199);
                    }
                }

            }
        }
    }
    /**
     * 获取用户提交商品信息
     *@author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function GetGoodsSub(Request $request){
        if(!$request->isPost()) return self::json([],403);
        $data=$_POST;
        $data['status'] = 1;
        unset($data['pic']);
        if($data['id']){
            if(Db::table('goods')->update($data)){
                $uinfo=Db::table('goods')->find($data['id']);
                return self::json($uinfo);
            }else{
                return self::json($data);
            }
        }else{
            unset($data['id']);
            if($id=Db::table('goods')->insertGetId($data)){
                $uinfo=Db::table('goods')->find($id);
                return self::json($uinfo);
            }else{
                return self::json($data);
            }
        }

    }
    /**
     * 获取商品列表
     *@author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function GetGoodsList(Request $request){
        if(!$request->isGet()) return self::json([],403);
        Db::table('goods')->where('status=0')->delete();
        $ginfo=Db::table('goods')->where('status=1')
            ->where('uid',$_GET['uid'])->field('title,id,price,other,pic,uid')->select();
        foreach ($ginfo as $gkey=>$gval){
            $ginfo[$gkey]['pic'] = firstPic($gval['pic']);
        }
        return self::json($ginfo);
    }
    /**
     * 删除商品
     *@author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function DelGoods(Request $request){
        if(!$request->isPost()) return self::json([],403);
        $data=$_POST;
        if(Db::table('goods')->delete($data['id'])){
            $ginfo=Db::table('goods')->where('status=1')
                ->where('uid',$data['uid'])->field('title,id,price,other,pic,uid')->select();
            foreach ($ginfo as $gkey=>$gval){
                $ginfo[$gkey]['pic'] = firstPic($gval['pic']);
            }
            return self::json($ginfo);
        }else{
            return self::json('删除失败！',199);
        }
    }
    /**
     * 获取商品信息
     *@author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function GetGoodsInfo(Request $request){
        if(!$request->isGet()) return self::json([],403);
        $gid=$_GET['id'];
        $ginfo=model('goods')->find($gid);
        return self::json($ginfo);
    }


}