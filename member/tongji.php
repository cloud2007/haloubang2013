<?php
require_once('../config.php');
$Borker = new Borker();
if(!$Borker -> checkborkertype(1)){ShowMsg('你还未登陆！','/user/login.php',0,1000);exit();}
$Borker->load($_SESSION['borker_id']);
//退出登录
if($_GET['action']=='exit'){
    $Borker -> exitborker();
    ShowMsg('你已安全退出！','/',0,1000);exit();
}

$view = new View('member/tongji');
$view -> set('Borker',$Borker);

$view->renderHtml_member($view->render());
?>