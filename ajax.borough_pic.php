<?php
require_once('config.php');
if(!$_GET['bid']){
echo '<div style="text-align:center; font-size:12px; line-height:40px; margin:160px 0 0 30px">请先选择楼盘!</div>';
die;
}
?>

<ul class="pic_load">
	<?php
	$borough_pic_load = new Borough_pic();
	$rows = $borough_pic_load -> find(
		array(
			'whereAnd'=>array(array('borough_id','='.$_GET['bid'])),
		)
	);
	foreach ($rows as $k => $v){
	?>
	<li id="load_li_<?php echo $k + 1000000000;?>"><img src="<?php echo $v->pic_thumb;?>" width="120" height="90" /> <span class="house_ok" style="display:none"></span>
		<div class="list_selects" style="border: 1px solid #8EADFF;"><em><?php echo Config::item('borough_pictype.'.$v->pic_sub_cate) ? Config::item('borough_pictype.'.$v->pic_sub_cate) : '未选择分类';?></em></div>
		<div class="list_selects1"><a href="javascript:void(0);" onclick="addthispic('<?php echo $k + 1000000000;?>','<?php echo $v->pic_thumb;?>','<?php echo $v->pic_sub_cate;?>','<?php echo Config::item('borough_pictype.'.$v->pic_sub_cate) ? Config::item('borough_pictype.'.$v->pic_sub_cate) : '未选择分类';?>');">添</a></div>
	</li>
	<?php }?>
</ul>
