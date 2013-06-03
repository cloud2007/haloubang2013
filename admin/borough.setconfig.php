<?php
//楼盘字典参数
require_once('config.admin.php');
CheckGrant('set');
$view = new View('borough.setconfig');
$sethouse = new Sethouse();

$action = $_GET['action'];
$set_id = $_GET['set_id'] ? $_GET['set_id'] : $_POST['set_id'];
$pid = $_GET['pid'] ? $_GET['pid'] : $_POST['pid'];
$sid = $_GET['sid'] ? $_GET['sid'] : $_POST['sid'];

$view -> set('action',$action);
$view -> set('set_id',$set_id);
$view -> set('pid',$pid);
$view -> set('sid',$sid);


//保存参数
if($action=='save'){
	$sethouse -> save();
}

if($action=='del'){
	$sethouse -> del();
}

//排参数序
if($action=='order'){
	$sethouse -> order();
}

//楼盘参数读取
$sql="select * from hlb_set order by order_id";
$set = $Mysql -> fetchRows($sql);
$view -> set('set',$set);

if ($action=='edit' && $set_id){
	$sql="select * from hlb_set_item where set_id=".$set_id." and parent_id=0 order by order_id";
	$parent = $Mysql -> fetchRows($sql);
	foreach($parent as $k => $key){
		$sql="select * from hlb_set_item where set_id=".$set_id." and parent_id=".$key['id']." order by order_id";
		$parent[$k]['son'] = $Mysql -> fetchRows($sql);
	}
	$view -> set('parent',$parent);
}

//读取编辑的参数
if($sid){
$data=$Mysql -> getRowById('hlb_set_item','id',$sid);
$view -> set('datainfo',$data);
}

$view->renderHtml($view->render());
?>