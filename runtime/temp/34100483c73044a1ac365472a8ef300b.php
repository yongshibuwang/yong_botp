<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:60:"F:\plant\public/../application/zhyong\view\tables\index.html";i:1555047577;s:50:"F:\plant\application\zhyong\view\Father\index.html";i:1555480675;}*/ ?>
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
                                    <a href="javascript:;" style="<?php echo $type==2?'background-color:#36c6d3;color:#fff;':''; ?>padding:6px 8px; border-radius: 4%;font-size: 18px;margin-right: 6px;"  onclick="t_type(2)">已通过</a>
                                    <a href="javascript:;" style="<?php echo $type==1?'background-color:#36c6d3;color:#fff;':''; ?>padding:6px 8px; border-radius: 4%;font-size: 18px;margin-right: 6px;"  onclick="t_type(1)">未审核</a>
                                    <a href="javascript:;" style="<?php echo $type==3?'background-color:#36c6d3;color:#fff;':''; ?>padding:6px 8px; border-radius: 4%;font-size: 18px;margin-right: 6px;"  onclick="t_type(3)">未通过</a>
                                </div>
                                    <input type="hidden" name="type" value="<?php echo $type; ?>"/>
                                    <input type="submit" id="tijiao" style="display: none;"/>
                                </form>
                                <div class="widget-function am-fr" style="margin-right: 3%;">
                                    <a href="<?php echo url('Tables/pid',['type'=>1]); ?>" class="">文章标签</a>
                                    <a href="<?php echo url('Tables/save',['type'=>1]); ?>" class="">添加</a>
                                    <a href="javascript:;" class="click_back">刷新</a>
                                </div>
                            </div>
                            <div class="widget-body  widget-body-lg am-fr">
                                <table width="100%" class="am-table am-table-compact tpl-table-black " id="">
                                    <thead>
                                        <tr>
                                            <th>文章标题</th>
                                            <th>作者</th>
                                            <th>时间</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(is_array($article) || $article instanceof \think\Collection || $article instanceof \think\Paginator): $i = 0; $__LIST__ = $article;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                        <tr class="gradeX">
                                            <td><?php echo $vo['title']; ?></td>
                                            <td><?php echo $vo['author']; ?></td>
                                            <td><?php echo date('Y-m-d',$vo['add_time'])?></td>
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <a href="<?php echo url('Tables/edit',['id'=>$vo['id']]); ?>">
                                                        <i class="am-icon-pencil"></i> 编辑
                                                    </a>
                                                    <a href="javascript:;"  class="tpl-table-black-operation-del" onclick="del_article(<?php echo $vo['id']; ?>)">
                                                        <i class="am-icon-trash"></i> 删除
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                        <!-- more data -->
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
                <!--<div class="row">

                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">斑马线</div>
                                <div class="widget-function am-fr">
                                    <a href="javascript:;" class="am-icon-cog"></a>
                                </div>
                            </div>
                            <div class="widget-body  widget-body-lg am-fr">

                                <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                                    <thead>
                                        <tr>
                                            <th>文章标题</th>
                                            <th>作者</th>
                                            <th>时间</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="gradeX">
                                            <td>Amaze UI 模式窗口</td>
                                            <td>张鹏飞</td>
                                            <td>2016-09-26</td>
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <a href="javascript:;">
                                                        <i class="am-icon-pencil"></i> 编辑
                                                    </a>
                                                    <a href="javascript:;" class="tpl-table-black-operation-del">
                                                        <i class="am-icon-trash"></i> 删除
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="even gradeC">
                                            <td>有适配微信小程序的计划吗</td>
                                            <td>天纵之人</td>
                                            <td>2016-09-26</td>
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <a href="javascript:;">
                                                        <i class="am-icon-pencil"></i> 编辑
                                                    </a>
                                                    <a href="javascript:;" class="tpl-table-black-operation-del">
                                                        <i class="am-icon-trash"></i> 删除
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="gradeX">
                                            <td>请问有没有amazeui 分享插件</td>
                                            <td>王宽师</td>
                                            <td>2016-09-26</td>
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <a href="javascript:;">
                                                        <i class="am-icon-pencil"></i> 编辑
                                                    </a>
                                                    <a href="javascript:;" class="tpl-table-black-operation-del">
                                                        <i class="am-icon-trash"></i> 删除
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="even gradeC">
                                            <td>关于input输入框的问题</td>
                                            <td>着迷</td>
                                            <td>2016-09-26</td>
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <a href="javascript:;">
                                                        <i class="am-icon-pencil"></i> 编辑
                                                    </a>
                                                    <a href="javascript:;" class="tpl-table-black-operation-del">
                                                        <i class="am-icon-trash"></i> 删除
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="even gradeC">
                                            <td>有没有发现官网上的下载包不好用</td>
                                            <td>醉里挑灯看键</td>
                                            <td>2016-09-26</td>
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <a href="javascript:;">
                                                        <i class="am-icon-pencil"></i> 编辑
                                                    </a>
                                                    <a href="javascript:;" class="tpl-table-black-operation-del">
                                                        <i class="am-icon-trash"></i> 删除
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="even gradeC">
                                            <td>我建议WEB版本文件引入问题</td>
                                            <td>罢了</td>
                                            <td>2016-09-26</td>
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <a href="javascript:;">
                                                        <i class="am-icon-pencil"></i> 编辑
                                                    </a>
                                                    <a href="javascript:;" class="tpl-table-black-operation-del">
                                                        <i class="am-icon-trash"></i> 删除
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        &lt;!&ndash; more data &ndash;&gt;
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>-->

            </div>
        </div>
<script>
    function t_type(id){
        $('[name=type]').val(id);
        document.getElementById('tijiao').click();
    }
    function del_article(id){
        layer.confirm('确认要删除吗？', function () {
            $.post("<?php echo url('del_article'); ?>",{id:id},function(data){
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
    <script src="/static/admin/assets/js/amazeui.min.js"></script>
    <script src="/static/admin/assets/js/amazeui.datatables.min.js"></script>
    <script src="/static/admin/assets/js/dataTables.responsive.min.js"></script>
    <script src="/static/admin/assets/js/app.js"></script>
</body>

</html>