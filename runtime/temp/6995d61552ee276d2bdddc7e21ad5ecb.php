<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:49:"F:\wzpl./application/zhyong\view\zhyong\menu.html";i:1542940863;s:49:"F:\wzpl\application\zhyong\view\Father\index.html";i:1542608302;}*/ ?>
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
        
        <!-- 内容区域 -->
        <div class="tpl-content-wrapper">
            <div class="row-content am-cf">
                <div class="row">
                    <!--<div class="am-u-sm-12 am-u-md-12 am-u-lg-6">-->
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-function am-fr" style="margin-right: 3%;">
                                    <a href="<?php echo url('Zhyong/topmenuadd'); ?>" class="">添加顶级菜单</a>
                                </div>
                            </div>
                            <div class="widget-body  widget-body-lg am-fr">
                                <table width="100%" class="am-table am-table-compact tpl-table-black " id="">
                                    <thead>
                                        <tr>
                                            <th>菜单名称</th>
                                            <th>所属分级</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(is_array($menu_info) || $menu_info instanceof \think\Collection || $menu_info instanceof \think\Paginator): $i = 0; $__LIST__ = $menu_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$me_vo): $mod = ($i % 2 );++$i;?>
                                        <tr class="gradeX">
                                            <td><?php echo $me_vo['menu_name']; ?></td>
                                            <td><?php echo !empty($me_vo['pid'])?$me_vo['pid']:''; ?></td>
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                        <a href="<?php echo url('Zhyong/menuedit',['id'=>$me_vo['id']]); ?>">
                                                            <i class="am-icon-pencil"></i> 编辑
                                                        </a>
                                                    <?php if($me_vo['pid'] == '0'): ?>
                                                        <a href="<?php echo url('Zhyong/menuadd',['id'=>$me_vo['id']]); ?>">
                                                            <i class="am-icon-pencil"></i> 添加
                                                        </a>
                                                    <?php else: ?>
                                                        <em style="width: 51px;height: 25px;">
                                                        </em>
                                                    <?php endif; ?>
                                                        <a href="javascript:;" class="tpl-table-black-operation-del" onclick="del_menu(<?php echo $me_vo['id']; ?>)">
                                                            <i class="am-icon-trash"></i> 删除
                                                        </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script>
    function del_menu(id){
        layer.confirm('确认要删除吗？', function () {
            $.post("<?php echo url('del_menu'); ?>",{id:id},function(data){
                if(data.code){
                    layer.msg('删除成功',{time:800},function(){
                        location=location;
                    })
                }else{
                    layer.msg('网络错误',{time:800})
                }
            });
        })
    }

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