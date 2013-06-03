<?php
require_once('../config.php');
$view = new View('news/index');

$house = new House();
$borough = new Borough();
//热门楼盘
$hotrentborough = $borough ->find(
    array(
        'limit'=>'0,10',
        'order'=>array('id'=>'asc'),
       )
);
$view ->set('hotrentborough',$hotrentborough);

$hothouse = $house ->find(
    array(
        'limit'=>'0,9',
        'order'=>array('edittime'=>'desc'),
       )
);
$view ->set('hothouse',$hothouse);

$news = new News();
$picnews = $news -> find(
	array(
		'whereAnd'=>array(array('pic','<>""')),
		'limit' => '0,6',
		'order' => 'rand',
	)
);
$view -> set('picnews',$picnews);

$postion = '<a href="/">首页</a> > <a href="/news">写字楼资讯</a>';
$view -> set ('postion',$postion);

$view -> set('web_title',"写字楼行业资讯|写字楼最新资讯 – 好楼帮");
$view -> set('web_keywords','');
$view -> set('web_description','');


$view->renderHtml_index($view->render());
?>