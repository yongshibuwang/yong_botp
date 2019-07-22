<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:54:"F:\yong/application/index\view\article\ajax_seach.html";i:1547020021;}*/ ?>
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