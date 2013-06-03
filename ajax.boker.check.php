<?php
//会员手机号是否可以注册 检测
require_once('config.php');
$tel=$_GET['tel'];
$sql="select id from hlb_borker where tel='{$tel}'";
if ($Mysql->queryNum($sql)>0) {
	echo '0';
} else {
	echo '1';
}
?>