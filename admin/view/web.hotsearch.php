<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>文档管理</title>
<link rel="stylesheet" type="text/css" href="css/base.css">
</head>
<body leftmargin="8" topmargin="8" background='images/allbg.gif'>
<form name="config" method="post" action="">
<table width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CFCFCF" align="center" style="margin-top:8px" class="config">
	<tr bgcolor="#E7E7E7" >
		<td height="28" colspan="2" background="images/tbg.gif" style="padding-left:10px;"> ◆ 在下面方框中写入热门搜索,多个关键词用英文逗号(,)分割. </td>
	</tr>
	<tr bgcolor="#FFFFFF" height="25">
		<td width="11%" align="right">热门搜索关键词</td>
		<td align="left"><textarea name="notice" rows="20" style="width:98%; margin:5px"><?php echo $notice;?></textarea></td>
	</tr>
	<tr align="center" bgcolor="#FBFCE2" height="25">
		<td colspan="5"><input type="button" value=" 保存 " onclick="config.action='?action=save';config.submit();"></td>
	</tr>
</table>
</form>
</body>
</html>
