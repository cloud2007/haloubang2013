<?php
//区域房源
require_once('../config.php');
$house = new House();
$arr = $house -> groupBy(
	array('b_area1'),
	array('Count' => 'id')
	//array('order' => array('Count' => 'desc')) //如果要按Count结果排序，字段名就写Count
);
print_r($arr);
$str="";
$str.="<chart formatNumberScale='0' palette='4' bgColor='666666' showShadow='0' bgAlpha='0' baseFontSize='12' baseFontColor='000000' bgAngle='360' showBorder='1' toolTipSepChar=':'>";
foreach($arr as $v){
	$str.="<set value='".$v['Count']."' label='".Config::item('borough_area.'.$v['b_area1'])."' />";
}
$str.="</chart>";

if (strpos(strtolower('server_'.$_SERVER['SERVER_SOFTWARE']),'apache')>0){
	echo iconv('utf-8','gb2312',$str);
}elseif(strpos(strtolower('server_'.$_SERVER['SERVER_SOFTWARE']),'iis')>0){
	echo $str;
}
?>