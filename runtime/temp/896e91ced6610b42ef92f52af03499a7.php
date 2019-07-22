<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:47:"F:\yong/application/index\view\index\ceshi.html";i:1551944263;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="/public/static/index/js/jquery.min.js"></script>
    <script src="/public/static/index/js/bootstrap.min.js"></script>
    <script src="/public/static/admin/layer/layer.js"></script>
</head>

<body>

<div><input type="text" id="setText"></div>
<div><button id= "sendMsg">提交</button></div>
<div>接受到信息:<span id="getText"></span></div>
<script>
    ws = new WebSocket("ws://127.0.0.1:2346");
    ws.onopen = function() {
        console.log("连接成功");
    };
    //获取消息
    ws.onmessage = function (e) {
        getText.innerHTML = e.data
    }
    /*ws.onclose = function () {
        console.log('关闭')
    }*/
    //发送消息
    $('#sendMsg').click(function(){
        if(!$('#setText').val()){
            layer.msg('消息不能为空')
        }else{
            ws.send($('#setText').val())
        }

    });
    // sendMsg.onclick=function () {
    //     ws.send(setText.value)
    // }
</script>
</body>
</html>