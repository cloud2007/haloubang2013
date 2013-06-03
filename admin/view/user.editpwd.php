<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>更改密码</title>
<link rel="stylesheet" type="text/css" href="css/base.css">
<script type="text/javascript" src="js/FormValid.js"></script>
</head>
<body leftmargin="8" topmargin="8" background='images/allbg.gif'>
<!--  快速转换位置按钮  -->
<table width="98%" border="0" cellpadding="0" cellspacing="1" bgcolor="#ccd9b9" align="center">
	<tr>
		<td height="26" background="images/newlinebg3.gif" align="center">用户密码更改</td>
	</tr>
</table>

<form id="form1" name="form1" method="post" onsubmit="return validator(this)" action="?action=save" autocomplete="off">
<table width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CFCFCF" align="center" style="margin-top:8px">
	<tr bgcolor="#E7E7E7" >
		<td height="28" colspan="2" background="images/tbg.gif" style="padding-left:10px;"> ◆ 修改用户密码 </td>
	</tr>
	<tr align="center" bgcolor="#FFFFFF" height="25">
		<td width="21%" align="right">用户名：<input type="hidden" name="id" value="<?php echo $datainfo['id'];?>" readonly="true" /></td>
		<td width="79%" align="left"> <input type="text" name="userid" value="<?php echo $datainfo['userid'];?>" /></td>
	</tr>
	<tr align="center" bgcolor="#FFFFFF" height="25">
		<td width="21%" align="right">旧密码：</td>
		<td width="79%" align="left"> <input type="password" name="pwd" valid="required" errmsg="旧密码不能为空!" /></td>
	</tr>
	<tr align="center" bgcolor="#FFFFFF" height="25">
		<td width="21%" align="right">登录密码：</td>
		<td width="79%" align="left"> <input type="password" name="pwd1" valid="required" errmsg="登录密码不能为空!" /></td>
	</tr>
	<tr align="center" bgcolor="#FFFFFF" height="25">
		<td width="21%" align="right">再次确认密码：</td>
		<td width="79%" align="left"> <input type="password" name="pwd2" valid="eqaul" eqaulName="pwd1" errmsg="两次密码不同!" /></td>
	</tr>
	<tr align="center" bgcolor="#FFFFFF" height="25">
		<td width="21%" align="right"></td>
		<td width="79%" align="left"><input type="submit" name="Submit" value="提交" /></td>
	</tr>
</table>
</form>

</body>
</html>