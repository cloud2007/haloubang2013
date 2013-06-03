<?php
//网站配置
require_once('config.admin.php');
CheckGrant('config');

if($_GET['action']=='save'){
    $notice = $_POST['notice'];
    $notice = explode("\n", $notice);
    file_put_contents( ROOTPATH . '/conf/notice.php','<?php return '.var_export($notice,true).' ;?>');
    ShowMsg('公告已保存！','web.notice.php',0,1000);exit();
}

$view = new View('web.notice');
$notice = Config::item('notice');
$view -> set ('notice',  implode("\n", $notice) );
$view->renderHtml($view->render());
?>