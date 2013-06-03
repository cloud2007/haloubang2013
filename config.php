<?php
//前台
session_start();
require_once('inc/common.inc.php');
if($_COOKIE['LOGIN_REMEMBER']==1){
	$_SESSION['borker_id'] = $_COOKIE['LOGIN_ID'];
	$_SESSION['borker_tel'] = $_COOKIE['LOGIN_TEL'];
	$_SESSION['borker_type'] = $_COOKIE['LOGIN_TYPE'];
	$_SESSION['borker_name'] = $_COOKIE['LOGIN_NAME'];
}
?>