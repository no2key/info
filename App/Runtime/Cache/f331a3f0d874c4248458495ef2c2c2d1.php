<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>index</title>
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


        <div class="row">
            <div class="span3">
                <div>
                    <form class="form-search">
                        <input type="text" class="input-medium" name="title" style="border-radius: 15px;" placeholder="招聘">
                        <button type="submit" class="btn">查找</button>
                    </form>
                </div>
                <div>
                    <dl class="sidebar-filter">
                        <dt>
                            筛选
                        </dt>
                        <?php foreach ($category as $id=>$vo):?>
                            <dd>
                                <strong></b><a rel="" href="<?php echo U('Index/index?category='.$id);?>"><?php echo ($vo["name"]); ?></a></strong>
                            </dd>
                            <?php foreach ($vo['sub'] as $svo):?>
                            <dd style="padding-left: 20px;">
                                <a rel="" href="<?php echo U('Index/index?category='.$svo['id']);?>"><?php echo ($svo["name"]); ?></a>
                            </dd>
                            <?php endforeach;?>
                        <?php endforeach;?>

                    </dl>
                </div>
            </div>
            <div class="span9">
                <ul class="inline new-info">
                    <a rel="" href="<?php echo U('Index/index?region=0');?>">全部城市</a>
                    <?php foreach($regions as $id=>$r): ?>
                    <li><a rel="" href="<?php echo U('Index/index?region='. $id);?>"><?php echo ($r); ?></a></li>
                    <?php endforeach;?>
                </ul>
            <h5 class="new-info">
                赞助商链接
            </h5>
            <div>
                <ul class="inline">
                    <li><img  title="全国高校毕业生夏季招聘月" src="http://u.img.huxiu.com/portal/201308/22/191123opp3f11kyx9yuuro.jpg.thumb.jpg"></li>
                    <li><img  title="全国高校毕业生夏季招聘月" src="http://u.img.huxiu.com/portal/201308/22/184055gl5bgg45vk5b51m4.jpg.thumb.jpg"></li>
                    <li><img  title="玛氏-箭牌2013创意策划大赛" src="http://u.img.huxiu.com/portal/201308/22/111747sw06wln0swi9eelq.jpg.thumb.jpg"></li>

                </ul>

            </div>
            <h5 class="new-info">
                最新信息
            </h5>
            <div>
                <ul class="unstyled">
                    <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="info-li-style">
                            <a href="__APP__/Detail/index/id/<?php echo ($vo["id"]); ?>" class="media-cap">
                                    <img src="<?php echo ($vo["thumb"]); ?>"></a>
                            <div>
                                <div>
                                    <a href="__APP__/Detail/index/id/<?php echo ($vo["id"]); ?>" class="media-body-title"><?php echo ($vo["title"]); ?></a>
                                    <span class="media-body-time"><?php echo ($vo["date"]); ?></span>
                                </div>
                                <div class="media-body-address"><?php echo ($vo["region"]); ?> - <?php echo ($vo["address"]); ?></div>
                                <div class="media-body-category inline pull-left"><?php echo ($vo["category"]); ?></div>
                                <?php if (!empty($vo['pay'])):?>
                                <span class="media-body-pay pull-right"><?php echo ($vo["pay"]); ?>元/天</span>
                                <?php endif;?>
                            </div>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
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