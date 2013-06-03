<?php
require_once('../config.php');
$Borker = new Borker();
if(!$Borker -> checkborkertype(1)){ShowMsg('你还未登陆！','/user/login.php',0,1000);exit();}

$Borker->load($_SESSION['borker_id']);

if($_POST['action']=='save'){
    if(!$_POST['pwd']){ShowMsg('旧密码未填写！','-1',0,1000);exit();}
    if(!$_POST['pwd1']){ShowMsg('密码未填写！','-1',0,1000);exit();}
    if(!$_POST['pwd2']){ShowMsg('确认密码未填写！','-1',0,1000);exit();}
    if($_POST['pwd1'] != $_POST['pwd2']){ShowMsg('两次密码输入不一致！','-1',0,1000);exit();}
    if(md5($_POST['pwd']) != $Borker->pwd ){ShowMsg('旧密码输入错误！','-1',0,1000);exit();}
    $Borker -> pwd = md5($_POST['pwd1']);
    $Borker -> save();
    $Borker -> exitborker();
    ShowMsg('密码已更改,请重新登录！','/user/login.php',0,1000);exit();
}

$view = new View('member/editpwd');
$view -> set('Borker',$Borker);

$view->renderHtml_member($view->render());
?>