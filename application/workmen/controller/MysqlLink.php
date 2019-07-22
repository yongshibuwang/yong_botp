<?php

namespace app\workmen\controller;

use think\Controller;
use think\Db;
use think\Request;

class MysqlLink extends Controller
{
    public function updatesql(){
        $sql="update admin set status=2 where id=1";
        $data=Db::query($sql);
        return $data;
    }
}
