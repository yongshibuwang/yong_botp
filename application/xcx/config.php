<?php
//配置文件
return [
//引用文件
    'view_replace_str' => [
        '__PUBLIC__' => ''
    ],
    //session配置
    'session'=>[
        'id'             => '',
        // SESSION_ID的提交变量,解决flash上传跨域
        'var_session_id' => '',
        // SESSION 前缀
        'prefix'         => 'think_admin',
        // 驱动方式 支持redis memcache memcached
        'type'           => '',
        // 是否自动开启 SESSION
        'auto_start'     => true,
    ],
];