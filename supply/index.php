<?php
require_once('../config.php');
$view = new View('supply/index');


$postion = '<a href="/">首页</a> > <a href="/supply">开发商直供</a>';
$view -> set ('postion',$postion);

$view -> set('web_title',"成都开发商直供写字楼 - 好楼帮");
$view -> set('web_keywords','');
$view -> set('web_description','');


$view->renderHtml_index($view->render());
?>