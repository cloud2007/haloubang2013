<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>文档管理</title>
<link rel="stylesheet" type="text/css" href="css/base.css">
<style type="text/css">
table.config tr{ background:#FFFFFF; height:30px;}
table.config td{ padding:0 5px;}
.config input[type='text']{ border:1px solid #d5dee9; padding:3px}
select{ line-height:30px;}
</style>
<script type="text/javascript" src="js/FormValid.js"></script>
</head>
<body leftmargin="8" topmargin="8" background='images/allbg.gif'>
<!--  快速转换位置按钮  -->
<table width="98%" border="0" cellpadding="0" cellspacing="1" bgcolor="#ccd9b9" align="center">
	<tr>
		<td height="26" background="images/newlinebg3.gif" align="center">网站参数管理</td>
	</tr>
	<tr>
		<td height="26" bgcolor="#FFFFFF"></td>
	</tr>
</table>

<form name="config" method="post" action="">
	<input type="hidden" name="id" value="1" />
<table width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CFCFCF" align="center" style="margin-top:8px" class="config">
	<tr bgcolor="#E7E7E7" >
		<td height="28" colspan="2" background="images/tbg.gif" style="padding-left:10px;"> ◆ 基本参数 </td>
	</tr>
	<tr bgcolor="#FFFFFF" height="25">
		<td width="11%" align="right">网站标题</td>
		<td align="left"><input type="text" name="cfg[title]" value="<?php echo $datainfo->get('title');?>" /></td>
	</tr>
	<tr bgcolor="#FFFFFF" height="25">
		<td width="11%" align="right">所在城市</td>
		<td align="left"><input type="text" name="cfg[city]" value="<?php echo $datainfo->get('city');?>" /></td>
	</tr>
	<tr bgcolor="#FFFFFF" height="25">
		<td width="11%" align="right">地图坐标</td>
		<td align="left"><input type="text" name="cfg[coordinate]" value="<?php echo $datainfo->get('coordinate');?>" /></td>
	</tr>
	<tr bgcolor="#FFFFFF" height="25">
		<td width="11%" align="right">CNZZ统计代码</td>
		<td align="left"><textarea name="cfg[cnzzcode]" rows="3" style="width:98%; margin:5px"><?php echo $datainfo->get('cnzzcode');?></textarea></td>
	</tr>
	<tr bgcolor="#FFFFFF" height="25">
		<td width="11%" align="right">百度统计代码</td>
		<td align="left"><textarea name="cfg[baiducode]" rows="3" style="width:98%; margin:5px"><?php echo $datainfo->get('baiducode');?></textarea></td>
	</tr>
	<tr bgcolor="#FFFFFF" height="25">
		<td width="11%" align="right">备案号</td>
		<td align="left"><input type="text" name="cfg[basenum]" value="<?php echo $datainfo->get('basenum');?>" /></td>
	</tr>
	<tr bgcolor="#FFFFFF" height="25">
		<td width="11%" align="right">广告开关</td>
		<td align="left"><input type="text" size="2" name="cfg[ad_isshow]" value="<?php echo $datainfo->get('ad_isshow');?>" /> (只有值为1的时候显示广告)</td>
	</tr>
</table>
<table width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CFCFCF" align="center" style="margin-top:8px" class="config">
	<tr bgcolor="#E7E7E7" >
		<td height="28" colspan="2" background="images/tbg.gif" style="padding-left:10px;"> ◆ 联系方式 </td>
	</tr>
	<tr bgcolor="#FFFFFF" height="25">
		<td width="11%" align="right">公司名称</td>
		<td align="left"><input type="text" name="cfg[comname]" value="<?php echo $datainfo->get('comname');?>" /></td>
	</tr>
	<tr bgcolor="#FFFFFF" height="25">
		<td width="11%" align="right">公司地址</td>
		<td align="left"><input name="cfg[comaddr]" type="text" value="<?php echo $datainfo->get('comaddr');?>" size="80" /></td>
	</tr>
	<tr bgcolor="#FFFFFF" height="25">
		<td width="11%" align="right">邮政编号</td>
		<td align="left"><input type="text" name="cfg[youbian]" value="<?php echo $datainfo->get('youbian');?>" /></td>
	</tr>
	<tr bgcolor="#FFFFFF" height="25">
		<td width="11%" align="right">座机号码</td>
		<td align="left"><input type="text" name="cfg[tel]" value="<?php echo $datainfo->get('tel');?>" /></td>
	</tr>
	<tr bgcolor="#FFFFFF" height="25">
		<td width="11%" align="right">传真号码</td>
		<td align="left"><input type="text" name="cfg[fax]" value="<?php echo $datainfo->get('fax');?>" /></td>
	</tr>
	<tr bgcolor="#FFFFFF" height="25">
		<td width="11%" align="right">400电话</td>
		<td align="left"><input type="text" name="cfg[num400]" value="<?php echo $datainfo->get('num400');?>" /></td>
	</tr>
	<tr bgcolor="#FFFFFF" height="25">
		<td width="11%" align="right">上次更新时间</td>
		<td align="left"> <?php echo date('Y-m-d H:i:s',$datainfo->edittime);?></td>
	</tr>
	<tr align="center" bgcolor="#FBFCE2" height="25">
		<td colspan="5"><input type="button" value=" 保存 " onclick="config.action='?action=save';config.submit();"></td>
	</tr>
</table>
</form>
</body>
</html>
