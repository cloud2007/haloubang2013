<?php
require_once('../config.php');
$view = new View('news/list');

$house = new House();
$borough = new Borough();
//热门出租楼盘
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

//新闻列表
$news = new News();
$news = $news ->find(
        array(
            'whereAnd'=>array(array('type','='.$_GET['bid'])),
        )
);
$view ->set('news',$news);

$postion = '<a href="/">首页</a> > <a href="/news">写字楼资讯</a> > '.Config::item('news_type.'.$_GET['bid']);
$view -> set ('postion',$postion);

$view -> set('web_title',Config::item('news_type.'.$_GET['bid'])." - 好楼帮");
$view -> set('web_keywords','');
$view -> set('web_description','');

$view->renderHtml_index($view->render());
?>