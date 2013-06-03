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

$view = new View('member/index');

$view -> set('Borker',$Borker);

$house = new House();
$houselist = $house->find(
        array(
            'limit' => '10',
            'whereAnd' => array(array('borker_id','='.$Borker->id)),
            'order' => array('edittime'=>'desc'),
        )
);
$view ->set('houselist',$houselist);

$view->renderHtml_member($view->render());
?>