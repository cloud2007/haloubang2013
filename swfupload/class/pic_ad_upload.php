<?php
if($_GET['action']=='upload'){
require('Config.upload.php');
$uploader = new Uploader();
if($cfg[1]=='true'){
	$uploader -> needResize = true;
	$uploader -> enableSize = Config::item('thumb.'.$cfg[2]);
}
if($cfg[3]=='true'){
	$uploader->needWaterMark = Uploader::WATER_MARK_IMAGE;
}
$res = json_decode($uploader->save(),true);
echo "<script>
	var parentForm;
	if(window.opener){
		parentForm = window.opener;
	}else{
		parentForm = window.parent;
	}
	parentForm.pic_ad_upload('".$res['msg']."');
</script>";
}
?>
<html>
<head>
<title>上传文件</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
</head>
<body leftmargin="0" topmargin="0">
<table cellpadding="0" cellspacing="0" border="0" height="100%" align="left">
	<form action='?action=upload&cfg=ad|true|ad|false' method='post' enctype='multipart/form-data'>
		<tr >
			<td valign='middle'><input name='Filedata' type='file'  id='Filedata'>
				<input name='submit' type='submit'  id='presentsub' value='上传'></td>
		</tr>
	</form>
</table>
</body>
</html>