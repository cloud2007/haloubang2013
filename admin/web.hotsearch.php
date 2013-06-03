<?php
//网站配置
require_once('config.admin.php');
CheckGrant('config');

if($_GET['action']=='save'){
    $notice = $_POST['notice'];
    $notice = explode(",", $notice);
    file_put_contents( ROOTPATH . '/conf/hotsearch.php','<?php return '.var_export($notice,true).' ;?>');
    ShowMsg('热门搜索词已保存！','web.hotsearch.php',0,1000);exit();
}

$view = new View('web.hotsearch');
$notice = Config::item('hotsearch');
$view -> set ('notice',  implode(",", $notice) );
$view->renderHtml($view->render());
?>