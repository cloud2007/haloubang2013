<div class="content">
	<div id="position_title">我的位置:楼盘相册</div>
	<div id="pic_s">
		<ul>
			<?php foreach($datalist as $k => $v){?>
			<li <?php if(($k+1)%4==0) echo 'class="one2"';?>> <span class="icon"><?php echo $v->getpicnum();?></span> <a href="/photo/details.php?id=<?php echo $v->id;?>"><img src="<?php echo Util::getpicthumb($v -> getdefaultpic(),'middle') ;?>" width="203" height="152"></a>
				<p class="ti"><a href="/photo/details.php?id=<?php echo $v->id;?>"><?php echo $v->b_name ;?></a></p>
				<p class="dz">地址：<a href="/borough/?area1=<?php echo $v->b_area1;?>"><span><?php echo Config::item('borough_area.'.$v->b_area1);?></span></a> <?php echo Util::csubstr($v->get('b_addr'),0,8);?></p>
				<p class="inf">该楼盘相册共有 <a href="/photo/details.php?id=<?php echo $v->id;?>"><span style="color:red; font-weight:bold; font-size:14px;"><?php echo $v->getpicnum();?></span></a> 张图片</p>
			</li>
			<?php }?>
		</ul>
	</div>
    
     <div class="pages_1"><?php echo $pagerData['linkhtml'];?></div>
    
</div>
