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
		<td height="26" background="images/newlinebg3.gif" align="center">楼盘字典管理</td>
	</tr>
	<tr>
		<td height="26" bgcolor="#FFFFFF">　<a href="borough.php">楼盘列表</a> | <a href="borough.php?action=add"><font color="red">添加楼盘</font></a></td>
	</tr>
</table>
<form name="order" method="post" onsubmit="return validator(this)" action="?action=save" class="form_box" >
	<table width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CFCFCF" align="center" style="margin-top:8px; " class="borough">
		<tr bgcolor="#E7E7E7" >
			<td height="28" colspan="4" background="images/tbg.gif" style="padding-left:10px;"> ◆ <strong>楼盘概要</strong> </td>
		</tr>
		<tr >
			<td width="10%" align="right" >楼盘名称</td>
			<td width="29%"><input name="b_name" type="text" id="b_name" value="<?php echo $datainfo->b_name;?>" valid="required" errmsg="楼盘名称未填！" onblur="checkborough();" />
				<input type="hidden" name="id" value="<?php echo $datainfo->id;?>" />
				<input type="hidden" name="b_addid" value="<?php echo $user['id'];?>" />
				<input type="hidden" name="b_addname" value="<?php echo $user['name'];?>" /><span id="btip" style="color:#FF0000"></span></td>
			<td width="12%" align="right">楼盘级别</td>
			<td width="49%"><select name="b_level" id="b_level" valid="required" errmsg="楼盘级别未选择！">
					<option value="">请选择楼盘级别</option>
					<?php foreach(Config::item("borough_level") as $key => $value){?>
					<option value="<?php echo $key;?>" <?php if($datainfo->b_level == $key) echo "selected";?>><?php echo $value;?></option>
					<?php }?>
				</select>
			</td>
		</tr>
		<tr>
			<td align="right">楼盘地址</td>
			<td colspan="3"><input name="b_addr" type="text" id="b_addr" size="80" value="<?php echo $datainfo->b_addr;?>" valid="required" errmsg="楼盘地址未填！" /></td>
		</tr>
		<tr>
			<td align="right">地图坐标</td>
			<td colspan="3"><input name="b_map" type="text" id="b_map" value="<?php echo $datainfo->b_map;?>" />
				<a href="http://api.map.baidu.com/lbsapi/getpoint/index.html" target="_blank">如何手动获取坐标？</a><font color="#FF0000" >添加方式：加英文括号"()"复制坐标粘贴到括号内</font></td>
		</tr>
		<tr>
			<td width="10%" align="right">楼盘区域</td>
			<td width="29%"><select name="b_area1" id="b_area1" style="float:left; margin-right:5px;" valid="required" errmsg="楼盘区域未选择！">
					<option value="">选择楼盘区域</option>
					<?php foreach(Config::item("borough_area") as $key => $value){?>
					<option value="<?php echo $key;?>" <?php if($datainfo->b_area1 == $key) echo "selected";?>><?php echo $value;?></option>
					<?php }?>
				</select>
				<div id="quote"></div>
				<script language="javascript">
					$("#b_area1").change(function(){
					$("#quote").load("ajax_area.php?id="+$("#b_area1").val()+"&"+Math.random());
					});
					$("#quote").load("ajax_area.php?id="+$("#b_area1").val()+"&area2=<?php echo $datainfo->b_area2;?>&"+Math.random());
				</script>
			</td>
			<td width="12%" align="right">用途</td>
			<td width="49%"><select name="b_used" id="select" style="float:left; margin-right:5px;">
					<option value="">选择物业类型</option>
					<?php foreach(Config::item("borough_type") as $key => $value){?>
					<option value="<?php echo $key;?>" <?php if($datainfo->b_used == $key) echo "selected";?>><?php echo $value;?></option>
					<?php }?>
				</select></td>
		</tr>
		<tr>
			<td width="10%" align="right">已入驻企业</td>
			<td colspan="3" style="padding:5px;"><textarea name="b_company" rows="3" id="b_company" style="width:99%; overflow:hidden"><?php echo $datainfo->b_company;?></textarea></td>
		</tr>
		<tr>
			<td width="10%" align="right">楼盘介绍</td>
			<td colspan="3" style="padding:5px;"><textarea name="b_content" rows="3" id="b_content" style="width:99%; overflow:hidden"><?php echo $datainfo->b_content;?></textarea></td>
		</tr>
		<tr>
			<td width="10%" align="right">楼盘配套</td>
			<td colspan="3"><?php foreach(Config::item("borough_support") as $key => $value){?>
				<input name="b_support[]" type="checkbox" id="b_support[]" value="<?php echo $key;?>" <?php if($datainfo->checkSupport($key) !== false)echo "checked";?> />
				<?php echo $value;?>
				<?php }?>
			</td>
		</tr>
	</table>
	<table width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CFCFCF" align="center" style="margin-top:8px" class="borough">
		<tr bgcolor="#E7E7E7" >
			<td height="28" colspan="4" background="images/tbg.gif" style="padding-left:10px;"> ◆ <strong>物业概况</strong> </td>
		</tr>
		<tr>
			<td width="10%" align="right">物业公司</td>
			<td width="29%"><input name="wy[wuyegongsi]" type="text" id="wy[wuyegongsi]" value="<?php echo $datainfo -> get('wuyegongsi');?>" /></td>
			<td width="12%" align="right">物业费</td>
			<td width="49%"><input name="wy[wuyefei]" type="text" id="wy[wuyefei]" size="10" value="<?php echo $datainfo -> get('wuyefei');?>" valid="isNumber" errmsg="物业费只能是数字!" />
				元/m<sup>2</sup></td>
		</tr>
		<tr>
			<td width="10%" align="right">物业支付方式</td>
			<td width="29%"><input name="wy[zhifufangsi]" type="text" id="wy[zhifufangsi]" value="<?php echo $datainfo -> get('zhifufangsi');?>" /></td>
			<td width="12%" align="right">&nbsp;</td>
			<td width="49%">&nbsp;</td>
		</tr>
		<tr>
			<td width="10%" align="right">地上车位</td>
			<td width="29%"><input name="wy[chewei1]" type="text" id="wy[chewei1]" value="<?php echo $datainfo -> get('chewei1');?>" />
				个（临停）</td>
			<td width="12%" align="right">地下车位</td>
			<td width="49%"><input name="wy[chewei2]" type="text" id="wy[chewei2]" value="<?php echo $datainfo -> get('chewei2');?>" />
				个</td>
		</tr>
		<tr>
			<td width="10%" rowspan="3" align="right">停车费用</td>
			<td width="29%">&nbsp;&nbsp;1.8L以下
				<input name="wy[tingchefei1]" type="text" id="wy[tingchefei1]" value="<?php echo $datainfo -> get('tingchefei1');?>" />
				元/月</td>
			<td width="12%" rowspan="3" align="right">备注</td>
			<td width="49%" rowspan="3" style="padding:5px;"><textarea name="wy[beizhu]" rows="3" id="wy[beizhu]" style="width:99%; overflow:hidden"><?php echo $datainfo -> get('beizhu');?></textarea></td>
		</tr>
		<tr>
			<td>1.8L至2.0L
				<input name="wy[tingchefei2]" type="text" id="wy[tingchefei2]" value="<?php echo $datainfo -> get('tingchefei2');?>" />
				元/月</td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;2.0L以上
				<input name="wy[tingchefei3]" type="text" id="wy[tingchefei3]" value="<?php echo $datainfo -> get('tingchefei3');?>" />
				元/月</td>
		</tr>
	</table>
	<table width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CFCFCF" align="center" style="margin-top:8px" class="borough">
		<tr bgcolor="#E7E7E7" >
			<td height="28" colspan="4" background="images/tbg.gif" style="padding-left:10px;"> ◆ <strong>建筑参数</strong> </td>
		</tr>
		<tr>
			<td width="10%" align="right">总建筑面积</td>
			<td width="29%"><input name="jz[zongmianji]" type="text" id="jz[zongmianji]" value="<?php echo $datainfo -> get('zongmianji');?>" />
				m<sup>2</sup></td>
			<td width="12%" align="right">占地面积</td>
			<td width="49%"><input name="jz[zandimianji]" type="text" id="jz[zandimianji]" value="<?php echo $datainfo -> get('zandimianji');?>" />
				m<sup>2</sup></td>
		</tr>
		<tr>
			<td width="10%" align="right">标准层面积</td>
			<td width="29%"><input name="jz[cengmianji]" type="text" id="jz[cengmianji]" value="<?php echo $datainfo -> get('cengmianji');?>" />
				m<sup>2</sup></td>
			<td width="12%" align="right">外墙</td>
			<td width="49%"><input name="jz[waiqiang]" type="text" id="jz[waiqiang]" value="<?php echo $datainfo -> get('waiqiang');?>" /></td>
		</tr>
		<tr>
			<td width="10%" align="right">总 楼 层</td>
			<td width="29%"><input name="jz[zonglouceng]" type="text" id="jz[zonglouceng]" value="<?php echo $datainfo -> get('zonglouceng');?>" />
				层</td>
			<td width="12%" align="right">标准层高</td>
			<td width="49%"><input name="jz[cenggao]" type="text" id="jz[cenggao]" value="<?php echo $datainfo -> get('cenggao');?>" />
				m</td>
		</tr>
		<tr>
			<td width="10%" align="right">净  高</td>
			<td width="29%"><input name="jz[jinggao]" type="text" id="jz[jinggao]" value="<?php echo $datainfo -> get('jinggao');?>" />
				m</td>
			<td width="12%" align="right">大堂层高</td>
			<td width="49%"><input name="jz[datangcenggao]" type="text" id="jz[datangcenggao]" value="<?php echo $datainfo -> get('datangcenggao');?>" />
				m</td>
		</tr>
		<tr>
			<td width="10%" align="right">容 积 率</td>
			<td width="29%"><input name="jz[rongjilv]" type="text" id="jz[rongjilv]" value="<?php echo $datainfo -> get('rongjilv');?>" /></td>
			<td width="12%" align="right">绿 化 率</td>
			<td width="49%"><input name="jz[lvhualv]" type="text" id="jz[lvhualv]" value="<?php echo $datainfo -> get('lvhualv');?>" />
				%</td>
		</tr>
		<tr>
			<td width="10%" align="right">总 户 数</td>
			<td width="29%"><input name="jz[zonghushu]" type="text" id="jz[zonghushu]" value="<?php echo $datainfo -> get('zonghushu');?>" />
				户</td>
			<td width="12%" align="right">开盘时间</td>
			<td width="49%"><input name="b_opentime" type="text" id="b_opentime" value="<?php echo date('Y-m-d',$datainfo -> get('b_opentime'));?>" onClick="WdatePicker({skin:'whyGreen',readOnly:'True'})" /></td>
		</tr>
		<tr>
			<td width="10%" align="right">楼盘售价区间</td>
			<td width="29%"><input name="b_saletprice1" type="text" id="b_saletprice1" size="10" value="<?php echo $datainfo -> get('b_saletprice1');?>" />
				-
				<input name="b_saletprice2" type="text" id="b_saletprice2" size="10" value="<?php echo $datainfo -> get('b_saletprice2');?>" /></td>
			<td width="12%" align="right">楼盘租金区间</td>
			<td width="49%"><input name="b_rentprice1" type="text" id="b_rentprice1" size="10" value="<?php echo $datainfo -> get('b_rentprice1');?>" />
				-
				<input name="b_rentprice2" type="text" id="b_rentprice2" size="10" value="<?php echo $datainfo -> get('b_rentprice2');?>" /></td>
		</tr>
		<tr>
			<td width="10%" align="right">交房时间</td>
			<td width="29%"><input name="b_begintime" type="text" id="b_begintime" value="<?php echo date('Y-m-d',$datainfo -> get('b_begintime'));?>" onClick="WdatePicker({skin:'whyGreen',readOnly:'True'})" /></td>
			<td width="12%" align="right">结构</td>
			<td width="49%"><input name="jz[jiegou]" type="text" id="jz[jiegou]" value="<?php echo $datainfo -> get('jiegou');?>" /></td>
		</tr>
		<tr>
			<td width="10%" align="right">面积参数</td>
			<td width="29%" style="padding:5px;"><textarea name="jz[mianjicanshu]" rows="3" id="jz[mianjicanshu]" style="width:99%; overflow:hidden"><?php echo $datainfo -> get('mianjicanshu');?></textarea></td>
			<td width="12%" align="right">得房率</td>
			<td width="49%"><input name="jz[defanglv]" type="text" id="jz[defanglv]" value="<?php echo $datainfo -> get('defanglv');?>" /></td>
		</tr>
		<tr>
			<td width="10%" align="right">避难层或者设备层</td>
			<td width="29%"><input name="jz[shebeiceng]" type="text" id="jz[shebeiceng]" value="<?php echo $datainfo -> get('shebeiceng');?>" /></td>
			<td width="12%" align="right">办公楼层</td>
			<td width="49%"><input name="jz[bangongceng]" type="text" id="jz[bangongceng]" value="<?php echo $datainfo -> get('bangongceng');?>" /></td>
		</tr>
		<tr>
			<td width="10%" align="right">建筑高度</td>
			<td width="29%"><input name="jz[jianzhugaodu]" type="text" id="jz[jianzhugaodu]" value="<?php echo $datainfo -> get('jianzhugaodu');?>" /></td>
			<td width="12%" align="right">写字楼架高地板高度</td>
			<td width="49%"><input name="jz[loujiagaodu]" type="text" id="jz[loujiagaodu]" value="<?php echo $datainfo -> get('loujiagaodu');?>" /></td>
		</tr>
		<tr>
			<td width="10%" align="right">楼板载重</td>
			<td width="29%"><input name="jz[zaizhong]" type="text" id="jz[zaizhong]" value="<?php echo $datainfo -> get('zaizhong');?>" /></td>
			<td width="12%" align="right">开发商</td>
			<td width="49%"><input name="jz[kaifashang]" type="text" id="jz[kaifashang]" value="<?php echo $datainfo -> get('kaifashang');?>" /></td>
		</tr>
	</table>
	<table width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CFCFCF" align="center" style="margin-top:8px" class="borough">
		<tr bgcolor="#E7E7E7" >
			<td height="28" colspan="4" background="images/tbg.gif" style="padding-left:10px;"> ◆ <strong>设备</strong> </td>
		</tr>
		<tr>
			<td width="10%" align="right">电梯</td>
			<td width="29%">客梯
				<input name="sb[keti]" type="text" id="sb[keti]" size="3" value="<?php echo $datainfo -> get('keti');?>" />
				部 货梯
				<input name="sb[huoti]" type="text" id="sb[huoti]" size="3" value="<?php echo $datainfo -> get('huoti');?>" />
				部 转乘梯
				<input name="sb[zhuancengti]" type="text" id="sb[zhuancengti]" size="3" value="<?php echo $datainfo -> get('zhuancengti');?>" />
				部</td>
			<td width="12%" align="right">电梯品牌</td>
			<td width="49%"><input name="sb[diantipinpai]" type="text" id="sb[diantipinpai]" value="<?php echo $datainfo -> get('diantipinpai');?>" /></td>
		</tr>
		<tr>
			<td width="10%" align="right">电梯有无分区</td>
			<td width="29%"><input type="radio" name="sb[diantifenqu]" value="1" <?php if($datainfo -> get('diantifenqu')==1)echo "checked";?> />
				有
				<input type="radio" name="sb[diantifenqu]" value="0" <?php if($datainfo -> get('diantifenqu')==0)echo "checked";?> />
				无</td>
			<td width="12%" align="right">空调品牌</td>
			<td width="49%"><input name="sb[kongtiaopinpai]" type="text" id="sb[kongtiaopinpai]" value="<?php echo $datainfo -> get('kongtiaopinpai');?>" /></td>
		</tr>
		<tr>
			<td width="10%" align="right">空调系统</td>
			<td width="29%"><input name="sb[kongtiaoxitong]" type="text" id="sb[kongtiaoxitong]" value="<?php echo $datainfo -> get('kongtiaoxitong');?>" /></td>
			<td width="12%" align="right">空调开放时间</td>
			<td width="49%"><input name="sb[kaifangshijian]" type="text" id="sb[kaifangshijian]" value="<?php echo $datainfo -> get('kaifangshijian');?>" /></td>
		</tr>
		<tr>
			<td width="10%" align="right">备注</td>
			<td width="29%"><input name="sb[beizhu]" type="text" id="sb[beizhu]" value="<?php echo $datainfo -> get('beizhu');?>" /></td>
			<td width="12%" align="right">电费</td>
			<td width="49%"><input name="sb[dianfei]" type="text" id="sb[dianfei]" value="<?php echo $datainfo -> get('dianfei');?>" /></td>
		</tr>
		<tr>
			<td width="10%" align="right">供电系统</td>
			<td width="29%"><input name="sb[gongdianxitong]" type="text" id="sb[gongdianxitong]" value="<?php echo $datainfo -> get('gongdianxitong');?>" /></td>
			<td width="12%" align="right">通讯系统</td>
			<td width="49%"><input name="sb[tongxunxitong]" type="text" id="sb[tongxunxitong]" value="<?php echo $datainfo -> get('tongxunxitong');?>" /></td>
		</tr>
		<tr>
			<td width="10%" align="right">安防系统</td>
			<td width="29%"><input name="sb[anfangxitong]" type="text" id="sb[anfangxitong]" value="<?php echo $datainfo -> get('anfangxitong');?>" /></td>
			<td width="12%" align="right">&nbsp;</td>
			<td width="49%">&nbsp;</td>
		</tr>
	</table>
	<table width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CFCFCF" align="center" style="margin-top:8px" class="borough">
		<tr bgcolor="#E7E7E7" >
			<td height="28" colspan="4" background="images/tbg.gif" style="padding-left:10px;"> ◆ <strong>周边配套</strong> </td>
		</tr>
		<tr>
			<td width="10%" align="right">公交线路</td>
			<td width="29%"><input name="zb[gongjiao]" type="text" id="zb[gongjiao]" value="<?php echo $datainfo -> get('gongjiao');?>" /></td>
			<td width="12%" align="right">地铁线路</td>
			<td width="49%"><?php foreach(Config::item("borough_metro") as $key => $value){?>
				<input name="b_subway[]" type="checkbox" id="b_subway[]" value="<?php echo $key;?>" <?php if($datainfo->checkSubway($key) !== false)echo "checked";?> />
				<?php echo $value;?>
				<?php }?>
			</td>
		</tr>
		<tr>
			<td width="10%" align="right">银行邮政</td>
			<td width="29%"><input name="zb[yinghang]" type="text" id="zb[yinghang]" value="<?php echo $datainfo -> get('yinghang');?>" /></td>
			<td width="12%" align="right">划片小学</td>
			<td width="49%"><input name="zb[xiaoxue]" type="text" id="zb[xiaoxue]" value="<?php echo $datainfo -> get('xiaoxue');?>" /></td>
		</tr>
		<tr>
			<td width="10%" align="right">划片中学</td>
			<td width="29%"><input name="zb[zhongxue]" type="text" id="zb[zhongxue]" value="<?php echo $datainfo -> get('zhongxue');?>" /></td>
			<td width="12%" align="right">医院药房</td>
			<td width="49%"><input name="zb[yiyuan]" type="text" id="zb[yiyuan]" value="<?php echo $datainfo -> get('yiyuan');?>" /></td>
		</tr>
		<tr>
			<td width="10%" align="right">超市商场</td>
			<td width="29%"><input name="zb[chaoshi]" type="text" id="zb[chaoshi]" value="<?php echo $datainfo -> get('chaoshi');?>" /></td>
			<td width="12%" align="right">餐馆酒店</td>
			<td width="49%"><input name="zb[jiudian]" type="text" id="zb[jiudian]" value="<?php echo $datainfo -> get('jiudian');?>" /></td>
		</tr>
		<tr>
			<td width="10%" align="right">公园景观</td>
			<td colspan="3"><?php foreach(Config::item("borough_sight") as $key => $value){?>
				<input name="b_sight[]" type="checkbox" id="b_sight[]" value="<?php echo $key;?>" <?php if($datainfo->checkSight($key) !== false)echo "checked";?> />
				<?php echo $value;?>
				<?php }?>
			</td>
		</tr>
	</table>
	<table width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CFCFCF" align="center" style="margin-top:8px" class="borough">
		<tr bgcolor="#E7E7E7" >
			<td height="28" background="images/tbg.gif" style="padding-left:10px;"> ◆ <strong>楼盘图片</strong> </td>
		</tr>
		<tr>
			<td><link href="../swfupload/css/uploadify.css" rel="stylesheet" type="text/css" />
				<link href="../swfupload/css/upload.css" rel="stylesheet" type="text/css" />
				<div class="upload_class <?php if(!is_array($piclist)) echo 'hide';?>">
					<!--p><b>分类详情</b>上传更多类型的照片，成为<a href="/help/content/help_center_66" target="_blank">精品房源</a>，获得更多的效果。</p-->
					<ul class="class_list">
						<?php
						foreach(Config::item('borough_pictype') as $key => $value){
						?>
						<li id="subcate_class_<?php echo $key;?>"><?php echo $value;?></li>
						<?php }?>
					</ul>
				</div></td>
		</tr>
		<tr>
			<td style="padding:10px;" id="uuuppp"><div id="info">
					<ul>
						<?php
                        if(is_array($piclist)){
						$z_index = 200;
                        foreach($piclist as $key){
                        ?>
						<li id="<?php echo 'subcates_'.$key->id;?>" style="z-index:<?php echo $z_index;?>">
							<div class="list_img"> <img src="<?php echo $key->pic_thumb;?>"></div>
							<?php if($key->pic_is_default==1){?>
							<div class="default_box" style="display: block;"><span class="default_picbg"></span><span class="default_pictext"><a>默认图片</a></span></div>
							<?php }else{?>
							<div class="default_box" style="display: none;"><span class="default_picbg"></span><span class="default_pictext"><a>设为默认图</a></span></div>
							<?php }?>
							<span class="closed"></span>
							<div id="select_<?php echo $key->id;?>" class="list_select"><em> <?php echo $key->showCate();?> </em>
								<div class="choice" style="display: none;"><i></i>
									<?php
								foreach(Config::item('borough_pictype') as $k => $v){
								?>
									<span subcate="<?php echo $k."_".$k;?>"><?php echo $v;?></span>
									<?php }?>
								</div>
							</div>
							<input type="hidden" name="pic_id[]" value="<?php echo $key->id;?>">
							<input type="hidden" name="pic_thumb[]" value="<?php echo $key->pic_thumb;?>">
							<input type="hidden" name="pic_sub_cate[]" id="subcate_<?php echo $key->id;?>" value="<?php echo $key->pic_sub_cate;?>">
							<input type="hidden" name="pic_is_default[]" value="<?php echo $key->pic_is_default;?>">
							<input type="hidden" name="pic_category[]" value="<?php echo $key->pic_sub_cate;?>">
						</li>
						<?php
						$z_index = $z_index-1;
						}}
						?>
					</ul>
				</div>
				<div class="myuploadbutton1">
								<input id="upload_button_js1" type="file" name="file" size="1"/>
								<p class="tips">上传高清照片(像素比例660*450),图片大小不要超过2M</p>
							</div>
							<div class="myuploadbutton" style="display:none">
								<input id="upload_button_js" type="file" name="file" size="1"/>
							</div>
				<!--div class="myuploadbutton">
					<input id="upload_button_js" type="file" name="file" size="1"/>
				</div-->
			</td>
		</tr>
	</table>
	<table width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CFCFCF" align="center" style="margin-top:8px" class="borough">
		<tr bgcolor="#E7E7E7" >
			<td height="28" colspan="4" background="images/tbg.gif" style="padding-left:10px;"> ◆ <strong>其他</strong> </td>
		</tr>
		<tr>
			<td width="10%" align="right">是否涉外</td>
			<td width="29%"><input type="radio" name="qt[shewai]" value="1" <?php if($datainfo -> get('shewai')==1)echo "checked";?> />
				是
				<input type="radio" name="qt[shewai]" value="0" <?php if($datainfo -> get('shewai')==0)echo "checked";?> />
				否</td>
			<td width="12%" align="right">是否可以涉外</td>
			<td width="49%"><input type="radio" name="qt[shewai1]" value="1" <?php if($datainfo -> get('shewai1')==1)echo "checked";?> />
				可以
				<input type="radio" name="qt[shewai1]" value="0" <?php if($datainfo -> get('shewai1')==0)echo "checked";?> />
				不可以</td>
		</tr>
		<tr>
			<td width="10%" align="right">装修保证金</td>
			<td width="29%"><input name="qt[baozhengjin]" type="text" id="qt[baozhengjin]" value="<?php echo $datainfo -> get('baozhengjin');?>" /></td>
			<td width="12%" align="right">装修审图费</td>
			<td width="49%"><input name="qt[shentufei]" type="text" id="qt[shentufei]" value="<?php echo $datainfo -> get('shentufei');?>" /></td>
		</tr>
		<tr>
			<td width="10%" align="right">楼盘发布选项</td>
			<td width="29%"><input name="b_states" type="radio" value="1" checked="checked" <?php if($datainfo -> b_states !==0)echo "checked";?> />
				正式发布
				<input type="radio" name="b_states" value="0" <?php if($datainfo -> b_states == 0)echo "checked";?> />
				保存为草稿</td>
			<td width="12%" align="right"></td>
			<td width="49%"><input name="b_creattime" type="hidden" id="b_creattime" value="<?php echo $datainfo->b_creattime;?>" /></td>
		</tr>
	</table>
	<table width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CFCFCF" align="center" style="margin-top:8px" class="borough">
		<tr bgcolor="#E7E7E7" >
			<td height="28" background="images/tbg.gif" style=" text-align:center; padding:7px 0 0 0"><input name="sumbmit" type="image" src="images/button_save.gif" width="60" height="22" class="np" border="0"  style="cursor:pointer;"/>
				<img src="images/button_reset.gif" width="60" height="22" border="0" onClick="location.reload();" style="cursor:pointer; "/></td>
		</tr>
	</table>
</form>
<div id="infos"></div>
<div id="back"></div>
<script src="/js/My97DatePicker/WdatePicker.js" language="javascript"></script>
<script type="text/javascript" src="../swfupload/scripts/swfobject.js"></script>
<script type="text/javascript" src="../swfupload/scripts/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript" src="../swfupload/myupload.js"></script>
</body>
</html>
<script type="text/javascript">
//var z_index=99;
//var category_data_assemble = {"1":<?php if($jsons[1]){echo $jsons[1];}else{echo 0;}?>,"2":0,"3":0,"4":0,"5":0,"6":0,"7":0,"8":0,"9":0,"10":0,"11":0,"12":0};
var category_data_assemble = {
    <?php for($i=1;$i<13;$i++){?>
            "<?php echo $i;?>":<?php if($jsons[$i]){echo $jsons[$i];}else{echo 0;}?>,
    <?php }?>
}
var category_data_all = {"1":["\u5916\u7acb\u9762",0],"2":["\u5927\u697c\u5165\u53e3",0],"3":["\u5927\u5802",0],"4":["\u7535\u68af\u5385",0],"5":["\u516c\u5171\u8d70\u5eca",0],"6":["\u536b\u751f\u95f4",0],"7":["\u697c\u5185\u914d\u5957",0],"8":["\u529e\u516c\u533a\u57df",0],"9":["\u505c\u8f66\u573a",0],"10":["\u9ad8\u5c42\u666f\u89c2",0],"11":["\u5468\u8fb9\u73af\u5883",0],"12":["\u5e73\u9762\u56fe",0]};
</script>
<script type="text/javascript">
var editor;
KindEditor.ready(function(K) {
	editor = K.create('textarea[name="b_content"]', {
		uploadJson : '/kind/php/upload_json.php',
        fileManagerJson : '/kind/php/file_manager_json.php',
		allowFileManager : true,
		resizeType : 1,
		allowPreviewEmoticons : true,
		allowImageUpload : true,
		items : [
			'source','fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
			'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright','|', 'emoticons', 'image', 'link']
	});
});


<?php if(is_array($piclist)) {?>
	var initype=1;
<?php }else{?>
	var initype=2;
<?php }?>
</script>

<script type="text/javascript">
function checkborough(){
var b_name = $('#b_name').val();
$("#btip").load("ajax_borough.php?b_name="+b_name+"&"+Math.random());
}
</script>