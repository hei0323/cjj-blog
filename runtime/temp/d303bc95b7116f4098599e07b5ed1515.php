<?php /*a:1:{s:63:"/www/wwwroot/www.wkchat/application/index/view/index/index.html";i:1573640435;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CQQ-Service服务大厅</title>
    <script src="<?php echo htmlentities(app('config')->get('public_path')); ?>/common/js/jquery.min.js"></script>
    <script src="<?php echo htmlentities(app('config')->get('public_path')); ?>/common/js/jquery-sina-emotion.js"></script>
    <link rel="stylesheet" href="<?php echo htmlentities(app('config')->get('public_path')); ?>/layui/css/layui.css">
    <script src="<?php echo htmlentities(app('config')->get('public_path')); ?>/layui/layui.js"></script>
</head>
<body class="layui-container" style="height: 80%;width: 60%;padding-top: 3%">

<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend>CQQ聊天大厅</legend>
</fieldset>

<div style="padding: 20px; background-color: #F2F2F2;">
    <div class="layui-row layui-col-space20">
        <div class="layui-col-md8">
            <div class="layui-card">
                <div class="layui-card-header">实时消息</div>
                <div id="chatList" class="layui-card-body" style="height: 300px;overflow-y: scroll;overflow">
                </div>
            </div>
        </div>
        <div class="layui-col-md4">
            <div class="layui-card">
                <div class="layui-card-header">在线列表</div>
                <div class="layui-card-body" style="height: 300px">
                    <page>罐罐</page>
                    <page>罐罐</page>
                    <page>罐罐</page>
                    <br>
                </div>
            </div>
        </div>
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body">
                    <form class="layui-form" action="">
                        <div class="layui-form-item">
                            <label class="layui-form-label">我的昵称</label>
                            <div class="layui-input-block">
                                <input type="radio" name="nickname" value="小狗丹尼" title="小狗丹尼">
                                <input type="radio" name="nickname" value="斑马佩德罗" title="斑马佩德罗" >
                                <input type="radio" name="nickname" value="小羊苏西" title="小羊苏西" checked>
                                <input type="radio" name="nickname" value="小兔理查德" title="小兔理查德" >
                                <input type="radio" name="nickname" value="弟弟乔治" title="弟弟乔治" >
                                <input type="radio" name="nickname" value="小猪佩奇" title="小猪佩奇" >
                                <input type="radio" name="nickname" value="小象艾米丽" title="小象艾米丽" >
                                <input type="radio" name="nickname" value="小马冬梅" title="小马冬梅" >
                            </div>
                        </div>
                        <div class="layui-form-item layui-form-text">
                            <label class="layui-form-label">发送消息</label>
                            <div class="layui-input-block">
                                <textarea name="content" placeholder="请输入内容" class="layui-textarea"></textarea>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <button class="layui-btn" lay-submit lay-filter="formDemo">立即发送</button>
                                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
<script>
    ws = new WebSocket("ws://www.cqqchat.com:7272");
    // 服务端主动推送消息时会触发这里的onmessage
    ws.onmessage = function(e){
        // json数据转换成js对象
        var data = eval("("+e.data+")");
        var type = data.type || '';
        switch(type){
            // Events.php中返回的init类型的消息，将client_id发给后台进行uid绑定
            case 'init':
                // 利用jquery发起ajax请求，将client_id发给后端进行uid绑定
                $.post('./customer/login', {client_id: data.client_id}, function(data){}, 'json');
                break;
            case 'getMsg':
                // 利用jquery发起ajax请求，将client_id发给后端进行uid绑定
                $("#chatList").append("<div style='clear: both;'>"+data.nickname+'：'+data.content+"</div>");
                var scrollHeight = $('#chatList').prop("scrollHeight");
                $('#chatList').scrollTop(scrollHeight,300);

                break;
            // 当mvc框架调用GatewayClient发消息时直接alert出来
            default :
                //alert(e.data);
        }
    };
</script>
<script>
    layui.use('form', function(){
        var form = layui.form;
        //监听提交
        form.on('submit(formDemo)', function(data){

            // 利用jquery发起ajax请求，将client_id发给后端进行uid绑定
            $("#chatList").append("<div style='float: right;clear: both'>"+data.field.nickname+'：'+data.field.content+"</div>");
            var scrollHeight = $('#chatList').prop("scrollHeight");
            $('#chatList').scrollTop(scrollHeight,300);

            $.post('./customer/sendMsg', data.field, function(data){}, 'json');
            return false;
        });
    });
</script>
</html>