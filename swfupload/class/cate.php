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
	parentForm.linkupload1('".$res['msg']."');
</script>";
}
?>
<html>
<head>
<title>上传文件</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">



</head>



<body leftmargin="0" topmargin="0">


<div class="file-box"> 
<form action='?action=upload&cfg=cate|true|cate|false' method='post' enctype='multipart/form-data'> 

<span style="font-size:12px;">上传图片不得超过2M</span>
<input name='Filedata' type='file' class="file"  id='Filedata' size="20" onChange="document.getElementById('textfield').value=this.value" /> 
<input name='submit' type='submit' class="btn"  id='presentsub' value='上传证书' /> 
</form> 
</div> 


</body>
</html>