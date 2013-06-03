<?php
//首页
require_once('config.php');

$link = array (
    '1' => '/rent/?',
    '2' => '/sale/?',
    '3' => '/borough/?',
);

$action = $link[$_POST['type']];

$condtion = array();

if($_POST['area1']) $condtion[] = 'area1='.$_POST['area1'];
if($_POST['level']) $condtion[] = 'level='.$_POST['level'];
if($_POST['area']) $condtion[] = 'area='.$_POST['area'];
if($_POST['q'] && $_POST['q']!='请输入楼盘名称、街道名称......') $condtion[] = 'q='.$_POST['q'];

$condtionstr = implode('&', $condtion);

$actionurl = $action.$condtionstr;

header("Location:".$actionurl);
?>


