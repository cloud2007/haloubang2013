<?php
require_once('../config.php');
$Borker = new Borker();
if(!$Borker -> checkborkertype(1)){ShowMsg('你还未登陆！','/user/login.php',0,1000);exit();}




$view = new View('member/QAF');
$view -> set('Borker',$Borker);

$view->renderHtml_member($view->render());
?>