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

//保存资料
if($_POST['action']=='editsave'){

    $Borker -> uname = $_POST['uname'];
    $Borker ->set('sex', $_POST['sex']);
    $Borker ->catenum = $_POST['catenum'];
    $Borker ->avatar = $_POST['avatar'];
    $Borker ->set('email', $_POST['email']);
    $Borker ->set('tel400', $_POST['tel400']);
    $Borker ->set('qqnum', $_POST['qqnum']);
    $Borker ->set('msnnum', $_POST['msnnum']);
    $Borker ->set('sign', $_POST['sign']);
    $Borker -> save();
    ShowMsg('保存成功！','/member',0,1000);exit();
}



$view = new View('member/editAll');

$view -> set('Borker',$Borker);

$view->renderHtml_member($view->render());
?>