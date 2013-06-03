<?php
//楼盘字典参数
require_once('config.admin.php');
CheckGrant('all');
$view = new View('user.manager');

$user = new User();
$datalist = $user -> getlist();
$view -> set('datalist',$datalist);

//编辑用户
if($_GET['action']=='edit'){
	$datainfo = $user -> getinfo();
	if(is_array($datainfo)){
		$view -> set('datainfo',$datainfo);
	}else{
		ShowMsg('参数不正确!','user.manager.php',0,1000);
		exit();
	}
}

//删除
if($_GET['action']=='del'){
	$user -> del();
	ShowMsg('删除成功!','user.manager.php',0,1000);
        exit;
}

//保存编辑用用户
if($_GET['action']=='save'){
	$user -> save();
}

//禁用账户
if($_GET['action']=='unused'){
	$user -> unused();
}

//启用账户
if($_GET['action']=='used'){
	$user -> used();
}

$view->renderHtml($view->render());
?>