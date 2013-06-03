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
		<td height="26" background="images/newlinebg3.gif" align="center">新闻管理</td>
	</tr>
	<tr>
		<td height="26" bgcolor="#FFFFFF">　<a href="news.php"><font color="red">新闻列表</font></a> | <a href="news.php?action=add">添加楼盘</a> | <a href="news.php">草稿箱</a></td>
	</tr>
</table>
<form name="order" method="post" onsubmit="return validator(this)" action="?action=save" class="form_box" >
	<table width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CFCFCF" align="center" style="margin-top:8px; " class="borough">
		<tr bgcolor="#E7E7E7" >
			<td height="28" colspan="2" background="images/tbg.gif" style="padding-left:10px;"> ◆ <strong>新闻添加</strong> </td>
		</tr>
		<tr>
			<td width="13%" align="right" >新闻标题</td>
			<td width="87%" colspan="3"><input name="title" type="text" id="title" value="<?php echo $datainfo->title;?>" size="50" valid="required" errmsg="新闻标题未填！" /><input type="hidden" name="addid" value="<?php echo $user['id'];?>" /><input type="hidden" name="addname" value="<?php echo $user['name'];?>" /><input type="hidden" name="id" value="<?php echo $datainfo->id;?>" /></td>
		</tr>
		<tr>
			<td width="13%" align="right" >新闻类别</td>
			<td>
				<select name="type" id="type" valid="required" errmsg="新闻类别未选择！">
					<option value="">请选择新闻类别</option>
					<?php foreach(Config::item("news_type") as $key => $value){?>
					<option value="<?php echo $key;?>" <?php if($datainfo->type == $key) echo "selected";?>><?php echo $value;?></option>
					<?php }?>
				</select>
			</td>
		</tr>
		<tr>
			<td width="13%" align="right" >阅读数</td>
			<td><input type="text" name="hits" id="hits" value="<?php echo $datainfo->hits;?>" /> <font style="color:#999999">填写正整数，如不填写则默认初始为0</font></td>
		</tr>
		<tr>
			<td width="13%" align="right" >附加图片</td>
			<td><input type="hidden" name="pic" id="pic" value="<?php echo $datainfo->pic;?>" />
		    	<div id="image_dis" style="padding:3px 0 0 3px;"><?php if($datainfo->pic){?><img src="<?php echo $datainfo->pic;?>" width="88" height="31" /><?php }?></div>
            <iframe style="padding:0;" name="linkupload" width="100%" height="35" scrolling="No" frameborder="no"  src="/swfupload/class/pic_news_upload.php" align="left"></iframe></td>
		</tr>
		<tr>
			<td width="13%" align="right" >来源</td>
			<td><input type="text" name="source" id="source" value="<?php echo $datainfo->source;?>" /> <a href="javascript:void(0);" onclick="javascript:write_source('原创');">原创</a> <a href="javascript:void(0);" onclick="javascript:write_source('网络');">网络</a></td>
		</tr>
		<tr>
			<td width="13%" align="right" >属性</td>
			<td><input type="checkbox" name="att[]" value="h" <?php if($datainfo -> att('h')!==false)echo 'checked="checked"';?> />头条 <input type="checkbox" name="att[]" value="j" <?php if($datainfo -> att('j')!==false)echo 'checked="checked"';?> />推荐</td>
		</tr>
		<tr>
			<td width="13%" align="right">新闻内容<br />
			换行使用ALT+ENTER</td>
			<td style="padding:5px;"><textarea name="content" rows="30" id="content" style="width:99%; overflow:hidden"><?php echo $datainfo->content;?></textarea></td>
		</tr>
		<tr>
			<td width="13%" align="right">发布选项</td>
			<td width="87%"><input name="states" type="radio" value="1" checked="checked" <?php if($datainfo -> states !==0)echo "checked";?> />
				正式发布
				<input type="radio" name="states" value="0" <?php if($datainfo -> states == 0)echo "checked";?> />
			保存为草稿</td>
	</table>
	<table width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CFCFCF" align="center" style="margin-top:8px" class="borough">
		<tr bgcolor="#E7E7E7" >
			<td height="28" background="images/tbg.gif" style=" text-align:center; padding:7px 0 0 0"><input name="sumbmit" type="image" src="images/button_save.gif" width="60" height="22" class="np" border="0"  style="cursor:pointer;"/>
				<img src="images/button_reset.gif" width="60" height="22" border="0" onClick="location.reload();" style="cursor:pointer; "/></td>
		</tr>
	</table>
</form>
</body>
</html>
<script type="text/javascript">
var editor;
KindEditor.ready(function(K) {
	editor = K.create('textarea[name="content"]', {
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
</script>

<script language="javascript">
function pic_news_upload( furl ){
	document.getElementById('pic').value = furl;
	document.getElementById('image_dis').innerHTML = '<img src="'+furl+'" width="88" height="31">';
}

function write_source( str ){
	document.getElementById('source').value = str ;
}
</script>