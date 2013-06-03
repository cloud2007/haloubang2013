<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $web_title;?></title>
<meta name="keywords" content="<?php echo $web_keywords;?>" />
<meta name="description" content="<?php echo $web_description;?>" />
<style type="text/css">
*{margin:0; padding:0; font-size:12px;}
li{ list-style:none}
body, html{width: 100%;height: 100%;overflow: hidden;margin:0;font-family:"微软雅黑", "宋体";}
#top{ border-bottom:3px solid #92acda; height:50px; background:url(/img/map/top_bg.gif); overflow:hidden;}

#top .logo{ background:url(/img/map/logo.png) 10px -10px no-repeat; width:180px; height:50px; float:left;}
#top .logo a{ display:block; width:150px; height:50px;}
#top .search{ padding:10px 0 0 20px; float:left;}
#top .quick{ line-height:50px; padding:0 0 0 30px; float:left; position:relative; display:none;}
#top .quick .bankuai{ position:absolute; top:35px; left:90px; border:1px solid #EC6200; background:#FFFFFF; width:150px; padding:5px; z-index:0}
#top .quick .bankuai li{ float:left; width:50px; text-align:center; line-height:25px;}
#top .quicka { padding:4px;}

.fh_hlb a { float:right; background:url(/img/map/back.png) no-repeat; width:128px; height:31px; display:block; margin-top:10px; margin-right:10px;}

#main1{width: 100%;height: 100%; }
#main1 .left{ float:left; width:200px;}
#main1 .right{ position:absolute; top:53px; left:200px; width:100%; height:100%;overflow: hidden;margin:0; border-left:1px solid #7A7978;}
#allmap{width: 100%;height: 90%;overflow: hidden;margin:0;}

#info{ width:554px; height:432px; position:absolute; background:url(/img/map/info.gif); top:50%; left:50%; margin-left:-277px; margin-top:-216px; display:none}

.clear{ clear:both;}
.hover{ color:#FF6600; font-weight:bold; text-decoration:none;}
#main1 .left .nav{ border-bottom:1px solid #CCCCCC; padding:0 0 10px 10px;}
#main1 .left .nav a{ color:#0041D9; text-decoration:none;}
#main1 .left .nav a.hover{ color:#FF6600; font-weight:bold; text-decoration:none;}
#main1 .left .tit{ font-weight:bold; line-height:30px; height:30px}
#main1 .left .nav ul li{ float:left; width:45%; line-height:20px;}

input.wd{ background:url(/img/map/text.gif); border:0; width:271px; height:27px; line-height:27px; padding:0 0 0 28px;vertical-align:middle}
input.button{ background:url(/img/map/button.gif); border:0; width:77px; height:27px; line-height:27px;vertical-align:middle}
input.button:hover{ background:url(/img/map/button1.gif); border:0; width:77px; height:27px; line-height:27px;}

</style>
<script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.3"></script>
<script type="text/javascript" src="/js/baidumap2.js"></script>
<script type="text/javascript">
$(function(){

	$('.mj').each(function(){  //编列所有元素
		$(this).bind('click',function(){	//绑定click事件
			$('.mj').removeClass('hover'); //所有的删除class bg2
			$(this).addClass('hover');     //这一个添加bg2
			var mj=$(this).attr('rel');
			$('#mj').val(mj);
			gotourl();
		})
	})//面积
	
	$('.rz').each(function(){  //编列所有元素
		$(this).bind('click',function(){	//绑定click事件
			$('.rz').removeClass('hover'); //所有的删除class bg2
			$(this).addClass('hover');     //这一个添加bg2
			var mj=$(this).attr('rel');
			$('#rz').val(mj);
			gotourl();
		})
	})//面积
	
	$('.yz').each(function(){  //编列所有元素
		$(this).bind('click',function(){	//绑定click事件
			$('.yz').removeClass('hover'); //所有的删除class bg2
			$(this).addClass('hover');     //这一个添加bg2
			var yz=$(this).attr('rel');
			$('#yz').val(yz);
			gotourl();
		})
	})//面积
	
	$('.bk').each(function(){  //编列所有元素
		$(this).bind('click',function(){	//绑定click事件
			$('.bk').removeClass('hover'); //所有的删除class bg2
			$(this).addClass('hover');     //这一个添加bg2
			var bk=$(this).attr('rel');
			$('#bk').val(bk);
			gotourl();
		})
	})//面积
	
})

function gotourl(){
	var mj=$('#mj').val();
	var rz=$('#rz').val();
	var yz=$('#yz').val();
	var wd=$('#wd').val();
	if(wd='输入楼盘名称搜索！')wd="";
	var bk=$('#bk').val();
	location.href='?mj='+mj+"&rz="+rz+"&yz="+yz+"&wd="+wd+'&bk='+bk;
}

function show(){
	var zindex = document.getElementById("zindex");
	zindex.style.zIndex="-1";
	//var quicka = document.getElementById("quicka");
	//quicka.style.border="1px solid #EC6200";
	//quicka.style.borderBottom="0px solid #EC6200";
	//quicka.style.padding="4px";
	//quicka.style.zIndex="9999";
	//quicka.style.backgroundColor="#FFFFFF";
	var bankuai = document.getElementById("bankuai");
	bankuai.style.display="block";
}
function hide(){
	var zindex = document.getElementById("zindex");
	zindex.style.zIndex="0";
	//var quicka = document.getElementById("quicka");
	//quicka.style.border="";
	//quicka.style.borderBottom="";
	//quicka.style.padding="4px";
	//quicka.style.zIndex="9999";
	//quicka.style.backgroundColor="";
	var bankuai = document.getElementById("bankuai");
	bankuai.style.display="none";
}

</script>
</head>
<body>
<div id="top">
	<div class="logo"><a href="/"></a></div>
	<div class="search">
		<form id="form1" name="form1" method="get" onsubmit="if(wd.value=='输入楼盘名称搜索！')wd.value='';" action="">
			<input type="hidden" id="mj" name="mj" value="<?php echo $_GET['mj'];?>" />
			<input type="hidden" id="rz" name="rz" value="<?php echo $_GET['rz'];?>" />
			<input type="hidden" id="yz" name="yz" value="<?php echo $_GET['yz'];?>" />
			<input type="hidden" id="bk" name="bk" value="<?php echo $_GET['bk'];?>" />
			<input type="text" id="wd" name="wd" class="wd" value="<?php if($_GET['wd'])echo $_GET['wd']; else echo "输入楼盘名称搜索！";?>" onfocus="if(this.value=='输入楼盘名称搜索！')this.value='';" onblur="if(this.value=='')this.value='输入楼盘名称搜索！';" />
			<input type="submit" name="Submit" value="找楼盘" class="button" />
		</form>
	</div>
	<?php
	if (!$_GET['bk']){
	$bk='请选择板块';
	}else{
	$mapping = array(
		'104.04124,30.612882' => '武侯',
		'104.124269,30.606302' => '锦江',
		'103.988429,30.685102' => '青羊',
		'104.061377,30.735622' => '金牛',
		'104.150032,30.69504' => '成华',
		'104.053242,30.623777' => '高新',
		'0,0' => '周边市区'
		);
		$bk=str_replace(array_keys($mapping), $mapping,$_GET['bk']);
	}
	?>
	<div class="quick"> 快速定位: <span class="quicka" id="quicka" onmousemove="show()" onmouseout="hide()"><?php echo $bk;?>
		<ul class="bankuai" style="display:none" id="bankuai">
			<li><a class="bk" href="javascript:void(0);" rel="104.04124,30.612882">武侯</a></li>
			<li><a class="bk" href="javascript:void(0);" rel="104.124269,30.606302">锦江</a></li>
			<li><a class="bk" href="javascript:void(0);" rel="103.988429,30.685102">青羊</a></li>
			<li><a class="bk" href="javascript:void(0);" rel="104.061377,30.735622">金牛</a></li>
			<li><a class="bk" href="javascript:void(0);" rel="104.150032,30.69504">成华</a></li>
			<li><a class="bk" href="javascript:void(0);" rel="104.053242,30.623777">高新</a></li>
			<li><a class="bk" href="javascript:void(0);" rel="0,0">周边市区</a></li>
		</ul>
		</span> </div>
        
        
        <div class="fh_hlb"><a href="/"></a></div>
        
</div>
<div id="main1">
	<div class="left">
		<div class="nav">
			<div class="tit">房源类型:</div>
			<ul>
				<li><a href="/map">写字楼出租</a></li>
				<li><a href="/map/index2.php">写字楼出售</a></li>
			</ul>
			<div class="clear"></div>
		</div>
		<div class="nav">
			<div class="tit">面积:</div>
			<ul>
				<li><a class="mj <?php if($_GET['mj']=="0,0" || $_GET['mj']=="") echo "hover";?>" href="javascript:void(0);" rel="0,0">不限</a></li>
				<li><a class="mj <?php if($_GET['mj']=="0,100") echo "hover";?>" href="javascript:void(0);" rel="0,100">100平米以下</a></li>
				<li><a class="mj <?php if($_GET['mj']=="100,150") echo "hover";?>" href="javascript:void(0);" rel="100,150">100-150平米</a></li>
				<li><a class="mj <?php if($_GET['mj']=="150,200") echo "hover";?>" href="javascript:void(0);" rel="150,200">150-200平米</a></li>
				<li><a class="mj <?php if($_GET['mj']=="200,300") echo "hover";?>" href="javascript:void(0);" rel="200,300">200-300平米</a></li>
				<li><a class="mj <?php if($_GET['mj']=="300,500") echo "hover";?>" href="javascript:void(0);" rel="300,500">300-500平米</a></li>
				<li><a class="mj <?php if($_GET['mj']=="500,1000") echo "hover";?>" href="javascript:void(0);" rel="500,1000">500-1000平米</a></li>
				<li><a class="mj <?php if($_GET['mj']=="1000,10000") echo "hover";?>" href="javascript:void(0);" rel="1000,10000">1000平米以上</a></li>
			</ul>
			<div class="clear"></div>
		</div>
		<div class="nav">
			<div class="tit">总价:<font style="font-weight:normal; color:#666">(元)</font></div>
			<ul>
				<li><a class="yz <?php if($_GET['yz']=="0,0" || $_GET['yz']=="") echo "hover";?>" href="javascript:void(0);" rel="0,0">不限</a></li>
				<li><a class="yz <?php if($_GET['yz']=="0,100") echo "hover";?>" href="javascript:void(0);" rel="0,100">100万元以下</a></li>
				<li><a class="yz <?php if($_GET['yz']=="100,200") echo "hover";?>" href="javascript:void(0);" rel="100,200">100-200万</a></li>
				<li><a class="yz <?php if($_GET['yz']=="200,300") echo "hover";?>" href="javascript:void(0);" rel="200,300">200-300万</a></li>
				<li><a class="yz <?php if($_GET['yz']=="300,500") echo "hover";?>" href="javascript:void(0);" rel="300,500">300-500万</a></li>
				<li><a class="yz <?php if($_GET['yz']=="500,800") echo "hover";?>" href="javascript:void(0);" rel="500,800">500-800万</a></li>
				<li><a class="yz <?php if($_GET['yz']=="800,1200") echo "hover";?>" href="javascript:void(0);" rel="800,1200">800-1200万</a></li>
				<li><a class="yz <?php if($_GET['yz']=="1200,2000") echo "hover";?>" href="javascript:void(0);" rel="1200,2000">1200-2000万</a></li>
				<li><a class="yz <?php if($_GET['yz']=="2000,1000000000") echo "hover";?>" href="javascript:void(0);" rel="2000,1000000000">2000万以上</a></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>
	<div class="right" id="zindex">
		<div id="allmap">
			<div style="text-align:center;padding:50px 0;width:100%;"><img src="/img/loading.gif" /><br /><br />数据加载中...请等待!</div>
		</div>
	</div>
</div>
<div id="info">
	<div class="title"></div>
	<div class="content"></div>
</div>
</body>
</html>
<script type="text/javascript">
var mp = new BMap.Map("allmap");
<?php
if($_GET['bk']){
	echo 'mp.centerAndZoom(new BMap.Point('.$_GET['bk'].';?>),13);';
}else{
	echo 'mp.centerAndZoom(new BMap.Point(104.071947,30.662797),13);';
}
echo 'mp.enableScrollWheelZoom();';

$mapping = array(':' => ',','：' => ',','(' => '','（' => '',')' => '','）' => '');

$borough = new Borough();
$options = array();
$whereand = array();
if($_GET['wd'])$whereand[]=array('b_name',"like '%".$_GET['wd']."%'");
$options['whereAnd'] = $whereand;
if($borough -> count($options) == 0 ) echo 'alert("没有找到相应的房源\n请更改条件后再次搜索！");';

$result=$borough -> find($options);
foreach($result as $k => $v){
	if($v->b_map){
		if($_GET['wd']){
			$c=str_replace(array_keys($mapping), $mapping, $v->b_map);
			if ( $k==0 ){
				echo 'mp.centerAndZoom(new BMap.Point('.$c.'),15);';
				echo 'mp.enableScrollWheelZoom();';
			}
		}
	$house = new House();
	$options_house = array();
	$whereand_house = array();
	$whereand_house[]=array('b_id','='.$v->id);
	$whereand_house[]=array('type','=2');
	if($_GET['mj']<>"0,0" && $_GET['mj']<>""){
		$mj=explode(',',$_GET['mj']);
		$whereand_house[]=array('area','>'.$mj[0].' and area<'.$mj[1]);
	}
	
	if($_GET['rz']<>"0,0" && $_GET['rz']<>""){
		$rz=explode(',',$_GET['rz']);
		$whereand_house[]=array('price','>'.$rz[0].' and price<'.$rz[1]);
	}
	
	if($_GET['yz']<>"0,0" && $_GET['yz']<>""){
		$yz=explode(',',$_GET['yz']);
		$whereand_house[]=array('type','=2 and area*price>'.($yz[0]*10000).' and area*price<'.($yz[1]*10000));
	}
	
	$options_house['whereAnd'] = $whereand_house;
	$num = $house -> count($options_house);
	if( $num > 0 ){
	echo 'var showtxt = "'.$num.'套";';
	echo 'var txt = "'.$v -> b_name.'";';
	echo 'mouseoverTxt = txt + "'.$num.'套";';
	$c=str_replace(array_keys($mapping), $mapping, $v->b_map);
	echo 'var myCompOverlay = new ComplexCustomOverlay(new BMap.Point('.$c.'), showtxt,mouseoverTxt,'.$v->id.');';
	echo 'mp.addOverlay(myCompOverlay);';
}}}
?>
</script>
