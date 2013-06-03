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
		<td height="26" background="images/newlinebg3.gif" align="center">广告管理</td>
	</tr>
</table>

<table width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CFCFCF" align="center" style="margin-top:8px">
	<tr bgcolor="#E7E7E7" >
		<td height="28" colspan="6" background="images/tbg.gif" style="padding-left:10px;"> ◆ 广告管理 </td>
	</tr>
	<tr align="center" bgcolor="#FBFCE2" height="25">
		<td width="3%">ID</td>
		<td width="13%">广告名称</td>
		<td width="32%">广告位</td>
		<td width="24%">备注</td>
		<td width="16%">状态</td>
		<td width="12%">操作</td>
	</tr>
	<?php foreach ($datalist as $key){?>
	<tr align="center" bgcolor="#FFFFFF" height="26" onMouseMove="javascript:this.bgColor='#FCFDEE';" onMouseOut="javascript:this.bgColor='#FFFFFF';">
		<td nowrap><?php echo $key->id;?></td>
		<td><?php echo $key->title;?></td>
		<td><?php echo Config::item('ad_place.'.$key->place_id);?></td>
		<td><?php echo $key->beizhu;?></td>
		<td><?php if($key->states==1){echo "<font color='green'>正常</font>";}else{echo "<font color='red'>禁用</font>";}?></td>
		<td><a href="?action=edit&id=<?php echo $key->id;?>">编辑</a> <a onclick="return confirm('真的要删除吗?')" href="?action=del&id=<?php echo $key->id;?>">删除</a> <?php if($key->states==1){echo "<a href=\"?action=unused&id=".$key->id."\">禁用</a>";}else{echo "<a href=\"?action=used&id=".$key->id."\">启用</a>";}?></td>
	</tr>
	<?php }?>
</table>

<form id="form1" name="form1" method="post" onsubmit="return validator(this)" action="?action=save" autocomplete="off">
<table width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CFCFCF" align="center" style="margin-top:8px">
	<tr bgcolor="#E7E7E7" >
		<td height="28" colspan="2" background="images/tbg.gif" style="padding-left:10px;"> ◆ 添加/修改 </td>
	</tr>
	<tr align="center" bgcolor="#FFFFFF" height="25">
		<td width="21%" align="right">广告名称：<input type="hidden" name="id" value="<?php echo $datainfo->id;?>" /></td>
		<td width="79%" align="left"> <input type="text" name="title" value="<?php echo $datainfo->title;?>" /></td>
	</tr>
	<tr align="center" bgcolor="#FFFFFF" height="25">
		<td width="21%" align="right">广告位置：</td>
		<td width="79%" align="left">
			<select name="place_id">
				<option value="">选择广告位置</option>
				<?php foreach(Config::item('ad_place') as $k=>$v){?>
				<option value="<?php echo $k;?>" <?php if($datainfo->place_id==$k){echo 'selected';}?>><?php echo $v;?></option>
				<?php }?>
			</select>
			<font color="#FF0000">(如果选择图片链接必须上传一张logo图片(),文字链接可以不上传图片。)</font>
		</td>
	</tr>
	<tr align="center" bgcolor="#FFFFFF">
		<td width="21%" align="right">广告图片：</td>
		<td width="79%" align="left">
            <input name="pic" type="text" id="pic" value="<?php echo $datainfo->pic;?>" size="60" ><font color="#FF0000">(可以手动输入图片相对地址或者上传一张图片)</font>
		    <div id="image_dis" style="padding:3px 0 0 3px;"><?php if($datainfo->pic){?><img src="<?php echo $datainfo->pic;?>" width="88" height="31" /><?php }?></div>
            <iframe style="padding:0;" name="linkupload" width="100%" height="35" scrolling="No" frameborder="no"  src="/swfupload/class/pic_ad_upload.php" align="left"></iframe>
		</td>
	</tr>
	<tr align="center" bgcolor="#FFFFFF" height="25">
		<td width="21%" align="right">广告链接地址：</td>
		<td width="79%" align="left"> <input type="text" name="link" value="<?php echo $datainfo->link;?>" size="100" /></td>
	</tr>
	<tr align="center" bgcolor="#FFFFFF" height="25">
		<td width="21%" align="right">排序：</td>
		<td width="79%" align="left"> <input type="text" name="order" value="<?php echo $datainfo->order;?>" size="5" /></td>
	</tr>
	<tr align="center" bgcolor="#FFFFFF" height="25">
		<td width="21%" align="right">备注：</td>
		<td width="79%" align="left"><textarea name="beizhu" cols="60" rows="3" id="beizhu"><?php echo $datainfo->beizhu;?></textarea></td>
	</tr>
	<tr align="center" bgcolor="#FFFFFF" height="25">
		<td width="21%" align="right">是否启用：</td>
		<td width="79%" align="left"><input type="radio" name="states" value="1" <?php if($datainfo->states==1)echo 'checked';?> />是　<input type="radio" name="states" value="0" <?php if($datainfo->states!=1)echo 'checked';?> />否</td>
	</tr>
	<tr align="center" bgcolor="#FFFFFF" height="25">
		<td width="21%" align="right"></td>
		<td width="79%" align="left"><input type="submit" name="Submit" value="提交" /></td>
	</tr>
</table>
</form>
<script language="javascript">
function pic_ad_upload( furl ){
	document.getElementById('pic').value = furl;
	document.getElementById('image_dis').innerHTML = '<img src="'+furl+'" width="88" height="31">';
}
</script>
</body>
</html>