<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:59:"F:\plant\public/../application/zhyong\view\tables\edit.html";i:1555050706;s:50:"F:\plant\application\zhyong\view\Father\index.html";i:1555480675;}*/ ?>
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
    <link rel="icon" type="image/png" href="/static/admin/assets/i/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="/static/admin/assets/i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <!--<script src="/static/admin/assets/js/echarts.min.js"></script>-->
    <link rel="stylesheet" href="/static/admin/assets/css/amazeui.min.css" />
    <link rel="stylesheet" href="/static/admin/assets/css/amazeui.datatables.min.css" />
    <link rel="stylesheet" href="/static/admin/assets/css/app.css">
    <script src="/static/admin/assets/js/jquery.min.js"></script>
    <script src="/static/admin/assets/js/LocalResizeIMG.js"></script>
    <script src="/static/admin/assets/js/public.js"></script>
    <script src="/static/admin/layer/layer.js"></script>
    <script src="/static/admin/editor/kindeditor.js"></script>
</head>

<body data-type="index">
    <script src="/static/admin/assets/js/theme.js"></script>
    <div class="am-g tpl-g"  >
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
                                <div class="widget-title am-fl" onclick="history.back(-1)">返回上一级</div>
                                <div class="widget-function am-fr" style="margin-right: 3%;">
                                    <a href="javascript:;" class="click_back">刷新</a>
                                </div>
                            </div>
                            <div class="widget-body am-fr">
                                <form class="am-form tpl-form-border-form tpl-form-border-br" id="form1">
                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label">标题 <span class="tpl-form-line-small-title">Title</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" name="title" style="width: 90%;" class="tpl-form-input" id="" value="<?php echo $article_edit['title']; ?>">
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
                                            <input type="text" name="add_time" style="width: 90%;" class="am-form-field tpl-form-no-bg" value="<?php echo date('Y-m-d',$article_edit['add_time'])?>" placeholder="发布时间" data-am-datepicker="" readonly="">
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-phone" class="am-u-sm-3 am-form-label">作者 <span class="tpl-form-line-small-title">Author</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" name="author" style="width: 90%;" class="tpl-form-input" id="user-name" value="<?php echo $article_edit['author']; ?>" placeholder="请输入作者">
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label for="pid" class="am-u-sm-3 am-form-label">所属分类 <span class="tpl-form-line-small-title">Author</span></label>
                                        <div class="am-u-sm-9">
                                            <select name="pid" id="pid">
                                                <?php if(is_array($label) || $label instanceof \think\Collection || $label instanceof \think\Paginator): $i = 0; $__LIST__ = $label;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lao): $mod = ($i % 2 );++$i;?>
                                                    <option value="<?php echo $lao['id']; ?>"  style="background-color:#36c6d3;color:#fff" <?php echo $lao['id']==$article_edit['pid']?'selected':''; ?>><?php echo $lao['name']; ?></option>
                                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                            </select>
                                            <!--<input type="text" name="author" style="width: 90%;" class="tpl-form-input" id="user-name" value="<?php echo $article_edit['author']; ?>" placeholder="请输入作者">-->
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
                'author':$('[name=author]').val(),
                'content':$('#editor').val(),
                'describe':$('#describe').val(),
                'pid':$('[name=pid] option:selected').val(),
                'is_hot':status_id,
                'type':$type,
                'id':"<?php echo $article_edit['id']; ?>",
                'img':picArr
        };
        $.post("<?php echo url('Tables/edit',['id'=>$article_edit['id'],'type'=>$type]); ?>",{data:a},function(data){
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
            'author':$('[name=author]').val(),
            'content':$('#editor').val(),
            'describe':$('#describe').val(),
            'pid':$('[name=pid] option:selected').val(),
            'is_hot':status_id,
            'id':"<?php echo $article_edit['id']; ?>",
            'img':picArr
        };
        $.post("<?php echo url('Tables/edit',['id'=>$article_edit['id'],'type'=>$type]); ?>",{data:a},function(data){
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
    <script src="/static/admin/assets/js/amazeui.min.js"></script>
    <script src="/static/admin/assets/js/amazeui.datatables.min.js"></script>
    <script src="/static/admin/assets/js/dataTables.responsive.min.js"></script>
    <script src="/static/admin/assets/js/app.js"></script>
</body>

</html>