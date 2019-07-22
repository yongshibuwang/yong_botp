<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:59:"F:\plant\public/../application/index\view\index\detail.html";i:1548493792;s:50:"F:\plant\application\index\view\Father\father.html";i:1562752508;}*/ ?>
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
        <div class="content-wrap">
            <div class="sidebar ">
                <!--<div class="widget widget_hot">
                    <h3>文章目录</h3>
                    <ul>
                        <li><a title="" href="#"><span class="text">用DTcms做一个独立博客网站（响应式模板）</span></a></li>
                        <li><a title="" href="#"><span class="text">用DTcms做一个独立博客网站（响应式模板）</span></a></li>
                    </ul>
                </div>-->
                <div class="widget widget_hot ">
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
                <header class="article-header" style="text-align: center;">
                    <h1 class="article-title"><?php echo $info['title']; ?></h1>
                    <div class="article-meta ">
                        <span class="item category"><?php echo $info['kind']; ?></span>
                        <span class="item time "><?php echo date('Y-m-d',$info['add_time'])?></span>
                        <!--<span class="item tags">标签：<a href="#">架构</a><a href="#">架构</a><a href="#">架构</a></span>-->
                        <span class="item views"><i class="glyphicon glyphicon-eye-open"></i> <?php echo $info['read_num']; ?></span>
                    </div>
                </header>
                <article class="article-content">
                    <?php echo $info['content']; ?>
                </article>
                <!--<div class="title">-->
                    <!--<h3>评论</h3>-->
                <!--</div>-->
                <!--<div class="article-comment">-->
                    <!--<form action="" method="POST">-->
                        <!--<input type="text" class="form-control" placeholder="您的昵称（必填）">-->
                        <!--<input type="text" class="form-control" placeholder="您的邮箱或联系电话（非必填）">-->
                        <!--<textarea class="form-control" rows="3" placeholder="您的评论或留言（必填）"></textarea>-->
                        <!--<button type="button" class="btn btn-default">发布评论</button>-->
                    <!--</form>-->
                <!--</div>-->

                <!--<div class="postcomments">-->
                    <!--<ol class="commentlist">-->
                        <!--<li class="comment-content"><span class="comment-f">#2</span>-->
                            <!--<div class="comment-main">-->
                                <!--<p><a class="name" href="#" target="_blank">zx@reedo.cn</a><span class="time"> 2016/10/28 11:41:03</span><br>不错的网站主题，看着相当舒服</p>-->
                            <!--</div>-->
                        <!--</li>-->
                        <!--<li class="comment-content"><span class="comment-f">#2</span>-->
                            <!--<div class="comment-main">-->
                                <!--<p><a class="name" href="#" target="_blank">九日</a><span class="time"> 2016/10/28 11:41:03</span><br>不错的网站主题，看着相当舒服</p>-->
                            <!--</div>-->
                        <!--</li>-->
                    <!--</ol>-->
                <!--</div>-->
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
