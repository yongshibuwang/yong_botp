<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:47:"F:\yong./application/index\view\index\info.html";i:1543569139;s:48:"F:\yong\application\index\view\father\index.html";i:1543569139;}*/ ?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>wzpl</title>
    <meta name="keywords" content="" />
    <!--<meta name="description" content="主题的个人博客模板，优雅、稳重、大气,低调。" />-->
    <script src="/public/static/admin/assets/js/jquery.min.js"></script>
    <script src="/public/static/admin/layer/layer.js"></script>
    <link href="/public/static/index/css/base.css" rel="stylesheet">
    <link href="/public/static/index/css/index.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="/public/static/index/js/modernizr.js"></script>
    <![endif]-->
</head>
<body>
<header>
    <div id="logo"><a href="/"><img style="height: 60px;width: 260px;" src="/public/static/index/images/logo.jpg" alt=""/></a></div>
    <nav class="topnav" id="topnav">
        <a href="<?php echo url('Index/index'); ?>" id="<?php echo $gl==1?'topnav_current':''; ?>"><span>首页</span><span class="en">Protal</span></a>
        <a href="<?php echo url('Article/phpOption'); ?>" id="<?php echo $gl==2?'topnav_current':''; ?>"><span>后端文章</span><span class="en">after end</span></a>
        <a href="<?php echo url('Article/htmlOption'); ?>" id="<?php echo $gl==3?'topnav_current':''; ?>"><span>前端文章</span><span class="en">leading end</span></a>
        <a href="moodlist.html" id="<?php echo $gl==4?'topnav_current':''; ?>"><span>碎言碎语</span><span class="en">Doing</span></a>
        <!--<a href="share.html" id="<?php echo $gl==5?'topnav_current':''; ?>"><span>分享</span><span class="en">Share</span></a>-->
        <a href="<?php echo url('Oftenweb/web'); ?>" id="<?php echo $gl==5?'topnav_current':''; ?>"><span>分享</span><span class="en">Share</span></a>
        <a href="knowledge.html" id="<?php echo $gl==6?'topnav_current':''; ?>"><span>学无止境</span><span class="en">Learn</span></a>
        <a href="book.html" id="<?php echo $gl==7?'topnav_current':''; ?>"><span>留言版</span><span class="en">Gustbook</span></a>
    </nav>
    </nav>
</header>
    
<link href="/public/static/index/css/base.css" rel="stylesheet">
<link href="/public/static/index/css/new.css" rel="stylesheet">
<!--[if lt IE 9]>
<script src="js/modernizr.js"></script>
<![endif]-->

<article class="blogs">
    <h1 class="t_nav"><span>您当前的位置：<a href="<?php echo url('Index/index'); ?>">首页</a>&nbsp;&gt;&nbsp;
        <a href="">文章详情</a></span>
        <a href="/" class="n1">网站首页</a><a href="" class="n2">文章详情</a></h1>
    <div class="index_about">
        <h2 class="c_titile"><?php echo $info['title']; ?></h2>

        <p class="box_c"><span class="d_time">发布时间：<?php echo date('Y-m-d',$info['add_time'])?></span>
            <span>编辑：<?php echo $info['author']; ?></span>
            <span>互动QQ群：<a href="http://wp.qq.com/wpa/qunwpa?idkey=8e4a889f9ad676742ad0b342a7c1b73ac5d2edc3d072eb946cfe82522e16c770">670292192</a></span></p>
        <ul class="infos">
            <?php echo $info['content']; ?>
        </ul>
        <!--<div class="keybq">
            <p><span>关键字词</span>：爱情,犯错,原谅,分手</p>

        </div>-->
        <div class="ad"> </div>
        <div class="nextinfo">
            <p>上一篇：<a href="/news/s/2013-09-04/606.html">程序员应该如何高效的工作学习</a></p>
            <p>下一篇：<a href="/news/s/2013-10-21/616.html">柴米油盐的生活才是真实</a></p>
        </div>
        <div class="otherlink">
            <h2>相关文章</h2>
            <ul>
                <li><a href="/news/s/2013-07-25/524.html" title="现在，我相信爱情！">现在，我相信爱情！</a></li>
                <li><a href="/newstalk/mood/2013-07-24/518.html" title="我希望我的爱情是这样的">我希望我的爱情是这样的</a></li>
                <li><a href="/newstalk/mood/2013-07-02/335.html" title="有种情谊，不是爱情，也算不得友情">有种情谊，不是爱情，也算不得友情</a></li>
                <li><a href="/newstalk/mood/2013-07-01/329.html" title="世上最美好的爱情">世上最美好的爱情</a></li>
                <li><a href="/news/read/2013-06-11/213.html" title="爱情没有永远，地老天荒也走不完">爱情没有永远，地老天荒也走不完</a></li>
                <li><a href="/news/s/2013-06-06/24.html" title="爱情的背叛者">爱情的背叛者</a></li>
            </ul>
        </div>
    </div>
    <aside class="right">
        <!-- Baidu Button BEGIN -->
        <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
        <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
        <script type="text/javascript" id="bdshell_js"></script>
        <script type="text/javascript">
            document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
        </script>
        <a href="/" class="weixin"> </a>
        <!-- Baidu Button END -->
        <div class="blank"></div>
        <div class="news">
            <h3>
                <p>栏目<span>最新</span></p>
            </h3>
            <ul class="rank">
                <?php if(is_array($new_article) || $new_article instanceof \think\Collection || $new_article instanceof \think\Paginator): $i = 0; $__LIST__ = $new_article;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$no): $mod = ($i % 2 );++$i;?>
                <li><a href="<?php echo url('Index/info',['id'=>$no['id']]); ?>" title="<?php echo $no['title']; ?>"><?php echo $no['title']; ?></a></li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <h3 class="ph">
                <p>点击<span>排行</span></p>
            </h3>
            <ul class="paih">
                <?php if(is_array($read_more) || $read_more instanceof \think\Collection || $read_more instanceof \think\Paginator): $i = 0; $__LIST__ = $read_more;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ro): $mod = ($i % 2 );++$i;?>
                <li><a href="<?php echo url('Index/info',['id'=>$ro['id']]); ?>" title="<?php echo $ro['title']; ?>"><?php echo $ro['title']; ?></a></li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <div class="visitors">
            <h3>
                <p>最近访客</p>
            </h3>
            <ul>
            </ul>
        </div>
    </aside>
</article>

<footer>
    <p>Design by DanceSmile More Templates <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a> - Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a> <a href="/">网站统计</a></p>
</footer>
<script src="/public/static/index/js/silder.js"></script>
</body>
</html>
