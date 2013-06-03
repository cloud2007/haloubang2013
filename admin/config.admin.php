<?php
//登录检测
date_default_timezone_set('PRC');
require_once('../inc/common.inc.php');
require_once('lib/View.class.php');
$cuserLogin = new userLogin();
$user = array();
$user['id'] = $cuserLogin -> getUserID();
$user['name'] = $cuserLogin -> getUserName();
$user['grant'] = $cuserLogin -> getUserGrant();
$user['logintime'] = $cuserLogin -> getLogintime();
if($user['id'] ==-1 ) echo '<script type="text/javascript">top.location.href="login.php";</script>';
?>