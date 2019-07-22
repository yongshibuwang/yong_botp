<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:61:"F:\plant\public/../application/index\view\article\gossip.html";i:1555039523;s:50:"F:\plant\application\index\view\Father\father.html";i:1562752508;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <meta name="keywords" content="IT学习之家，PHP学习，web学习，vue学习，热门IT网址，时事政治，散文，捧腹笑话" />
    <meta name="description" content="IT学习之家，PHP学习，web学习，vue学习，热门IT网址，时事政治，散文，捧腹笑话" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="format-detection" content="telephone=yes"/>
    <meta name="msapplication-tap-highlight" content="no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $selfWebInfo['name']; ?></title>

    <link rel="shortcut icon" href="/static/index/images/logo2.jpg">
    <script src="/static/index/js/jquery.min.js"></script>
    <script src="/static/index/js/bootstrap.min.js"></script>
    <script src="/static/admin/layer/layer.js"></script>

    <!--<link rel="stylesheet" type="text/css" media="screen" href="/static/index/css/bootstrap.min1.css" />-->
    <link rel="stylesheet" type="text/css" media="screen" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/static/index/css/style1.css">
</head>

<body>
<header>
    <nav class="navbar navbar-default" id="navbar">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar" aria-expanded="false">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <h1 class="logo">
                    <a href="<?php echo url('Index/index'); ?>">勇☆贳&卟☆莣</a>
                </h1>

            </div>
            <div class="collapse navbar-collapse" id="header-navbar">
                <form class="navbar-form visible-xs" action="#" method="POST">
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" placeholder="请输入关键字" maxlength="20" autocomplete="off">
                        <span class="input-group-btn">
                                <button type="submit" class="btn btn-default btn-search">搜索</button>
                            </span>
                    </div>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo url('Index/index',['mobile'=>1]); ?>">首页</a></li>
                    <li><a href="<?php echo url('Article/htmlOption',['mobile'=>1]); ?>">Web文章</a></li>
                    <li><a href="<?php echo url('Article/phpOption',['mobile'=>1]); ?>">后端文章</a></li>
                    <li><a href="<?php echo url('Article/gossip',['mobile'=>1]); ?>">随笔</a></li>
                    <li><a href="<?php echo url('Oftenweb/web'); ?>">常用网站</a></li>
                    <!--<li><a href="http://m.zhyong.top">常用网站</a></li>-->
                    <li><a href="http://we.zhyong.top">捧腹笑话</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
    
<div class="container">
    <!-- <div class="introBanner">
         <h3>Reedo</h3>
         <p>有意义的想法，值得全情兑现！</p>
     </div>-->
    <div class="banner introBanner" style="background: url(/static/index/images/banner_top.jpg) top center;width: 100%;background-size:cover;">
        <section class="box">
            <ul class="texts">
                <p>好想给你打一辈子辅助</p>
                <p>人头是你的、兵线是你的、buff是你的、塔是你的</p>
                <p>所有经济都是你的，我什么都不要，只要你活着。</p>
            </ul>
            <div class="avatar"><a href="#"><span>勇☆贳&卟☆莣</span></a> </div>
        </section>
    </div>
    <div class="content-wrap">
        <div class="sidebar">
            <div class="widget widget_category">
                <h3>文章分类</h3>
                <ul>
                    <li><a href="<?php echo url('Article/htmlOption'); ?>"><span class="text"><i class="glyphicon glyphicon-triangle-right"></i>Web文章</span><span class="count"><?php echo $w_article; ?>篇</span></a></li>
                    <li><a href="<?php echo url('Article/phpOption'); ?>"><span class="text"><i class="glyphicon glyphicon-triangle-right"></i>后端文章</span><span class="count"><?php echo $p_article; ?>篇</span></a></li>
                    <li><a href="<?php echo url('Article/gossip'); ?>"><span class="text"><i class="glyphicon glyphicon-triangle-right"></i>随笔</span><span class="count"><?php echo $s_article; ?>篇</span></a></li>
                    <li><a href="<?php echo url('Article/ling'); ?>"><span class="text"><i class="glyphicon glyphicon-triangle-right"></i>捧腹笑话</span><span class="count"><?php echo $w_web; ?>篇</span></a></li>

                </ul>
            </div>
            <!--<div class="widget">
                <h3>归档</h3>
                <ul>
                    <li><a><span class="text"><i class="glyphicon glyphicon-play-circle"></i> 2018年3月</span></a></li>
                    <li><a><span class="text"><i class="glyphicon glyphicon-play-circle"></i> 2018年3月</span></a></li>
                    <li><a><span class="text"><i class="glyphicon glyphicon-play-circle"></i> 2018年3月</span></a></li>
                </ul>
            </div>-->
            <div class="widget widget_sentence">
                <h3>标签云</h3>
                <ul>
                    <?php if($label): if(is_array($label) || $label instanceof \think\Collection || $label instanceof \think\Paginator): $i = 0; $__LIST__ = $label;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$loo): $mod = ($i % 2 );++$i;?>
                    <li><a href="<?php echo url('Article/gossip',['pid'=>$loo['id']]); ?>"><?php echo $loo['name']; ?> </a></li>
                    <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                </ul>
            </div>
            <div class="widget widget_hot">
                <h3>最新文章</h3>
                <ul>
                    <?php if(is_array($new_article) || $new_article instanceof \think\Collection || $new_article instanceof \think\Paginator): $i = 0; $__LIST__ = $new_article;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lo): $mod = ($i % 2 );++$i;?>
                    <li>
                        <a title="" href="<?php echo url('Index/detail',['id'=>$lo['id']]); ?>">
                            <span class="text"><?php echo $lo['title']; ?></span>
                            <span class="muted">
                                            <i class="glyphicon glyphicon-time"></i>
                                <?php echo date('Y-m-d',$lo['add_time'])?>
                                        </span>
                            <span class="muted">
                                            <i class="glyphicon glyphicon-eye-open"></i> <?php echo $lo['read_num']; ?></span>
                        </a>
                    </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>
        <div class="content">
            <!--<div class="title">
                <h3>最新发布</h3>
                <div class="more">
                    <a href="#">产品</a>
                    <a href="#">技术</a>
                    <a href="#">生活笔记</a>
                </div>
            </div>-->
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <div class="excerpt">
                <header>
                    <a class="cat" href="#"><?php echo $vo['laname']; ?><i></i></a>
                    <?php if($vo['link']): ?>
                        <h2><a target="_blank" href="<?php echo $vo['link']; ?>"><?php echo $vo['title']; ?></a></h2>
                    <?php else: ?>
                        <h2><a href="<?php echo url('Index/detail',['id'=>$vo['id']]); ?>"><?php echo $vo['title']; ?></a></h2>
                    <?php endif; ?>

                </header>
                <p><?php echo $vo['describe']; ?></p>
                <p class="meta">
                    <a class="category" href="#"><i class="glyphicon glyphicon-folder-open"></i> <?php echo $vo['kind']; ?></a>
                    <a class="time" href="#"><i class="glyphicon glyphicon-time"></i> <?php echo date('Y-m-d',$vo['add_time'])?></a>
                    <a class="views" href="#"><i class="glyphicon glyphicon-eye-open"></i> <?php echo $vo['read_num']; ?></a>
                    <!--<a class="comment" href="#"><i class="glyphicon glyphicon-comment"></i> 10</a>-->
                </p>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            <style>
                #page div span a {
                    border: 1px solid #000;
                    border-radius: 4px;
                    height: 25px;
                    line-height: 26px;
                    margin: 0 3px;
                    padding: 8px 12px;
                    font-size: 12px;
                    color: #000;
                }
            </style>
            <nav aria-label="Page navigation" id="page" style="margin-top: 10px;text-align: center;">
                <?php echo $page; ?>
            </nav>
        </div>

    </div>
</div>

<div class="footer">
    <div class="container"  style="height: 22px;">
        <p style="height: 22px;"><?php echo $selfWebInfo['intro']; ?>-  <a href="https://new.cnzz.com/v1/login.php?siteid=5329134">网站统计<img style="width: 40px;height: 10px;display: inline;" src="/static/index/images/2.gif"></a></p>
    </div>
</div>
</body>
</html>
