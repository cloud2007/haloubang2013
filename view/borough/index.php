<?php $Creaturl = new Creaturls();?>
<div class="content">
	<div id="position_title">我的位置：<?php echo $postion;?></div>
	<div class="single_search">
		<div class="area_search">
			<p class="area_search1">区域：<?php $Creaturl -> creaturl('area1');?></p>
			<p class="area_search1 area_search2"> 类型：<?php $Creaturl -> creaturl('level');?></p>
			<p class="area_search1 area_search3">地铁：<?php $Creaturl -> creaturl('metro');?></p>
		</div>
	</div>
	<div id="pic_s">
		<ul>
			<?php if($datalist){?>
			<?php foreach($datalist as $k => $v){?>
			<li <?php if(($k+1)%4==0) echo 'class="one2"';?>> <a href="/borough/d-<?php echo $v->id;?>.html"><img src="<?php echo Util::getpicthumb($v -> getdefaultpic(),'middle') ;?>" width="203" height="152"></a>
				<p class="ti"><a href="/borough/d-<?php echo $v->id;?>.html"><?php echo $v->b_name ;?></a></p>
				<p class="dz">地址：<span><?php echo Config::item('borough_area.'.$v->b_area1);?></span> <?php echo Util::csubstr($v->get('b_addr'),0,6);?></p>
				<p class="inf"><span class="inf_dz_span"><?php echo $v->gethousenum(1);?></span>套房源出租 <span class="inf_dz_span"><?php echo $v->gethousenum(2);?></span>套房源出售</p>
			</li>
			<?php }}else{echo '暂无相关楼盘,<a href="/borough">点击跳转到楼盘列表.</a>';}?>
		</ul>
	</div>
	<div class="pages_1"><?php echo $pagerData['linkhtml'];?></div>
</div>
<!--分页没有写样式-->
