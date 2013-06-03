<?php
//退出后台登录
require_once('../inc/common.inc.php');
$cuserLogin = new userLogin($admindir);
$cuserLogin -> exitUser();
//header("location:index.php");
echo '<script type="text/javascript">top.location.href="index.php";</script>';
?>