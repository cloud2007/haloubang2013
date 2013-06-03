<?php
require_once('../config.php');
$Borker = new Borker();
$Borker->load($_SESSION['borker_id']);
if (!$Borker->checkborkertype(1)) {
    ShowMsg('你还未登陆！', '/user/login.php', 0, 1000);
    exit();
}
$view = new View('member/manager');
$type = $_GET['type'] ? $_GET['type'] : 1;
$House = new House();
$pager = new Pager();
$pagesize = 20;
//检测是否传入当前页数----------------------
if(isset($_GET['PageNo'])&&is_numeric($_GET['PageNo'])){
    $currentpage=$_GET['PageNo'];
}else{
    $currentpage=1;
}
    $PageNum=($currentpage-1)*$pagesize;

$options=array();
$whereAnd=array();
$House -> type = $type;
$House -> borker_id = $Borker -> id;
$options['limit']="{$PageNum},{$pagesize}";
//$options['whereAnd']=$whereAnd;
$datalist = $House -> find($options);
$view -> set('datalist',$datalist);

$pagerData=$pager->getPagerData($House->count($options),$currentpage,'?',4,$pagesize);//参数记录数 当前页数 链接地址 显示样式 每页数量
$view -> set('pagerData',$pagerData);

$view->set('Borker', $Borker);
$view->set('type', $type);

$view->renderHtml_member($view->render());
?>