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
<form name="addItem" method="post" action="?action=save" onsubmit="return validator(this)">
	<table width="98%" border="0" cellpadding="0" cellspacing="1" bgcolor="#ccd9b9" align="center">
		<tr>
			<td height="26" background="images/newlinebg3.gif" align="center">楼盘参数管理</td>
		</tr>
		<input type="hidden" name="set_id" value="<?php echo $set_id;?>" />
		<input type="hidden" name="sid" value="<?php echo $sid;?>" />
		<tr>
			<td height="26" bgcolor="#FFFFFF">　　增加新参数 => 
				<?php if(!$action){?>
				值：<input name="set_name" type="text" value="" valid="required|isEnglish" errmsg="值不能为空!|值只能是英文!" />
				<?php }?>
				<?php if($set_id==1){?>
				所属区域：
				<select name="pid">
					<option value="0" style="color:#FF0000;">一级区域</option>
					<?php foreach($parent as $key){?>
					<option value="<?php echo $key['id'];?>" <?php if($datainfo['parent_id']==$key['id']){echo "selected";}?>><?php echo $key['set_caption'];?></option>
					<?php }?>
				</select>
				<?php }?>
				名称:
				<input name="set_caption" value="<?php echo $datainfo['set_caption'];?>" valid="required" errmsg="名称不能为空!" />
				<input type="submit" value="保存" /></td>
		</tr>
	</table>
</form>
<form name="order" method="post" action="">
<table width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CFCFCF" align="center" style="margin-top:8px">
	<tr bgcolor="#E7E7E7" >
		<td height="28" colspan="5" background="images/tbg.gif" style="padding-left:10px;"> ◆ 楼盘参数管理 </td>
	</tr>
	<tr align="center" bgcolor="#FBFCE2" height="25">
		<td width="4%">ID</td>
		<td width="17%">值</td>
		<td width="8%">排序</td>
		<td width="58%">名称</td>
		<td width="13%">操作</td>
	</tr>
	<?php 
	if($action == "edit"){
	foreach($parent as $key){
	$pid=$key['id'];
	?>
	<tr align="center" bgcolor="#FFFFFF" height="26" onMouseMove="javascript:this.bgColor='#FCFDEE';" onMouseOut="javascript:this.bgColor='#FFFFFF';">
		<td nowrap><?php echo $key['id'];?></td>
		<td>-</td>
		<td><input type="text" name="list_order[<?php echo $key['id'];?>]" value="<?php echo $key['order_id'];?>" size="3" style="text-align:center" /></td>
		<td><b><?php echo $key['set_caption'];?></b></td>
		<td><a href="?action=edit&set_id=<?php echo $set_id;?>&pid=0&sid=<?php echo $key['id'];?>">编辑</a> <a href="?action=del&set_id=<?php echo $set_id;?>&id=<?php echo $key['id'];?>">删除</a></td>
	</tr>
	<?php
	foreach ($key['son'] as $key){
	?>
	<tr align="center" bgcolor="#FFFFFF" height="26" onMouseMove="javascript:this.bgColor='#FCFDEE';" onMouseOut="javascript:this.bgColor='#FFFFFF';">
		<td nowrap><?php echo $key['id'];?></td>
		<td>-</td>
		<td><input type="text" name="list_order[<?php echo $key['id'];?>]" value="<?php echo $key['order_id'];?>" size="3" style="text-align:center" /></td>
		<td>　　　- <?php echo $key['set_caption'];?></td>
		<td><a href="?action=edit&set_id=<?php echo $set_id;?>&pid=<?php echo $pid;?>&sid=<?php echo $key['id'];?>">编辑</a> <a href="?action=del&set_id=<?php echo $set_id;?>&id=<?php echo $key['id'];?>">删除</a></td>
	</tr>
	<?php
	}}
	}else{
	foreach($set as $key){
	?>
	<tr align="center" bgcolor="#FFFFFF" height="26" onMouseMove="javascript:this.bgColor='#FCFDEE';" onMouseOut="javascript:this.bgColor='#FFFFFF';">
		<td nowrap><?php echo $key['id'];?></td>
		<td><?php echo $key['set_name'];?></td>
		<td><input type="text" name="list_order[<?php echo $key['id'];?>]" value="<?php echo $key['order_id'];?>" size="3" style="text-align:center" /></td>
		<td><?php echo $key['set_caption'];?></td>
		<td><a href="?action=edit&set_id=<?php echo $key['id'];?>">编辑</a></td>
	</tr>
	<?php
	}}
	?>
	<tr align="center" bgcolor="#FBFCE2" height="25">
		<td colspan="5"><input type="button" value=" 排序 " onclick="order.action='?action=order&set_id=<?php echo $set_id;?>';order.submit();"></td>
	</tr>
</table>
</form>
</body>
</html>
