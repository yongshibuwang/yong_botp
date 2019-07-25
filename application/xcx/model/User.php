<?php

namespace app\xcx\model;

use think\Model;

class User extends Model
{
    //
    public function getPicAttr($value)
    {
        $data=[];
        $img=explode(',',$value);
        foreach ($img as $ikey=>$ival){
            if($ival){
                $data[$ikey]=request()->domain().'/'.$ival;
            }
        }
        return $data;
    }
}
