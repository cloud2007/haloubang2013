<?php require_once('../config.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php
$id=$_POST['id'];
$mianji=$_POST['mianji'];
$zujin=$_POST['zujin'];
$orderby=$_POST['order'];

$house = new House();
$pager = new Pager();
$pagesize = 6;
if(isset($_POST['PageNo'])&&is_numeric($_POST['PageNo'])){
    $currentpage=$_POST['PageNo'];
}else{
    $currentpage=1;
}
$PageNum=($currentpage-1)*$pagesize;
$options = array();
$whereand = array();
$order = array();
$whereand[]=array('type','=2');
$whereand[]=array('b_id','='.$id);
if($mianji){
	$mianji=explode(',',$mianji);
	$whereand[]=array('area','>'.$mianji[0].' and area<'.$mianji[1]);
}
if($zujin){
	$zujin=explode(',',$zujin);
	$whereand[]=array('type','=2 and price*area>'.($zujin[0]*10000).' and price*area<'.($zujin[1]*10000));
}
if($order) $options['order'] = $order[$orderby] = '';//array('{$order}'=>'desc');
$options['whereAnd'] = $whereand;
$options['limit']="{$PageNum},{$pagesize}";
$num=$house->count($options);
$rows = $house -> find($options);
$pagerData=$pager->getPagerData($num,$currentpage,'?',5,$pagesize);//参数记录数 当前页数 链接地址 显示样式 每页数量
?>
<div class="postion">
		<span>
			<select name="order" id="order" onchange="house()">
				<option value="id">默认排序</option>
				<option value="house_totalarea" <?php if($order=="house_totalarea") echo "selected";?>>面积从小到大</option>
				<option value="house_totalarea desc" <?php if($order=="house_totalarea desc") echo "selected";?>>面积从大到小</option>
				<option value="house_price*house_totalarea" <?php if($order=="house_price*house_totalarea") echo "selected";?>>租金从低到高</option>
				<option value="house_price*house_totalarea desc" <?php if($order=="house_price*house_totalarea desc") echo "selected";?>>租金从高到低</option>
			</select>
		</span>找到 <?php echo $num;?> 套房源</div>
		<?php
		if($num==0) echo "<div style=\"font-size:14px; padding:40px; line-height:30px;\">对不起，没有找到合适的房源，请更换条件后再次搜索，谢谢^-^!</div>";
		foreach($rows as $v){
		?>
		<li>
			<table width="400" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="81" align="center"><img src="<?php echo Util::getpicthumb($v->getdefaultpic($v->b_id),'thumb');?>" width="55" height="40" border="1" /></td>
					<td width="230" style="line-height:22px"><a href="/rent/d-<?php echo $row['id'];?>.html" target="_blank"><?php echo $v->b_name;?></a><br /><?php echo $v->area;?>平米 第<?php echo $v->h_floor;?>/<?php echo $v->b_floor;?>层 <?php echo $v->price;?>元/平米</td>
					<td width="89" align="center" style="color:#FF6600; font-weight:bold;"><?php echo $v->area*$v->price;?>元</td>
				</tr>
			</table>
		</li>
		<?php
		}
		?>
		<?php echo '<div style=" text-align:center; padding:10px 0 0 0;">'.$pagerData['linkhtml'].'</div>';?>
</body>
</html>
