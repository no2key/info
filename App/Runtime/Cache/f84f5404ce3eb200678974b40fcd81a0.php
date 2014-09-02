<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>publish</title>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- Bootstrap -->
    <link href="http://cdn.staticfile.org/twitter-bootstrap/2.3.2/css/bootstrap.min.css" rel="stylesheet" media="screen" type="text/css">
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
                    <li>
                        <a href="#">当前城市:<?php echo isset(cookie('region')['name']) ? cookie('region')['name']:'所有';?></a>
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
                    <a href="<?php echo U('Admin/index');?>" class="btn" style="float:left">管理员登录</a>
                    <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="container row">
        <div class="span12">
            <h1>LOGO</h1>
        </div>
        <div>
            <form class="form-horizontal" method="post" action="<?php echo U('Publish/add');?>" enctype="multipart/form-data">
                <div class="control-group">
                    <label class="control-label" for="inputTitle">标题：</label>
                    <div class="controls">
                        <input type="text" id="inputTitle" placeholder="" name="title">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputCategory">分类：</label>
                    <div class="controls">
                        <option selected disabled="disabled">----选择信息类目----</option>
                        <select id="inputCategory" placeholder="" name="category">
                            <?php foreach ($category as $id=>$vo):?>
                            <?php foreach ($vo['sub'] as $svo):?>
                            <dd style="padding-left: 20px;">
                                <option value="<?php echo ($svo["id"]); ?>"><?php echo ($vo["name"]); ?>-<?php echo ($svo["name"]); ?></option>
                            </dd>
                            <?php endforeach;?>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputPay">工资：</label>
                    <div class="controls">
                        <input type="text" id="inputPay" placeholder="" name="pay"><span> 元/天</span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputContent">描述：</label>
                    <div class="controls">
                        <textarea id="inputContent" name="content" rows="9" class="input-block-level input-xxlarge">
                        </textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">上传照片：</label>
                    <div class="controls">
                        <input type="file" placeholder="" name="photo[]">
                    </div>
                    <div class="controls">
                        <input type="file" placeholder="" name="photo[]">
                    </div>
                    <div class="controls">
                        <input type="file" placeholder="" name="photo[]">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputCompany">公司名称：</label>
                    <div class="controls">
                        <input type="text" id="inputCompany" placeholder="" name="company">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputAddress">工作地点：</label>
                    <div class="controls">
                        <select id="inputAddress" placeholder="" name="region" class="input-medium">
                            <option selected disabled="disabled">----选择城市----</option>
                            <?php foreach($regions as $r): ?>
                            <option value="<?php echo ($r["id"]); ?>"><?php echo ($r["name"]); ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <input type="text" id="inputDetailAddress" placeholder="" name="address">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputContract">联系人：</label>
                    <div class="controls">
                        <input type="text" id="inputContract" placeholder="" name="contract">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputPhone">联系电话：</label>
                    <div class="controls">
                        <input type="text" id="inputPhone" placeholder="" name="phone">
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-primary">免费注册并发布</button> <button type="button" class="btn">取消</button>
                    </div>
                </div>
            </form>
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
    var permission="<?php echo ($permission); ?>";
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
        +"<a href=\"<?php echo U('Publish/index');?>\">免费发布信息</a>"
        +"</li>"
        +"<li>"
        +"<a href=\"<?php echo U('Index/logout');?>\">退出登录</a>"
        +"</li>"
        +"</ul>"
        +"</div>"
    }).appendTo("#navLogin");

//    if(permission==1){
//        $("<li>",{
//            "html":"<div class=\"btn-group\">"
//            +"<button class=\"btn\" onclick=\"window.location.href='<?php echo U('Publish/index');?>';\">发布招聘信息</button>"
//            +"<button class=\"btn dropdown-toggle\" data-toggle=\"dropdown\">"
//            +"<span class=\"caret\"></span>"
//            +"</button>"
//            +"<ul class=\"dropdown-menu\">"
//            +"<li>"
//            +"<a href=\"<?php echo U('Index/logout');?>\">退出登录</a>"
//            +"</li>"
//            +"</ul>"
//            +"</div>"
//        }).appendTo("#navLogin");
//    }

})

</script>
</body>
</html>