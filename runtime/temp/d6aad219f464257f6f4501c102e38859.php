<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:49:"F:\wzpl./application/zhyong\view\tables\edit.html";i:1542613283;s:49:"F:\wzpl\application\zhyong\view\Father\index.html";i:1542608302;}*/ ?>
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
                                <div class="widget-title am-fl">边框表单</div>
                                <div class="widget-function am-fr" style="margin-right: 3%;">
                                    <a href="javascript:;" class="click_back">刷新</a>
                                </div>
                            </div>
                            <div class="widget-body am-fr">
                                <form class="am-form tpl-form-border-form tpl-form-border-br" id="form1">
                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label">标题 <span class="tpl-form-line-small-title">Title</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" name="title" style="width: 90%;" class="tpl-form-input" id="user-name" value="<?php echo $article_edit['title']; ?>">
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label for="describe" class="am-u-sm-3 am-form-label">描述 <span class="tpl-form-line-small-title">Title</span></label>
                                        <div class="am-u-sm-9">
                                            <textarea name="describe" id="describe" style="width: 90%;" class="tpl-form-input" cols="10" rows="3" placeholder="请输入描述"><?php echo $article_edit['describe']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label for="user-email" class="am-u-sm-3 am-form-label">发布时间 <span class="tpl-form-line-small-title">Time</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" name="add_time" style="width: 90%;" class="am-form-field tpl-form-no-bg" placeholder="发布时间" data-am-datepicker="" readonly="">
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-phone" class="am-u-sm-3 am-form-label">作者 <span class="tpl-form-line-small-title">Author</span></label>
                                        <div class="am-u-sm-9">
                                            <select data-am-selected="{searchBox: 1}" name="author" style="display: none;">
                                              <option value="a">-The.CC</option>
                                              <option value="b">夕风色</option>
                                              <option value="o">Orange</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!--<div class="am-form-group">
                                        <label class="am-u-sm-3 am-form-label">SEO关键字 <span class="tpl-form-line-small-title">SEO</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" style="width: 90%;" placeholder="输入SEO关键字">
                                        </div>
                                    </div>-->
                                    <div class="am-form-group" >
                                        <label class="am-u-sm-3 am-form-label">封面图 <span class="tpl-form-line-small-title">Images</span></label>
                                        <div class="am-u-sm-9" style="height:100px;">
                                            <div class="am-form-group am-form-file list_pic" style="height: 120px;width: 120px;">
                                                <label class="up_pic" for="doc-form-file">
                                                    <div id="look_toux"  class="pic tpl-form-file-img" style="background-image: url('<?php echo $article_edit['img']; ?>');"></div>
                                                </label>
                                                <input id="doc-form-file" name="file" type="file" multiple="" onchange="javascript:setImagePreviews(this);">
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="am-form-group">
                                        <label for="user-weibo" class="am-u-sm-3 am-form-label">添加分类 <span class="tpl-form-line-small-title">Type</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text"  style="width: 90%;" id="user-weibo" placeholder="请添加分类用点号隔开">
                                            <div>
                                            </div>
                                        </div>
                                    </div>-->
                                    <div class="am-form-group">
                                        <label for="user-intro" class="am-u-sm-3 am-form-label">是否推荐</label>
                                        <div class="am-u-sm-9">
                                            <div class="tpl-switch">
                                                <input type="checkbox" id="user-intro" name="status" class="ios-switch bigswitch tpl-switch-btn" checked="">
                                                <div class="tpl-switch-btn-view">
                                                    <div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="editor_id" class="am-u-sm-3 am-form-label">文章内容</label>
                                        <div class="am-u-sm-9" id="">
                                            <textarea class="" name="content" rows="10" style="width: 90%;"  id="editor" placeholder="请输入文章内容"><?php echo $article_edit['content']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <?php if($article_edit['type'] == 1): ?>
                                        <div class="am-u-sm-9 am-u-sm-push-3">
                                            <button type="button" class="am-btn am-btn-primary tpl-btn-bg-color-success" onclick="t_pass(2)">通过</button>
                                            <button type="button" class="am-btn am-btn-primary tpl-btn-bg-color-success" onclick="t_pass(3)">不通过</button>
                                        </div>
                                        <?php else: ?>
                                        <div class="am-u-sm-9 am-u-sm-push-3">
                                            <button type="button" class="am-btn am-btn-primary tpl-btn-bg-color-success submit_up">提交</button>
                                        </div>
                                        <?php endif; ?>

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
    //提交
    function t_pass($type){
        editor.sync();
        if(!$('[name=title]').val()){layer.msg('请输入标题',{time:800});$('[name=title]').focus();return false;};
        if(!$('#describe').val()){layer.msg('请输入描述',{time:800});$('#describe').focus();return false;};
        if(!$('#editor').val()){layer.msg('请输入文章内容',{time:800});$('#editor').focus();return false;};
        var status_id=2;
        if($('[name=status]:checked').val()){
            status_id=1;
        }
        var a = {
                'title':$('[name=title]').val(),
                'content':$('#editor').val(),
                'describe':$('#describe').val(),
                'is_hot':status_id,
                'type':$type,
                'id':"<?php echo $article_edit['id']; ?>",
                'img':picArr
        };
        $.post("<?php echo url('Tables/edit',['id'=>$article_edit['id']]); ?>",{data:a},function(data){
            console.log(data);
            if(data.code){
                layer.msg(data.msg,{time:800},function(){
                    self.location=document.referrer;
                })
            }else{
                layer.msg(data.msg);
            }
        });
    };
    //提交
    $('.submit_up').click(function(){
        editor.sync();
        if(!$('[name=title]').val()){layer.msg('请输入标题',{time:800});$('[name=title]').focus();return false}
        if(!$('#editor').val()){layer.msg('请输入文章内容',{time:800});$('#editor').focus();return false}
        var status_id=2;
        if($('[name=status]:checked').val()){
            status_id=1;
        }
        var a = {
                'title':$('[name=title]').val(),
                'content':$('#editor').val(),
            'describe':$('#describe').val(),
                'is_hot':status_id,
                'id':"<?php echo $article_edit['id']; ?>",
                'img':picArr
        };
        $.post("<?php echo url('Tables/edit',['id'=>$article_edit['id']]); ?>",{data:a},function(data){
            console.log(data);
            if(data.code){
                layer.msg(data.msg,{time:800},function(){
                    self.location=document.referrer;
                })
            }else{
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