<?php
require_once('../config.php');
$view = new View('single/index');

$mod=isset($_GET['mod'])?$_GET['mod']:'about';

$aboutinfo=file_get_contents('about.txt');
$contactinfo=file_get_contents('contact.txt');
$xieyiinfo=file_get_contents('xieyi.txt');

switch ($mod)
{
case "about":
	$content=$aboutinfo;
	break;
case "contact":
	$content=$contactinfo;
  	break;
case "xieyi":
	$content=$xieyiinfo;
  	break;
default:
  	$content="default";
}
$view -> set('content',$content);

$view->renderHtml($view->render());
?>