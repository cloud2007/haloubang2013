<?php require_once('../config.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>读取房源</title>
<style type="text/css">
li{ list-style:inside; list-style:none}
#info{ width:554px; height:432px; position:absolute; background:url(/img/map/info.gif); top:50%; left:50%; margin-left:-277px; margin-top:-216px; display:none}
body{ font-size:12px;}
.info_title{ height:35px; line-height:35px; font-size:14px; padding:0 0 0 10px; color:#FFF; font-weight:bold;}
.info_title span{ float:right; margin:0 22px 0 0; width:50px; height:26px; text-indent:-999em}
.info_title span a{width:46px; height:27px; display:block;}
.main{ width:554px; height:397px;}
.main .left{ width:130px; height:395px; border-right:1px solid #ccc; float:left; padding:0 0 0 2px}
dl{ line-height:20px;border-bottom:1px solid #ccc; padding:0 0 0 10px}
dt{ font-weight:bold; color:#073FC6}
p{ line-height:30px; padding:0 0 0 20px;}
a{ color:#073FC6; text-decoration:none;}
a:hover{ color:#FF6600; text-decoration:underline;}
.main .right{ width:419px; float:right; margin:0 2px 0 0}
.postion{ height:30px; line-height:30px; background:#E2F2FE; padding:0 10px}
.postion span{ float:right;}
.main .right li{ border-bottom:1px solid #C0DBF8; padding:3px 0;}

.hover{ color:#FF6600; font-weight:bold;}
</style>
<script type="text/javascript">
$(function(){
	$('.mianji').each(function(){  //编列所有元素
		$(this).bind('click',function(){	//绑定click事件
			$('.mianji').removeClass('hover'); //所有的删除class bg2
			$(this).addClass('hover');     //这一个添加bg2
			var mianji=$(this).attr('rel');
			$('#mianji').val(mianji);
			house();
		})
	})//面积
	
	$('.zujin').each(function(){  //编列所有元素
		$(this).bind('click',function(){	//绑定click事件
			$('.zujin').removeClass('hover'); //所有的删除class bg2
			$(this).addClass('hover');     //这一个添加bg2
			var zujin=$(this).attr('rel');
			$('#zujin').val(zujin);
			house();
		})
	})//租金
	
	house();
})

function house(page){
	if(!page)page=1;
	var id=$('#id').val();
	var mianji=$('#mianji').val();
	var zujin=$('#zujin').val();
	var order=$('#order').val();
	if(!order)order="id";
	var data='id='+id+'&mianji='+mianji+'&zujin='+zujin+'&order='+order+'&PageNo='+page;
	data+='&rnd='+Math.random();
	var loading='<div style="text-align:center;padding:50px 0;width:100%;"><img src="images/loading.gif" /><br /><br />数据加载中...请等待!</div>';
	$("#result").html(loading);
	$.ajax({
		url:'search2.php',
		type:'post',
		data:data,
		error:function(){alert('request error');},
		success:function(msg){
			if(msg!='error'){
				$('#result').html(msg);
			}else{
				alert("抱歉,数据出错");
			}
		}
	})

}
</script>
</head>

<body>
<?php
$id=$_POST['id'];
$borough = new Borough();
?>
<input type="hidden" id="id" value="<?php echo $id;?>" />
<input type="hidden" id="mianji" value="" />
<input type="hidden" id="zujin" value="" />
<div class="info_title"><span><a href="javascript:void(0);" onclick="closeinfo()">Close</a></span><?php echo $borough->b_name;?></div>
<div class="main">
	<div class="left">
		<dl>
			<dt>按面积筛选</dt>
			<dd><a class="mianji hover" href="javascript:void(0);" rel="">不限</a></dd>
			<dd><a class="mianji" href="javascript:void(0);" rel="100,150">100-150平米</a></dd>
			<dd><a class="mianji" href="javascript:void(0);" rel="150,200">150-200平米</a></dd>
			<dd><a class="mianji" href="javascript:void(0);" rel="200,300">200-300平米</a></dd>
			<dd><a class="mianji" href="javascript:void(0);" rel="300,500">300-500平米</a></dd>
			<dd><a class="mianji" href="javascript:void(0);" rel="500,1000">500-1000平米</a></dd>
			<dd><a class="mianji" href="javascript:void(0);" rel="1000,100000">1000平米以上</a></dd>
		</dl>
		<dl>
			<dt>总价</dt>
			<dd><a class="zujin hover" href="javascript:void(0);" rel="">不限</a></dd>
			<dd><a class="zujin" href="javascript:void(0);" rel="0,100">100万元以下</a></dd>
			<dd><a class="zujin" href="javascript:void(0);" rel="100,200">100-200万</a></dd>
			<dd><a class="zujin" href="javascript:void(0);" rel="200,300">200-300万</a></dd>
			<dd><a class="zujin" href="javascript:void(0);" rel="300,500">300-500万</a></dd>
			<dd><a class="zujin" href="javascript:void(0);" rel="500,800">500-800万</a></dd>
			<dd><a class="zujin" href="javascript:void(0);" rel="800,1200">800-1200万</a></dd>
			<dd><a class="zujin" href="javascript:void(0);" rel="1200,2000">1200-2000万</a></dd>
			<dd><a class="zujin" href="javascript:void(0);" rel="2000,1000000000">2000万以上</a></dd>
		</dl>
		<p><a href="">查看楼盘详情>>></a></p>
	</div>
	<div class="right" id="result">
		<div style="text-align:center;padding:50px 0;width:100%;"><img src="images/loading.gif" /><br /><br />数据加载中...请等待!</div>
	</div>
</div>

</body>
</html>
