<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"F:\plant\public/../application/zhyong\view\index\welcome.html";i:1562742486;}*/ ?>
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
<script src="/static/admin/assets/js/echarts.min.js"></script>
<div class="am-g tpl-g">
	<!-- 内容区域 -->
	<div class="tpl-content-wrapper" >

		<!--<div class="container-fluid am-cf">
            <div class="row">
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                    <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 部件首页 <small>Amaze UI</small></div>
                    <p class="page-header-description">Amaze UI 含近 20 个 CSS 组件、20 余 JS 组件，更有多个包含不同主题的 Web 组件。</p>
                </div>
                <div class="am-u-lg-3 tpl-index-settings-button">
                    <button type="button" class="page-header-button"><span class="am-icon-paint-brush"></span> 设置</button>
                </div>
            </div>
        </div>-->
		<div class="row-content am-cf">
			<div class="row  am-cf">
				<div class="am-u-sm-12 am-u-md-12 am-u-lg-4 am-u-md-6" style="width: 100%;">
					<!--<div class="widget am-cf">
                        <div class="widget-head am-cf">
                            <div class="widget-title am-fl">月度财务收支计划</div>
                            <div class="widget-function am-fr">
                                <a href="javascript:;" class="am-icon-cog"></a>
                            </div>
                        </div>
                        <div class="widget-body am-fr">
                            <div class="am-fl">
                                <div class="widget-fluctuation-period-text">
                                    ￥61746.45
                                    <button class="widget-fluctuation-tpl-btn">
                    <i class="am-icon-calendar"></i>
                    更多月份
                  </button>
                                </div>
                            </div>
                            <div class="am-fr am-cf">
                                <div class="widget-fluctuation-description-amount text-success" am-cf>
                                    +￥30420.56

                                </div>
                                <div class="widget-fluctuation-description-text am-text-right">
                                    8月份收入
                                </div>
                            </div>
                        </div>
                    </div>-->
				<div class="am-u-sm-12 am-u-md-6 am-u-lg-4" style="height:280px; ">
					<div class="widget widget-primary am-cf" style="height:280px; ">
						<div class="widget-statistic-header">
							今日游客访问量
						</div>
						<div class="widget-statistic-body">
							<div class="widget-statistic-value">
								<?php echo $accessNum; ?>
							</div>
							<!-- <div class="widget-statistic-description">
								本季度比去年多收入 <strong>2593元</strong> 人民币
							</div> -->
							<span class="widget-statistic-icon am-icon-credit-card-alt"></span>
						</div>
					</div>
				</div>
				<div class="am-u-sm-12 am-u-md-4" >
					<div class="widget am-cf" style="height:280px; ">
						<div class="widget-head am-cf">
							<div class="widget-title am-fl">专用服务器负载</div>
							<div class="widget-function am-fr">
								<a href="javascript:;" class="am-icon-cog"></a>
							</div>
						</div>
						<div class="widget-body widget-body-md am-fr">

							<div class="am-progress-title">CPU Load <span class="am-fr am-progress-title-more">28% / 100%</span></div>
							<div class="am-progress">
								<div class="am-progress-bar" style="width: 15%"></div>
							</div>
							<div class="am-progress-title">CPU Load <span class="am-fr am-progress-title-more">28% / 100%</span></div>
							<div class="am-progress">
								<div class="am-progress-bar  am-progress-bar-warning" style="width: 75%"></div>
							</div>
							<div class="am-progress-title">CPU Load <span class="am-fr am-progress-title-more">28% / 100%</span></div>
							<div class="am-progress">
								<div class="am-progress-bar am-progress-bar-danger" style="width: 35%"></div>
							</div>
						</div>
					</div>
				</div>
				<!-- <div class="am-u-sm-12 am-u-md-6 am-u-lg-4" style="height:260px; ">
					<div class="widget widget-purple am-cf">
						<div class="widget-statistic-header">
							本季度利润
						</div>
						<div class="widget-statistic-body">
							<div class="widget-statistic-value">
								￥27,294
							</div>
							<div class="widget-statistic-description">
								本季度比去年多收入 <strong>2593元</strong> 人民币
							</div>
							<span class="widget-statistic-icon am-icon-support"></span>
						</div>
					</div>
				</div> -->
			</div>

			<div class="row am-cf">
				<!--<div class="am-u-sm-12 am-u-md-8">
                    <div class="widget am-cf">
                        <div class="widget-head am-cf">
                            <div class="widget-title am-fl">月度财务收支计划</div>
                            <div class="widget-function am-fr">
                                <a href="javascript:;" class="am-icon-cog"></a>
                            </div>
                        </div>
                        <div class="widget-body-md widget-body tpl-amendment-echarts am-fr" id="tpl-echarts">

                        </div>
                    </div>
                </div>-->

				<!---->
			</div>


			<div class="row am-cf">
				<div class="am-u-sm-12 am-u-md-12 am-u-lg-4 widget-margin-bottom-lg ">
					<div class="tpl-user-card am-text-center widget-body-lg">
						<div class="tpl-user-card-title">
							<?php echo $admin_info['name']; ?>
						</div>
						<div class="achievement-subheading">
							月度最佳员工
						</div>
						<img class="achievement-image" style="height: 100px;width: 100px;" src="<?php echo $admin_info['img']; ?>" alt="">
						<div class="achievement-description">
							<?php echo $admin_info['name']; ?>
							<strong>30天内</strong> 禁言了
							<strong>200多</strong>人。
						</div>
					</div>
				</div>

				<div class="am-u-sm-12 am-u-md-12 am-u-lg-8 widget-margin-bottom-lg">

					<div class="widget am-cf widget-body-lg">

						<div class="widget-body  am-fr">
							<div class="am-scrollable-horizontal ">
								<table width="100%" class="am-table am-table-compact am-text-nowrap tpl-table-black " >
									<thead>
									<tr>
										<th>文章标题</th>
										<th>作者</th>
										<th>时间</th>
										<th>操作</th>
									</tr>
									</thead>
									<tbody>
									<?php if(is_array($new_article) || $new_article instanceof \think\Collection || $new_article instanceof \think\Paginator): $i = 0; $__LIST__ = $new_article;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$no): $mod = ($i % 2 );++$i;?>
										<tr class="gradeX">
											<td><?php echo $no['title']; ?></td>
											<td><?php echo $no['author']; ?></td>
											<td><?php echo date('Y-m-d',$no['add_time'])?></td>
											<td>
												<div class="tpl-table-black-operation">
													<a href="<?php echo url('Tables/edit',['id'=>$no['id']]); ?>">
	                                                        <i class="am-icon-pencil"></i> 编辑
	                                                    </a>
	                                                    <a href="javascript:;"  class="tpl-table-black-operation-del" onclick="del_article(<?php echo $no['id']; ?>)">
	                                                        <i class="am-icon-trash"></i> 删除
	                                                    </a>
												</div>
											</td>
										</tr>
									<?php endforeach; endif; else: echo "" ;endif; ?>
									<!-- more data -->
									</tbody>
								</table>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<script src="/static/admin/assets/js/amazeui.min.js"></script>
<script src="/static/admin/assets/js/amazeui.datatables.min.js"></script>
<script src="/static/admin/assets/js/dataTables.responsive.min.js"></script>
<script src="/static/admin/assets/js/app.js"></script>
</body>
<script>
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
</html>