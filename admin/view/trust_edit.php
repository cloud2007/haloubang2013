<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>文档管理</title>
<link rel="stylesheet" type="text/css" href="css/base.css">
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="/js/FormValid.js"></script>
<script type="text/javascript" src="/kind/kindeditor-min.js"></script>
<style type="text/css">
table.borough tr{ background:#FFFFFF; height:30px;}
table.borough td{ padding:0 5px;}
.borough input[type='text']{ border:1px solid #d5dee9; padding:3px}
select{ line-height:30px;}
</style>
</head>
<body leftmargin="8" topmargin="8" background='images/allbg.gif' >
<!--  快速转换位置按钮  -->
<table width="98%" border="0" cellpadding="0" cellspacing="1" bgcolor="#ccd9b9" align="center">
	<tr>
		<td height="26" background="images/newlinebg3.gif" align="center">委托信息管理</td>
	</tr>
	<tr>
		<td height="26" bgcolor="#FFFFFF">　<a href="trust.php"><font color="red">信息列表</font></a></td>
	</tr>
</table>
<form name="order" method="post" onsubmit="return validator(this)" action="?action=save" class="form_box" >
	<table width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CFCFCF" align="center" style="margin-top:8px; " class="borough">
		<tr>
			<td width="20%" align="right">姓名</td>
			<td width="80%"><input name="uname" type="text" id="uname" value="<?php echo $datainfo->uname;?>" disabled="disabled" />
				<input type="hidden" name="id" value="<?php echo $datainfo->id;?>" />
				<input type="hidden" name="editid" value="<?php echo $user['id'];?>" />
				<input type="hidden" name="editname" value="<?php echo $user['name'];?>" /></td>
		</tr>
		<tr>
			<td align="right">委托类型</td>
			<td><input name="type" type="text" id="type" value="<?php echo $datainfo->type();?>" disabled="disabled" /></td>
		</tr>
		<tr>
			<td align="right">电话</td>
			<td><input name="tel" type="text" id="tel" value="<?php echo $datainfo->tel;?>" disabled="disabled" /></td>
		</tr>
		<tr>
			<td align="right">E-Mail</td>
			<td><input name="email" type="text" id="email" value="<?php echo $datainfo->email;?>" disabled="disabled" /></td>
		</tr>
		<tr>
			<td align="right">委托信息</td>
			<td><textarea name="content" cols="70" rows="5" disabled="disabled" id="content"><?php echo $datainfo->content;?></textarea></td>
		</tr>
		<tr>
			<td align="right">信息标记</td>
			<td>
				<input type="radio" name="states" value="1" <?php if ($datainfo -> states == 1) echo 'checked="checked"';?> />新委托
				<input type="radio" name="states" value="2" <?php if ($datainfo -> states == 2) echo 'checked="checked"';?> />已处理
			</td>
		</tr>
		<tr>
			<td align="right">备注该信息</td>
			<td>
			处理历史：<?php if($datainfo -> editcontent)echo $datainfo->editcontent;?><br />
			<textarea name="editcontent" cols="70" rows="5" id="editcontent"></textarea>
			</td>
		</tr>
		<tr bgcolor="#E7E7E7" >
			<td height="28" colspan="2" background="images/tbg.gif" style=" text-align:center; padding:7px 0 0 0"><input name="sumbmit" type="image" src="images/button_save.gif" width="60" height="22" class="np" border="0"  style="cursor:pointer;"/>
				<img src="images/button_back.gif" width="60" height="22" border="0" onClick="history.back(-1);" style="cursor:pointer; "/></td>
		</tr>
	</table>
</form>
</body>
</html>