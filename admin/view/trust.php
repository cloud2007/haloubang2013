<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>文档管理</title>
<link rel="stylesheet" type="text/css" href="css/base.css">
<script type="text/javascript" src="/js/FormValid.js"></script>
<SCRIPT language=JavaScript src="/js/alt.js"></SCRIPT>
<style type="text/css">
/*下面这个样式用来控制title属性显示的那个方框样式的*/
DIV#qTip {
	BORDER: #abab98 1px solid; 
	DISPLAY: none; 
	FONT-SIZE: 12px; 
	Z-INDEX: 1000; 
	BACKGROUND: #fefeda;
	COLOR: #5f5f52;
	LINE-HEIGHT: 16px;
	FONT-FAMILY: "Tahoma"; 
	POSITION: absolute; 
	TEXT-ALIGN: left;
	padding:4px;
	margin-top:-4px;
}
DIV#qTip p { line-height:18px;}
</style>
</head>
<body leftmargin="8" topmargin="8" background='images/allbg.gif'>
<!--  快速转换位置按钮  -->
<table width="98%" border="0" cellpadding="0" cellspacing="1" bgcolor="#ccd9b9" align="center">
	<tr>
		<td height="26" background="images/newlinebg3.gif" align="center">委托信息管理</td>
	</tr>
</table>

<table width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CFCFCF" align="center" style="margin-top:8px">
	<tr bgcolor="#E7E7E7" >
		<td height="28" colspan="8" background="images/tbg.gif" style="padding-left:10px;"> ◆ 委托信息列表 </td>
	</tr>
	<tr align="center" bgcolor="#FBFCE2" height="25">
		<td>ID</td>
		<td>姓名</td>
		<td>电话</td>
		<td>E-Mail</td>
		<td>详细信息</td>
		<td>添加时间</td>
		<td>状态</td>
		<td>操作</td>
	</tr>
	<?php foreach ($datalist as $key){?>
	<tr align="center" bgcolor="#FFFFFF" height="26" onMouseMove="javascript:this.bgColor='#FCFDEE';" onMouseOut="javascript:this.bgColor='#FFFFFF';">
		<td nowrap><?php echo $key->id;?></td>
		<td><?php echo $key->uname;?></td>
		<td><?php echo $key->tel;?></td>
		<td><?php echo $key->email;?></td>
		<td><?php echo $key->content;?></td>
		<td><?php echo $key->creatTime();?></td>
		<td><?php echo $key->states();?></td>
		<td><a href="?action=add&id=<?php echo $key->id;?>">处理</a> <a onclick="return confirm('真的要删除吗?')" href="?action=del&id=<?php echo $key->id;?>">删除</a> <a href="javascript:void(0);" onclick="alert('<?php echo $key->editcontent();?>');" target="_blank">处理历史</a></td>
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