<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>添加信息</title>
<link href="css/uploadify.css" rel="stylesheet" type="text/css" />
<style>
#infos{ display:none}
#info ul li{ list-style:none; float:left; width:200px; height:200px; margin:10px; border:1px solid #000000}
</style>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
var flash_buttonImg = "http://pages.jinpu.com/images/newmy/upload_bigbottom.gif";
var flash_buttonImg_small = "http://pages.jinpu.com/images/newmy/upload_smallbottom.gif";
$(document).ready(function() {
	$("#upload_button_js").uploadify({
		'uploader'       : 'scripts/uploadify.swf',
		'script'         : 'class/upload.php?cfg=link|false|link|false',
		'cancelImg'      : 'images/cancel.png',
		'width'          : '110',
		'height'         : '30',
		'wmode'          : 'transparent',  //falsh透明
		'buttonImg'      : flash_buttonImg,
		'fileDesc'       : '允许上传的文件列表',
		'fileExt'        : '*.gif;*.jpg;*.bmp;*.png;*.jpeg;*.png',
		'queueID'        : 'infos',
		'auto'           : true, //自动上传
		'multi'          : true, //允许上传多个文件
		//'sizeLimit'      : 86400, //控制上传文件的大小，单位byte
		'onSelect'       : function(event,ID,fileObj) {
      						$('#info ul').append('<li id="'+ID+'">12</li>');
							},
		'onSelectOnce'   : function(event,data){},
		'onProgress' : function(event,ID,fileObj,data){
						//$('#upinfo').html(data.percentage);	
						//var bytes = Math.round(data.bytesLoaded / 1024);
						//var bytes = Math.round(data.bytesLoaded / 1024);
						//alert(data.percentage);
						
		},
		'onComplete'	 : function(event, queueID, fileObj, response, data) {						
                        var json = eval("(" + response + ")");        
						alert(json['msg']);         
                        //$('#back').append( json['msg']);                            
			}
	})
	
})
</script>
</head>
<body>
<div class="upload_default" id="upload_default">
	<div id="upload_button" class="upload_bottom" >
		<input id="upload_button_js" type="file" name="file" size="1"/>
	</div>
</div>

<div id="infos"></div>
<div id="info"><ul></ul></div>
<script type="text/javascript" src="scripts/swfobject.js"></script>
<script type="text/javascript" src="scripts/jquery.uploadify.v2.1.4.min.js"></script>
<script type="text/javascript" src="myupload.js"></script>
</body>
</html>
