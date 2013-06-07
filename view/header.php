<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?php echo $web_title;?></title>
<link rel="shortcut icon" href="favicon.ico">
<meta name="keywords" content="<?php echo $web_keywords;?>" />
<meta name="description" content="<?php echo $web_description;?>" />
<link rel="stylesheet" type="text/css" href="/public/css/base.css"/>
<link rel="stylesheet" type="text/css" href="/css/web_name.css"/>
<script type="text/javascript" src="/public/js/jquery-1.6.2.min.js"></script>
</head>
<body id="b_bg">
<?php $pageurl=$_SERVER["REQUEST_URI"];?>
<div class="header">
	<div id="top">
		<div class="cs" style="text-align:center">
			<ul>
				<!--<li class="c" style="display:none;">成都</li>  -->
				<li>成都写字楼出租出售专业网站 – 好楼帮</li>
			</ul>
		</div>
		<div class="s_nav">
			<ul>
				<ul>
					<li><a href="/trust">委托发布 </a></li>
					<li><a href="/map"> 写字楼地图 </a></li>
					<li><a href="/photo">楼盘图库</a></li>
					<li><a href="/news">新闻 </a>
						<?php
				if ($_SESSION['borker_id']){
					echo '<li >你好，'.$_SESSION['borker_name'].'，欢迎登陆<a class="s_nav_member" href="/member">     经纪人中心 </a></li>  <li ><a class="s_nav_member" href="/member/?action=exit"  >退出</a></li>';
				}else{
					echo '<li><a class="one" href="/user/login.php">经纪人登陆</a></li>';
				}
				?>
				</ul>
			</ul>
		</div>
		<div id="logo"> <a href="/"> <img src="/img/house_05.png" width="175" height="65" alt=""></a> </div>
		<div id="nav_list">
			<div class="nav_l">
				<ul>
					<li><a <?php if($pageurl=='/') echo 'class="menu_ul_li_hover"';?> href="/">首　页</a></li>
					<li><a <?php if(strpos($pageurl,'rent')>0) echo 'class="menu_ul_li_hover"';?> href="/rent">租写字楼</a></li>
					<li><a <?php if(strpos($pageurl,'sale')>0) echo 'class="menu_ul_li_hover"';?> href="/sale">买写字楼</a></li>
					<li><a <?php if(strpos($pageurl,'newborough')>0) echo 'class="menu_ul_li_hover"';?> href="/newborough">新　盘</a></li>
					<li><a <?php if(strpos($pageurl,'supply')>0) echo 'class="menu_ul_li_hover"';?> href="/supply">开发商直供 </a></li>
					<li><a <?php if(strpos($pageurl,'borker')>0) echo 'class="menu_ul_li_hover"';?> href="/borker"> 经纪人 </a></li>
					<li><a <?php if(strpos($pageurl,'map')>0) echo 'class="menu_ul_li_hover"';?> href="/map"> 地图找房 </a></li>
					<li class="no_b"><a <?php if(strpos($pageurl,'news')>0) echo 'class="menu_ul_li_hover"';?> href="/news"> 写字楼资讯 </a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="search_small">
	<div class="header_tips">
		<p>成都共有<span><strong><?php echo $housenum;?></strong></span> 套写字楼</p>
	</div>
	<form id="form1" name="form1" method="post" action="/search.php">
		<input type="hidden" name="type" value="<?php echo Util::get_search_action($pageurl);?>" />
		<input type="text" class="text" id="myinput" name="q" value="<?php echo $_GET['q'] ? $_GET['q'] : '请输入楼盘名称、街道名称......';?>">
		<input type="submit" class="sbt sbt<?php echo Util::get_search_action($pageurl);?>" value="搜索" >
	</form>
	<div class="header_tips_2">
		<p  class="w">免费咨询/委托找房&nbsp;&nbsp;</p>
		<img src="/img/house007_03.png" width="182" height="23" alt="咨询热线：028-61326632" style="float:right;"> </div>
</div>
