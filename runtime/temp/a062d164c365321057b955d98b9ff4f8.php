<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:49:"F:\plant/application/zhyong\view\zhyong\menu.html";i:1555050946;s:50:"F:\plant\application\zhyong\view\Father\index.html";i:1555480675;}*/ ?>
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
                    <!--<div class="am-u-sm-12 am-u-md-12 am-u-lg-6">-->
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-function am-fr" style="margin-right: 3%;">
                                    <a href="<?php echo url('Zhyong/topmenuadd'); ?>" class="">添加顶级菜单</a>
                                    <a href="javascript:;" class="click_back">刷新</a>
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
                                            <td><?php echo !empty($me_vo['pid1'])?$me_vo['pid1']:''; ?></td>
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                        <a href="<?php echo url('Zhyong/menuedit',['id'=>$me_vo['id']]); ?>">
                                                            <i class="am-icon-pencil"></i> 编辑
                                                        </a>
                                                    <?php if(($me_vo['pid']=='0')): ?>
                                                        <a href="<?php echo url('Zhyong/menuadd',['id'=>$me_vo['id'],'er'=>2]); ?>">
                                                            <i class="am-icon-pencil"></i> 添加
                                                        </a>
                                                    <?php elseif(($me_vo['er']=='2')): ?>
                                                        <a href="<?php echo url('Zhyong/menuadd',['id'=>$me_vo['id'],'er'=>3]); ?>">
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
                                <style type="text/css">
                                    #page {
                                        float: right;
                                    }
                                    #page div span a{
                                        border: 1px solid #fff;
                                        border-radius: 4px;
                                        height: 25px;
                                        line-height: 26px;
                                        margin: 0 3px;
                                        padding: 8px 12px;
                                        font-size: 12px;
                                        color: #fff;
                                    }
                                </style>
                                <div id="page"><?php echo $page; ?></div>
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
    <script src="/public/static/admin/assets/js/amazeui.min.js"></script>
    <script src="/public/static/admin/assets/js/amazeui.datatables.min.js"></script>
    <script src="/public/static/admin/assets/js/dataTables.responsive.min.js"></script>
    <script src="/public/static/admin/assets/js/app.js"></script>
</body>

</html>