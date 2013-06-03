<?php
//首页
require_once('config.php');
$view = new View('index');

$house = new House();
$borough = new Borough();

//热门出租房源
$hotrenthouse = $house ->find(
    array(
        'whereAnd'=>array(array('type','=1'),array('states','=1')),
        'limit'=>'0,8',
        'order'=>array('hits'=>'desc'),
       )
);
$view ->set('hotrenthouse',$hotrenthouse);

//热门出售房源
$hotsalehouse = $house ->find(
    array(
        'whereAnd'=>array(array('type','=2'),array('states','=1')),
        'limit'=>'0,8',
        'order'=>array('hits'=>'desc'),
       )
);
$view ->set('hotsalehouse',$hotsalehouse);

//热门出租12个
$hotrent = $house ->find(
    array(
        'whereAnd'=>array(array('type','=1'),array('states','=1')),
        'limit'=>'0,12',
        'order'=>array('hits'=>'desc'),
       )
);
$view ->set('hotrent',$hotrent);

//热门出售12个
$hotsale = $house ->find(
    array(
        'whereAnd'=>array(array('type','=2'),array('states','=1')),
        'limit'=>'0,12',
        'order'=>array('hits'=>'desc'),
    )
);
$view ->set('hotsale',$hotsale);

//楼盘相册
$boroughphoto = $borough ->find(
    array(
        'limit'=>'0,24',
        'order'=>array('id'=>'asc'),
       )
);
$view ->set('boroughphoto',$boroughphoto);

//最新房源
$newhouse = $house ->find(
    array(
        'whereAnd'=>array(array('states','=1')),
        'limit'=>'0,8',
        'order'=>array('edittime'=>'desc'),
    )
);
$view ->set('newhouse',$newhouse);

//友情链接
$link = new Link();
$linklist = $link -> getlist();
$view ->set('linklist',$linklist);

$view -> set('web_title','成都写字楼出租出售专业网站 - 好楼帮');
$view -> set('web_keywords','成都写字楼出租,成都写字楼,成都写字楼出售,写字楼出租,写字楼租售');
$view -> set('web_description','好楼帮是成都佳融资产管理有限公司旗下的商业地产网站，同时好楼帮也是国内首个专业的写字楼出租出售咨询服务类网站。好楼帮为用户提供最新最具价值的写字楼租售信息。好楼帮致力于成都写字楼出租出售行业，为你带来最佳的网上找楼体验。');

$view->renderHtml_index($view->render());
?>


