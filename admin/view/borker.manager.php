<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>文档管理</title>
<link rel="stylesheet" type="text/css" href="css/base.css">
<script type="text/javascript" src="/js/FormValid.js"></script>
</head>
<body leftmargin="8" topmargin="8" background='images/allbg.gif'>
<!--  快速转换位置按钮  -->
<table width="98%" border="0" cellpadding="0" cellspacing="1" bgcolor="#ccd9b9" align="center">
	<tr>
		<td height="26" background="images/newlinebg3.gif" align="center">经纪人管理</td>
	</tr>
</table>

<table width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CFCFCF" align="center" style="margin-top:8px">
	<tr bgcolor="#E7E7E7" >
		<td height="28" colspan="8" background="images/tbg.gif" style="padding-left:10px;"> ◆ 经纪人列表 </td>
	</tr>
	<tr align="center" bgcolor="#FBFCE2" height="25">
		<td width="3%">ID</td>
		<td>登录电话号码</td>
		<td>头像</td>
		<td>资格证书</td>
		<td>真实姓名</td>
		<td>类型</td>
		<td>状态</td>
		<td>操作</td>
	</tr>
	<?php foreach ($datalist as $key){?>
	<tr align="center" bgcolor="#FFFFFF" height="26" onMouseMove="javascript:this.bgColor='#FCFDEE';" onMouseOut="javascript:this.bgColor='#FFFFFF';">
		<td nowrap><?php echo $key->id;?></td>
		<td><?php echo $key->tel;?></td>
		<td><img src="<?php echo $key->avatar();?>" width="75" height="100" /></td>
		<td><a href="<?php echo $key->cate();?>"><img src="<?php echo $key->cate();?>" width="75" height="100" /></a><br />资格证号：<?php echo $key->catenum;?></td>
		<td><?php echo $key->uname;?></td>
		<td><?php echo $key->showtype();?></td>
		<td><?php echo $key->showstates();?></td>
		<td><a onclick="return confirm('密码重设为888888?')" href="?action=reset&id=<?php echo $key->id;?>">重设密码</a> <?php if($key->states==1){echo "<a href=\"?action=unused&id=".$key->id."\">禁用账户</a>";}else{echo "<a href=\"?action=used&id=".$key->id."\">审核通过</a>";}?> <a onclick="return confirm('是否删除该账户?')" href="?action=del&id=<?php echo $key->id;?>">删除</a></td>
	</tr>
	<?php }?>
</table>
<table width="98%" border="0" cellpadding="0" cellspacing="1" bgcolor="#ccd9b9" align="center" style="margin-top:8px">
	<tr>
		<td height="26" background="images/newlinebg3.gif" align="center"><?php echo $pagerData['linkhtml'];?></td>
	</tr>
</table>
</body>
</html>