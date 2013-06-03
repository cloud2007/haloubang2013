<?php
require_once('../config.php');
$view = new View('borker/details');

$borker = new Borker();
$borker -> load($_GET['id']);
$view ->set('borker',$borker);

$house = new House();
$rent = $house -> find(
    array(
        'whereAnd'=>array(array('type','=1'),array('borker_id','='.$borker->id)),
        'limit'=>'0,10',
        'order'=>array('edittime'=>'desc'),
    )
);
$view ->set('rent',$rent);

$sale = $house -> find(
    array(
        'whereAnd'=>array(array('type','=2'),array('borker_id','='.$borker->id)),
        'limit'=>'0,10',
        'order'=>array('edittime'=>'desc'),
    )
);
$view ->set('sale',$sale);

$postion = '<a href="/">首页</a> > <a href="/borker">经纪人列表</a> > '.$borker->uname;
$view -> set ('postion',$postion);

$view -> set('web_title',"成都房地产经纪人 - 好楼帮");
$view -> set('web_keywords','成都房地产经纪人');
$view -> set('web_description','好楼帮房地产经纪人为你提供最好的写字楼出租出售信息咨询。租好楼，买好楼，卖好楼找好楼帮房地产经纪人，为你提供一对一免费中介服务。');


$view->renderHtml_index($view->render());
?>