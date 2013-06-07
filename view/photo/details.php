<script type="text/javascript" src="/js/jquery.lightbox-0.5.js"></script>
<link rel="stylesheet" type="text/css" href="/css/jquery.lightbox-0.5.css" media="screen" />
<script type="text/javascript">
    $(function() {
        $('.intro_list a').lightBox();
    });
    </script>
<div class="content">
	<!-----------------------------楼盘信息----------------------------------->
	<div id="position_title">我的位置:找出租 > 新希望国际 > 楼盘相册</div>
	<!-------------------------------------------具体的楼盘相册------------------------------------------------------>
	<div id="intro_con"> <img src="<?php echo Util::getpicthumb($borough->getdefaultpic(),'small');?>" width="86" height="80" alt="">
		<p class="m"><?php echo $borough->b_name;?> <a href="/borough/d-<?php echo $borough->id;?>.html" class="f4"> 楼盘详情</a> <a href="/photo" class="f4">返回楼盘相册列表</a></p>
		<div class="m_5"><?php echo $borough->b_content;?></div>
	</div>
	<div class="intro_list">
		<ul>
			<?php foreach($piclist as $k => $v){?>
			<li <?php if(($k+1)%4==0) echo 'style="margin-right:0;"'?>><a href="<?php echo $v->pic_thumb;?>"><img src="<?php echo Util::getpicthumb($v->pic_thumb,'middle');?>" width="207" height="152"></a><p><?php echo Config::item('borough_pictype.'.$v->pic_sub_cate) ? Config::item('borough_pictype.'.$v->pic_sub_cate) : '未选择分类';?></p></li>
			<?php }?>
		</ul>
	</div>
	<!-------------------------------------------具体的楼盘相册end--------------------------------------------------->
	<!---------------------------你可能感兴趣----------------------------------->
	<?php require_once( ROOTPATH . '/interestrent.php');?>
	<!---------------------------你可能感兴趣end----------------------------------->
	<!-------------------------------------------底部公共部分代码------------------------------------------------------>
</div>
