<?php
require_once('../config.php');
$view = new View('photo/house');

$house = new House();
$house -> load($_GET['id']);
$view -> set ('house',$house);

$house_pic = new House_pic();
$piclist = $house_pic ->find(
        array(
                'whereAnd'=>array(array('house_id','='.$house->id)),
        )

);
$view -> set ('piclist',$piclist);

$view->renderHtml_index($view->render());
?>