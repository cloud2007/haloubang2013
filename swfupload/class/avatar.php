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



<body leftmargin="0" topmargin="0" >


<div class="file-box"> 
<form action='?action=upload&cfg=avatar|true|avatar|false' method='post' enctype='multipart/form-data'> 

<span style="font-size:12px;">请上传 100*75 比例的头像；否则会失真。</span>
<input name='Filedata' type='file' class="file"  id='Filedata' size="20" onChange="document.getElementById('textfield').value=this.value" /> 
<input name='submit' type='submit' class="btn"  id='presentsub' value='上传该头像' /> 
</form> 
</div> 


</body>
</html>