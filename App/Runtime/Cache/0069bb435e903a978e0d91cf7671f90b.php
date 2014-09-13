<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>detail</title>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- Bootstrap -->
    <link href="http://cdn.staticfile.org/twitter-bootstrap/2.3.2/css/bootstrap.min.css" rel="stylesheet" media="screen" type="text/css">
    <link href="http://v2.bootcss.com/assets/css/bootstrap-responsive.css" rel="stylesheet" media="screen" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo C('BASE_URI');?>/css/todc-bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo C('BASE_URI');?>/css/main.css">
</head>
<body>
    <div class="navbar navbar-static-top">
        <div class="navbar-inner">
            <div class="container">
                <ul class="nav">
                    <li class="active">
                        <a href="<?php echo C('BASE_URI');?>">首页</a>
                    </li>
                    <li class="divider-vertical"></li>
                    <li>
                        <a href="#">当前城市:<?php $temp=cookie('region');echo isset($temp['name']) ? $temp['name']:'所有';?></a>
                    </li>
                </ul>
                <ul class="nav pull-right" id="navLogin">
                    <?php if(!$usr):?>
                    <li>
                        <a href="#myReg" data-toggle="modal">注册</a>
                    </li>
                    <?php endif;?>
                    <li class="divider-vertical"></li>
                </ul>

                <!-- reg -->
                <div id="myReg" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">注册</h3>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" method="post" action="<?php echo U('Index/reg');?>">
                            <div class="control-group">
                                <label class="control-label" for="inputEmail">用户名：</label>
                                <div class="controls">
                                    <input type="text" id="inputEmail" placeholder="手机号/用户名" name="username">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputPassword">密码：</label>
                                <div class="controls">
                                    <input type="password" id="inputPassword" placeholder="请输入密码" name="password">
                                </div>
                            </div><div class="control-group">
                            <label class="control-label" for="inputPassword">确认密码：</label>
                            <div class="controls">
                                <input type="password" id="inputPassword" placeholder="请输入密码" name="repassword">
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" class="btn">注册</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
                </div>
            </div>
                <!-- login -->
                <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">登录</h3>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="<?php echo U('Index/login');?>">
                        <div class="control-group">
                            <label class="control-label" for="inputEmail">帐号：</label>
                            <div class="controls">
                                <input type="text" id="inputEmail" placeholder="手机号/用户名" name="username">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputPassword">密码：</label>
                            <div class="controls">
                                <input type="password" id="inputPassword" placeholder="请输入密码" name="password">
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <label class="checkbox">
                                    <input type="checkbox">记住我
                                </label>
                                <button type="submit" class="btn">登录</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
                </div>
            </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="span12">
            <h1>LOGO</h1>
        </div>
        <table class="table table-bordered">
            <thead>
            <caption>
                <div class="page-header">
                    <h1 style="display: inline">
                        <?php echo ($data["title"]); ?>
                    </h1>
                    <small>浏览:<?php echo ($data["view"]); ?></small>
                </div>
            </caption>
            <tbody>
            <tr>
                <td style="font-weight: bold">日期</td>
                <td><?php echo ($data["date"]); ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold">城市</td>
                <td><?php echo ($data["region"]); ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold">区域</td>
                <td><?php if (empty($data['lat']) || empty($data['lng'])): echo ($data["address"]); else:?>
                    <?php echo ($data["address"]); ?>
                    <div id="map-canvas" style="height: 200px;"></div>
                    <script>
                        var mapScript= document.createElement("script");
                        mapScript.type = "text/javascript";
                        mapScript.src="http://api.map.baidu.com/api?v=2.0&callback=init&ak=Z0QeCyOfVo4mb8q9HT1Fxu2f";
                        document.body.appendChild(mapScript);
                        window.loadMap = true;
                        function init() {
                            var map = new BMap.Map("map-canvas");
                            var point = new BMap.Point(<?php echo ($data["lng"]); ?>,<?php echo ($data["lat"]); ?>);
                        var gc = new BMap.Geocoder();
                        map.centerAndZoom(point, 14);
                        var mkr = new BMap.Marker(point, {
                            enableDragging:true
                        });
                        map.addOverlay(mkr);
                        map.enableScrollWheelZoom();
                        map.disableDoubleClickZoom();
                        map.addControl(new BMap.NavigationControl());
                        map.addControl(new BMap.ScaleControl());
                        map.addControl(new BMap.OverviewMapControl());
                        }
                    </script>
                    <?php endif;?>
                </td>
            </tr>
            <?php if(!empty($data['pay'])):?>
            <tr>
                <td style="font-weight: bold">日薪</td>
                <td><?php echo ($data["pay"]); ?>/天</td>
            </tr>
            <tr>
                <td style="font-weight: bold">公司</td>
                <td><?php echo ($data["company"]); ?></td>
            </tr>
            <?php endif;?>
            <tr>
                <td colspan="2" style="font-weight: bold;">详情</td>
            </tr>
            <tr>
                <td style="border-top: none;" colspan="2">
                    <?php echo ($data["content"]); ?></br>
                    <?php foreach($data['photo'] as $pho):?>
                    <img src="<?php echo $pho;?>"></a>
                    <?php endforeach;?>
                </td>
            </tr>
            <tr>
                <td style="font-weight: bold">电话</td>
                <td><?php echo ($data["phone"]); ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold">联系人</td>
                <td><?php echo ($data["contract"]); ?></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <a href="#mailModal" role="button" class="btn" data-toggle="modal" style="color: black;">给 <?php echo ($data["uname"]); ?> 发送站内信，方便又省钱</a>
                </td>
            </tr>
            </tbody>
        </table>

        <!-- Modal -->
        <form action="<?php echo U('User/sendMail');?>" method="post">
            <div id="mailModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="mailModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">站内信</h3>
                </div>
                <div class="modal-body">
                    <span class="help-block">收件人：<?php echo ($data["uname"]); ?></span>
                    <input id="mail_to" type="hidden" name="to" value="<?php echo ($data["uid"]); ?>">
                    <input class="input-block-level" name="content" type="text" id="inputEmail" placeholder="回复">
                    <br>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
                    <input type="submit" class="btn btn-primary" value="发送">
                </div>
            </div>
        </form>
    </div>
       
<script src="http://cdn.staticfile.org/jquery/1.10.2/jquery.min.js" type="text/javascript">
</script>
<script src="http://cdn.staticfile.org/twitter-bootstrap/2.3.2/js/bootstrap.min.js" type="text/javascript">
</script>
<script type="text/javascript">
$(function(){
    var name="<?php echo ($usr); ?>";
    if(!name){
        $("<li>",{
            "html":"<a href='#myModal' data-toggle='modal'>登录</a>"
        }).appendTo("#navLogin");
        return 
    }
    $("<li>",{
        "html":"<a href='javascript:'><?php echo ($usr); ?></a>"
    }).appendTo("#navLogin");
    $("<li>",{
        "class":"divider-vertical"
    }).appendTo("#navLogin");

    $("<li>",{
        "html":"<a href='javascript:'><?php echo ($jifen); ?><small> 积分</small></a>"
    }).appendTo("#navLogin");
    $("<li>",{
        "class":"divider-vertical"
    }).appendTo("#navLogin");
    $("<li>",{
        "html":"<div class=\"pull-right btn-group\">"
        +"<button class=\"btn\" onclick=\"window.location.href='<?php echo U('Index/sign');?>';\">签到</button>"
        +"<button class=\"btn dropdown-toggle\" data-toggle=\"dropdown\">"
        +"<span class=\"caret\"></span>"
        +"</button>"
        +"<ul class=\"dropdown-menu\">"
        +"<li>"
        +"<a href=\"<?php echo U('Publish/index');?>\">免费发布信息</a>"
        +"</li>"
        +"<li>"
        +"<a href=\"<?php echo U('User/index');?>\">个人中心</a>"
        +"</li>"
        +"<li>"
        +"<a href=\"<?php echo U('Index/logout');?>\">退出登录</a>"
        +"</li>"
        +"</ul>"
        +"</div>"
    }).appendTo("#navLogin");
})

</script>


</body>
</html>