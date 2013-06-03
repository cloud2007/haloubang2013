<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php require('../inc/common.inc.php');?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>添加信息</title>
<link href="css/uploadify.css" rel="stylesheet" type="text/css" />
<link href="css/upload.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://pages.jinpu.com/js/jquery-1.6.min.js"></script>
</head>
<body style="padding:10px;">
<table width="820" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #C5C5C5;">
	<tr>
		<td>
			<div class="upload_class">
				<p><b>分类详情</b>上传更多类型的照片，成为<a href="/help/content/help_center_66" target="_blank">精品房源</a>，获得更多的效果。</p>
				<ul class="class_list">
					<?php
					foreach(Config::item('borough_pictype') as $key => $value){
					?>
					<li id="subcate_class_<?php echo $key;?>"><?php echo $value;?></li>
					<?php }?>
				</ul>
			</div>
		</td>
	</tr>
	<tr>
		<td style="padding:10px;"><div id="info"><ul></ul></div><div class="myuploadbutton"><input id="upload_button_js" type="file" name="file" size="1"/></div></td>
	</tr>
</table>

<div id="infos"></div>
<div id="back"></div>
<script type="text/javascript" src="scripts/swfobject.js"></script>
<script type="text/javascript" src="scripts/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript" src="myupload.js"></script>
</body>
</html>
<script type="text/javascript">
var category_data_assemble = {"1":0,"2":0,"3":0,"4":0,"5":0,"6":0,"7":0,"8":0,"9":0,"10":0,"11":0,"12":0};
var category_data_all = {"1":["\u5916\u7acb\u9762",2],"2":["\u5927\u697c\u5165\u53e3",1],"3":["\u5927\u5802",1],"4":["\u7535\u68af\u5385",1],"5":["\u516c\u5171\u8d70\u5eca",1],"6":["\u536b\u751f\u95f4",1],"7":["\u697c\u5185\u914d\u5957",1],"8":["\u529e\u516c\u533a\u57df",1],"9":["\u505c\u8f66\u573a",1],"10":["\u9ad8\u5c42\u666f\u89c2",2],"11":["\u5468\u8fb9\u73af\u5883",2],"12":["\u5e73\u9762\u56fe",3]};
</script>