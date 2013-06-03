<?php
//友情链接
require_once('config.admin.php');
CheckGrant('all');
$view = new View('ads.manager');

$ads = new Ads();
$datalist = $ads -> find();
$view -> set('datalist',$datalist);

if($_GET['action']=='save'){
    $savecolumns = array(
	'title' => 'title',
	'place_id' => 'place_id',
        'type' => 'type',
        'link' => 'link',
        'pic' => 'pic',
	'content' => 'content',
	'code' => 'code',
	'order' => 'order',
	'states' => 'states',
	'creattime' => 'creattime',
        'beizhu' => 'beizhu',
    );
    if ($_POST['id']) $ads->id = $_POST['id'];
    foreach ($savecolumns as $k) {
        $ads->$k = $_POST[$k];
    }
    try {
        $ads -> save();
        ShowMsg('保存完毕', 'ads.manager.php', 0, 1000);
        exit();
    } catch (Exception $exc) {
        echo 'there is some wrong was happen!';
    }
}

if ($_GET['action'] == 'edit') {
    $datainfo = new Ads();
    if ($_GET['id'])$datainfo->load($_GET['id']);
    $view->set('datainfo', $datainfo);
}

if ($_GET['action'] == 'used') {
    $datainfo = new Ads();
    if ($_GET['id'])$datainfo->load($_GET['id']);
    $datainfo -> states =1;
    $datainfo -> save();
    ShowMsg('保存完毕', 'ads.manager.php', 0, 1000);
    exit();
}

if ($_GET['action'] == 'unused') {
    $datainfo = new Ads();
    if ($_GET['id'])$datainfo->load($_GET['id']);
    $datainfo -> states =0;
    $datainfo -> save();
    ShowMsg('保存完毕', 'ads.manager.php', 0, 1000);
    exit();
}

if ($_GET['action'] == 'del') {
    $datainfo = new Ads();
    $datainfo->delete($_GET['id']);
    ShowMsg('删除完毕', 'ads.manager.php', 0, 1000);
    exit();
}

$view->renderHtml($view->render());
?>