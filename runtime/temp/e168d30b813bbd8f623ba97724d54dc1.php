<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:49:"F:\wzpl./application/zhyong\view\login\login.html";i:1542438855;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>wzpl</title>
    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="/public/static/admin/assets/i/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="/public/static/admin/assets/i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet" href="/public/static/admin/assets/css/amazeui.min.css" />
    <link rel="stylesheet" href="/public/static/admin/assets/css/amazeui.datatables.min.css" />
    <link rel="stylesheet" href="/public/static/admin/assets/css/app.css">
    <script src="/public/static/admin/assets/js/jquery.min.js"></script>
    <script src="/public/static/admin/layer/layer.js"></script>
</head>
<body data-type="login">
    <script src="/public/static/admin/assets/js/theme.js"></script>
    <div class="am-g tpl-g" style="margin-top:-6%;">
        <!-- 风格切换 -->
        <div class="tpl-skiner">
            <div class="tpl-skiner-toggle am-icon-cog">
            </div>
            <div class="tpl-skiner-content">
                <div class="tpl-skiner-content-title">
                    选择主题
                </div>
                <div class="tpl-skiner-content-bar">
                    <span class="skiner-color skiner-white" data-color="theme-white"></span>
                    <span class="skiner-color skiner-black" data-color="theme-black"></span>
                </div>
            </div>
        </div>
        <div class="tpl-login">
            <div class="tpl-login-content">
                <div class="tpl-login-logo">
                </div>
                <form class="am-form tpl-form-line-form">
                    <div class="am-form-group">
                        <input type="text" name="name" class="tpl-form-input" id="user-name" placeholder="请输入账号">

                    </div>
                    <div class="am-form-group">
                        <input type="password" name="password" class="tpl-form-input" id="user-name" placeholder="请输入密码">

                    </div>
                    <div class="am-form-group tpl-login-remember-me">
                        <input id="remember-me" type="checkbox">
                        <label for="remember-me">
                        记住密码
                         </label>
                    </div>
                    <div class="am-form-group">
                        <button type="button" class="am-btn am-btn-primary  am-btn-block tpl-btn-bg-color-success  tpl-login-btn sumbit_zhyong">提交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="/public/static/admin/assets/js/amazeui.min.js"></script>
    <script src="/public/static/admin/assets/js/app.js"></script>
    <script>
        $('.sumbit_zhyong').click(function(){
            var name=$('[name=name]').val();
            var password=$('[name=password]').val();
            if(!name){layer.msg('请输入账号',{time:800});$('[name=name]').focus();return false;};
            if(!password){layer.msg('请输入密码',{time:800});$('[name=password]').focus();return false;};
            $.post("<?php echo url('Login/login'); ?>",{name:name,password:password},function(data){
                if(data.code){
                    layer.msg(data.msg,{time:800},function(){
                        location.href=data.url;
                    });
                }else{
                    layer.msg(data.msg);
                }
            })
        });
    </script>
</body>
</html>