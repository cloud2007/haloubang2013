<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="/public/css/base.css"/>
<link rel="stylesheet" type="text/css" href="/css/web_name.css"/>
<script language="JavaScript" src="/tongji/js/FusionCharts.cnzz.js"></script>
<title>成都写字楼出租出售专业网站 - 好楼帮</title>
</head>
<body id="b_bg">
<div class="content">
	<?php require('left.php');?>
	<div id="person_right" >
		<div class="percon_title "> <span class="title_l" >数据统计</span> </div>
		<div class="r_con_0">
		
			<h1 align="center">出租出售房源总数</h1>
			<div id='rentsale' style="text-align:center">
			<script type="text/javascript">  
				var chart = new FusionCharts('/tongji/js/Pie2D.swf', "ChartId", "400", "300");  
				chart.setDataURL("rentsale.php?rnd=<?php echo rand();?>");
				chart.render('rentsale');  
			</script>
			</div>
			
			<br />
			
			<h1 align="center">过去30天发布房源情况</h1>
			<div id="week" align="center">
			<script type="text/javascript">  
				var chart = new FusionCharts('/tongji/js/MSLine.swf', "ChartId", "760", "220");
				chart.setDataURL("week.php?rnd=<?php echo rand();?>");
				chart.render('week');  
			</script>
			</div>
			
			<div style="clear:both"></div>
		</div>
	</div>
	<div style="clear:both"></div>
</div>
</body>
</html>
