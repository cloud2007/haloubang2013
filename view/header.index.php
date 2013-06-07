<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- Mimic Internet Explorer 8 -->
<title><?php echo $web_title;?></title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
<link rel="shortcut icon" href="favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php echo $web_keywords;?>" />
<meta name="description" content="<?php echo $web_description;?>" />
<link rel="stylesheet" type="text/css" href="/public/css/base.css"/>
<link rel="stylesheet" type="text/css" href="/css/web_name.css"/>
<script type="text/javascript" src="/js/js.js"></script>
<script type="text/javascript" src="/public/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="/js/index.js"></script>
<script type="text/javascript" src="/js/topad.js"></script>
</head>

<body id="b_bg">
<?php $pageurl=$_SERVER["REQUEST_URI"];?>
<div class="header">
	<?php if($pageurl=='/' && Config::item('webconfig.ad_isshow')==1) echo '<DIV class="gg_full wrapfix"><DIV class=gg_fbtn><A style="DISPLAY: none" class=gg_freplay title=重播 href="#"></A><A class=gg_fclose title=关闭 href="#"></A></DIV><DIV class=gg_fcon></DIV></DIV><SCRIPT type=text/javascript src="js/qpxl.js"></SCRIPT>';?>
	<div id="top">
		<div class="cs">
			<ul>
		<!--<li class="c" style="display:none;">成都</li>  -->
				<li>成都写字楼出租出售专业网站 – 好楼帮</li>
			</ul>
		</div>
		<div class="s_nav">
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
		</div>
		<div id="logo"> <a href="/"> <img src="/img/house_05.png" width="175" height="65" alt=""></a>		</div>
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
<div id="des">
	<div class="header_tips" style="width:230px; "><p style="line-height:24px;">成都共有<span><strong><?php echo $housenum;?></strong></span> 套写字楼，<span><strong><?php echo $boroughnum;?></strong></span> 个新盘</p></div>
    <div class="header_tips_2" style="padding:0;"><img src="/img/house007_03.png" width="182" height="23" alt="咨询热线：028-61326632"><p class="m">免费咨询/委托找房</p>
	
    </div>
</div>