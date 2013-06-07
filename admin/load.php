<?php
$itemid=$_POST['itemid'];
switch ($itemid){
	case 1:
?>
<dl class='bitem'>
	<dt onClick='showHide("items1_1")'><b>网站信息</b></dt>
	<dd style='display:block' class='sitem' id='items1_1'>
		<ul class='sitemu'>
			<li><a href='web.notice.php' target='main'>首页公告</a></li>
			<li><a href='web.hotsearch.php' target='main'>热门搜索</a></li>
			<li><a href='web.config.php' target='main'>网站配置</a></li>
		</ul>
	</dd>
</dl>
<dl class='bitem'>
	<dt onClick='showHide("items1_2")'><b>新闻系统</b></dt>
	<dd style='display:block' class='sitem' id='items1_2'>
		<ul class='sitemu'>
			<li><a href='news.php?action=add' target='main'>添加新闻</a></li>
			<li><a href='news.php' target='main'>管理新闻</a></li>
		</ul>
	</dd>
</dl>
<dl class='bitem'>
	<dt onClick='showHide("items1_3")'><b>友情链接管理</b></dt>
	<dd style='display:block' class='sitem' id='items1_3'>
		<ul class='sitemu'>
			<li><a href='link.manager.php' target='main'>友情链接</a> </li>
		</ul>
	</dd>
</dl>
<dl class='bitem'>
	<dt onClick='showHide("items1_4")'><b>新闻栏目广告</b></dt>
	<dd style='display:block' class='sitem' id='items1_4'>
		<ul class='sitemu'>
			<li><a href='ads.manager.php' target='main'>广告管理</a> </li>
		</ul>
	</dd>
</dl>
<?php
	break;
	case 2:
?>
<dl class='bitem'>
	<dt onClick='showHide("items2_1")'><b>房源管理</b></dt>
	<dd style='display:block' class='sitem' id='items2_1'>
		<ul class='sitemu'>
			<li>
				<div class='items'>
					<div class='fllct'><a href='house.php' target='main'>房源管理</a></div>
				</div>
			</li>
		</ul>
	</dd>
</dl>
<dl class='bitem'>
	<dt onClick='showHide("items2_2")'><b>委托信息管理</b></dt>
	<dd style='display:block' class='sitem' id='items2_2'>
		<ul class='sitemu'>
			<li>
				<div class='items'>
					<div class='fllct'><a href='trust.php' target='main'>委托信息管理</a></div>
				</div>
			</li>
		</ul>
	</dd>
</dl>
<?php
	break;
	case 3:
?>
<dl class='bitem'>
	<dt onClick='showHide("items3_1")'><b>楼盘字典管理</b></dt>
	<dd style='display:block' class='sitem' id='items3_1'>
		<ul class='sitemu'>
			<li><a href='borough.php?action=add' target='main'>添加楼盘</a></li>
			<li><a href='borough.php?isnew=0' target='main'>管理楼盘</a></li>
		</ul>
	</dd>
</dl>
<dl class='bitem'>
	<dt onClick='showHide("items3_2")'><b>新盘管理</b></dt>
	<dd style='display:block' class='sitem' id='items3_2'>
		<ul class='sitemu'>
			<li><a href='borough.php?action=add&isnew=1' target='main'>添加新盘</a></li>
			<li><a href='borough.php?isnew=1' target='main'>管理新盘</a></li>
		</ul>
	</dd>
</dl>
<dl class="bitem">
	<dt onClick='showHide("items3_3")'><b>楼盘参数管理</b></dt>
	<dd style='display:block' class='sitem' id='items3_3'>
		<ul class='sitemu'>
			<li><a href='borough.setconfig.php' target='main'>楼盘参数</a></li>
			<li><a href='borough.setcache.php' target='main'>楼盘参数缓存更新</a></li>
		</ul>
	</dd>
</dl>
<?php
	break;
	case 4:
?>
<dl class='bitem'>
	<dt onClick='showHide("items4_1")'><b>系统用户管理</b></dt>
	<dd style='display:block' class='sitem' id='items4_1'>
		<ul class='sitemu'>
			<li><a href='user.manager.php' target='main'>管理用户</a></li>
			<li><a href='borker.manager.php' target='main'>系统经纪人</a></li>
		</ul>
	</dd>
</dl>
<dl class='bitem'>
	<dt onClick='showHide("items4_2")'><b>修改账户密码</b></dt>
	<dd style='display:block' class='sitem' id='items4_2'>
		<ul class='sitemu'>
			<li><a href='user.editpwd.php' target='main'>修改密码</a></li>
		</ul>
	</dd>
</dl>
<?php
	break;
	default:
	echo '<dl class="bitem" id="sunitems2_1">'.$itemid.'</dl>';
}
?>