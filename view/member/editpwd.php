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
	<div id="person_right" >
    
    <div class="r_con">
   <span class="pic"><img src="<?php echo $Borker->avatar();?>" width="78" height="103" alt=""></span>
   <p class="name">真实姓名： <span><?php echo $Borker -> uname ;?></span></p>
   <p class="name tel">联系电话： <span><?php echo $Borker -> tel ;?></span></p>
   <p class="name zige">资格证号： <span><?php echo $Borker -> get('coding');?></span></p>
   <p class="name qq">QQ： <span><?php echo $Borker -> get('qqnum');?></span></p>
   <p class="name ema">E-mail： <span><?php echo $Borker -> get('email');?></span></p>
   <span class="pic_tel">
<span class="phone_num_less"><?php echo $Borker -> get('tel');?></span></span>
   <div class="dec"><span style="float:left; display:block; height:30px; color:#262626;">个人说明：</span><p><?php echo $Borker -> get('sign');?></p></div>
  </div>
    
	<div class="percon_title " style="margin-top:15px;"> <span class="title_l" >修改密码</span> </div>
	<div class="r_con_0">
<form  method="post" action="?" class="myform">
				<input type="hidden" name="id" value="<?php echo $Borker -> id ;?>" />
				<input type="hidden" name="action" value="save" />
				<div class="one">
					<label for="">旧密码:</label>
					<input name="pwd" type="password"  class="aa" id="pwd" />
				</div>
				<div class="one">
					<label for="">新密码:</label>
					<input name="pwd1" type="password"  class="aa" id="pwd1" />
				</div>
				<div class="one">
					<label for="">密码确认:</label>
					<input name="pwd2" type="password"  class="aa" id="pwd2" />
				</div>
				<div class="two">
					<input type="submit" value="提交" class="btn">
				</div>
			</form>
	
</div>
</div>
<div style="clear:both"></div>
</div>
</body>
</html>
