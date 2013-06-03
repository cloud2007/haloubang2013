<?php
if($_GET['action']=='upload'){
require('Config.upload.php');
$uploader = new Uploader();
if($cfg[1]=='true'){
	$uploader -> needResize = true;
	$uploader -> cfgfile = $cfg[2];
}
if($cfg[3]=='true'){
	$uploader->needWaterMark = Uploader::WATER_MARK_IMAGE;
}
echo $uploader->save();
}
?>
<html>
<head>
<title>上传文件</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
</head>
<body leftmargin="0" topmargin="0">
<table cellpadding="2" cellspacing="1" border="0" height="100%" align="left">
	<form action='?action=upload&cfg=link|false|link|false' method='post' enctype='multipart/form-data'>
		<tr >
			<td valign='middle'><input type='file'  id='Filedata' name='Filedata'>
				<input name='submit' type='submit'  id='presentsub' value='上传'></td>
		</tr>
	</form>
</table>
</body>
</html>