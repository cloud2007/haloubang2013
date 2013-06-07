<?php
//楼盘自动完成
require_once('config.php');
$q=$_GET['q'];
$options=array();
$whereand=array();
$whereand[]=array('b_states','=1');
$whereand[]=array('b_isnew','=0');
$whereand[]=array('b_name',"like '%".$q."%' or b_letter like '%".$q."%'");
$options['whereAnd']=$whereand;
$Borough = new Borough();
$rs = $Borough -> find($options);
foreach($rs as $key){
    echo $key->id.'|'.$key->b_name.'|'.$key->b_addr.'|'.$key->b_level."|".$key->b_area1."|".$key->b_area2."|".$key->b_used."|".$key->get('zonglouceng')."|".$key->b_subway."|".$key->b_opentime;
    echo "\n";
    //data0=id  data1=楼盘名称  data2=楼盘地址 data3=楼盘级别 data4=区域1 data5=区域2 data6=物业用途 data7=总楼层 data8=地铁线路 data9=开盘时间
}
?>