<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/4
 * Time: 16:09
 */

namespace offen;

use think\Db;
class OffenFunction
{
    /**
     * 构造函数
     * @access public
     */
    public function __construct($options = []){

    }
    /*
     * 删除指定数据表中的图片
     * 图片保存以‘，’隔开,
     * $table     表名
     * $id        id名
     * $field     存储图片的字段名+
     * $img       图片名
     * */
    public function delImg($table,$id,$field,$img){
        if($table){
            $data['id']=$id;
            $pic=Db::table($table)->where('id',$id)->value($field);
            $arr_pic=explode(',',$pic);
            foreach ($arr_pic as $ark=>$arv){
                if($arv){
                    if(strstr($img,$arv)!=false){
                        @unlink($arr_pic[$ark]);
                        unset($arr_pic[$ark]);
                    }
                }
            }
            $data[$field]=implode(',',$arr_pic);
            if(Db::table($table)->update($data)){
                return 1;
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }
}