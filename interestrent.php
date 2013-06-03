<?php
//首页
require_once('config.php');
$view = new View('interestrent');
$interestrent = new House();
$interestrent = $interestrent -> find(
	array(
		'whereAnd'=>array(array('states','=1')),
		'limit' => '0,5',
		'order' => 'rand',
	)
);
$view -> set('interestrent',$interestrent);//感兴趣的出租房源
$view->renderHtml_map($view->render());
?>
