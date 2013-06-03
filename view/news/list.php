<div class="content">
	<!-----------------------------楼盘信息----------------------------------->
	<div id="position_title">我的位置：<?php echo $postion;?></div>
	<!---------------------------------写字楼咨询------------------------------------------->
	<div class="mation">
		<div class="mation_l">
			<div class="mation_l_t"></div>
			<div class="mation_l_bg">
				<h2><?php echo Config::item('news_type.'.$_GET['bid']);?></h2>
				<ul class="mation_ul">
					<?php foreach($news as $k => $v){?>
					<li <?php if(($k+1)%6==0) echo 'class="one"';?>><a href="/news/d-<?php echo $v->id;?>.html"><?php echo $v->title;?></a></li>
					<?php }?>
				</ul>
			</div>
			<div class="mation_l_b"></div>
		</div>
		<div class="mation_r ">
			<div class="mark_bg hot_rent">
				<ul class="md_ul">
					<li class="hover_li">热门楼盘</li>
					<!--li>热售楼盘</li-->
				</ul>
				<div class="md_content">
					<div class="hot_r rent_bg_r">
						<ul>
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
							<li> <span class="c_1 c_2">1</span>
								<dl>
									<dt style="display:none;"><a href="#">平安国际[人民南路]</a><span>140</span></dt>
									<dd><a href=""><img src="../img/x_03.jpg" width="79" height="64" alt=""></a>
										<p><a href="#" class="gray">中加国际</a></p>
										<p><a href="#">锦江区-成龙路</a></p>
										<p><a href="#"  class="red">57.00元/m2/月</a></p>
									</dd>
								</dl>
							</li>
							<li> <span class="c_1 c_2">2</span>
								<dl>
									<dt ><a href="#">平安国际[人民南路]</a><span>140</span></dt>
									<dd style="display:none;"><a href=""><img src="../img/x_03.jpg" width="79" height="64" alt=""></a>
										<p><a href="#" class="gray">中加国际</a></p>
										<p><a href="#">锦江区-成龙路</a></p>
										<p><a href="#"  class="red">57.00元/m2/月</a></p>
									</dd>
								</dl>
							</li>
							<li> <span class="c_1 c_2">3</span>
								<dl>
									<dt ><a href="#">平安国际[人民南路]</a><span>140</span></dt>
									<dd style="display:none;"><a href=""><img src="../img/x_03.jpg" width="79" height="64" alt=""></a>
										<p><a href="#" class="gray">中加国际</a></p>
										<p><a href="#">锦江区-成龙路</a></p>
										<p><a href="#"  class="red">57.00元/m2/月</a></p>
									</dd>
								</dl>
							</li>
							<li> <span class="c_1">4</span>
								<dl>
									<dt ><a href="#">平安国际[人民南路]</a><span>140</span></dt>
									<dd style="display:none;"><a href=""><img src="../img/x_03.jpg" width="79" height="64" alt=""></a>
										<p><a href="#" class="gray">中加国际</a></p>
										<p><a href="#">锦江区-成龙路</a></p>
										<p><a href="#"  class="red">57.00元/m2/月</a></p>
									</dd>
								</dl>
							</li>
							<li> <span class="c_1">5</span>
								<dl>
									<dt ><a href="#">平安国际[人民南路]</a><span>140</span></dt>
									<dd style="display:none;"><a href=""><img src="../img/x_03.jpg" width="79" height="64" alt=""></a>
										<p><a href="#" class="gray">中加国际</a></p>
										<p><a href="#">锦江区-成龙路</a></p>
										<p><a href="#"  class="red">57.00元/m2/月</a></p>
									</dd>
								</dl>
							</li>
							<li> <span class="c_1">6</span>
								<dl>
									<dt ><a href="#">平安国际[人民南路]</a><span>140</span></dt>
									<dd style="display:none;"><a href=""><img src="../img/x_03.jpg" width="79" height="64" alt=""></a>
										<p><a href="#" class="gray">中加国际</a></p>
										<p><a href="#">锦江区-成龙路</a></p>
										<p><a href="#"  class="red">57.00元/m2/月</a></p>
									</dd>
								</dl>
							</li>
							<li> <span class="c_1">7</span>
								<dl>
									<dt ><a href="#">平安国际[人民南路]</a><span>140</span></dt>
									<dd style="display:none;"><a href=""><img src="../img/x_03.jpg" width="79" height="64" alt=""></a>
										<p><a href="#" class="gray">中加国际</a></p>
										<p><a href="#">锦江区-成龙路</a></p>
										<p><a href="#"  class="red">57.00元/m2/月</a></p>
									</dd>
								</dl>
							</li>
							<li> <span class="c_1">8</span>
								<dl>
									<dt ><a href="#">平安国际[人民南路]</a><span>140</span></dt>
									<dd style="display:none;"><a href=""><img src="../img/x_03.jpg" width="79" height="64" alt=""></a>
										<p><a href="#" class="gray">中加国际</a></p>
										<p><a href="#">锦江区-成龙路</a></p>
										<p><a href="#"  class="red">57.00元/m2/月</a></p>
									</dd>
								</dl>
							</li>
							<li> <span class="c_1">9</span>
								<dl>
									<dt ><a href="#">平安国际[人民南路]</a><span>140</span></dt>
									<dd style="display:none;"><a href=""><img src="../img/x_03.jpg" width="79" height="64" alt=""></a>
										<p><a href="#" class="gray">中加国际</a></p>
										<p><a href="#">锦江区-成龙路</a></p>
										<p><a href="#"  class="red">57.00元/m2/月</a></p>
									</dd>
								</dl>
							</li>
							<li> <span class="c_1">10</span>
								<dl>
									<dt ><a href="#">平安国际[人民南路]</a><span>140</span></dt>
									<dd style="display:none;"><a href=""><img src="../img/x_03.jpg" width="79" height="64" alt=""></a>
										<p><a href="#" class="gray">中加国际</a></p>
										<p><a href="#">锦江区-成龙路</a></p>
										<p><a href="#"  class="red">57.00元/m2/月</a></p>
									</dd>
								</dl>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="b">
				<div class="building_new_right_t"></div>
				<div class="building_new_right_bg">
					<h4>最新租赁信息</h4>
					<ul class="building_ul">
						<li class="ar">区域</li>
						<li class="mj">面积</li>
						<li class="price">价格</li>
					
					</ul>
					<ul class="b_ul">
					<?php foreach($hothouse as $v){?>
					<li><a href="/<?php if($v->type==1)echo 'rent'; else echo 'sale';?>/d-<?php echo $v->id;?>.html" class="h <?php if($v->type==2) echo 's';?>"><?php echo $v->b_name;?></a><span class="m"><?php echo number_format($v->area,0,'.','');?>平米</span><span class="p"><?php echo $v->price;?>元/平米•月</span></li>
					<?php }?>
				</ul>
				</div>
				<div class="building_new_right_b"></div>
			</div>
		</div>
	</div>
	<!---------------------------------写字楼咨询end------------------------------------------->
	<!---------------------------你可能感兴趣----------------------------------->
	<?php require_once( ROOTPATH . '/interestrent.php');?>
	<!---------------------------你可能感兴趣end----------------------------------->
	<!-------------------------------------------底部公共部分代码------------------------------------------------------>
</div>
