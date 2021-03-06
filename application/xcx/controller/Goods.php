<?php
namespace app\xcx\controller;
use offen\OffenFunction;
use think\Cache;
use think\Db;
use think\Request;
use wechat\getCord;

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
//        dump($data);die;
        $data['status'] = 1;
        if(!$data['but']){
            unset($data['but']);
        }
        unset($data['pic']);
        if($data['id']){
            /*生成二维码*/
            $id = $data['id'];
            $uid = $data['uid'];
            $path = "pages/goods/goodsi/info";
            $code = new getCord(WXAPPID,WXAPPSECRET,$id,100,$path,$uid);
            /*删除指定日期前的文件*/
            $dir = 'goods';
            if (!is_dir($dir)) { //判断目录是否存在 不存在就创建
                mkdir($dir, 0777, true);
            }
            if(is_file($dir.'/goods_'.$id.'.png')){
                @unlink($dir.'/goods_'.$id.'.png');
            }
            $file_path = $dir.'/goods_'.$id.'.png';
            file_put_contents($file_path, $code->get_qrcode());//保存二维码
            $data['er_code'] = $request->domain().'/'.$file_path;

            if(Db::table('goods')->update($data)){
                /*获取该用户的全部商品并缓存*/
                $uid = Db::table('goods')->where('id',$data['id'])->value('uid');
                Db::table('goods')->where('status=0')->delete();
                $ginfo=Db::table('goods')->where('status=1')
                    ->where('uid',$uid)->field('title,id,price,other,pic,uid')->select();
                foreach ($ginfo as $gkey=>$gval){
                    $ginfo[$gkey]['pic'] = firstPic($gval['pic']);
                }
                Cache::store('redis')->set('goodslist'.$uid,$ginfo);


                $uinfo=Db::table('goods')->find($data['id']);
                return self::json($uinfo);
            }else{
                /*获取该用户的全部商品并缓存*/
                $uid = Db::table('goods')->where('id',$data['id'])->value('uid');
                Db::table('goods')->where('status=0')->delete();
                $ginfo=Db::table('goods')->where('status=1')
                    ->where('uid',$uid)->field('title,id,price,other,pic,uid')->select();
                foreach ($ginfo as $gkey=>$gval){
                    $ginfo[$gkey]['pic'] = firstPic($gval['pic']);
                }
                Cache::store('redis')->set('goodslist'.$uid,$ginfo);
                return self::json($data);
            }
        }else{
            unset($data['id']);
            if($id=Db::table('goods')->insertGetId($data)){
                $uid = $data['uid'];
                $path = "pages/goods/goodsi/info";
                $code = new getCord(WXAPPID,WXAPPSECRET,$id,100,$path,$uid);
                /*删除指定日期前的文件*/
                $dir = 'goods';
                if (!is_dir($dir)) { //判断目录是否存在 不存在就创建
                    mkdir($dir, 0777, true);
                }
                if(is_file($dir.'/goods_'.$id.'.png')){
                    @unlink($dir.'/goods_'.$id.'.png');
                }
                $file_path = $dir.'/goods_'.$id.'.png';
                file_put_contents($file_path, $code->get_qrcode());//保存二维码
                $ginfo['er_code'] = $request->domain().'/'.$file_path;
                $ginfo['id'] = $id;
                Db::table('goods')->update($ginfo);


                /*获取该用户的全部商品并缓存*/
                $uid = Db::table('goods')->where('id',$id)->value('uid');
                Db::table('goods')->where('status=0')->delete();
                $ginfo=Db::table('goods')->where('status=1')
                    ->where('uid',$uid)->field('title,id,price,other,pic,uid')->select();
                foreach ($ginfo as $gkey=>$gval){
                    $ginfo[$gkey]['pic'] = firstPic($gval['pic']);
                }
                Cache::store('redis')->set('goodslist'.$uid,$ginfo);


                $uinfo=Db::table('goods')->find($id);
                return self::json($uinfo);
            }else{
                /*获取该用户的全部商品并缓存*/
                $uid = Db::table('goods')->where('id',$data['id'])->value('uid');
                Db::table('goods')->where('status=0')->delete();
                $ginfo=Db::table('goods')->where('status=1')
                    ->where('uid',$uid)->field('title,id,price,other,pic,uid')->select();
                foreach ($ginfo as $gkey=>$gval){
                    $ginfo[$gkey]['pic'] = firstPic($gval['pic']);
                }
                Cache::store('redis')->set('goodslist'.$uid,$ginfo);

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
        $ginfo=Cache::store('redis')->get('goodslist'.$_GET['uid']);
        if(!$ginfo){
            Db::table('goods')->where('status=0')->delete();
            $ginfo=Db::table('goods')->where('status=1')
                ->where('uid',$_GET['uid'])->field('title,id,price,other,pic,uid')->select();
            foreach ($ginfo as $gkey=>$gval){
                $ginfo[$gkey]['pic'] = firstPic($gval['pic']);
            }
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
        $del->delAllImg('goods',$data['id'],'er_code');
        if(Db::table('goods')->delete($data['id'])){
            /*获取该用户的全部商品并缓存*/
            Db::table('goods')->where('status=0')->delete();
            $ginfo=Db::table('goods')->where('status=1')
                ->where('uid',$data['uid'])->field('title,id,price,other,pic,uid')->select();
            foreach ($ginfo as $gkey=>$gval){
                $ginfo[$gkey]['pic'] = firstPic($gval['pic']);
            }
            Cache::store('redis')->set('goodslist'.$data['uid'],$ginfo);



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
    /*微信生成商品分享图片*/
    public function share_info(Request $request)
    {
        if(!$request->isGet()) return self::json([],403);
        //个人信息
        $gid=$_GET['gid'];
        $uinfo=Db::table('goods')->alias('g')
            ->join('user u','g.uid=u.id')
            ->field('g.id,g.pic,g.title,g.detail,u.er_code,g.price,g.other,u.head_img,u.color')
            ->where('g.id',$gid)
            ->find();
        if($uinfo){
            if(!$uinfo['price']){
                $uinfo['price'] = $uinfo['other'];
            }
            $uinfo['pic']=firstPic($uinfo['pic']);
        }else{
            $uinfo['pic']=$uinfo['head_img'];
        }
        if($uinfo){
            return self::json($uinfo);
        }else{
            return self::json('',199);
        }
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
     * 获取商品二维码 停用
     *@author 勇☆贳&卟☆莣
     * @return \think\Response
     */
    public function getgoodsercode(Request $request){
        if(!$request->isGet()) return self::json([],403);
        $id = $request->get('id',1);
        $uid = $request->get('uid',1);
        $path = $request->get('pages/goods/goodsi/info','pages/login/login');
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
