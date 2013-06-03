<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="/public/css/base.css"/>
<link rel="stylesheet" type="text/css" href="/css/web_name.css"/>
<title>成都写字楼出租出售专业网站 - 好楼帮</title>
</head>
<body id="b_bg">
<div class="content">
	<?php require('left.php');?>
	<!--	<div class="logoin_menu_r">
			<div class="r">
				<span class="title">我的个人中心</span>
				<span>欢迎你的登陆 <span class="hey">
					<?php if($Borker->name){echo $Borker->name;}else{echo $Borker->tel;}?> </span> ！登录时间：<?php echo $Borker->loginTime();?></span>
	<div class="dc"><a href="/member/?action=exit" class="dc_in" >登出</a></div>
</div>
<form  method="post" action="?" class="myform">
	<input type="hidden" name="id" value="<?php echo $Borker -> id ;?>" />
	<input type="hidden" name="action" value="editsave" />
	<div class="one">
		<label for="">手机号码:</label>
		<span class="ph_tips"><?php echo $Borker -> tel ;?>(手机号码注册后不能自主修改，如需更改手机号，请联系管理员！)</span> </div>
	<div class="one">
		<label for="">真实姓名:</label>
		<input type="text" name="uname" value="<?php echo $Borker -> uname ;?>"  class="aa" />
	</div>
	<div class="one">
		<label>性别:</label>
		<input name="sex" type="radio" class="ab" value="1" <?php if ($Borker->checksex(1)){echo "checked";}?> />
		<span class="b1">男</span>
		<input name="sex" type="radio" class="ab" value="2" <?php if ($Borker->checksex(2)){echo "checked";}?> />
		<span class="b1">女</span> </div>
	<div class="one">
		<label>资格证号:</label>
		<input name="coding" type="text" value="<?php echo $Borker -> get('coding');?>"  class="aa" id="coding" />
	</div>
	<div class="one">
		<label>Email:</label>
		<input name="email" type="text" value="<?php echo $Borker -> get('email');?>"  class="aa" id="email" />
	</div>
	<div class="one">
		<label for="">400号码:</label>
		<input name="tel400" type="text"  class="aa" value="<?php echo $Borker -> get('tel400');?>" id="tel400" />
	</div>
	<div class="one">
		<label for="">QQ:</label>
		<input name="qqnum" type="text"  class="aa" value="<?php echo $Borker -> get('qqnum');?>" id="qqnum" />
	</div>
	<div class="one">
		<label for="">MSN:</label>
		<input name="msnnum" type="text"  class="aa" value="<?php echo $Borker -> get('msnnum');?>" id="msnnum" />
	</div>
	<div class="one">
		<label for="">个性说明:</label>
		<textarea name="sign" class="tex" id="sign"><?php echo $Borker -> get('sign');?></textarea>
	</div>
	<div class="two">
		<input type="submit" value="提交" class="btn">
	</div>
</form>
</div>
-->
<div id="person_right">
	<div class="r_con"> <span class="pic"><img src="<?php echo $Borker->avatar();?>" width="78" height="103" alt=""></span>
		<p class="name">真实姓名： <span><?php echo $Borker -> uname ;?></span></p>
		<p class="name tel">联系电话： <span><?php echo $Borker -> tel ;?></span></p>
		<p class="name zige">资格证号： <span><?php echo $Borker -> catenum;?></span></p>
		<p class="name qq">QQ： <span><?php echo $Borker -> get('qqnum');?></span></p>
		<p class="name ema">E-mail： <span><?php echo $Borker -> get('email');?></span></p>
		<span class="pic_tel"><span class="phone_num_less"> <?php echo $Borker -> get('tel');?></span></span>
		<div class="dec"><span style="float:left; display:block; height:80px; color:#262626;">个人说明：</span>
			<p><?php echo $Borker -> get('sign');?></p>
		</div>
	</div>
	<div class="percon_title fast"> <span class="title_l" >快捷通道</span><span class="r"></span> </div>
	<div class="fast_list">
		<ul>
			<li><a  href="rent.php?type=1"><img src="/img/person_a_07.png" width="85" height="85" alt=""></a>
				<p>发布出租</p>
			</li>
			<li><a href="rent.php?type=2"><img src="/img/person_a_09.png" width="85" height="85" alt=""></a>
				<p>发布出售</p>
			</li>
			<li><a href="manager.php?type=1"><img src="/img/person_a_11.png" width="85" height="85" alt=""></a>
				<p>出租房源</p>
			</li>
			<li><a href="manager.php?type=2"><img src="/img/person_a_13.png" width="85" height="85" alt=""></a>
				<p>出售房源</p>
			</li>
			<li style="margin-right:0"><a href="editAll.php"><img src="/img/person_a_15.jpg" width="85" height="85" alt=""></a>
				<p>个人资料修改</p>
			</li>
		</ul>
	</div>
	<div class="percon_title publish"> <span class="title_l" >最近发布房源</span> </div>
	<div class="publish_list">
		<ul>
			<?php if(is_array($houselist)){?>
			<?php foreach($houselist as $v){?>
			<li>
				<p class="list_l"><?php echo $v->edittime();?>&nbsp;&nbsp;&nbsp;<?php echo $v->type();?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $v->b_name;?>&nbsp;&nbsp;<?php echo $v->h_floor;?>F <?php echo $v->roomnum;?>号&nbsp;&nbsp;<?php echo $v->area;?>㎡&nbsp;&nbsp;<?php echo $v->price;?>元 </p>
				<p class="list_r"><a href="/<?php echo $v->typeurl();?>/d-<?php echo $v->id;?>.html" target="_blank">前台查看</a></p>
			</li>
			<?php }}?>
		</ul>
	</div>
</div>
<div style="clear:both"></div>
</div>
</body>
</html>
