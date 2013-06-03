<?php $pageurl=$_SERVER["REQUEST_URI"];?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="/public/css/base.css"/>
<link rel="stylesheet" type="text/css" href="/css/web_name.css"/>
<link rel="stylesheet" type="text/css" href="/css/lrtk.css"/>
<script type="text/javascript" src="/public/js/jquery-1.6.2.min.js"></script>

<title>经纪人管理后台 - 好楼帮</title>
</head>
<body id="b_bg">
<div class="header">
	
	<div id="top" style="height:180px;">
		<div class="cs" style="text-align:center">
			<ul>
				<!--<li class="c" style="display:none;">成都</li>  -->
				<li>成都写字楼出租出售专业网站 – 好楼帮</li>
			</ul>
		</div>
		<div class="s_nav" >
			
				<ul>
				<li><a href="/trust">委托发布 </a></li>
				<li><a href="/map"> 写字楼地图 </a></li>
				<li><a href="/photo">楼盘图库</a></li>
				<li><a href="/news">新闻 </a></li>
                <?php
				if ($_SESSION['borker_id']){
					echo '<li >你好，'.$_SESSION['borker_name'].'，欢迎登陆<a class="s_nav_member" href="/member">     经纪人中心 </a></li>  <li ><a class="s_nav_member" href="/member/?action=exit"  >退出</a></li>';
				}else{
					echo '<li><a class="one" href="/user/login.php">经纪人登陆</a></li>';
				}
				?>
                
		
			</ul>
		</div>
		<div id="logo" style="position:absolute; top:60px; left:0;"> <a href="/member/index.php"> <img src="/img/logo_center.png" width="247" height="42" alt=""></a>		</div>
		<div id="nav_list" style="width:1001px; top:120px;"> 
			<div class="nav_l" style="width:1001px;">
				<ul>
					<li style="width:125px; text-align:center"><a style="width:125px; text-align:center" href="/">首　页</a></li>
					<li style="width:125px; text-align:center"><a style="width:125px; text-align:center" href="/rent">找出租 </a></li>
					<li style="width:125px; text-align:center"><a style="width:125px; text-align:center" href="/sale">找出售 </a></li>
					<li style="width:125px; text-align:center"><a style="width:125px; text-align:center" href="/borough">找楼盘 </a></li>
					<li style="width:125px; text-align:center"><a style="width:125px; text-align:center" href="/supply">开发商直供 </a></li>
					<li style="width:125px; text-align:center"><a style="width:125px; text-align:center" href="/borker"> 经纪人 </a></li>
					<li style="width:125px; text-align:center"><a style="width:125px; text-align:center" href="/map"> 地图找房 </a></li>
					<li style="width:125px; text-align:center" ><a style="width:125px; text-align:center" href="/news"> 写字楼资讯 </a></li>
				</ul>
			</div>
			 </div>
	</div>

</div>
