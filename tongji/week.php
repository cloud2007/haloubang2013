<?php
//过去7天房源发布情况
require_once('../config.php');

$str="";
$str.="<chart showFCMenuItem='0' lineThickness='2' showValues='0' anchorRadius='4' divLineAlpha='20' divLineColor='CC3300' divLineIsDashed='1' showAlternateHGridColor='1' alternateHGridAlpha='5' alternateHGridColor='CC3300' shadowAlpha='40' labelStep='2' numvdivlines='25' showAlternateVGridColor='1' chartsshowShadow='1' chartRightMargin='20' chartTopMargin='15' chartLeftMargin='0' chartBottomMargin='3' bgColor='FFFFFF' canvasBorderThickness='1' showBorder='0' legendBorderAlpha='0' bgAngle='360' showlegend='1' borderColor='DEF3F3' toolTipBorderColor='cccc99' canvasPadding='0' toolTipBgColor='ffffcc' legendShadow='0' baseFontSize='12' canvasBorderAlpha='20' outCnvbaseFontSize='12' outCnvbaseFontColor='000000' numberScaleValue='10000,1,1,1000' formatNumberScale='1' palette='2' numberScaleUnit='' lineColor='AFD8F8'>";
$str.="<categories>";
$t = time();
$t = strtotime("-31 days", $t);

for($i=0;$i<30;$i++){
	$t = strtotime("+1 days", $t);
	$str.="<category label='".date("m-d", $t)."' />";
}
$str.="</categories>";

//总房源
$t = time();
$t = strtotime("-31 days", $t);
$str.="<dataset seriesName='过去30天发布房源情况' color='0033CC' anchorBorderColor='0033CC'>";
for($i=0;$i<30;$i++){
	$t = strtotime("+1 days", $t);
	$ts = date("m-d", $t);
	$house = new House();
	$num = $house ->count(array('whereAnd'=>array(array('edittime','>'.$t),array('edittime','<'.($t+86400)))));
	$str.="<set value='".$num."' toolText='".$ts.":".$num."套' />";
}
$str.="</dataset>";
//出租房源
$t = time();
$t = strtotime("-31 days", $t);
$str.="<dataset seriesName='过去30天发布出租房源情况' color='ff0000' anchorBorderColor='ff0000'>";
for($i=0;$i<30;$i++){
	$t = strtotime("+1 days", $t);
	$ts = date("m-d", $t);
	$house = new House();
	$num = $house ->count(array('whereAnd'=>array(array('edittime','>'.$t),array('type','=1'),array('edittime','<'.($t+86400)))));
	$str.="<set value='".$num."' toolText='".$ts.":".$num."套' />";
}
$str.="</dataset>";
//出售房源
$t = time();
$t = strtotime("-31 days", $t);
$str.="<dataset seriesName='过去30天发布出售房源情况' color='4CB848' anchorBorderColor='4CB848'>";
for($i=0;$i<30;$i++){
	$t = strtotime("+1 days", $t);
	$ts = date("m-d", $t);
	$house = new House();
	$num = $house ->count(array('whereAnd'=>array(array('edittime','>'.$t),array('type','=2'),array('edittime','<'.($t+86400)))));
	$str.="<set value='".$num."' toolText='".$ts.":".$num."套' />";
}
$str.="</dataset>";
//end
$str.="</chart>";

if (strpos(strtolower('server_'.$_SERVER['SERVER_SOFTWARE']),'apache')>0){
	echo iconv('utf-8','gb2312',$str);
}elseif(strpos(strtolower('server_'.$_SERVER['SERVER_SOFTWARE']),'iis')>0){
	echo $str;
}
?>