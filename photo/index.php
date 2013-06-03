<?php
require_once('../config.php');
$view = new View('photo/index');

$borough = new Borough();
$pager = new Pager();
$pagesize = 12;
//检测是否传入当前页数----------------------
if(isset($_GET['PageNo'])&&is_numeric($_GET['PageNo'])){
    $currentpage=$_GET['PageNo'];
}else{
    $currentpage=1;
}
    $PageNum=($currentpage-1)*$pagesize;

$options = array();
$whereand = array();
$order = array();

$options['whereAnd'] = $whereand;
$options['limit']="{$PageNum},{$pagesize}";

$pagerData=$pager->getPagerData($borough->count($options),$currentpage,'?',4,$pagesize);//参数记录数 当前页数 链接地址 显示样式 每页数量
$view -> set('pagerData',$pagerData);

$datalist = $borough ->find($options);
$view ->set('datalist',$datalist);

$view->renderHtml_index($view->render());
?>