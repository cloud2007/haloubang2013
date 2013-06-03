<?php
require_once('../config.php');

if($_POST['action']=='save'){
    $trust = new Trust();
    $trust -> type = $_POST['type'];
    $trust -> uname = $_POST['uname'];
    $trust -> tel = $_POST['tel'];
    $trust -> email = $_POST['email'];
    $trust -> content = $_POST['content'];
    $trust -> states = 1;
    $trust -> creattime = time();
    $trust -> edittime = time();
    $trust -> save();
    ShowMsg('已提交成功，我们工作人员会在随后联系您，请保持你的电话畅通','/',0,3000);exit();
}

$view = new View('trust/index');

$view->renderHtml($view->render());
?>