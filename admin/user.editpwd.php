<?php
//用户修改密码
require_once('config.admin.php');
$view = new View('user.editpwd');

$user = new User();
$datainfo = $user -> getlogin();
$view -> set('datainfo',$datainfo);

if($_GET['action']=='save'){
	$user -> editpwd();
	ShowMsg('密码已修改,请重新登录!','exit.php',0,1000);exit();
}

$view->renderHtml($view->render());
?>