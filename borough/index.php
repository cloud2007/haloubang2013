<?php
require_once('../config.php');
$view = new View('borough/index');

$borough = new Borough();
$pager = new Pager();
$pagesize = 12;
//检测是否传入当前页数----------------------
if(isset($_GET['PageNo'])&&is_numeric($_GET['PageNo'])){
    $currentpage=$_GET['PageNo'];
}else{
    $currentpage=1;
}
    $PageNum=($currentpage-1)*$pagesize;

$options = array();
$whereand = array();
$order = array();

if($_GET['area1']) $whereand[]=array('b_area1','='.$_GET['area1']);
if($_GET['level']) $whereand[]=array('b_level','='.$_GET['level']);
if($_GET['metro']) $whereand[]=array('b_subway',"like '%".$_GET['metro']."%'");
if($_GET['q']) $whereand[]=array('b_name',"like '%".$_GET['q']."%' or b_addr like '%".$_GET['q']."%'");
$options['whereAnd'] = $whereand;
$options['limit']="{$PageNum},{$pagesize}";

$pagerData=$pager->getPagerData($borough->count($options),$currentpage,'?',4,$pagesize);//参数记录数 当前页数 链接地址 显示样式 每页数量
$view -> set('pagerData',$pagerData);

$datalist = $borough ->find($options);
$view ->set('datalist',$datalist);

$postion = '<a href="/">首页</a> > <a href="/borough">楼盘列表</a>';
$view -> set ('postion',$postion);

if($_GET['area1']) $t .= Config::item('borough_area.'.$_GET['area1']);
//if($_GET['level']) $t .= Config::item('borough_level.'.$_GET['level']);
if($_GET['metro']) $t .= Config::item ('borough_metro.'.$_GET['metro']);
$view -> set('web_title','成都'.$t.'写字楼楼盘信息 - 好楼帮');
$view -> set('web_keywords','成都写字楼楼盘,成都'.Config::item('borough_area.'.$_GET['area1']).'写字楼新盘');
$view -> set('web_description','好楼帮为您提供成都'.Config::item('borough_area.'.$_GET['area1']).'写字楼楼盘信息，给您传递成都'.Config::item('borough_area.'.$_GET['area1']).Config::item ('borough_metro.'.$_GET['metro']).'最详细的写字楼新盘出租出售信息。了解成都'.Config::item('borough_area.'.$_GET['area1']).'写字楼新盘信息上好楼帮,'.Config::item('borough_area.'.$_GET['area1']).Config::item ('borough_metro.'.$_GET['metro']).'详尽的'.Config::item ('borough_metro.'.$_GET['level']).'楼盘资料更清晰！');


$view->renderHtml($view->render());
?>