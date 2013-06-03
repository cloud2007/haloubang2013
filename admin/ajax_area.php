<?php
require_once('config.admin.php');
$id=$_GET['id'];
if(!$id){
	echo "请先选择一级区域!";
}else{
	try {
		$area2=Config::item("area_".$_GET['id']);
		echo "<select name=\"b_area2\">";
		foreach($area2 as $key => $value){
		if($_GET['area2'] == $key)
		$sel = "selected";
		else
		$sel = "";
		echo "<option value=\"{$key}\" ".$sel.">{$value}</option>";
		}
		echo "</select>";
	} 
	catch(Exception $e){
		echo "选择错误!";
	}
}
?>