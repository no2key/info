<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title>detail</title>
        <meta charset="utf8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- Bootstrap -->
        <link href="http://cdn.staticfile.org/twitter-bootstrap/2.3.2/css/bootstrap.min.css" rel="stylesheet" media="screen" type="text/css">
        <link rel="stylesheet" type="text/css" href="/css/main.css">
    </head>
    <body>
        <div class="navbar navbar-static-top">
            <div class="navbar-inner">
                <div class="container">
                    <ul class="nav">
                        <li class="active">
                            <a href="__APP__">首页</a>
                        </li>
                    </ul>
                    <ul class="nav" style="float:right" id="navLogin">
                            <li>
                                <a href="#myReg" data-toggle="modal">注册</a>
                            </li>
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
                                <label class="control-label" for="inputPermission">您是：</label>
                                <div class="controls">
                                    <select id="inputPermission" placeholder="" name="permission">
                                        <option>
                                            
                                        </option>
                                        <option value="1">
                                            企业用户
                                        </option>
                                        <option value="2">
                                            学生用户
                                        </option>
                                    </select>
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
        
    <div class="container row">
        <div class="span12">
            <img src="/img/logo.png">
        </div>
        <div>
            <div class="viewad">
                <h2 class="viewad-title">
                    <?php echo ($list['title']); ?>
                </h2>
                <div class="viewad-info">
                    <a target="_blank" href="#"><?php echo ($list['address']); ?></a>
                    <span>&nbsp;-&nbsp;</span>
                    <a target="_blank" href="#"><?php echo ($list['detailaddress']); ?></a>
                </div>
            </div>
            <div class="medi">
                <?php echo ($list['phone']); ?>
            </div>
            <div class="viewad-descript">
                <div class="typo-p textwrap">
                    <span><?php echo ($list['pay']); ?></span>，<span><?php echo ($list['company']); ?></span>
                </div>
                <div class="typo-p textwrap">
                    <pre><?php echo ($list['content']); ?></pre>
                </div>
            </div>
            <div class="viewad-meta">
                <?php echo ($list['date']); ?>
            </div>
        </div>
    </div>
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
            "html":"<div class=\"btn-group\">"
                    +"<button class=\"btn\" onclick=\"window.location.href='<?php echo U('Index/sign');?>';\">签到</button>"
                    +"<button class=\"btn dropdown-toggle\" data-toggle=\"dropdown\">"
                    +"<span class=\"caret\"></span>"
                    +"</button>"
                    +"<ul class=\"dropdown-menu\">"
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