<?php
require_once('config.admin.php');

$view = new View('index');

$view -> set('user',$user);

$view->renderHtml($view->render());
?>