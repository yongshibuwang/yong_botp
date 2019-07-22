<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:46:"F:\plant/application/zhyong\view\set\info.html";i:1547112650;s:50:"F:\plant\application\zhyong\view\Father\index.html";i:1555480675;}*/ ?>
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
    <div class="am-g tpl-g"  >
        <!-- 内容区域 -->
        
<!-- 内容区域 -->
<div class="tpl-content-wrapper">
    <div class="row-content am-cf">
        <div class="row">

            <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title am-fl" style="width: 30%;">
                            <a href="javascript:history.go(-1)" style="padding-right: 4%;">
                                <img src="/public/static/admin/assets/img/back_i1.png" alt=""/></a>
                            网站设置->网站信息</div>
                        <div class="widget-function am-fr" style="margin-right: 3%;">
                            <a href="javascript:;" class="click_back">刷新</a>
                        </div>
                    </div>
                    <div class="widget-body am-fr">
                        <form class="am-form tpl-form-border-form tpl-form-border-br" id="form1">
                            <div class="am-form-group">
                                <label for="name" class="am-u-sm-3 am-form-label">网站名称 <span class="tpl-form-line-small-title">menu_name</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" name="name"  style="width: 40%;" value="<?php echo $web_edit['name']; ?>" class="tpl-form-input" id="name" placeholder="请输入菜单名称">
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="intro" class="am-u-sm-3 am-form-label">网站简介 <span class="tpl-form-line-small-title">controller</span></label>
                                <div class="am-u-sm-9">
                                    <textarea name="intro" id="intro" cols="30" rows="5" style="width: 40%;" placeholder="请输入简介！"><?php echo $web_edit['intro']; ?></textarea>
                                    <!--<input type="text" name="web_address" style="width: 40%;" class="tpl-form-input" id="" placeholder="请输入菜单名称">-->
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="web_address" class="am-u-sm-3 am-form-label">网站地址 <span class="tpl-form-line-small-title">controller</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" name="web_address" value="<?php echo $web_edit['web_address']; ?>" style="width: 40%;" class="tpl-form-input" id="web_address" placeholder="请输入菜单名称">
                                </div>
                            </div>
                            <div class="am-form-group" >
                                <label class="am-u-sm-3 am-form-label">二维码 <span class="tpl-form-line-small-title">payCode</span></label>
                                <div class="am-u-sm-9" style="height:100px;">
                                    <div class="am-form-group am-form-file list_pic" style="height: 120px;width: 120px;">
                                        <label class="up_pic" for="doc-form-file">
                                            <div id="look_toux"  class="pic tpl-form-file-img" style="background-image: url(<?php echo $web_edit['img']; ?>);"></div>
                                        </label>
                                        <input id="doc-form-file" name="file" type="file" multiple="" onchange="javascript:setImagePreviews(this);">
                                    </div>
                                </div>
                            </div>
                            <div class="am-form-group" style="margin-top: 6%;">
                                <div class="am-u-sm-9 am-u-sm-push-3">
                                    <button type="button" class="am-btn am-btn-primary tpl-btn-bg-color-success submit-up-add" id="" onclick="submit_menu()">提交</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        //提交
        function submit_menu(){
            if(!$('[name=name]').val()){layer.msg('请输入网站名',{time:800});$('[name=name]').focus();return false;};
            if(!$('[name=web_address]').val()){layer.msg('请输入网站地址',{time:1500});$('[name=web_address]').focus();return false;};
//            if(!picArr){layer.msg('请添加图片',{time:800});};
            var a = {
                'name':$('[name=name]').val(),
                'intro':$('[name=intro]').val(),
                'web_address':$('[name=web_address]').val(),
                'img':picArr
            };
            $.post("<?php echo url('Set/info'); ?>",{data:a},function(data){
//                console.log(data);
                if(data.code){
                    layer.msg(data.msg,{time:800},function(){
                        self.location=document.referrer;
                    })
                }else{
                    layer.msg(data.msg);
                }
            });
        };
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
    </script>
</div>


    </div>
    <script src="/public/static/admin/assets/js/amazeui.min.js"></script>
    <script src="/public/static/admin/assets/js/amazeui.datatables.min.js"></script>
    <script src="/public/static/admin/assets/js/dataTables.responsive.min.js"></script>
    <script src="/public/static/admin/assets/js/app.js"></script>
</body>

</html>