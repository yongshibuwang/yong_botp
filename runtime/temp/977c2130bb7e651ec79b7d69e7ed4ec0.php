<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:48:"F:\yong/application/index\view\article\ling.html";i:1548579621;}*/ ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link rel="stylesheet" href="/public/static/index/css/amazeui.min.css">
    <link rel="stylesheet" href="/public/static/index/css/wap.css">
    <title>花开成海，思念成灾</title>
</head>
<body style="background:#ececec">
<div class="pet_mian" id="top" style="position: relative;">
    <div data-am-widget="slider" class="am-slider am-slider-a1" data-am-slider='{"directionNav":false}' >
        <ul class="am-slides">
            <li>
                <img src="/public/static/index/images/fl01.png">
                <div class="pet_slider_font">
                    <span class="pet_slider_emoji">好想给你打一辈子辅助</span>
                    <span class="pet_slider_emoji" style="font-size: 14px;">人头是你的、兵线是你的、buff是你的、塔是你的</span>
                    <span>所有经济都是你的，我什么都不要，只要你活着</span>
                </div>
                <div class="pet_slider_shadow"></div>
            </li>
        </ul>
    </div>
    <span class="refresh-ac" style="position: absolute;z-index: 9999;top: 0;color: #a92db7;
                font-size: 12px;
                background-color: #0ba4ea;padding: 3px 6px;border-radius: 4px;
                ">再来一批
    </span><a href="<?php echo url('Index/index',['mobile'=>1]); ?>" style="position: absolute;z-index: 9999;top: 0;right:0;color: #a92db7;
                font-size: 12px;
                background-color: #0ba4ea;padding: 3px 6px;border-radius: 4px;
                ">返回首页</a>
</div>
<div class="pet_mian"  style="">
    <div class="pet_content pet_content_list">
        <div class="pet_article_like">
            <div class="pet_content_main pet_article_like_delete">
                <div data-am-widget="list_news" class="am-list-news am-list-news-default am-no-layout">
                    <div class="am-list-news-bd">
                        <ul class="am-list">
                            <!--缩略图在标题右边-->
                            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-right pet_list_one_block">
                                <div class="pet_list_one_info" style="margin-bottom: 0;">
                                    <div class="pet_list_one_info_l">
                                        <div class="pet_list_one_info_ico"><img src="<?php echo $vo['head_img']; ?>" alt=""></div>
                                        <div class="pet_list_one_info_name"><?php echo $vo['name']; ?></div>
                                    </div>
                                </div>
                                <div class=" am-u-sm-8 am-list-main pet_list_one_nr" style="width: 100%;font-size: 16px;">
                                        <?php echo $vo['text']; ?>
                                </div>
                            </li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>

                        </ul>
                    </div>

                </div>

            </div>
            <style>
                #page div span a{
                    border: 1px solid #000;
                    border-radius: 4px;
                    height: 25px;
                    line-height: 26px;
                    margin: 0 3px;
                    padding: 10px 14px;
                    font-size: 12px;
                    color: #000;
                }
            </style>
            <div  id="page" class="pet_article_footer_info"><?php echo $page; ?></div>
        </div>
        <div class="pet_article_footer_info">一个很有趣的油腻大叔(内容来源网络，如有侵权，请联系删除)</div>
    </div>
</div>
<script src="/public/static/index/js/jquery.min.js"></script>
<script src="/public/static/index/js/amazeui.min.js"></script>
<script src="/public/static/admin/layer/layer.js"></script>
<script>
    $(function(){
        // 动态计算新闻列表文字样式
        auto_resize();
        $(window).resize(function() {
            auto_resize();
        });
        $('.am-list-thumb img').load(function(){
            auto_resize();
        });
        $('.pet_article_like li:last-child').css('border','none');
        function auto_resize(){
            $('.pet_list_one_nr').height($('.pet_list_one_img').height());
            // alert($('.pet_list_one_nr').height());
        }
        $('.pet_article_user').on('click',function(){
            if($('.pet_article_user_info_tab').hasClass('pet_article_user_info_tab_show')){
                $('.pet_article_user_info_tab').removeClass('pet_article_user_info_tab_show').addClass('pet_article_user_info_tab_cloes');
            }else{
                $('.pet_article_user_info_tab').removeClass('pet_article_user_info_tab_cloes').addClass('pet_article_user_info_tab_show');
            }
        });

        $('.pet_head_gd_ico').on('click',function(){
            $('.pet_more_list').addClass('pet_more_list_show');
        });
        $('.pet_more_close').on('click',function(){
            $('.pet_more_list').removeClass('pet_more_list_show');
        });
    });
    $('.refresh-ac').click(function(){
        $.post("<?php echo url('Article/refresh'); ?>",{id:2},function(data){
            if(data.code){
                layer.msg(data.msg,{time:1000},function(){
                    location=location;
                })
            }

        });
    });

</script>
</body>
</html>