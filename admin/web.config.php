<?php
//网站配置
require_once('config.admin.php');
CheckGrant('config');
$view = new View('web.config');
$config = new Webconfig();

//读取参数
$cfg = new Webconfig();
try {
    $cfg -> load(1);
} catch (Exception $exc) {
    echo 'NOTE:There is some wrong!';
}
$view -> set('datainfo',$cfg);

//print_r($cfg ->attris);
//die;

//保存
if($_GET['action']=='save'){
        $cfg -> id =1;
        foreach($_POST['cfg'] as $key => $value){
            $cfg -> set ("{$key}","{$value}");
	}
        $cfg->edittime = time();
	$cfg -> save();
	$cfg -> updatecache();//缓存更新
	ShowMsg('保存成功!','web.config.php',0,1000);exit();
}


//缓存更新
if($_GET['action']=='cache'){
	$cfg -> updatecache();//缓存更新
	ShowMsg('更新完毕!更新时间：'.date('Y-m-d H:i:s',time()),'web.config.php',0,1000);exit();
}

$view->renderHtml($view->render());
?>