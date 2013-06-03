<?php
require_once('../config.php');
$view = new View('news/details');

$news = new News();
$news -> load($_GET['id']);
$news ->hits = $news ->hits+1;
$news ->save();

$prev = new News();
$prev = $prev ->find(
        array(
            'whereAnd' => array(array('type', '=' . $news->type), array('states', '=1')),
            'limit' => '0,1',
            'order' => array('edittime' => 'desc'),
        )
);

$next = new News();
$next = $next ->find(
        array(
            'whereAnd' => array(array('type', '=' . $news->type), array('states', '=1')),
            'limit' => '0,1',
            'order' => array('edittime' => 'asc'),
        )
);

$view ->set('news',$news);
$view ->set('prev',$prev);
$view ->set('next',$next);


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

$ads = new Ads();
$ad = $ads ->find(
    array(
        'whereAnd'=>array(array('states','=1'),array('place_id','=1')),
        'limit'=>'0,1',
        'order'=>'rand',
       )
);
$view ->set('ad',$ad[0]);

$postion = '<a href="/">首页</a> > <a href="/news">写字楼资讯</a> > '.$news->title;
$view -> set ('postion',$postion);

$view -> set('web_title',$news -> title ." - 好楼帮");
$view -> set('web_keywords','');
$view -> set('web_description','');

$view->renderHtml_index($view->render());
?>