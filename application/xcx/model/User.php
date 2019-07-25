<?php

namespace app\xcx\model;

use think\Model;

class User extends Model
{
    //
    public function getPicAttr($value)
    {
        $img=explode(',',$value);
        return $img;
    }
}
