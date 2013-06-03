<?php
require_once('config.admin.php');
$b_name=$_GET['b_name'];
$house = new House();
$res = $house -> find(
       array(
           'whereAnd'=>array(array('b_name',"='".$b_name."'")),
       )
);
if($res) echo '已存在！';
?>