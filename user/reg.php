<?php
//首页
require_once('../config.php');
//if(!$_GET['type'] || ($_GET['type']<>1 && $_GET['type']<>2)){ShowMsg('参数不正确，请重试','/',0,1000);exit();}
if($_POST['action']=='save'){
    if(!$_POST['tel'] || !$_POST['pwd1'] || !$_POST['type'] || !$_POST['catenum'] || !$_POST['cate'] || !$_POST['avatar']){ShowMsg('填写不完整，请重试',-1,0,1000);exit();}
    $svali = strtolower(GetCkVdValue());
    if(!$_POST['vcode'] || $_POST['vcode'] !==$svali){
        ResetVdValue();
        ShowMsg('验证码填写错误，请重试','reg.php?type='.$_POST['type'],0,1000);
        exit();
    }
    $Borker = new Borker();
    $Borker -> tel = $_POST['tel'];
    $Borker -> pwd = md5($_POST['pwd1']);
    $Borker -> uname = $_POST['uname'];
    $Borker -> type = $_POST['type'];
    $Borker -> catenum = $_POST['catenum'];
    $Borker -> cate = $_POST['cate'];
    $Borker -> avatar = $_POST['avatar'];
    $Borker -> states = 0;
    $Borker -> creattime = time();
    $Borker -> logintime = time();
    $Borker -> save();
	$rs = $Borker -> login($_POST['tel'],md5($_POST['pwd1']));
	$Borker -> keepborker($rs);
    ShowMsg('注册成功!','/member',0,1000);exit();
}

$view = new View('user/reg');
$view->renderHtml($view->render());
?>