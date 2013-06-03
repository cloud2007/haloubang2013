<!--This is IE DTD patch , Don't delete this line.-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>后台管理</title>
<link href="css/frame.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-1.4.2.min.js" language="javascript" type="text/javascript"></script>
<script src="js/frame.js" language="javascript" type="text/javascript"></script>
<style type="text/css">
#skinlist {
    display: block;
    height: 11px;
	margin-top: 10px;
    overflow: hidden;
    width: 86px;
}
#skin div {
    float: left;
}
#skin li {
    cursor: pointer;
    float: left;
    height: 11px;
    width: 14px;
}
#def div, #s1 div, #s2 div, #s3 div, #s4 div{
    background-image: url("images/skinbutton.png");
    background-repeat: no-repeat;
}
#s1 div {
    background-position: 0 0px;
}
#s2 div {
    background-position: 0 -11px;
}
#s3 div {
    background-position: 0 -22px;
}
#s4 div {
    background-position: 0 -33px;
}
#s1 div.sel {
    background: url("images/skinbutton.png") no-repeat scroll -14px top transparent;
}
#s2 div.sel {
    background: url("images/skinbutton.png") no-repeat scroll -14px -11px transparent;
}
#s3 div.sel {
    background: url("images/skinbutton.png") no-repeat scroll -14px -22px transparent;
}
#s4 div.sel {
    background: url("images/skinbutton.png") no-repeat scroll -14px -33px transparent;
}
</style>
</head>
<body class="showmenu">
<div class="head">
	<div class="top">
		<div class="top_logo"> <img src="images/admin_top_logo.gif" width="200" height="37" alt="Logo" title="Welcome use DedeCms" id="topdedelogo" /> </div>
		<div class="top_link">
			<ul>
				<li class="welcome">您好:<?php echo $user['name']?>,欢迎登录后台管理.上次登录时间:<?php echo date('Y-m-d H:i:s',$user['logintime']);?></li>
				<li><a href="index_menu.php" target="menu">主菜单</a></li>
				<li><a href="javascript:void(0);" onclick="JumpFrame('index_menu.php','news.php?action=add');">新闻发布</a></li>
				<li><a href="javascript:void(0);" onclick="JumpFrame('index_menu.php','house.php');">房源管理</a></li>
				<li><a href="/" target="_blank">网站主页</a></li>
				<li><a href="javascript:void(0);" onclick="JumpFrame('index_menu.php','borker.manager.php');">会员中心</a></li>
				<li><a href="exit.php" target="_top">注销</a></li>
			</ul>
			<div class="quick"> <a href="javascript:void(0);" class="ac_qucikmenu" id="ac_qucikmenu">快捷方式</a></div>
		</div>
	</div>
	<div class="topnav"><div class="menuact"> <a href="javascript:void(0);" id="togglemenu">隐藏菜单</a></div></div>
</div>

<div class="left">
	<div class="menu" id="menu">
		<iframe src="index_menu.php" id="menufra" name="menu" frameborder="0"></iframe>
	</div>
</div>

<div class="right">
	<div class="main">
		<iframe id="main" name="main" frameborder="0" src="index_body.php"></iframe>
	</div>
</div>

<div class="qucikmenu" id="qucikmenu">
	<ul>
		<li><a href='news.php' target='main'>新闻列表</a></li>
		<li><a href='borough.php' target='main'>楼盘字典</a></li>
	</ul>
</div>
<script language="javascript">
function JumpFrame(url1, url2){
    jQuery('#menufra').get(0).src = url1;
    jQuery('#main').get(0).src = url2;
}
</script>
</body>
</html>
