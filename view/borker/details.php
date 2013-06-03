<?php $news = new News();?>
<?php $hs = Config::item('house.paystyle3');?>
<div class="content">
	<!-----------------------------楼盘信息----------------------------------->
	<div id="position_title">我的位置:<?php echo $postion;?> </div>
	<div id="agent">
		<div class="agent_l">
			<div class="agent_info"> <img src="<?php echo $borker->avatar();?>" width="78" height="103" alt="" class="im"> <span class="name">姓名：<?php echo $borker->uname;?></span> <span class="Certificate">执业资格证号：<?php echo $borker->get('coding');?></span>
				<p class="count">累计出租房源：<span><?php echo $borker->countrent();?></span> 套</p>
				<p class="today">累计出售房源：<span><?php echo $borker->countsale();?></span> 套</p>
				<div class="phone_num im5"><span class="phone_num_less"><?php echo $borker->get('tel');?></span> </div>
				<p class="co">欢迎致电好楼帮经纪人，为您提供 <span>找房/选址/顾问/代办消防 </span>等服务</p>
			</div>
			<div class="agent_content">
				<div class="agent_rent">
					<ul class="md_rent">
						<li class="md_hover">出租房源</li>
						<li>出售房源</li>
					</ul>
					<div class="content_con">
						<div class="re">
							<ul>
								<?php foreach($rent as $v){?>
								<li>
									<div class="fang_price">
									<?php echo $v->price;?>元/平米•月<br />
                                    <font style="font-size:12px; color:#888; font-weight:200; text-decoration:none;"><?php echo Config::item('house.paystyle.'.$v->paystyle);?> 总租金：<?php echo $v->price*$v->area;?>元/月</font>
                                     </div>
                                     
									<div class="img5"><a href="/rent/d-<?php echo $v->id;?>.html" target="_blank"><img src="<?php echo Util::getpicthumb($v->getdefaultpic(),'thumb');?>" width="107" height="71" alt=""></a></div>
                                    
									<div class="p_con"> <a href="/rent/d-<?php echo $v->id;?>.html" target="_blank"><?php echo $v->b_name;?></a>
										<p> 
										楼层：<font style="font-size:12px; font-weight:bold; color:#0000DD"><?php echo $v->h_floor;?></font>F  &nbsp;&nbsp;房号：<font style="font-size:12px; font-weight:bold; color:#0000DD"><?php echo $v->roomnum;?></font>号 <br />
                                        面积：<font style="font-size:12px; font-weight:bold; color:#0000DD"><?php echo $v->area;?></font>平米 <br />
								
											地址： <?php echo $v->b_addr;?></p>
									</div>
									<div class="adc">
										<dl class="boker_abc">
											<?php if($v->get('qt1'))echo '<dt class="exemption">'.$hs[$v->get('qt1')].'</dt>';?>
											<?php if($v->get('qt2') ==1 )echo '<dt class="yj">免佣金</dt>';?>
											<?php if($v->get('qt3') ==1 )echo '<dt class="jz">急租</dt>';?>
											<dt class="qs" ><?php echo Config::item('house_fitment.'.$v->fitment);?></dt>
										</dl>
									</div>
								</li>
								<?php }?>
							</ul>
						</div>
						<div class="re fn-hide">
							<ul>
								<?php foreach($sale as $v){?>
								<li>
									<div class="fang_price">
									<?php echo number_format($v -> area * $v -> price /10000 , 2) ;?>万<br />
					
						<font style="font-size:12px;  color:#888; font-weight:200; text-decoration:none;">单价：<?php echo $v->price;?>元/平米</font>
                                     </div>
                                     
									<div class="img5"><a href="/sale/d-<?php echo $v->id;?>.html" target="_blank"><img src="<?php echo Util::getpicthumb($v->getdefaultpic(),'thumb');?>" width="107" height="71" alt=""></a></div>
                                    
									<div class="p_con"> <a href="/sale/d-<?php echo $v->id;?>.html" target="_blank"><?php echo $v->b_name;?></a>
										<p> 
										楼层：<font style="font-size:12px; font-weight:bold; color:#0000DD"><?php echo $v->h_floor;?></font>F  &nbsp;&nbsp;房号：<font style="font-size:12px; font-weight:bold; color:#0000DD"><?php echo $v->roomnum;?></font>号 <br />
                                        面积：<font style="font-size:12px; font-weight:bold; color:#0000DD"><?php echo $v->area;?></font>平米 <br />
								
											地址： <?php echo $v->b_addr;?></p>
									</div>
									<div class="adc">
										<dl class="boker_abc">
											<?php if($v->get('qt1'))echo '<dt class="exemption">'.$hs[$v->get('qt1')].'</dt>';?>
											<?php if($v->get('qt2') ==1 )echo '<dt class="yj">免佣金</dt>';?>
											<?php if($v->get('qt3') ==1 )echo '<dt class="jz">急售</dt>';?>
											<dt class="qs" ><?php echo Config::item('house_fitment.'.$v->fitment);?></dt>
										</dl>
									</div>
								</li>
								<?php }?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="agent_r">
			<div class="ag"><a href="/map"><img src="../img/fo_10.jpg"></a></div>
			<div class="ags">
				<ul class="ags_ul">
					<li class="hover_li">站内资讯</li>
					<li>各地资讯</li>
				</ul>
				<div class="zhuyao">
					<div class="zhuyao1">
						<ul>
							<?php foreach($news ->getnews(76,7) as $v){?>
							<li><a href="/news/d-<?php echo $v->id;?>.html"><?php echo Util::csubstr($v->title,0,14);?></a></li>
							<?php }?>
						</ul>
					</div>
					<div class="zhuyao1 fn-hide">
						<ul>
							<?php foreach($news ->getnews(75,7) as $v){?>
							<li><a href="/news/d-<?php echo $v->id;?>.html"><?php echo Util::csubstr($v->title,0,14);?></a></li>
							<?php }?>
						</ul>
					</div>
				</div>
			</div>
			<div class="af"><a href="/rent/?is_present=1"><img src="../img/fo_11.jpg" width="203" height="165" alt=""></a></div>
		</div>
	</div>
	<!---------------------------你可能感兴趣----------------------------------->
	<?php require_once( ROOTPATH . '/interestrent.php');?>
	<!---------------------------你可能感兴趣end----------------------------------->
</div>
<script type="text/javascript" src="../js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="../js/index.js"></script>
<script type="text/javascript" src="../js/slide.js"></script>
