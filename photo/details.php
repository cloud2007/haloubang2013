<?php
require_once('../config.php');
$view = new View('photo/details');

$borough = new Borough();
$borough -> load($_GET['id']);
$view -> set ('borough',$borough);

$borough_pic = new Borough_pic();
$piclist = $borough_pic ->find(
        array(
                'whereAnd'=>array(array('borough_id','='.$borough->id)),
        )

);
$view -> set ('piclist',$piclist);

$view->renderHtml_index($view->render());
?>