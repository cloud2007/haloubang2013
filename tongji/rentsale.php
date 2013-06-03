<?php
//出租出售房源
require_once('../config.php');
$house = new House();
$rent = $house ->count(array('whereAnd'=>array(array('type','=1'))));
$sale = $house ->count(array('whereAnd'=>array(array('type','=2'))));
$str="";
$str.="<chart formatNumberScale='0' palette='4' bgColor='666666' showShadow='0' bgAlpha='0' baseFontSize='12' baseFontColor='000000' bgAngle='360' showBorder='1' toolTipSepChar='套数:'>";
$str.="<set value='".$rent."' label='出租' color='#FF0000'  />";
$str.="<set value='".$sale."' label='出售' color='#00FFFF'  />";
$str.="</chart>";

if (strpos(strtolower('server_'.$_SERVER['SERVER_SOFTWARE']),'apache')>0){
	echo iconv('utf-8','gb2312',$str);
}elseif(strpos(strtolower('server_'.$_SERVER['SERVER_SOFTWARE']),'iis')>0){
	echo $str;
}
?>