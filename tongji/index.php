<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="JavaScript" src="js/FusionCharts.cnzz.js"></script>
<title>图形报表统计</title>
</head>
<body>
<h1 align="center">出租出售房源总数</h1>
<div id='rentsale' align="center">
<script type="text/javascript">  
	var chart = new FusionCharts('js/Pie2D.swf', "ChartId", "400", "300");  
	chart.setDataURL("rentsale.php?rnd=<?php echo rand();?>");
	chart.render('rentsale');  
</script>
</div>

<hr />

<h1 align="center">过去30天发布房源情况</h1>
<div id="week" align="center">
<script type="text/javascript">  
	var chart = new FusionCharts('js/MSLine.swf', "ChartId", "760", "220");
	chart.setDataURL("week.php?rnd=<?php echo rand();?>");
	chart.render('week');  
</script>
</div>

<hr />

<h1 align="center">经纪人发布情况</h1>
<div id='borkernum' align="center">
<script type="text/javascript">  
	var chart = new FusionCharts('js/Pie2D.swf', "ChartId", "400", "300");  
	chart.setDataURL("borkernum.php?rnd=<?php echo rand();?>");
	chart.render('borkernum');  
</script>
</div>

<hr />

<h1 align="center">经纪人发布情况2</h1>
<div id='colunm' align="center">
<script type="text/javascript">
	var so = new FusionCharts("js/Column2D.swf", "ChartId", "760", "260");		
	so.setDataURL("xml.column.php?rnd=<?php echo rand();?>");
	so.addParam("wmode","transparent");	
	so.render("colunm");
</script> 
</div>

<hr />

<h1 align="center">房源区域分布</h1>
<div id='areanum' align="center">
<script type="text/javascript">  
	var chart = new FusionCharts('js/Pie2D.swf', "ChartId", "400", "300");  
	chart.setDataURL("areanum.php?rnd=<?php echo rand();?>");
	chart.render('areanum');  
</script>
</div>
</body>
</html>
