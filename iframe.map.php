<?php require_once('config.php');?>
<?php
$borough = new Borough();
$borough -> load($_GET['id']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>房源地图展示</title>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.5&ak=BCa4753e543535e8c1ab7f470ebf1bea"></script>
<link rel="stylesheet" type="text/css" href="/public/css/base.css"/>
<style type="text/css">
/*-----------------------------具体的地图-----------------------------------*/
.con{ height:345px; }
.con .con_l{ padding-left:30px; padding-top:5px; float:left;}
.con .con_r{  float:right; margin-top:5px; margin-right:30px !important; margin-right:18px; width:300px; }
.con .con_r h2{ height:50px; color:#282828; }
.con .con_r ul{ border-bottom:1px solid #e4e4df; overflow:hidden;}
.con .con_r ul li{ width:130px; float:left; height:30px;}
.con .con_r ul li a { display:block;  height:18px; line-height:18px;}
.con .con_r ul li a input{ margin-right:10px;}
.con .con_r h3{ height:25px;  font-size:14px; font-weight:bold; color:#4b4b4b; line-height:25px; clear:left;}
.con .con_r p{ color:#939393;}
.con .con_r button{ height:28px; width:101px; background:url(../img/info_10.jpg) no-repeat; border:none; cursor:pointer; margin-top:28px;}
/*-----------------------------具体的地图end-----------------------------------*/

</style>
</head>

<body>
<div class="con">
	<div class="con_l" id="allmap" style="width:604px; height:337px;"><img src="../img/info_07.jpg" width="604" height="337" alt=""></div>
	<div class="con_r">
		<h2>周边情况</h2>
		<ul >
			<li><a href="javascript:void(0);" onClick="fun_searchNearbys('银行');"><input type="checkbox" name="check" value="银行" />银行</a></li>
			<li><a href="javascript:void(0);" onClick="fun_searchNearbys('超市');"><input type="checkbox" name="check" value="超市" />超市</a></li>
			<li><a href="javascript:void(0);" onClick="fun_searchNearbys('地铁');"><input type="checkbox" name="check" value="地铁" />地铁</a></li>
			<li><a href="javascript:void(0);" onClick="fun_searchNearbys('公交');"><input type="checkbox" name="check" value="公交" />公交</a></li>
			<li><a href="javascript:void(0);" onClick="fun_searchNearbys('商场');"><input type="checkbox" name="check" value="商场" />商场</a></li>
			<li><a href="javascript:void(0);" onClick="fun_searchNearbys('餐饮');"><input type="checkbox" name="check" value="餐饮" />餐饮</a></li>
			<li><a href="javascript:void(0);" onClick="fun_searchNearbys('酒店');"><input type="checkbox" name="check" value="酒店" />酒店</a></li>
			<li><a href="javascript:void(0);" onClick="fun_searchNearbys('学校');"><input type="checkbox" name="check" value="学校" />学校</a></li>
			<li><a href="javascript:void(0);" onClick="fun_searchNearbys('医院');"><input type="checkbox" name="check" value="医院" />医院</a></li>
		</ul>
		<h3><?php echo $borough->b_name;?></h3>
		<p><?php echo $borough->b_addr;?></p>
		<button onClick="window.open('/map','','scrollbars=yes,status=yes')"></button>
	</div>
</div>
<script type="text/javascript">

var map = new BMap.Map("allmap");
var point = new BMap.Point(<?php echo Util::maping($borough->b_map);?>);
var marker = new BMap.Marker(point);
var opts = {
  width : 250,     // 信息窗口宽度
  height: 100,     // 信息窗口高度
  title : "<a href='/borough/details.php?id=<?php echo $borough->id;?>' style='font-size:14px; color:#000; line-height:150%;' target='_blank'><?php echo $borough->b_name;?></a>"  // 信息窗口标题
}
map.centerAndZoom(point, 15);
map.addOverlay(marker);
var infoWindow = new BMap.InfoWindow("<span style='font-size:12px; color:#999; line-height:150%;'><?php echo $borough->b_addr;?></span><br><a href='/rent/?b_id=<?php echo $borough->id;?>' style='font-size:12px; color:#f90; line-height:150%;' target='_blank'>出租房源:<?php echo $borough->gethousenum(1);?>套</a><br><a href='/sale/?b_id=<?php echo $borough->id;?>' style='font-size:12px; color:#f90; line-height:150%;' target='_blank'>出售房源:<?php echo $borough->gethousenum(2);?>套</a>", opts);  // 创建信息窗口对象
marker.openInfoWindow(infoWindow);//提示信息
marker.addEventListener("click", function(){          
   this.openInfoWindow(infoWindow);  
});
map.addControl(new BMap.NavigationControl());//鱼骨控件


//智能搜索Localsearch类
//周边搜索fun_searchNearby方法
var options = {renderOptions: {map: map, panel: "results"}};
var myLocalsearch = new BMap.LocalSearch(map,options);
function fun_searchNearbys(type){
	var tmp="";
	var arr = document.getElementsByTagName("input");
	for(var i=0;i<arr.length;i++){
	if(arr[i].type == "checkbox" && arr[i].checked){
		tmp = tmp + "," + arr[i].value;  
		}
	}
	tmp = tmp.substring(1);
	var myKeys = tmp.split(",")
	myLocalsearch.searchNearby(myKeys,new BMap.Point(<?php echo Util::maping($borough->b_map);?>),500);
}
</script>
</body>
</html>