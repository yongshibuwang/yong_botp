<?php

namespace app\xcx\model;

use think\Model;

class Goods extends Model
{
    //
    public function getPicAttr($value)
    {
        $img=explode(',',$value);
        return $img;
    }
    public function getImgsAttr($value)
    {
        $img=explode(',',$value);
        return $img;
    }
}
