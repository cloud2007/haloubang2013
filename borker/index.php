<?php
//经纪人
require_once('../config.php');
$view = new View('borker/index');

$borker = new Borker();
$pager = new Pager();
$pagesize = 10;
//检测是否传入当前页数----------------------
if(isset($_GET['PageNo'])&&is_numeric($_GET['PageNo'])){
    $currentpage=$_GET['PageNo'];
}else{
    $currentpage=1;
}
    $PageNum=($currentpage-1)*$pagesize;

$options = array();
$whereand = array(array('states','=1'));
$order = array();

$options['whereAnd'] = $whereand;
$options['limit']="{$PageNum},{$pagesize}";

$pagerData=$pager->getPagerData($borker->count($options),$currentpage,'?',4,$pagesize);//参数记录数 当前页数 链接地址 显示样式 每页数量
$view -> set('pagerData',$pagerData);

$datalist = $borker ->find($options);
$view ->set('datalist',$datalist);

$postion = '<a href="/">首页</a> > <a href="/borker">经纪人列表</a>';
$view -> set ('postion',$postion);

$view -> set('web_title',"成都房地产经纪人 - 好楼帮");
$view -> set('web_keywords','成都房地产经纪人');
$view -> set('web_description','好楼帮房地产经纪人为你提供最好的写字楼出租出售信息咨询。租好楼，买好楼，卖好楼找好楼帮房地产经纪人，为你提供一对一免费中介服务。');

$view->renderHtml_index($view->render());
?>