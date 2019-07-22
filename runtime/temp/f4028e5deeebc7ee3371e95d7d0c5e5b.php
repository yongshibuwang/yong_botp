<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:49:"F:\wzpl./application/zhyong\view\zhyong\edit.html";i:1543401549;s:49:"F:\wzpl\application\zhyong\view\Father\index.html";i:1543403672;}*/ ?>
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
    <!--<script src="/public/static/admin/assets/js/echarts.min.js"></script>-->
    <link rel="stylesheet" href="/public/static/admin/assets/css/amazeui.min.css" />
    <link rel="stylesheet" href="/public/static/admin/assets/css/amazeui.datatables.min.css" />
    <link rel="stylesheet" href="/public/static/admin/assets/css/app.css">
    <script src="/public/static/admin/assets/js/jquery.min.js"></script>
    <script src="/public/static/admin/assets/js/LocalResizeIMG.js"></script>
    <script src="/public/static/admin/assets/js/public.js"></script>
    <script src="/public/static/admin/layer/layer.js"></script>
    <script src="/public/static/admin/editor/kindeditor.js"></script>
</head>

<body data-type="index">
    <script src="/public/static/admin/assets/js/theme.js"></script>
    <div class="am-g tpl-g">
        <!-- 头部 -->
        <header>
            <!-- logo -->
            <div class="am-fl tpl-header-logo">
                <a href="javascript:;"><img src="/public/static/admin/assets/img/logo.png" alt=""></a>
            </div>
            <!-- 右侧内容 -->
            <div class="tpl-header-fluid">
                <!-- 侧边切换 -->
                <div class="am-fl tpl-header-switch-button am-icon-list">
                    <span>

                </span>
                </div>
                <!-- 搜索 -->
                <div class="am-fl tpl-header-search">
                    <form class="tpl-header-search-form" action="javascript:;">
                        <button class="tpl-header-search-btn am-icon-search"></button>
                        <input class="tpl-header-search-box" type="text" placeholder="搜索内容...">
                    </form>
                </div>
                <!-- 其它功能-->
                <div class="am-fr tpl-header-navbar">
                    <ul>
                        <!-- 欢迎语 -->
                        <li class="am-text-sm tpl-header-navbar-welcome">
                            <a href="javascript:;">欢迎你, <span><?php echo $admin_user_info['name']; ?></span> </a>
                        </li>



                        <!-- 退出 -->
                        <li class="am-text-sm">
                            <a href="javascript:;" onclick="loginOut()">
                                <span class="am-icon-sign-out"></span> 退出
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
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
        <!-- 侧边导航栏 -->
        <div class="left-sidebar">
            <!-- 用户信息 -->
            <div class="tpl-sidebar-user-panel">
                <div class="tpl-user-panel-slide-toggleable">
                    <div class="tpl-user-panel-profile-picture">
                        <img src="/public/static/admin/assets/img/user04.png" alt="">
                    </div>
                    <span class="user-panel-logged-in-text">
              <i class="am-icon-circle-o am-text-success tpl-user-panel-status-icon"></i>
              <?php echo $admin_user_info['name']; ?>
          </span>
                    <a href="javascript:;" class="tpl-user-panel-action-link"> <span class="am-icon-pencil"></span> 账号设置</a>
                </div>
            </div>

            <!-- 菜单 -->
            <ul class="sidebar-nav">
                <?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$me_v): $mod = ($i % 2 );++$i;?>
                <li class="sidebar-nav-link">
                    <a href="javascript:;" class="sidebar-nav-sub-title">
                        <i class="am-icon-table sidebar-nav-link-logo"></i> <?php echo $me_v['menu_name']; ?>
                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                    </a>
                    <ul class="sidebar-nav sidebar-nav-sub">
                        <?php if(is_array($me_v['child_menu']) || $me_v['child_menu'] instanceof \think\Collection || $me_v['child_menu'] instanceof \think\Paginator): $i = 0; $__LIST__ = $me_v['child_menu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$me_va): $mod = ($i % 2 );++$i;?>
                            <li class="sidebar-nav-link">
                                <a href="<?php echo $http; ?>zhyong/<?php echo $me_va['controller']; ?>/<?php echo $me_va['function']; ?>">
                                    <span class="am-icon-angle-right sidebar-nav-link-logo"></span> <?php echo $me_va['menu_name']; ?>
                                </a>
                            </li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>

        </div>
        <!-- 内容区域 -->
        
<script>
    KindEditor.ready(function(K) {
        window.editor = K.create('#editor');
    });
</script>
        <!-- 内容区域 -->
        <div class="tpl-content-wrapper">
            <div class="row-content am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl" style="width: 30%;">
                                <a href="javascript:history.go(-1)" style="margin-right: 4%;">
                                    <img src="/public/static/admin/assets/img/back_i1.png" alt=""/></a>
                                系统管理->管理员->编辑</div>
                                <div class="widget-function am-fr" style="margin-right: 3%;">
                                    <a href="javascript:;" class="click_back">刷新</a>
                                </div>
                            </div>
                            <div class="widget-body am-fr">
                                <form class="am-form tpl-form-border-form tpl-form-border-br" id="form1">
                                    <div class="am-form-group">
                                        <label for="name" class="am-u-sm-3 am-form-label">管理员名称 <span class="tpl-form-line-small-title">Name</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" name="name" value="<?php echo $admin_info['name']; ?>" style="width: 40%;" class="tpl-form-input" id="name" placeholder="请输入标题文字">
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label for="role-name" class="am-u-sm-3 am-form-label">所属角色 <span class="tpl-form-line-small-title">RoleType</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" name="rolename" value="<?php echo $admin_info['rolename']; ?>" style="width: 40%;" class="tpl-form-input" id="role-name" placeholder="请输入标题文字">
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label for="password" class="am-u-sm-3 am-form-label">管理密码 <span class="tpl-form-line-small-title">Password</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" name="password" value="" style="width: 40%;" class="tpl-form-input" id="password" placeholder="******">
                                        </div>
                                    </div>
                                    <div class="am-form-group" >
                                        <label class="am-u-sm-3 am-form-label">图片 <span class="tpl-form-line-small-title">Images</span></label>
                                        <div class="am-u-sm-9" style="height:100px;">
                                            <div class="am-form-group am-form-file list_pic" style="height: 120px;width: 120px;">
                                                <label class="up_pic" for="doc-form-file">
                                                    <div id="look_toux"  class="pic tpl-form-file-img" style="background-image: url('<?php echo $admin_info['img']; ?>');"></div>
                                                </label>
                                                <input id="doc-form-file" name="file" type="file" multiple="" onchange="javascript:setImagePreviews(this);">
                                                <input type="hidden" name="img"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label for="password" class="am-u-sm-3 am-form-label">管理权限 <span class="tpl-form-line-small-title">Password</span></label>
                                        <div class="am-u-sm-9" id="right_item" style="margin-top: 3%;">
                                            <?php if(is_array($menu_all) || $menu_all instanceof \think\Collection || $menu_all instanceof \think\Paginator): $i = 0; $__LIST__ = $menu_all;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                                <div class="" style="">
                                                    <span style="font-size: 16px;color: #888;"><?php echo $v['menu_name']; ?></span>
                                                    <div style="margin-left: 3%;">
                                                        <?php if(is_array($v['child_menu']) || $v['child_menu'] instanceof \think\Collection || $v['child_menu'] instanceof \think\Paginator): $i = 0; $__LIST__ = $v['child_menu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?>
                                                        <label style="font-size: 14px;color: #888;margin-left: 1%;"><input class="choes_dan" type="checkbox"  name="ChkTrue[]" data-id="<?php echo $voo['id']; ?>" value="<?php echo $v['id']; ?>_<?php echo $voo['id']; ?>"><?php echo $voo['menu_name']; ?></label>
                                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </div>
                                                </div>
                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <div class="am-u-sm-9 am-u-sm-push-3">
                                            <button type="button" class="am-btn am-btn-primary tpl-btn-bg-color-success submit_up">提交</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script>
    //图片转化为base64
    var picArr = "";
    $('.list_pic input:file').localResizeIMG({
        width:600,
        quality: 0.7,
        success: function (result) {
            var img = new Image();
            img.src = result.base64;
            $(".list_pic").css("background-image","url("+result.base64+")");
            picArr= result.base64;
            // picArr[_i] = _i;
//            console.log(picArr)
        }
    });
    $(document).ready(function(){
        <!--登陆用户已有的权限 -->
        var role ="<?php echo $admin_info['role']; ?>";
        role=role.split(',');
        <!--循环取出checkbox 的值  如果role 中有就 追加 选中-->
        $("#right_item .choes_dan").each(function(){
            var l=$(this).attr('data-id');
            var res=$.inArray( l, role);
            if(res>=0){
                $(this).attr('checked','checked');
            }
        });
    });
    //提交
    $('.submit_up').click(function(){
        if(!$('[name=name]').val()){layer.msg('请输入管理员名称',{time:800});$('[name=name]').focus();return false;};
        if(!$('[name=rolename]').val()){layer.msg('请输入角色名称',{time:800});$('[name=rolename]').focus();return false;};
//        if(!$('[name=password]').val()){layer.msg('请输入管理密码',{time:800});$('[name=password]').focus();return false;};
        if(picArr){$('[name="img"]').val(picArr);};
        var form = new FormData($("#form1")[0]);


        $.ajax({
            url:"<?php echo url('Zhyong/edit',['id'=>$admin_info['id']]); ?>",
            type:"POST",
            data:form,
            dataType:'json',    //返回的数据格式：json/xml/html/script/jsonp/text
            processData:false,
            contentType:false,
            success:function(data){
                layer.msg(data.msg,{time:800},function(){
                    self.location=document.referrer;
                })
            },
            error:function(data){
                layer.msg(data.msg);
            }
        });
    });
</script>

    </div>
    </div>
    <script src="/public/static/admin/assets/js/amazeui.min.js"></script>
    <script src="/public/static/admin/assets/js/amazeui.datatables.min.js"></script>
    <script src="/public/static/admin/assets/js/dataTables.responsive.min.js"></script>
    <script src="/public/static/admin/assets/js/app.js"></script>
</body>
<script>
    function loginOut(){
        layer.confirm('确认要退出吗？', function () {
            $.post("<?php echo url('Login/loginOut'); ?>", {id: 1}, function (data) {
                if (data.code) {
                    layer.msg(data.msg, {time: 800}, function () {
                        location = location;
                    })
                }
            });
        });
    }
</script>
</html>