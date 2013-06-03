<?php
require_once('../config.php');
$view = new View('map/index');

$postion = '<a href="/">首页</a> > <a href="/map">地图找房</a>';
$view -> set ('postion',$postion);

$view -> set('web_title',"成都地图找楼 - 好楼帮");
$view -> set('web_keywords','成都地图找房,成都楼盘地图');
$view -> set('web_description','好楼帮提供的成都写字楼租售地图带你体验全新的找房过程，更准确的商业圈，更直接的商业机会。好楼帮写字楼租售地图你找房的最佳帮手！');


$view->renderHtml_map($view->render());
?>