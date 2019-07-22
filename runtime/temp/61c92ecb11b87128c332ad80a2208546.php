<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:65:"F:\yongshibuwang./application/index\view\article\html_option.html";i:1543569139;s:58:"F:\yongshibuwang\application\index\view\father\father.html";i:1543569139;}*/ ?>
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
<link href="/public/static/index/css/style.css" rel="stylesheet">
<article class="blogs">

    
    <h1 class="t_nav" style="position: relative"><span style="position: absolute;right: 3%;">
            <input type="text" name="title" style="height: 26px;width: 160px;" />
            <span class="sub_seach" style="font-size: 16px;line-height: 26px;margin-top:4px;background-color: #f90;padding: 0 10px 4px 10px;"><img src="/public/static/index/images/seach.png" style="float: left;width: 20px;height: 20px;padding-top:6px;" alt=""/></span>
        </span>
        <a href="/" class="n1">网站首页</a><a href="/" class="n2">前端文章</a></h1>
    <div class="newblog left">
        <div class="add_title">
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lo): $mod = ($i % 2 );++$i;?>
            <h2><?php echo $lo['title']; ?></h2>
            <p class="dateview"><span style="padding-left: 1%;">发布时间：<?php echo date('Y-m-d',$lo['add_time'])?></span><span>作者：<?php echo $lo['author']; ?></span><span>分类：[<a href="<?php echo url('About/phpOption'); ?>">后端文章</a>]</span></p>
            <figure><img src="<?php echo $lo['img']; ?>"></figure>
            <ul class="nlist">
                <p><?php echo $lo['describe']; ?></p>
                <a title="阅读全文" href="<?php echo url('Index/info',['id'=>$lo['id']]); ?>" class="readmore">阅读全文>></a>
            </ul>
            <div class="line"></div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div class="blank"></div>
        <div class="ad">
            <!--广告位<img src="/public/static/index/images/ad.png">-->
        </div>
        <div class="page">
            <?php echo $page; ?>
        </div>
    </div>

<script>
    $('.sub_seach').click(function(){
        var title=$('[name=title]').val();
        $.post("<?php echo url('Article/ajax_seach'); ?>",{title:title},function(data){
            console.log(data);
            if(data.code){
                $('.add_title').html(data.msg);
            }
        });
    });
</script>


    <aside class="right">
        <div class="rnav">
            <ul>
                <li class="rnav1" ><a href="<?php echo url('Index/index'); ?>" >首页</a></li>
                <li class="rnav2" style="background-color: #e15782"><a href="/newsfree/">个人笔记</a></li>
                <li class="rnav3"><a href="/web/" >留言板</a></li>
                <li class="rnav4" style="background-color:#f90"><a href="/newshtml5/" >常用网站</a></li>
            </ul>
        </div>
        <div class="news">
            <h3>
                <p>最新<span>文章</span></p>
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

        <!-- Baidu Button BEGIN -->
        <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
        <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
        <script type="text/javascript" id="bdshell_js"></script>
        <script type="text/javascript">
            document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
        </script>
        <a href="/" class="weixin"> </a>
        <div class="visitors">
            <h3 style="padding-bottom: 3px;"><p>最近访客</p></h3>
            <ul style="display:inline;">
                <?php if(is_array($access) || $access instanceof \think\Collection || $access instanceof \think\Paginator): $i = 0; $__LIST__ = $access;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ao): $mod = ($i % 2 );++$i;?>
                <li style="display: inline-block;"><img src="<?php echo $ao['img']; ?>" style="background-color: #d1d1d1;padding: 1px 1px; width: 40px;height:40px;border-radius: 50%;" alt="<?php echo $ao['ip']; ?>"/></li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <!-- Baidu Button END -->
    </aside>
</article>
<footer>
    <p>Design by DanceSmile More Templates <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a> - Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a> <a href="/">网站统计</a></p>
</footer>
<script src="/public/static/index/js/silder.js"></script>
</body>
</html>
