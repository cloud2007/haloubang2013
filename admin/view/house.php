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
		<td height="26" background="images/newlinebg3.gif" align="center">房源管理</td>
	</tr>
</table>
<form id="search" name="search" method="post" action="borough.php">
<!--table width="98%" border="0" cellpadding="0" cellspacing="1" bgcolor="#ccd9b9" align="center" style="margin-top:8px">
	<tr>
		<td height="26" background="images/newlinebg3.gif" style="padding:0 0 0 10px;"> 起止时间：
			<input type="text" name="btime" size="11" onClick="WdatePicker({skin:'whyGreen',readOnly:'True'})" />
			-
			<input type="text" name="etime" size="11" onClick="WdatePicker({skin:'whyGreen',readOnly:'True'})" />
			经纪人：
			<input type="text" name="bname" size="11" value="" />
			<select name="cityarea">
				<option value="">所在区域</option>
				<?php foreach(Config::item("borough_area") as $key => $value){?>
				<option value="<?php echo $key;?>" <?php if($datainfo->b_area1 == $key) echo "selected";?>><?php echo $value;?></option>
				<?php }?>
			</select>
			<input type="text" name="q" onblur="if(this.value ==''||this.value == '请输入楼盘名称,楼盘地址'){this.value = '请输入楼盘名称,楼盘地址';this.style.color = '#999999';}" onfocus="if(this.value == '请输入楼盘名称,楼盘地址'){this.value = '';this.style.color = '#333333';}" value="请输入楼盘名称,楼盘地址" size="35" >
			&nbsp;
			<input type="submit" name="dosubmit" value=" 查询 " class="button_style">
		</td>
	</tr>
</table-->
</form>
<table width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CFCFCF" align="center" style="margin-top:8px">
	<tr bgcolor="#E7E7E7" >
		<td height="28" colspan="10" background="images/tbg.gif" style="padding-left:10px;"> ◆ 房源列表 </td>
	</tr>
	<tr align="center" bgcolor="#FBFCE2" height="25">
		<td>ID</td>
		<td>楼盘名称</td>
		<td>房间号</td>
		<td>租价/单价</td>
		<td>面积</td>
		<td>添加时间</td>
		<td>经纪人</td>
		<td>类型</td>
		<td>状态</td>
		<td>操作</td>
	</tr>
	<?php foreach ($datalist as $key){?>
	<tr align="center" bgcolor="#FFFFFF" height="26" onMouseMove="javascript:this.bgColor='#FCFDEE';" onMouseOut="javascript:this.bgColor='#FFFFFF';">
		<td nowrap><?php echo $key->id;?></td>
		<td><?php echo $key->b_name;?></td>
		<td><?php echo $key->roomnum;?></td>
		<td><?php echo $key->price;?></td>
		<td><?php echo $key->area;?></td>
		<td><?php echo $key->creatTime();?></td>
		<td><?php echo $key->borker();?></td>
		<td><?php echo $key->type();?></td>
		<td><?php echo $key->showstates();?></td>
		<td><a href="/<?php if($key->type==1){echo 'rent';}else{echo 'sale';}?>/details.php?id=<?php echo $key->id;?>" target="_blank">查看</a> <a onclick="return confirm('真的要删除吗?')" href="?action=del&id=<?php echo $key->id;?>">删除</a></td>
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
