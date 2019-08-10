<?php
namespace app\xcx\controller;
use offen\OffenFunction;
use think\Controller;
use think\Db;
use think\Request;
use think\cache\driver\Redis;
use wechat\getCord;
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
        /*获取商品图片*/
        $del=new OffenFunction();
        $del->delAllImg('goods',$data['id'],'pic');
        $del->delAllImg('goods',$data['id'],'imgs');
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
    /**
     * 通过分享点击获取商品信息
     *@author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function gInfo(Request $request){
        if(!$request->isGet()) return self::json([],403);
        $gid = $_GET['gid'];
        $uid = $_GET['uid'];
        $aid = $_GET['aid'];
        if($ginfo=model('goods')->where('id',$gid)->where('uid',$uid)->find()){
            $ginfo['simg']=$ginfo->pic[0];
            $u = Db::table('user')->field('color,x_name,id,wechat,link_phone')->find($uid);
            if($u){
                $ginfo['color']=$u['color'];
                $ginfo['x_name']=$u['x_name'];
                $ginfo['uid']=$u['id'];
                $ginfo['wechat']=$u['wechat'];
                $ginfo['phone']=$u['link_phone'];
            }
            return self::json($ginfo);
        }else{
            return self::json($ginfo,199);
        }
    }

    /**
     * 获取商品二维码
     *@author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function getgoodsercode(Request $request){
        if(!$request->isGet()) return self::json([],403);
        $id = $request->get('id',1);
        $uid = $request->get('uid',1);
        $path = $request->get('path','pages/login/login');
        $code = new getCord(WXAPPID,WXAPPSECRET,$id,100,$path,$uid);
        /*删除指定日期前的文件*/
        $dir = 'goods';
        if (!is_dir($dir)) { //判断目录是否存在 不存在就创建
            mkdir($dir, 0777, true);
        }
        if(is_file($dir.'/'.$id.'.png')){
            @unlink($dir.'/'.$id.'.png');
        }
        $file_path = $dir.'/'.$id.'.png';
        file_put_contents($file_path, $code->get_qrcode());//保存二维码
        $f_path = $request->domain().'/'.$file_path;
//        $base64_image ="data:image/jpeg;base64,".base64_encode( $code);
        return self::json($f_path);
    }



}
