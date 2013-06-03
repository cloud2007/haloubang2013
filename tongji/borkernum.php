<?php
//出租出售房源
require_once('../config.php');
$house = new House();
$arr = $house -> groupBy(
	array('borker_id'),
	array('Count' => 'id')
	//array('order' => array('Count' => 'desc')) //如果要按Count结果排序，字段名就写Count
);
$str="";
$str.="<chart formatNumberScale='0' palette='4' bgColor='666666' showShadow='0' bgAlpha='0' baseFontSize='12' baseFontColor='000000' bgAngle='360' showBorder='1' toolTipSepChar='套数:'>";
foreach($arr as $v){
	$borker=new Borker();
	$borker->load($v['borker_id']);
	$str.="<set value='".$v['Count']."' label='".$borker->uname."' />";
}
$str.="</chart>";

if (strpos(strtolower('server_'.$_SERVER['SERVER_SOFTWARE']),'apache')>0){
	echo iconv('utf-8','gb2312',$str);
}elseif(strpos(strtolower('server_'.$_SERVER['SERVER_SOFTWARE']),'iis')>0){
	echo $str;
}
?>