<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>index</title>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- Bootstrap -->
    <link href="http://cdn.staticfile.org/twitter-bootstrap/2.3.2/css/bootstrap.min.css" rel="stylesheet" media="screen" type="text/css">
    <link href="http://v2.bootcss.com/assets/css/bootstrap-responsive.css" rel="stylesheet" media="screen" type="text/css">
    <link rel="stylesheet" type="text/css" href="/css/todc-bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
</head>
<body>
    <div class="navbar navbar-static-top">
        <div class="navbar-inner">
            <div class="container">
                <ul class="nav">
                    <li class="active">
                        <a href="/">首页</a>
                    </li>
                    <li class="divider-vertical"></li>
                    <li>
                        <a href="#">当前城市:<?php echo isset(cookie('region')['name']) ? cookie('region')['name']:'所有';?></a>
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


    <style>
        .table th, .table td {
            line-height: 30px;
        }
        .table a:visited {
            color: #3078eb;
        }
        .table a:link {
            color: #3078eb;
        }
    </style>
    <div class="container">
        <div class="span12">
            <h1>LOGO</h1>
        </div>

        <div class="row-fluid">
            <div class="span3">
                <ul class="nav nav-list bs-docs-sidenav">
                    <li class="active">
                        <a href="#">我的发布</a>
                    </li>
                    <li>
                        <a href="<?php echo U('User/mail');?>">我的私信</a>
                    </li>
                </ul>
            </div>
            <div class="span9">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>标题</th>
                            <th>时间</th>
                            <th>类别</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td><a href="<?php echo U('Detail/index', array('id'=>($vo['id'])));?>"><?php echo ($vo["title"]); ?></a></td>
                        <td><?php echo ($vo["date"]); ?></td>
                        <td><?php echo ($vo["category"]); ?></td>
                        <td>
                            <span class="span4">
                            <a href="<?php echo U('User/refresh', array('id'=>$vo['id']));?>" class="btn btn-success" type="button" style="color: white">刷新</a>
                            </span>
                            <span class="span4">
                            <a href="<?php echo U('Publish/edit', array('id'=>$vo['id']));?>" class="btn btn-primary" type="button" style="color: white">修改</a>
                            </span>
                            <span class="span4">
                            <a href="<?php echo U('Publish/del', array('id'=>$vo['id']));?>" class="btn btn-danger" type="button" style="color: white">删除</a>
                            </span>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
                <div class="pagination">
                    <?php echo ($page); ?>
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