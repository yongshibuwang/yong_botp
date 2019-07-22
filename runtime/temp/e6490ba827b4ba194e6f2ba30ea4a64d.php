<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:48:"F:\yong./application/index\view\index\index.html";i:1543569139;s:48:"F:\yong\application\index\view\father\index.html";i:1543569139;}*/ ?>
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
    
<div class="banner" style="width: 100%;background-size:cover;">
  <section class="box">
    <ul class="texts">
      <p>好想给你打一辈子辅助</p>
      <p>人头是你的、兵线是你的、buff是你的、塔是你的</p>
      <p>所有经济都是你的，我什么都不要，只要你活着。</p>
    </ul>
    <div class="avatar"><a href="#"><span>勇☆贳&卟☆莣</span></a> </div>
  </section>
</div>
<div class="template">
  <div class="box">
    <h3>
      <p><span>最新文章</span> The latest article</p>
    </h3>
    <ul>
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lo): $mod = ($i % 2 );++$i;?>
        <li><a href="<?php echo url('Index/info',['id'=>$lo['id']]); ?>"><img src="<?php echo $lo['img']; ?>"></a><span  style="color: #fff;"><?php echo $lo['title']; ?></span></li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      <!--<li><a href="/" target="_blank"><img src="/public/static/index/images/02.jpg"></a><span>黑色质感时间轴html5个人博客模板</span></li>
      <li><a href="/"  target="_blank"><img src="/public/static/index/images/03.jpg"></a><span>Green绿色小清新的夏天-个人博客模板</span></li>
      <li><a href="/" target="_blank"><img src="/public/static/index/images/04.jpg"></a><span>女生清新个人博客网站模板</span></li>
      <li><a href="/"  target="_blank"><img src="/public/static/index/images/02.jpg"></a><span>黑色质感时间轴html5个人博客模板</span></li>
      <li><a href="/"  target="_blank"><img src="/public/static/index/images/03.jpg"></a><span>Green绿色小清新的夏天-个人博客模板</span></li>
    --></ul>
  </div>
</div>
<article>
  <h2 class="title_tj">
    <p>文章<span>推荐</span></p>
  </h2>
  <div class="bloglist left">
      <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
      <h3><?php echo $vo['title']; ?></h3>
      <figure><img src="<?php echo $vo['img']; ?>"></figure>
      <ul>
          <p style="display: -webkit-box;
    overflow: hidden;
    text-overflow: ellipsis;
    word-wrap: break-word;
    white-space: normal !important;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;"><?php echo $vo['describe']; ?></p>
          <a title="<?php echo $vo['title']; ?>" href="<?php echo url('Index/info',['id'=>$vo['id']]); ?>" class="readmore">阅读全文>></a>
      </ul>
      <p class="dateview"><span><?php echo date('Y-m-d',$vo['add_time'])?></span><span>作者：<?php echo $vo['author']; ?></span><!--<span>个人博客：[<a href="/news/life/">程序人生</a>]</span>--></p>
      <?php endforeach; endif; else: echo "" ;endif; ?>

    <!--<h3>程序员请放下你的技术情节，与你的同伴一起进步</h3>
    <figure><img src="/public/static/index/images/001.png"></figure>
    <ul>
      <p>如果说掌握一门赖以生计的技术是技术人员要学会的第一课的话， 那么我觉得技术人员要真正学会的第二课，不是技术，而是业务、交流与协作，学会关心其他工作伙伴的工作情况和进展...</p>
      <a title="/" href="/" target="_blank" class="readmore">阅读全文>></a>
    </ul>
    <p class="dateview"><span>2013-11-04</span><span>作者：杨青</span><span>个人博客：[<a href="/news/life/">程序人生</a>]</span></p>-->

  </div>
  <aside class="right">
    <div class="weather"><iframe width="250" scrolling="no" height="60" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=12&icon=1&num=1"></iframe></div>
    <div class="news">
    <h3>
      <p>最新<span>文章</span></p>
    </h3>
    <ul class="rank">
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lio): $mod = ($i % 2 );++$i;?>
        <li style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;"><a href="<?php echo url('Index/info',['id'=>$lio['id']]); ?>" title="<?php echo $lio['title']; ?>" ><?php echo $lio['title']; ?></a></li>
        <?php endforeach; endif; else: echo "" ;endif; ?>

    </ul>
    <h3 class="ph">
      <p>点击<span>排行</span></p>
    </h3>
    <ul class="paih">
      <li><a href="/" title="Column 三栏布局 个人网站模板" target="_blank">Column 三栏布局 个人网站模板</a></li>
      <li><a href="/" title="withlove for you 个人网站模板" target="_blank">with love for you 个人网站模板</a></li>
      <li><a href="/" title="免费收录网站搜索引擎登录口大全" target="_blank">免费收录网站搜索引擎登录口大全</a></li>
      <li><a href="/" title="做网站到底需要什么?" target="_blank">做网站到底需要什么?</a></li>
      <li><a href="/" title="企业做网站具体流程步骤" target="_blank">企业做网站具体流程步骤</a></li>
    </ul>
    <h3 class="links">
      <p>友情<span>链接</span></p>
    </h3>
    <ul class="website">
      <li><a href="/">个人博客</a></li>
      <li><a href="/">谢泽文个人博客</a></li>
      <li><a href="/">3DST技术网</a></li>
      <li><a href="/">思衡网络</a></li>
    </ul> 
    </div>  
    <!-- Baidu Button BEGIN -->
    <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
    <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script> 
    <script type="text/javascript" id="bdshell_js"></script> 

    <!-- Baidu Button END -->   
    <a href="/" class="weixin"> </a></aside>
    <script type="text/javascript">
        document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
    </script>
</article>

<footer>
    <p>Design by DanceSmile More Templates <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a> - Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a> <a href="/">网站统计</a></p>
</footer>
<script src="/public/static/index/js/silder.js"></script>
</body>
</html>
