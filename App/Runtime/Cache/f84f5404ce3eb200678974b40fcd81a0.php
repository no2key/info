<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>publish</title>
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
                <div class="control-group hide">
                    <label class="control-label" for="inputPay">工资：</label>
                    <div class="controls">
                        <input type="text" id="inputPay" placeholder="" name="pay"><span> 元/天</span>
                    </div>
                </div>
                <div class="control-group hide">
                    <label class="control-label" for="inputCompany">公司名称：</label>
                    <div class="controls">
                        <input type="text" id="inputCompany" placeholder="" name="company">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputContent">描述：</label>
                    <div class="controls">
                        <textarea id="inputContent" name="content" rows="9" class="input-block-level input-xxlarge"></textarea>
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
                    <label class="control-label" for="inputAddress">工作地点：</label>
                    <div class="controls">
                        <select id="inputAddress" placeholder="" name="region" class="input-medium">
                            <option selected disabled="disabled">----选择城市----</option>
                            <?php foreach($regions as $id=>$r): ?>
                            <option value="<?php echo ($id); ?>"><?php echo ($r); ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputDetailAddress">详细地址：</label>
                    <div class="controls">
                        <input type="text" id="inputDetailAddress" placeholder="" name="address">
                        <a id="mapModal_btn" role="button" class="btn" data-toggle="modal">在地图上标注</a>
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


                <div id="mapModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="mapModalLabel" aria-hidden="true">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">标注位置</h3>
                    </div>
                    <div class="modal-body" style="height: 300px;">
                        <div id="map-canvas" style="width: 100%;height: 100%;overflow: hidden;margin:0;"></div>

                        <input type="hidden" name="lng">
                        <input type="hidden" name="lat">
                        <br>
                    </div>
                    <div class="modal-footer">
                        <label style="display: inline">当前标注位置：</label>
                        <input type="text" id="marker_address">
                        <ul id="searchResultPanel" style="display:none;"></ul>
                        <a id="mark" class="btn btn-primary">确定</a>
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

<!--<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>-->
<script>
function init() {
    var map = new BMap.Map("map-canvas");
    var point = new BMap.Point(116.400244,39.92556);
    var gc = new BMap.Geocoder();
    map.centerAndZoom("北京", 12);
    var mkr = new BMap.Marker(point, {
        enableDragging:true
    });
    map.addOverlay(mkr);
    map.enableScrollWheelZoom();
    map.disableDoubleClickZoom();
    map.addControl(new BMap.NavigationControl());
    map.addControl(new BMap.ScaleControl());
    map.addControl(new BMap.OverviewMapControl());
    mkr.addEventListener("dragend", function(e){
        var pt = e.point;
        mkr.setPosition(pt);
        gc.getLocation(pt, function(rs){
            $("#marker_address").attr('value',
                    rs.addressComponents.street+", "+
                            rs.addressComponents.district+", "+
                            rs.addressComponents.city
            );
        });
        $("input[name=lng]").attr('value', pt.lng);
        $("input[name=lat]").attr('value', pt.lat);
    });
}
$(function(){
    $("#mapModal_btn").click(function(){
        $('#mapModal').modal('toggle');
        if (!window.loadMap) {
            var mapScript= document.createElement("script");
            mapScript.type = "text/javascript";
            mapScript.src="http://api.map.baidu.com/api?v=2.0&callback=init&ak=Z0QeCyOfVo4mb8q9HT1Fxu2f";
            document.body.appendChild(mapScript);
            window.loadMap = true;
        }

        $("#mark").click(function(e){
            $("input[name=address]").attr('value', $("#marker_address").val());
            $('#mapModal').modal('toggle');
        })
    });
    $("#inputCategory").change(function(){
        if ($("#inputCategory").val() == 12) {
            $("input[name=pay]").parent().parent().fadeIn();
            $("input[name=company]").parent().parent().fadeIn();
        } else {
            $("input[name=pay]").parent().parent().fadeOut();
            $("input[name=company]").parent().parent().fadeOut();
        }
    });
})


//function initialize() {
//    var myLatlng = new google.maps.LatLng(39.904214, 116.407413);
//    var mapOptions = {
//        zoom: 11,
//        mapTypeId: google.maps.MapTypeId.ROADMAP,
//        zoomControl: true,
//        scaleControl: true,
//        center: myLatlng
//    }
//    var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
//
//    var marker = new google.maps.Marker({
//        position: myLatlng,
//        map: map,
//        title: 'Hello World!',
//        draggable: true,
//        geodesic: true
//    });
//    google.maps.event.addListener(marker, "dragend", function() {
//        var latlng = marker.getPosition();
//        lat = String(latlng.lat());
//        lng = String(latlng.lng());
//        alert(lat+","+lng);
//    });
//}
//
//google.maps.event.addDomListener(window, 'load', initialize);
</script>


</body>
</html>