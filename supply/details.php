<?php
require_once('../config.php');

if(!$_GET['id']){
	ShowMsg('Error','/supply',0,1000);exit();
}

$view = new View('supply/'.$_GET['id'].'/detail');

$title = file_get_contents( ROOTPATH . '/view/supply/'.$_GET['id'].'/title.txt') ;
$encode = mb_detect_encoding($title, array("ASCII","UTF-8","GB2312","GBK","BIG5"));
if($encode!='UTF-8') $title = iconv( $encode , 'UTF-8' ,  $title);

$postion = '<a href="/">首页</a> > <a href="/supply">开发商直供</a> > '.$title;
$view -> set ('postion',$postion);

$view -> set('web_title',"成都开发商直供写字楼 - 好楼帮");
$view -> set('web_keywords','');
$view -> set('web_description','');


$view->renderHtml_index($view->render());
?>