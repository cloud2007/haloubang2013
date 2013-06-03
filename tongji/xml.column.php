<?php
//柱状图 xml
require_once('../config.php');
$str="";
$str.="<chart showFCMenuItem='0' palette='2' caption=' ' canvasBorderAlpha='20' bgColor='FFFFFF' canvasBorderThickness='1' showBorder='0' legendBorderAlpha='0' bgAngle='360' showlegend='1' showValues='1' decimals='2' useRoundEdges='0' baseFontSize ='12' outCnvbaseFontSize='12' use3DLighting='0' numberScaleValue='10000,1,1,1000' formatNumberScale='1' numberScaleUnit=' , ,万,千万 ' toolTipSepChar=':' plotFillRatio='100,0' chartRightMargin='6' chartTopMargin='0' chartLeftMargin='0' chartBottomMargin='3' showShadow='0' labelStep='1' animation='0'>";
$house = new House();
$arr = $house -> groupBy(
	array('borker_id'),
	array('Count' => 'id')
	//array('order' => array('Count' => 'desc')) //如果要按Count结果排序，字段名就写Count
);
foreach($arr as $v){
	$borker=new Borker();
	$borker->load($v['borker_id']);
	$str.="<set label='".$borker->uname."'  value='".$v['Count']."' toolText='".$borker->uname."' />";
}

$str.="</chart>";

if (strpos(strtolower('server_'.$_SERVER['SERVER_SOFTWARE']),'apache')>0){
	echo iconv('utf-8','gb2312',$str);
}elseif(strpos(strtolower('server_'.$_SERVER['SERVER_SOFTWARE']),'iis')>0){
	echo $str;
}
?>