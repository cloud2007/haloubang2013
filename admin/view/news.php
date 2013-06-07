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
		<td height="26" background="images/newlinebg3.gif" align="center">楼盘管理</td>
	</tr>
</table>
<form id="search" name="search" method="post" action="news.php">
<table width="98%" border="0" cellpadding="0" cellspacing="1" bgcolor="#ccd9b9" align="center" style="margin-top:8px">
	<tr>
		<td height="26" background="images/newlinebg3.gif" style="padding:0 0 0 10px;">
			<input type="text" name="q" onblur="if(this.value ==''||this.value == '请输入关键字'){this.value = '请输入关键字';this.style.color = '#999999';}" onfocus="if(this.value == '请输入关键字'){this.value = '';this.style.color = '#333333';}" value="请输入关键字" size="35" >
			<select name="type" id="type">
				<option value="">请选择新闻类别</option>
				<?php foreach(Config::item("news_type") as $key => $value){?>
				<option value="<?php echo $key;?>"><?php echo $value;?></option>
				<?php }?>
			</select>
			<input type="submit" name="dosubmit" value=" 查询 " class="button_style">
		</td>
	</tr>
</table>
</form>
<table width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CFCFCF" align="center" style="margin-top:8px">
	<tr bgcolor="#E7E7E7" >
		<td height="28" colspan="10" background="images/tbg.gif" style="padding-left:10px;"> ◆ 楼盘列表 </td>
	</tr>
	<tr align="center" bgcolor="#FBFCE2" height="25">
		<td>ID</td>
		<td>新闻标题</td>
		<td>新闻类别</td>
		<td>添加人</td>
		<td>来源</td>
		<td>添加时间</td>
		<td>修改时间</td>
		<td>属性</td>
		<td>发布状态</td>
		<td>操作</td>
	</tr>
	<?php foreach ($datalist as $key){?>
	<tr align="center" bgcolor="#FFFFFF" height="26" onMouseMove="javascript:this.bgColor='#FCFDEE';" onMouseOut="javascript:this.bgColor='#FFFFFF';">
		<td nowrap><?php echo $key->id;?></td>
		<td><?php echo $key->title;?><?php if($key->borough_id)echo '<a style="color:red" href="/newborough/d-'.$key->borough_id.'.html" target="_blank">(所属新盘ID:'.$key->borough_id.')</a>';?></td>
		<td><?php echo $key->type <> 0 ? Config::item('news_type.'.$key->type) : '未选';?></td>
		<td><?php echo $key->addname;?></td>
		<td><?php echo $key->source;?></td>
		<td><?php echo $key->creatTime();?></td>
		<td><?php echo $key->editTime();?></td>
		<td><?php echo $key->showatt();?></td>
		<td><?php echo $key->states();?></td>
		<td><a href="?action=add&id=<?php echo $key->id;?>">编辑</a> <a onclick="return confirm('真的要删除吗?')" href="?action=del&id=<?php echo $key->id;?>">删除</a></td>
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
<script src="/js/My97DatePicker/WdatePicker.js" language="javascript"></script>
