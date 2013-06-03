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
		
        
        <div id="person_right">
			<form  method="post" action="?" class="myform">
				<input type="hidden" name="id" value="<?php echo $Borker -> id ;?>" />
				<input type="hidden" name="action" value="save" />
				<input type="hidden" name="avatar" id="avatar" value="" />
				
                
                <div class="photo_change">
                <ul class="photo_change_before">
                <li class="photo_change_title">当前使用头像</li>
                <li class="photo_change_img"><img  src="<?php echo $Borker->avatar();?>" width="75" height="100" /></li>
                <li>75 x 100</li>
                </ul>
                
                <ul class="photo_change_after">
                <li class="photo_change_title">新头像预览</li>
                <li class="photo_change_img"  id="avatar_dis" style="width:150px; height:150px;"></li>
                <li>3:4</li>
                </ul>
                </div>
				
				<div style="margin-bottom:120px;">
                <iframe style="padding:0;" name="linkupload" width="100%" height="50" scrolling="No" frameborder="no"  src="/swfupload/class/avatar.php" align="left"></iframe>
                
                </div>
				<div class="two">
					<input type="submit" value="提交" class="btn">
				</div>
			</form>
		</div>
	</div>



<script type="text/javascript" src="/public/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="/js/index.js"></script>
<script language="javascript">
function linkupload( furl ){
	document.getElementById('avatar').value = furl;
	document.getElementById('avatar_dis').innerHTML = '<img  src="'+furl+'" width="75" height="100">';
}
</script>
</body>
</html>
