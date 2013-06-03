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
		<td height="26" background="images/newlinebg3.gif" align="center">友情链接管理</td>
	</tr>
</table>

<table width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CFCFCF" align="center" style="margin-top:8px">
	<tr bgcolor="#E7E7E7" >
		<td height="28" colspan="6" background="images/tbg.gif" style="padding-left:10px;"> ◆ 友情链接管理 </td>
	</tr>
	<tr align="center" bgcolor="#FBFCE2" height="25">
		<td width="3%">ID</td>
		<td width="13%">链接名称</td>
		<td width="32%">链接类型</td>
		<td width="24%">备注</td>
		<td width="16%">状态</td>
		<td width="12%">操作</td>
	</tr>
	<?php foreach ($datalist as $key){?>
	<tr align="center" bgcolor="#FFFFFF" height="26" onMouseMove="javascript:this.bgColor='#FCFDEE';" onMouseOut="javascript:this.bgColor='#FFFFFF';">
		<td nowrap><?php echo $key['id'];?></td>
		<td><?php echo $key['title'];?></td>
		<td><?php if($key['type']==1){echo "文字链接";}else{echo "图片链接";}?></td>
		<td><?php echo $key['beizhu'];?></td>
		<td><?php if($key['used']==1){echo "<font color='green'>正常</font>";}else{echo "<font color='red'>禁用</font>";}?></td>
		<td><a href="?action=edit&id=<?php echo $key['id'];?>">编辑</a> <a onclick="return confirm('真的要删除吗?')" href="?action=del&id=<?php echo $key['id'];?>">删除</a> <?php if($key['used']==1){echo "<a href=\"?action=unused&id=".$key['id']."\">禁用</a>";}else{echo "<a href=\"?action=used&id=".$key['id']."\">启用</a>";}?></td>
	</tr>
	<?php }?>
</table>

<form id="form1" name="form1" method="post" onsubmit="return validator(this)" action="?action=save" autocomplete="off">
<table width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CFCFCF" align="center" style="margin-top:8px">
	<tr bgcolor="#E7E7E7" >
		<td height="28" colspan="2" background="images/tbg.gif" style="padding-left:10px;"> ◆ 添加/修改链接 </td>
	</tr>
	<tr align="center" bgcolor="#FFFFFF" height="25">
		<td width="21%" align="right">链接名称：<input type="hidden" name="id" value="<?php echo $datainfo['id'];?>" readonly="true" /></td>
		<td width="79%" align="left"> <input type="text" name="title" value="<?php echo $datainfo['title'];?>" /></td>
	</tr>
	<tr align="center" bgcolor="#FFFFFF" height="25">
		<td width="21%" align="right">链接类型：</td>
		<td width="79%" align="left">
			<select name="type">
				<option value="1" <?php if($datainfo['type']==1){echo '"selected"';}?>>文字链接</option>
				<option value="2" <?php if($datainfo['type']==2){echo '"selected"';}?>>图片链接</option>
			</select>
			<font color="#FF0000">(如果选择图片链接必须上传一张logo图片(),文字链接可以不上传图片。)</font>
		</td>
	</tr>
	<tr align="center" bgcolor="#FFFFFF">
		<td width="21%" align="right">链接图片：</td>
		<td width="79%" align="left">
                    <input type="hidden" name="logo" id="logo" value="<?php echo $datainfo['logo'];?>" >
		    <div id="image_dis" style="padding:3px 0 0 3px;"><?php if($datainfo['logo']){?><img src="<?php echo $datainfo['logo'];?>" width="88" height="31" /><?php }?></div>
                    <iframe style="padding:0;" name="linkupload" width="100%" height="35" scrolling="No" frameborder="no"  src="/swfupload/class/uploadaction.php" align="left"></iframe>
		</td>
	</tr>
	<tr align="center" bgcolor="#FFFFFF" height="25">
		<td width="21%" align="right">链接地址：</td>
		<td width="79%" align="left"> <input type="text" name="link" value="<?php echo $datainfo['link'];?>" size="30" /></td>
	</tr>
	<tr align="center" bgcolor="#FFFFFF" height="25">
		<td width="21%" align="right">备注：</td>
		<td width="79%" align="left"> <input type="text" name="beizhu" value="<?php echo $datainfo['beizhu'];?>" /></td>
	</tr>
	<tr align="center" bgcolor="#FFFFFF" height="25">
		<td width="21%" align="right"></td>
		<td width="79%" align="left"><input type="submit" name="Submit" value="提交" /></td>
	</tr>
</table>
</form>
<script language="javascript">
function linkupload( furl ){
	document.getElementById('logo').value = furl;
	document.getElementById('image_dis').innerHTML = '<img src="'+furl+'" width="88" height="31">';
}
</script>
</body>
</html>