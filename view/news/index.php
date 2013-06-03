<?php $news = new News();?>
<script type="text/javascript" src="../js/js_for_tabp.js"></script>

<div class="content">
	<!-----------------------------楼盘信息----------------------------------->
	<div id="position_title">我的位置：<?php echo $postion;?></div>
	<!---------------------------------滚动图片+新闻咨询+推荐------------------------------------------->
	<div id="office_new" >
		<div class="slide_nav">
			<div id="news_mian">
			<?php foreach ($picnews as $k => $v){?>
			<a href="/news/d-<?php echo $v->id;?>.html" target="_blank"><img src="<?php echo Util::getpicthumb($v->pic,'middle');?>" width="330" height="244" <?php if($k==0) echo 'style="display:block;"';?>></a>
			<?php }?>
				<ul class="main_ul">
					<?php foreach ($picnews as $k => $v){?>
					<li <?php if($k==0) echo 'class="one"';?>><?php echo $k+1;?></li>
					<?php }?>
				</ul>
			</div>
		</div>
		<div class="new">
			<div class="new_t"></div>
			<div class="new_bg">
				<h2>成都写字楼快讯</h2>
				<a href="/news/list.php?bid=69" class="more">更多</a>
				<?php foreach($news ->getattnews(69,1,'h') as $v){?>
				<p class="b_t"><a href="/news/d-<?php echo $v->id;?>.html"><?php echo Util::csubstr($v->title,0,16);?></a></p>
				<?php }?>
				<ul class="new_ul">
					<?php foreach($news ->getnews(69,6) as $v){?>
					<li><a href="/news/d-<?php echo $v->id;?>.html"><?php echo $v->title;?></a></li>
					<?php }?>
				</ul>
			</div>
			<div class="new_b"></div>
		</div>
		<div class="new_r">
			<div class="new_r_t"></div>
			<div class="new_r_bg">
				<h2>热门楼盘推荐</h2>
				<a href="/news/list.php?bid=70" class="more">更多</a>
				<?php foreach($news ->getnews(70,1) as $v){?>
				<div class="cont"> <img src="<?php echo Util::getpicthumb($v->pic(),'thumb');?>" width="100" height="100">
					<h3><a href="/news/d-<?php echo $v->id;?>.html"><?php echo $v->title;?></a></h3>
					<p><?php echo Util::csubstr(strip_tags($v->content),0,150);?></p>
				</div>
				<?php }?>
			</div>
			<div class="new_r_b"></div>
		</div>
	</div>
	<div id="pic"> <a target="_blank" href="/map"><img src="../img/banner_for_singe.jpg" width="1003" height="102" alt="" style="float:left;"></a> </div>
	<div class="building_new">
		<div class="building_new_l">
			<div class="building_new_l_t"></div>
			<div class="building_new_l_bg">
				<div class="trends trends_line trends_height_1">
					<p class="p2"><span style="display:block; float:left;">写字楼最新动态</span><a href="/news/list.php?bid=71" style="display:block; float:right;">更多</a></p>
					<?php foreach($news ->getattnews(71,1,'h') as $v){?>
					<div class="p1"> <img src="<?php echo Util::getpicthumb($v->pic(),'thumb');?>" width="99" height="71">
						<p class="one"><a href="/news/d-<?php echo $v->id;?>.html"><?php echo Util::csubstr($v->title,0,14);?></a></p>
						<p class="two"><a href="/news/d-<?php echo $v->id;?>.html"><?php echo Util::csubstr(strip_tags($v->content),0,42);?></a></p>
					</div>
					<?php }?>
					<div class="new_li">
						<ul>
							<?php foreach($news ->getnews(71,8) as $k => $v){?>
							<li <?php if($k==3)echo 'class="ul_li"';?>><a href="/news/d-<?php echo $v->id;?>.html"><?php echo $v->title;?></a></li>
							<?php }?>
						</ul>
					</div>
				</div>
				<div class="trends trends_height_1">
					<p class="p2"><span style="display:block; float:left;">写字楼热点行情</span><a href="/news/list.php?bid=72" style="display:block; float:right;">更多</a></p>
					<?php foreach($news ->getattnews(72,1,'h') as $v){?>
					<div class="p1"> <img src="<?php echo Util::getpicthumb($v->pic(),'thumb');?>" width="99" height="71">
                    <ul>
						<li class="one"><a href="/news/d-<?php echo $v->id;?>.html"><?php echo Util::csubstr($v->title,0,14);?></a></li>
						<li class="two"><a href="/news/d-<?php echo $v->id;?>.html"><?php echo Util::csubstr(strip_tags($v->content),0,42);?></a></li>
                    </ul>
					</div>
					<?php }?>
					<div class="new_li">
						<ul>
							<?php foreach($news ->getnews(72,8) as $k => $v){?>
							<li <?php if($k==3)echo 'class="ul_li"';?>><a href="/news/d-<?php echo $v->id;?>.html"><?php echo $v->title;?></a></li>
							<?php }?>
						</ul>
					</div>
				</div>
			</div>
			<div class="building_new_l_b"></div>
		</div>
		<div class="building_new_r">
			<div class="mark_bg hot_rent">
				<ul class="md_ul">
					<li style="color: #A4A4A4; border:none; text-decoration:none;" >热门楼盘</li>
					<!--楼盘不分出租出售。  建议修改成热门楼盘就可以了-->
					<!--li>热售楼盘</li-->
				</ul>
				<div class="md_content">
					<div class="hot_r rent_bg_r" >
						<ul style="height:320px">
							<?php foreach($hotrentborough as $k=>$v){?>
							<li> <span class="c_1 <?php if($k <3) echo 'c_2';?>"><?php echo $k+1;?></span>
								<dl>
									<dt <?php if($k == 0) echo 'style="display:none"';?>><a href="/borough/d-<?php echo $v->id;?>.html"><?php echo $v->b_name;?></a><span>[<?php echo Config::item('borough_area.'.$v->b_area1);?>]</span></dt>
									<dd <?php if($k != 0) echo 'style="display:none"';?>><a href="/borough/d-<?php echo $v->id;?>.html"><img src="<?php echo Util::getpicthumb($v -> getdefaultpic(),'small') ;?>" width="79" height="64" alt=""></a>
										<p><a href="/borough/d-<?php echo $v->id;?>.html" class="gray"><?php echo $v->b_name;?></a></p>
										<p><a href="/borough/d-<?php echo $v->id;?>.html"><?php echo Config::item('borough_area.'.$v->b_area1);?>-<?php echo Config::item('area_'.$v->b_area1.'.'.$v->b_area2);?></a></p>
										<p><a href="/borough/d-<?php echo $v->id;?>.html"  class="red"><?php echo $v->b_rentprice1.'-'.$v->b_rentprice2;?>元/平米•月</a></p>
									</dd>
								</dl>
							</li>
							<?php }?>
						</ul>
					</div>
					<div class="hot_s  fn-hide">
						<ul>
							<?php foreach($hotsaleborough as $k=>$v){?>
							<li> <span class="c_1 <?php if($k <3) echo 'c_2';?>"><?php echo $k+1;?></span>
								<dl>
									<dt <?php if($k == 0) echo 'style="display:none"';?>><a href="/borough/d-<?php echo $v->id;?>.html"><?php echo $v->b_name;?>[<?php echo Config::item('borough_area.'.$v->b_area1);?>]</a><span><?php echo ($v->b_rentprice1+$v->b_rentprice2)/2;?></span></dt>
									<dd <?php if($k != 0) echo 'style="display:none"';?>><a href="/borough/d-<?php echo $v->id;?>.html"><img src="<?php echo Util::getpicthumb($v -> getdefaultpic(),'thumb') ;?>" width="79" height="64" alt=""></a>
										<p><a href="/borough/d-<?php echo $v->id;?>.html" class="gray">中加国际</a></p>
										<p><a href="/borough/d-<?php echo $v->id;?>.html"><?php echo Config::item('borough_area.'.$v->b_area1);?>-<?php echo Config::item('area_'.$v->b_area1.'.'.$v->b_area2);?></a></p>
										<p><a href="/borough/d-<?php echo $v->id;?>.html"  class="red"><?php echo $v->b_rentprice1.'-'.$v->b_rentprice2;?>元/m2/月</a></p>
									</dd>
								</dl>
							</li>
							<?php }?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="building_new">
		<div class="building_new_l">
			<div class="building_new_l_t"></div>
			<div class="building_new_l_bg new_div">
				<div class="trends trends_line trends_height_0">
					<p class="p2"><span style="display:block; float:left;">房产政策法规</span><a href="/news/list.php?bid=73" style="display:block; float:right;">更多</a></p>
					<div class="new_li">
						<ul>
							<?php foreach($news ->getnews(73,9) as $k => $v){?>
							<li><a href="/news/d-<?php echo $v->id;?>.html"><?php echo $v->title;?></a></li>
							<?php }?>
						</ul>
					</div>
				</div>
				<div class="trends trends_height_0">
					<p class="p2"><span style="display:block; float:left;">房产市场新闻</span><a href="/news/list.php?bid=74" style="display:block; float:right;">更多</a></p>
					<div class="new_li">
						<ul>
							<?php foreach($news ->getnews(74,9) as $k => $v){?>
							<li><a href="/news/d-<?php echo $v->id;?>.html"><?php echo $v->title;?></a></li>
							<?php }?>
						</ul>
					</div>
				</div>
			</div>
			<div class="building_new_l_b"></div>
		</div>
		<div class="building_new_right">
			<div class="building_new_right_t"></div>
			<div class="building_new_right_bg">
				<h4>最新房源信息</h4>
				<ul class="building_ul">
					<li class="ar">名称</li>
					<li class="mj">面积</li>
					<li class="price">价格</li>
				
				</ul>
				<ul class="b_ul">
					<?php foreach($hothouse as $v){?>
					<li><a href="/<?php if($v->type==1)echo 'rent'; else echo 'sale';?>/d-<?php echo $v->id;?>.html" class="h <?php if($v->type==2) echo 's';?>"><?php echo $v->b_name;?></a><span class="m"><?php echo number_format($v->area,0,'.','');?>平米</span><span class="p"><?php echo $v->price;?>
元/平米•月 </span></li>
					<?php }?>
				</ul>
			</div>
			<div class="building_new_right_b"></div>
		</div>
	</div>
	<!---------------------------------滚动图片+新闻咨询+推荐end------------------------------------------->
	<!-------------------------------------------底部公共部分代码------------------------------------------------------>
</div>
<script type="text/javascript" src="../js/js_for_tabp.js"></script>
