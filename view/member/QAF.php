<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="/public/css/base.css"/>
<link rel="stylesheet" type="text/css" href="/css/web_name.css"/>
<link rel="stylesheet" type="text/css" href="/js/Autocomlete/jquery.autocomplete.css" />
<script type="text/javascript" src="/public/js/jquery-1.6.2.min.js"></script>
<script type='text/javascript' src='/js/Autocomlete/jquery.autocomplete.js'></script>
<script type="text/javascript" src="/js/FormValid.js"></script>
<script type="text/javascript" src="/kind/kindeditor-min.js"></script>
<script type="text/javascript" src="/js/thickbox-compressed.js" ></script>
<link href="/css/thickbox.css" media="screen" rel="stylesheet" type="text/css" />
<style type="text/css">
table.borough tr{ background:#FFFFFF; height:30px;}
table.borough td{ padding:0 5px;}
</style>
<script type="text/javascript">
$().ready(function() {

	$("#b_name").autocomplete("/ajax.borough.autocomlete.php", {
		selectFirst: false,
		formatItem: function(data, i, total) {
			return data[1];
		},
		formatResult: function(data, i, total) {
			return data[1];
		}
	});

	$("#b_name").result(function(event, data, formatted) {
		document.getElementById('borough_infos').style.display="block";
		if (data){
			$('#b_id').val(data[0]);
			$('#b_addr').val(data[2]);
			$('#b_area1').val(data[4]);
			$('#b_area2').val(data[5]);
			$('#b_used').val(data[6]);
			$('#b_level').val(data[3]);
			$('#b_floor').val(data[7]);
            $('#b_subway').val(data[8]);
			$('#b_opentime').val(data[9]);
			$("#pic_load").load("/ajax.borough_pic.php?bid="+data[0]+'&rnd='+Math.random());
		}
	});
	
	$("#pic_load").load("/ajax.borough_pic.php?bid="+$('#b_id').val()+'&rnd='+Math.random());
})
</script>
<title>成都写字楼出租出售专业网站 - 好楼帮</title>
</head>
<body id="b_bg">
<div class="content">
	<?php require('left.php');?>
	<div id="person_right" >
	<div class="percon_title "> <span class="title_l" >QAF 常见问题及解答</span> </div>
	<div class="r_con_0">
	
    
    <h2>问题1：怎么才能发布房源？</h2>
    <p>首先要认证头像，以及经纪人资格证书。</p>
	
</div>
</div>
<div style="clear:both"></div>
</div>
</body>
</html>
<script type="text/javascript" src="../swfupload/scripts/swfobject.js"></script>
<script type="text/javascript" src="../swfupload/scripts/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript">
function count(){
	var area = $("#area").val();
	var price = $("#price").val();
	var count;
	if(area>0 && price>0){
		count = area * price;
		$("#count_tips").html(count+' 元');
	}else{
		$("#count_tips").html("请先填写完整信息!");
	}
}

function pic_hxt_upload(msg){
	$("#pic_hxt").val(msg);
	$("#pic_hxt_tips").html('<a target="_blank" href="'+msg+'"><img style="border:1px solid #999999; padding:2px;" src="'+msg+'" width="100" height="60" /></a>');
}
function pic_pmt_upload(msg){
	$("#pic_pmt").val(msg);
	$("#pic_pmt_tips").html('<a target="_blank" href="'+msg+'"><img style="border:1px solid #999999; padding:2px;" src="'+msg+'" width="100" height="60" /></a>');
}
</script>
<script type="text/javascript">
//var z_index=99;
//var category_data_assemble = {"1":<?php if($jsons[1]){echo $jsons[1];}else{echo 0;}?>,"2":0,"3":0,"4":0,"5":0,"6":0,"7":0,"8":0,"9":0,"10":0,"11":0,"12":0};
var category_data_assemble = {
    <?php for($i=1;$i<13;$i++){?>
            "<?php echo $i;?>":<?php if($jsons[$i]){echo $jsons[$i];}else{echo 0;}?>,
    <?php }?>
}
var category_data_all = {"1":["\u5916\u7acb\u9762",0],"2":["\u5927\u697c\u5165\u53e3",0],"3":["\u5927\u5802",0],"4":["\u7535\u68af\u5385",0],"5":["\u516c\u5171\u8d70\u5eca",0],"6":["\u536b\u751f\u95f4",0],"7":["\u697c\u5185\u914d\u5957",0],"8":["\u529e\u516c\u533a\u57df",0],"9":["\u505c\u8f66\u573a",0],"10":["\u9ad8\u5c42\u666f\u89c2",0],"11":["\u5468\u8fb9\u73af\u5883",0],"12":["\u6237\u578B\u56FE",0],"13":["\u697C\u5C42\u5E73\u9762\u56FE",0]};
</script>
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
<script type="text/javascript" src="../swfupload/myupload_house.js"></script>
<script type="text/javascript" src="/js/jquery.lightbox-0.5.js"></script>
<link rel="stylesheet" type="text/css" href="/css/jquery.lightbox-0.5.css" media="screen" />
<script type="text/javascript">
    $(function() {
        $('.r_p a').lightBox();
    });
    </script>
