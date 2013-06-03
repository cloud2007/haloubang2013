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
	parentForm.linkupload('".$res['msg']."');
</script>";
}
?>
<html>
<head>
<title>上传文件</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
</head>
<body leftmargin="0" topmargin="0">
<table cellpadding="2" cellspacing="1" border="0" height="100%" align="left">
	<form action='?action=upload&cfg=pic|true|link|true' method='post' enctype='multipart/form-data'>
		<tr >
			<td valign='middle'><input type='file'  id='Filedata' name='Filedata'>
				<input name='submit' type='submit'  id='presentsub' value='上传'></td>
		</tr>
	</form>
</table>
</body>
</html>