<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>文档管理</title>
<link rel="stylesheet" type="text/css" href="css/base.css">
<script type="text/javascript" src="js/FormValid.js"></script>
</head>
<body leftmargin="8" topmargin="8" background='images/allbg.gif'>
<!--  快速转换位置按钮  -->
<table width="98%" border="0" cellpadding="0" cellspacing="1" bgcolor="#ccd9b9" align="center">
	<tr>
		<td height="26" background="images/newlinebg3.gif" align="center">系统用户管理</td>
	</tr>
</table>

<table width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CFCFCF" align="center" style="margin-top:8px">
	<tr bgcolor="#E7E7E7" >
		<td height="28" colspan="6" background="images/tbg.gif" style="padding-left:10px;"> ◆ 后台管理用户列表 </td>
	</tr>
	<tr align="center" bgcolor="#FBFCE2" height="25">
		<td width="3%">ID</td>
		<td width="13%">登录用户名</td>
		<td width="32%">权限</td>
		<td width="24%">备注</td>
		<td width="16%">状态</td>
		<td width="12%">操作</td>
	</tr>
	<?php foreach ($datalist as $key){?>
	<tr align="center" bgcolor="#FFFFFF" height="26" onMouseMove="javascript:this.bgColor='#FCFDEE';" onMouseOut="javascript:this.bgColor='#FFFFFF';">
		<td nowrap><?php echo $key['id'];?></td>
		<td><?php echo $key['userid'];?></td>
		<td><?php foreach(explode(',',$key['grant']) as $k){echo Config::item("grant.".$k).',';}?></td>
		<td><?php echo $key['beizhu'];?></td>
		<td><?php if($key['used']==1){echo "<font color='green'>正常</font>";}else{echo "<font color='red'>禁用</font>";}?></td>
		<td><a href="?action=edit&id=<?php echo $key['id'];?>">编辑</a> <a onclick="return confirm('真的要删除吗?')" href="?action=del&id=<?php echo $key['id'];?>">删除</a> <?php if($key['used']==1){echo "<a href=\"?action=unused&id=".$key['id']."\">禁用</a>";}else{echo "<a href=\"?action=used&id=".$key['id']."\">启用</a>";}?></td>
	</tr>
	<?php }?>
</table>

<form id="form1" name="form1" method="post" onsubmit="return validator(this)" action="?action=save" autocomplete="off">
<table width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CFCFCF" align="center" style="margin-top:8px">
	<tr bgcolor="#E7E7E7" >
		<td height="28" colspan="2" background="images/tbg.gif" style="padding-left:10px;"> ◆ 添加/修改用户 </td>
	</tr>
	<tr align="center" bgcolor="#FFFFFF" height="25">
		<td width="21%" align="right">用户名：<input type="hidden" name="id" value="<?php echo $datainfo['id'];?>" readonly="true" /></td>
		<td width="79%" align="left"> <input type="text" name="userid" value="<?php echo $datainfo['userid'];?>" /></td>
	</tr>
	<tr align="center" bgcolor="#FFFFFF" height="25">
		<td width="21%" align="right">登录密码：</td>
		<td width="79%" align="left"> <input type="password" name="pwd" value="<?php echo $datainfo['pwd'];?>" /></td>
	</tr>
	<tr align="center" bgcolor="#FFFFFF" height="25">
		<td width="21%" align="right">再次确认密码：</td>
		<td width="79%" align="left"> <input type="password" name="pwd2" value="<?php echo $datainfo['pwd'];?>" valid="eqaul" eqaulName="pwd" errmsg="两次密码不同!" /></td>
	</tr>
	<tr align="center" bgcolor="#FFFFFF" height="25">
		<td width="21%" align="right">备注：</td>
		<td width="79%" align="left"> <input type="text" name="beizhu" value="<?php echo $datainfo['beizhu'];?>" /></td>
	</tr>
	<tr align="center" bgcolor="#FFFFFF" height="25">
		<td width="21%" align="right">权限：</td>
		<td width="79%" align="left">
			<?php
			foreach(Config::item("grant") as $key => $value ){
			if(strpos($datainfo['grant'],$key)===false){
					echo "<input type=\"checkbox\" name=\"grant[]\" value=\"{$key}\" />{$value} ";
				}else{
					echo "<input type=\"checkbox\" name=\"grant[]\" value=\"{$key}\" checked />{$value} ";
				}
			}
			?>
		</td>
	</tr>
	<tr align="center" bgcolor="#FFFFFF" height="25">
		<td width="21%" align="right"></td>
		<td width="79%" align="left"><label>
			<input type="submit" name="Submit" value="提交" />
		</label></td>
	</tr>
</table>
</form>

</body>
</html>