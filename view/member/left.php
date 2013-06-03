<?php $pageurl=$_SERVER["REQUEST_URI"];?>
<div id="percon_left">
	<div class="percon_title"><span class="title_l">常用工具</span><span class="r"></span></div>
	<div class="perlist perlist_bg">
		<ul class="list_ul">
			<li><a <?php if($pageurl=='/member/index.php') echo 'class="hover"';?> href="index.php">我的首页</a></li>
			<li><a <?php if($pageurl=='/member/rent.php?type=1') echo 'class="hover"';?> href="rent.php?type=1">发布出租信息</a></li>
			<li><a <?php if($pageurl=='/member/rent.php?type=2') echo 'class="hover"';?> href="rent.php?type=2">发布出售信息</a></li>
			<li><a <?php if($pageurl=='/member/manager.php?type=1') echo 'class="hover"';?> href="manager.php?type=1">出租信息管理</a></li>
			<li><a <?php if($pageurl=='/member/manager.php?type=2') echo 'class="hover"';?> href="manager.php?type=2" >出售信息管理</a></li>
			<li class="drop" ><a <?php if($pageurl=='/member/tongji.php') echo 'class="hover"';?> href="tongji.php" >数据统计</a></li>
			<li><a <?php if($pageurl=='/member/editAll.php') echo 'class="hover"';?> href="editAll.php">个人资料修改</a></li>
			<li><a <?php if($pageurl=='/member/editpwd.php') echo 'class="hover"';?> href="editpwd.php">密码修改</a></li>
		</ul>
	</div>
	<div class="per_ad"><a href="/map"><img src="/img/ad_eg_1.jpg" width="184" height="86" alt=""></a></div>
	<div class="percon_title more_person"><span class="title_l">常见问题</span><a href="QAF.php" class="r">更多</a></div>
	<div class="perlist morelist">
		<ul class="more_ul">
			<li><a href="QAF.php">常见的房源问题</a></li>
			<li><a href="QAF.php">常见的房源问题</a></li>
			<li><a href="QAF.php">常见的房源问题</a></li>
			<li><a href="QAF.php">常见的房源问题</a></li>
			<li><a href="QAF.php">常见的房源问题</a></li>
			<li><a href="QAF.php">常见的房源问题</a></li>
		</ul>
	</div>
</div>
