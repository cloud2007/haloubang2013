<?php
//主菜单
require_once('config.admin.php');

$view = new View('index_body');

$view->renderHtml($view->render());
?>