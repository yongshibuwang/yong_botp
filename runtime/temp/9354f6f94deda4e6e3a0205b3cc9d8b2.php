<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:60:"F:\plant\public/../application/zhyong\view\oftenweb\web.html";i:1555047577;s:50:"F:\plant\application\zhyong\view\Father\index.html";i:1555480675;}*/ ?>
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
        
<!-- 分页样式 -->
        <!-- 内容区域 -->
        <div class="tpl-content-wrapper">
            <div class="row-content am-cf">
                <div class="row">
                    <!--<div class="am-u-sm-12 am-u-md-12 am-u-lg-6">-->
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <form action="">
                                <div class="widget-title am-fl tpl-table-black-operation">
                                    <!--<a href="javascript:;" style="padding:6px 8px; border-radius: 4%;font-size: 18px;margin-right: 6px;"  onclick="t_type(1)">未审核</a>-->
                                </div>
                                    <input type="hidden" name="type" value=""/>
                                    <input type="submit" id="tijiao" style="display: none;"/>
                                </form>
                                <div class="widget-function am-fr" style="margin-right: 3%;">
                                    <a href="<?php echo url('Oftenweb/add'); ?>" class="">添加</a>
                                    <!--<a href="javascript:;" class="delete">删除</a>-->
                                    <a href="javascript:;" class="click_back" style="padding: 0 20px">刷新</a>
                                </div>
                            </div>
                            <div class="widget-body  widget-body-lg am-fr">
                                <table width="100%" class="am-table am-table-compact tpl-table-black " id="">
                                    <thead>
                                        <tr>
                                            <th width="20%">网站名</th>
                                            <th>图像</th>
                                            <th>链接地址</th>
                                            <th width="30%">简介</th>
                                            <th>是否推荐</th>
                                            <th>添加时间</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(is_array($web) || $web instanceof \think\Collection || $web instanceof \think\Paginator): $i = 0; $__LIST__ = $web;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                        <tr class="gradeX" >
                                            <td><?php echo $vo['name']; ?></td>
                                            <td><img src="<?php echo $vo['img']; ?>" alt="" style="width: 50px;height: 50px;"/></td>
                                            <td><?php echo $vo['web_address']; ?></td>
                                            <td style="display: -webkit-box;
    overflow: hidden;
    text-overflow: ellipsis;
    word-wrap: break-word;
    white-space: normal !important;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;"><?php echo $vo['intro']; ?></td>
                                            <td><?php echo $vo['is_recommend']==1?'是':'否'; ?></td>
                                            <td><?php echo date('Y-m-d',$vo['add_time'])?></td>
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <a href="<?php echo url('Oftenweb/edit',['id'=>$vo['id']]); ?>">
                                                        <i class="am-icon-pencil"></i> 编辑
                                                    </a>
                                                    <a href="javascript:;" class="tpl-table-black-operation-del" onclick="del_web(<?php echo $vo['id']; ?>)">
                                                        <i class="am-icon-trash"></i> 删除
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </tbody>
                                </table>
                                <div id="page"><?php echo $article; ?></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
<script>
    function t_type(id){
        $('[name=type]').val(id);
        document.getElementById('tijiao').click();
    }
    function del_web(id){
        layer.confirm('确认要删除吗？',function(){
            $.post("<?php echo url('Oftenweb/del_web'); ?>",{id:id},function(data){
                if(data.code){
                    layer.msg(data.msg,{time:1000},function(){
                        location.replace(location.href);
                    })
                }else{
                    layer.msg(data.msg,{time:1000});
                }
            })
        })

    }
</script>

    </div>
    <script src="/static/admin/assets/js/amazeui.min.js"></script>
    <script src="/static/admin/assets/js/amazeui.datatables.min.js"></script>
    <script src="/static/admin/assets/js/dataTables.responsive.min.js"></script>
    <script src="/static/admin/assets/js/app.js"></script>
</body>

</html>