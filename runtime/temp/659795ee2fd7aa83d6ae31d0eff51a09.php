<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:51:"F:\yong/application/zhyong\view\zhyong\roleadd.html";i:1554863619;s:49:"F:\yong\application\zhyong\view\Father\index.html";i:1547089984;}*/ ?>
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
                                系统管理->管理员->添加</div>
                                <div class="widget-function am-fr" style="margin-right: 3%;">
                                    <a href="javascript:;" class="click_back">刷新</a>
                                </div>
                            </div>
                            <div class="widget-body am-fr">
                                <form class="am-form tpl-form-border-form tpl-form-border-br" id="form1">
                                    <div class="am-form-group">
                                        <label for="name" class="am-u-sm-3 am-form-label">角色名称 <span class="tpl-form-line-small-title">Name</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" name="name" style="width: 40%;" class="tpl-form-input" id="name" placeholder="请输入标题文字">
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label for="password" class="am-u-sm-3 am-form-label">管理权限 <span class="tpl-form-line-small-title">Password</span></label>
                                        <div class="am-u-sm-9" style="margin-top: 3%;">
                                            <?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
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
    //提交
    $('.submit_up').click(function(){
        if(!$('[name=name]').val()){layer.msg('请输入角色名称',{time:800});$('[name=name]').focus();return false;};

        var form = new FormData(document.getElementById('form1'));
        $.ajax({
            url:"<?php echo url('Zhyong/roleadd'); ?>",
            type:"POST",
            data:form,
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

</html>