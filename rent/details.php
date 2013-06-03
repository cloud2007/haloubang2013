<?php
require_once('../config.php');
$view = new View('rent/details');

$house = new House();
try {
    $house -> load($_GET['id']);
	$house -> hits = $house -> hits+1;
	$house -> save();
} catch (Exception $exc) {
    ShowMsg('你查看的房源不存在！现在为你跳转到房源列表','/rent',0,3000);exit();
}

$borough = new Borough();
$borough -> load($house->b_id);

$borker = new Borker();
$borker -> load($house -> borker_id);

//其他房源
$houses = new House();
$likehouse = $houses -> find(
        array(
            'whereAnd'=>array(array('type','=1'),array('b_id','='.$borough->id)),
            'limit'=>'0,4',
            'order'=>'rand',
        )
);

$house_pic = new House_pic();
$piclist = $house_pic -> find(
        array(
            'whereAnd'=>array(array('house_id','='.$house->id)),
            'limit'=>'0,4',
            'order'=>'rand',
        )
);
$piclists = $house_pic -> find(
        array(
            'whereAnd'=>array(array('house_id','='.$house->id)),
            'order'=>'rand',
        )
);

$borough_pic = new Borough_pic();
$borough_pic = $borough_pic -> find(
        array(
            'whereAnd'=>array(array('borough_id','='.$borough->id)),
            'order'=>'rand',
        )
);

$view ->set('house',$house);
$view ->set('borough',$borough);
$view ->set('borker',$borker);
$view ->set('piclist',$piclist);
$view ->set('piclists',$piclists);
$view ->set('likehouse',$likehouse);
$view ->set('borough_pic',$borough_pic);

//热门出租房源
$hotrenthouse = $houses ->find(
    array(
        'whereAnd'=>array(array('type','=1')),
        'limit'=>'0,4',
        'order'=>array('id'=>'asc'),
       )
);
$view ->set('hotrenthouse',$hotrenthouse);
//热门出售房源
$hotsalehouse = $houses ->find(
    array(
        'whereAnd'=>array(array('type','=2')),
        'limit'=>'0,4',
        'order'=>array('id'=>'asc'),
       )
);
$view ->set('hotsalehouse',$hotsalehouse);

$postion = '<a href="/">首页</a> > <a href="/rent">出租房源</a> > '.$house->b_name.$house->h_floor.'F'.$house->roomnum.'号';
$view -> set ('postion',$postion);

$view -> set('web_title',"成都{$borough->b_name}{$house->h_floor}楼{$house->roomnum}号{$house->area}平米写字楼出租 - 好楼帮");
$view -> set('web_keywords',"{$borough->b_name},{$borough->b_name}写字楼,{$borough->b_name}出租信息,成都写字楼出租");
$view -> set('web_description','写字楼出租是好楼帮提供的众多服务之一。我们致力于成都写字楼出租行业，为商家提供最具价值的的写字楼出租信息，努力让每位商家都租到理想的办公地。好楼帮为您带来最佳的网上找楼服务！');



//保存浏览记录
if($_COOKIE['houseHis']){
	$rentArr = explode(',', $_COOKIE['houseHis']);
	if(!in_array($id, $rentArr)){
		if(count($rentArr) == 5){
			array_shift($rentArr);
			$ids = implode(',', $rentArr);
			setcookie('houseHis',$ids.','.$id,time()+3600*24*30,'/');
		}elseif(count($rentArr) == 1){
			setcookie('houseHis',$_COOKIE['houseHis'].','.$id,time()+3600*24*30,'/');
		}else {
			$ids = implode(',', $rentArr);
			setcookie('houseHis',$ids.','.$id,time()+3600*24*30,'/');
		}

	}
}
else {
	setcookie('houseHis',$id,time()+3600*24*30,'/');
}

$view->renderHtml($view->render());
?>