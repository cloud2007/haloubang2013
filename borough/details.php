<?php
require_once('../config.php');
$view = new View('borough/details');

$house = new House();
$borough = new Borough();
$borough -> load($_GET['id']);
$view ->set('borough',$borough);

//楼盘幻灯图片
$borough_pic = new Borough_pic();
$piclist = $borough_pic -> find(
        array(
            'whereAnd'=>array(array('borough_id','='.$borough->id)),
            'order'=>'rand',
            'limit'=>'0,4',
        )
);
$view ->set('piclist',$piclist);

//楼盘所有图片
$allpic = $borough_pic -> find(
        array(
            'whereAnd'=>array(array('borough_id','='.$borough->id)),
            'order'=>'rand',
        )
);
$view ->set('allpic',$allpic);

//出租房源
$renthouse = $house -> find(
        array(
            'whereAnd'=>array(array('b_id','='.$borough->id),array('type','=1')),
            'limit' => '0,10',
            'order' => 'rand',
        )
);
$view ->set('renthouse',$renthouse);

//出售房源
$salehouse = $house -> find(
        array(
            'whereAnd'=>array(array('b_id','='.$borough->id),array('type','=2')),
            'limit' => '0,10',
            'order' => 'rand',
        )
);
$view ->set('salehouse',$salehouse);


//热门楼盘
$hotborough= new Borough();
$hotrentborough = $hotborough ->find(
    array(
        'limit'=>'0,10',
        'order'=>array('id'=>'asc'),
       )
);
$view ->set('hotrentborough',$hotrentborough);

$postion = '<a href="/">首页</a> > <a href="/borough">楼盘列表</a> > '.$borough->b_name;
$view -> set ('postion',$postion);

$view -> set('web_title',"成都[{$borough->b_name}] - 好楼帮");
$view -> set('web_keywords','成都写字楼出租,成都办公楼出租,成都写字间出租');
$view -> set('web_description','写字楼出租是好楼帮提供的众多服务之一。我们致力于成都写字楼出租行业，为商家提供最具价值的的写字楼出租信息，努力让每位商家都租到理想的办公地。好楼帮为您带来最佳的网上找楼服务！');


$view->renderHtml($view->render());
?>