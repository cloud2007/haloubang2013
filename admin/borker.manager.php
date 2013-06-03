<?php
//楼盘字典参数
require_once('config.admin.php');
CheckGrant('all');
$view = new View('borker.manager');

$borker = new Borker();

//禁用账户
if($_GET['action']=='unused'){
    $borker -> load($_GET['id']);
    $borker -> states = 0;
    $borker -> save();
    ShowMsg('账户已禁用！','borker.manager.php',0,1000);exit();
}

//启用账户
if($_GET['action']=='used'){
    $borker -> load($_GET['id']);
    $borker -> states = 1;
    $borker -> save();
    ShowMsg('账户已启用！','borker.manager.php',0,1000);exit();
}

//启用账户
if($_GET['action']=='reset'){
    $borker -> load($_GET['id']);
    $borker -> pwd = md5('888888');
    $borker -> save();
    ShowMsg('账户密码已重设！','borker.manager.php',0,1000);exit();
}

//启用账户
if($_GET['action']=='del'){
    $borker ->delete($_GET['id']);
    ShowMsg('账户已删除！','borker.manager.php',0,1000);exit();
}

$pager = new Pager();
$pagesize = 10;
//检测是否传入当前页数----------------------
if(isset($_GET['PageNo'])&&is_numeric($_GET['PageNo'])){
    $currentpage=$_GET['PageNo'];
}else{
    $currentpage=1;
}
$PageNum=($currentpage-1)*$pagesize;
$options=array();
$options['limit']="{$PageNum},{$pagesize}";
$datalist = $borker -> find($options);
$pagerData=$pager->getPagerData($borker->count($options),$currentpage,'?',4,$pagesize);//参数记录数 当前页数 链接地址 显示样式 每页数量
$view -> set('datalist',$datalist);
$view -> set('pagerData',$pagerData);

$view->renderHtml($view->render());
?>