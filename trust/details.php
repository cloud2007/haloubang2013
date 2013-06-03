<?php
require_once('../config.php');
$view = new View('rent/details');

$house = new House();
$house -> load($_GET['id']);

$borough = new Borough();
$borough -> load($house->b_id);

$borker = new Borker();
$borker -> load($house -> borker_id);

$house_pic = new House_pic();
$house_pic -> house_id = $house->house_id;

$view ->set('house',$house);
$view ->set('borough',$borough);
$view ->set('borker',$borker);

$view->renderHtml($view->render());
?>