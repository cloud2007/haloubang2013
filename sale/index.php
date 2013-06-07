<?php
require_once('../config.php');
$view = new View('sale/index');

$saleprice = array (
    '1' => '<8000',
    '2' => 'between 8000 and 15000',
    '3' => 'between 15000 and 20000',
    '4' => '>20000',
);
$price1 = array(
'1' => '8000元/平米以下',
'2' => '8000-15000元',
'3' => '15000-20000元',
'4' => '20000元以上',
);
$area = array (
    '1' => '<101',
    '2' => 'between 100 and 151',
    '3' => 'between 150 and 201',
    '4' => 'between 200 and 301',
    '5' => 'between 300 and 501',
    '6' => 'between 500 and 1001',
    '7' => '>1000',
);
$area1 = array(
    '1' => '100平米以下',
    '2' => '100-150平米',
    '3' => '150-200平米',
    '4' => '200-300平米',
    '5' => '300-500平米',
    '6' => '500-1000平米',
    '7' => '1000平米以上',
);
$fangling = array (
    '1' => " > " . (time()-365*24*60*60*2),//＜2年
    '2' => " between " . (time()-(365*24*60*60*5)) . " and " . (time()-(365*24*60*60*2)),//2-5年
    '3' => " between " . (time()-(365*24*60*60*10)) . " and " . (time()-(365*24*60*60*5)),//5-10年
    '4' => " < " . (time()-(365*24*60*60*10)),//10年以上
);

$fangling1 = array (
    '1' => '房龄两年以下',
    '2' => '房龄2-5年',//2-5年
    '3' => '房龄5-10年',//5-10年
    '4' => '房龄10年以上',//10年以上
);

$orders = array (
    '1' => 'area',
    '2' => 'price',
    '3' => 'edittime',
);

$House = new House();
$pager = new Pager();
$pagesize = 25;
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
$whereand[]=array('type','=2');
$whereand[]=array('states','=1');
if($_GET['area1']) $whereand[]=array('b_area1','='.$_GET['area1']);
if($_GET['area1'] && $_GET['area2']) $whereand[]=array('b_area2','='.$_GET['area2']);
if($_GET['saleprice']) $whereand[]=array('price',$saleprice[$_GET['saleprice']]);
if($_GET['area']) $whereand[]=array('area',$area[$_GET['area']]);
if($_GET['level']) $whereand[]=array('b_level','='.$_GET['level']);
if($_GET['fitment']) $whereand[]=array('fitment','='.$_GET['fitment']);
if($_GET['is_present']) $whereand[]=array('is_present','='.$_GET['is_present']);
if($_GET['metro']) $whereand[]=array('b_subway',"like '%".$_GET['metro']."%'");
if($_GET['q']) $whereand[]=array('b_name',"like '%".$_GET['q']."%' or b_addr like '%".$_GET['q']."%'");
if($_GET['fangling']) $whereand[]=array('b_opentime',$fangling[$_GET['fangling']]);
if($_GET['b_id']) $whereand[]=array('b_id','='.$_GET['b_id']);

if($_GET['order']) $options['order'] = array($orders[$_GET['order']]=>$_GET['by']);// $order[$orders[$_GET['order']]] = $_GET['by'];

$options['whereAnd'] = $whereand;
$options['limit']="{$PageNum},{$pagesize}";

$totalcount=$House->count($options);
$pagerData=$pager->getPagerData($totalcount,$currentpage,'?',4,$pagesize);//参数记录数 当前页数 链接地址 显示样式 每页数量
$view -> set('pagerData',$pagerData);
$view -> set('totalcount',$totalcount);
$totalarea = $House -> sum($options,'area');
$view -> set('totalarea',number_format($totalarea,2));//总面积

$datalist = $House ->find($options);
$view ->set('datalist',$datalist);


$postion = '<a href="/">首页</a> > <a href="/sale">出售房源</a>';
$view -> set ('postion',$postion);

if($_GET['area1']) $t .= Config::item('borough_area.'.$_GET['area1']);
if($_GET['fitment']) $t .= Config::item('house_fitment.'.$_GET['fitment']);
if($_GET['level']) $t .= Config::item('borough_level.'.$_GET['level']);

if($_GET['metro']) $t1 .= Config::item ('borough_metro.'.$_GET['metro']);
if($_GET['q']) $t1 .= $_GET['q'];
if($_GET['fangling']) $t1 .= $fangling1[$_GET['fangling']];
if($_GET['price']) $t1 .= $price1[$_GET['price']];
if($_GET['area']) $t1 .=$area1[$_GET['area']];

$view -> set('web_title','成都'.$t.'写字楼出售 '.$t1.' - 好楼帮');
$view -> set('web_keywords','成都写字楼出售,写字间出售,'.$t.'办公楼出售');
$view -> set('web_description','找成都'.$t.'写字楼出售就到好楼帮，'.$t1.'写字间出售信息量更多。我们致力于成都写字楼出售行业，为商家提供最具价值的的写字楼出售信息。');

$view->renderHtml($view->render());
?>