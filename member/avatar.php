<?php
require_once('../config.php');
$Borker = new Borker();
if(!$Borker -> checkborkertype(1)){ShowMsg('你还未登陆！','/user/login.php',0,1000);exit();}

$Borker->load($_SESSION['borker_id']);

if($_POST['action']=='save'){
    if(!$_POST['avatar']){ShowMsg('没有上传头像！','-1',0,1000);exit();}
    $Borker ->avatar = $_POST['avatar'];
    $Borker -> save();
    ShowMsg('头像已保存！','avatar.php',0,1000);exit();
}

$view = new View('member/avatar');
$view -> set('Borker',$Borker);

$view->renderHtml_member($view->render());
?>