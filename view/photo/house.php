<script type="text/javascript" src="/js/jquery.lightbox-0.5.js"></script>
<link rel="stylesheet" type="text/css" href="/css/jquery.lightbox-0.5.css" media="screen" />
<script type="text/javascript">
    $(function() {
        $('.intro_list a').lightBox();
    });
    </script>
<div class="content">
	<!-----------------------------postion----------------------------------->
	<div id="position_title">我的位置:房源相册 > <?php echo $house->b_name.'-'.$house->h_floor.'F'.$house->roomnum.'号';?></div>
	<div class="intro_list">
		<ul>
			<?php foreach($piclist as $k => $v){?>
			<li <?php if(($k+1)%4==0) echo 'style="margin-right:0;"'?>><a href="<?php echo $v->pic_thumb;?>" title="<?php echo Config::item('borough_pictype.'.$v->pic_sub_cate) ? Config::item('borough_pictype.'.$v->pic_sub_cate) : '未选择分类';?>"><img src="<?php echo Util::getpicthumb($v->pic_thumb,'thumb');?>" width="207" height="152"></a><p><?php echo Config::item('borough_pictype.'.$v->pic_sub_cate) ? Config::item('borough_pictype.'.$v->pic_sub_cate) : '未选择分类';?></p></li>
			<?php }?>
		</ul>
	</div>
	<!-------------------------------------------具体的楼盘相册end--------------------------------------------------->
	<!---------------------------你可能感兴趣----------------------------------->
	<?php require_once( ROOTPATH . '/interestrent.php');?>
	<!---------------------------你可能感兴趣end----------------------------------->
	<!-------------------------------------------底部公共部分代码------------------------------------------------------>
</div>
