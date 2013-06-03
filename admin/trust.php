<?php
//楼盘字典参数
require_once('config.admin.php');
CheckGrant('trust');
$view = new View('trust');
$trust = new Trust();
$view->set('user', $user);

if($_GET['action']=='del'){
	$trust ->delete($_GET['id']);
        ShowMsg('信息删除完毕','trust.php',0,1000);exit();
}

if($_GET['action']=='add'){
$view = new View('trust_edit');
$view->set('user', $user);
$datainfo = new Trust();
if($_GET['id'])$datainfo -> load($_GET['id']);
$view -> set('datainfo',$datainfo);
}

if($_GET['action']=='save'){
    $trust -> load($_POST['id']);
    $trust -> states = $_POST['states'];
    $trust -> editid = $_POST['editid'];
    $trust -> editname = $_POST['editname'];
    if($_POST['editcontent'])
    $trust -> editcontent = $trust -> editcontent.'<p>该信息由'.$_POST['editname'].'于'.date('Y-m-d H:i:s',time()).'处理<br />备注：'.$_POST['editcontent']."</p>";
    else
    $trust -> editcontent = $trust -> editcontent.'<p>该信息由'.$_POST['editname'].'于'.date('Y-m-d H:i:s',time())."处理</p>";
    $trust -> edittime = time();
    $trust -> save();
    ShowMsg('信息处理完毕','trust.php',0,1000);exit();
}

$pager = new Pager();
$pagesize = 20;
//检测是否传入当前页数----------------------
if (isset($_GET['PageNo']) && is_numeric($_GET['PageNo'])) {
    $currentpage = $_GET['PageNo'];
} else {
    $currentpage = 1;
}
$PageNum = ($currentpage - 1) * $pagesize;

$options = array();
$options['limit'] = "{$PageNum},{$pagesize}";
$options['order'] = array('states'=>'asc','edittime'=>'desc');
$datalist = $trust->find($options);
$view->set('datalist', $datalist);

$pagerData = $pager->getPagerData($trust->count($options), $currentpage, '?', 4, $pagesize); //参数记录数 当前页数 链接地址 显示样式 每页数量
$view->set('pagerData', $pagerData);

$view->renderHtml($view->render());
?>