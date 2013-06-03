<div class="content">
	<div id="position_title">我的位置：<?php echo $postion;?></div>
	<div id="houses">
		<div class="houses_l">
			<DIV  class="wrap picshow" >
				<!--大图轮换区-->
				<div class="slides">
					<ul class="slide-pic">
						<?php foreach($piclist as $key => $value){?>
						<li class="cur"><a href="<?php echo Util::getpicthumb($value->pic_thumb,'reset');?>"> <IMG alt="" src="<?php echo Util::getpicthumb($value->pic_thumb,'big');?>" width=415 height=288></a></li>
						<?php }?>
					</ul>
					<ul class="slide-li op">
						<?php foreach($piclist as $key => $value){?>
						<li <?php if($key==3){echo 'class="one"';}?> <?php if($key==0){echo 'class="cur"';}?> ></li>
						<?php }?>
					</ul>
					<ul class="slide-li slide-txt">
						<?php foreach($piclist as $key => $value){?>
						<li <?php if($key==3){echo 'class="one"';}?> <?php if($key==0){echo 'class="cur"';}?> ><a href="<?php echo $value->pic_thumb;?>" target="_blank"><?php if(Config::item('borough_pictype.'.$value->pic_sub_cate))echo Config::item('borough_pictype.'.$value->pic_sub_cate); else echo "房源图片";?></a></li>
						<?php }?>
					</ul>
				</div>
				<div style=" text-align:center;  height:20px; line-height:20px;"><a href="/photo/details.php?id=<?php echo $borough->id;?>" target="_blank">查看全部相册</a></div>
			</DIV>
		</div>
		<div class="houses_r h_information_bo"> <span class="house_title">楼盘基本概况</span> <span class="score">完成度:</span> <span class="score_a"><?php echo $borough->b_complete;?>%</span>
			<ul class="houses_des_1">
				<li class="houses_r_li"><span class="f"><span class="f1">楼盘：</span><span class="t"><?php echo $borough->b_name;?> [<?php echo Config::item('area_'.$borough->b_area1.'.'.$borough->b_area2);?>]</span></span> <span> <span class="f1">类型：</span><?php echo Config::item('borough_level.'.$borough->b_level);?></span> </li>
				<li class="houses_r_li"><span class="f"><span class="f1">租金：</span><span class="r"><?php echo $borough->b_rentprice1.'-'.$borough->b_rentprice2;?></span> 元/平米•月 </span> <span> <span class="f1">客梯：</span><?php echo $borough->get('keti');?> 部&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="f1">货梯：</span><?php echo $borough->get('huoti');?>部</span></li>
				<li class="houses_r_li"><span class="f"><span class="f1">总楼层：</span><span class="r"><?php echo $borough->get('zonglouceng');?></span>层</span> <span><span class="f1">标准层高：</span><?php echo $borough->get('cenggao');?>平米</li>
				<li class="houses_r_li"><span class="f"><span class="f1">单层面积：</span><span class="r"><?php echo $borough->get('cengmianji');?></span>平米</span> <span><span class="f1">空调：</span><?php echo $borough->get('kongtiaoxitong');?></span></li>
				<li class="houses_r_li"><span class="f"><span class="f1">物业：</span><span class="r"><?php echo $borough->get('wuyegongsi');?></span></span> <span><span class="f1">物管费：</span><?php echo $borough->get('wuyefei');?>元/平米</span></li>
				<li class="houses_r_li"><span class="f"><span class="f1">开发商：</span> </span> <span><span class="f1">停车位：</span>地上<?php echo $borough->get('chewei1');?>个 &nbsp; /地下<?php echo $borough->get('chewei2');?>个</span></li>
				<li class="houses_r_li"><span class="f"><span class="f1">地址：</span><?php echo $borough->b_addr;?></span></li>
			</ul>
            
            	<p class="hp1">打电话请告诉经纪人,您是从<span>好楼帮</span>上看见的</p>
			<p class="p_t"><span class="ep">二手均价：</span> <span class="r">￥<?php echo $borough->b_saletprice1;?>-<?php echo $borough->b_saletprice2;?>元/平米</span> <span class="sa"><span class="or"><?php echo $borough->gethousenum(2);?></span>套在售</span> &nbsp;&nbsp;&nbsp;<span class="ep">租赁均价：</span> <span class="r">￥<?php echo $borough->b_rentprice1;?>-<?php echo $borough->b_rentprice2;?>元/平米•月</span> <span class="sa"><span class="or"><?php echo $borough->gethousenum(1);?></span>套在租</span> </p>
			<div class="phone_num img_1"><span class="phone_num_main">028-68611333</span><!--font style="font-size:24px; color:#001645; font-weight:blod;">转</font></span> <span class="phone_num_less">1006</span--> </div>
             <!-- Baidu Button BEGIN -->
<div id="bdshare_0" class="bdshare_t bds_tools get-codes-bdshare">
<span class="bds_more">分享到：</span>
<a class="bds_qzone"></a>
<a class="bds_tsina"></a>
<a class="bds_tqq"></a>
<a class="bds_renren"></a>
<a class="bds_t163"></a>
<a class="shareCount"></a>
</div>
<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6718782" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script>
<!-- Baidu Button END -->


			<!--p class="pe">联系经纪人：<a href="/"><span class="b">李欣帽</span></a></p-->
		</div>
	</div>
	<div id="house_information">
		<div class="house_infor_l">
			<div class="house_infor_l_a">
				<div class="h_t"></div>
				<div class="h_bg">
					<h2>楼盘出租信息：</h2>
					<ul class="h_ul hover_1">
						<li><span class="lh">楼层房号</span><span class="mj">面积</span><span class="jg">价格</span><span class="fb">发布时间</span></li>
						<?php foreach($renthouse as $v){?>
						<li><span class="a1"><?php echo $v->h_floor;?>F  <?php echo $v->roomnum;?>号 </span><span class="a2"><?php echo $v->area;?>平米 </span><span class="a3"><?php echo $v->price;?>元/平米•月</span><span class="a4"><?php echo $v->creattime();?></span><a href="/rent/d-<?php echo $v->id;?>.html" target="_blank" class="a5"> 查看详情</a></li>
						<?php }?>
					</ul>
					<a href="/rent/?b_id=<?php echo $borough->id;?>" target="_blank" style="display:block; height:30px; float:right; line-height:30px; padding-right:20px; font-weight:bold; color:#0036fe;">点击 展开更多></a> </div>
				<div class="h_b"></div>
			</div>
			<div class="house_infor_l_a" style="margin-top:20px;">
				<div class="h_t"></div>
				<div class="h_bg">
					<h2>楼盘出售信息：</h2>
					<ul class="h_ul hover_2">
						<li><span class="lh">楼层房号</span><span class="mj">面积</span><span class="jg">价格</span><span class="fb">发布时间</span></li>
						<?php foreach($salehouse as $v){?>
						<li><span class="a1"><?php echo $v->h_floor;?>F  <?php echo $v->roomnum;?>号 </span><span class="a2"><?php echo $v->area;?>平米 </span><span class="a3"><?php echo $v->price;?>元/平米</span><span class="a4"><?php echo $v->creattime();?></span><a href="/sale/d-<?php echo $v->id;?>.html" target="_blank" class="a5"> 查看详情</a></li>
						<?php }?>
					</ul>
					<a href="/sale/?b_id=<?php echo $borough->id;?>" target="_blank" style="display:block; height:30px; float:right; line-height:30px; padding-right:20px; font-weight:bold; color:#0036fe;">点击 展开更多></a>
				</div>
				<div class="h_b"></div>
			</div>
			<div id="parameter">
				<?php require('../iframe.borough.php');?>
			</div>
		</div>
		<div class="house_infor_r">
			<!-----------------------------楼盘评分----------------------------------->
			<div class="mark" style="display:none;">
				<div class="mark_t"></div>
				<div class="mark_bg">
					<h2>楼盘评分</h2>
					<div class="content">
						<div class="health">
							<p>卫生方面</p>
							<span><span class="sc"></span></span>
							<p class="fs">100</p>
						</div>
						<div class="health">
							<p>电梯速度</p>
							<span><span class="sd"></span></span>
							<p class="fs">80</p>
						</div>
						<div class="health">
							<p>物业服务</p>
							<span><span class="wy"></span></span>
							<p class="fs">75</p>
						</div>
						<div class="health">
							<p>生活配套</p>
							<span><span class="pt"></span></span>
							<p class="fs">35</p>
						</div>
						<div class="health">
							<p>停车方面</p>
							<span><span class="pa"></span></span>
							<p class="fs">30</p>
						</div>
						<div class="health">
							<p>综合评分</p>
							<span><span class="zh"></span></span>
							<p class="fs r">87</p>
						</div>
					</div>
				</div>
				<div class="mark_b"></div>
			</div>
			<!-----------------------------楼盘评分end----------------------------------->
			<!-----------------------------热租楼盘和热售楼盘----------------------------------->
			<div class="mark">
				<div class="mark_t"></div>
				<div class="mark_bg hot_rent">
					<ul class="md_ul">
						<li class="hover_li">热门楼盘</li>
						<!--li>热售楼盘</li-->
					</ul>
					<div class="md_content">
						<div class="hot_r rent_bg_r">
							<ul>
								<?php foreach($hotrentborough as $k=>$v){?>
								<li>
									<dl>
										<dt <?php if($k == 0) echo 'style="display:none"';?>><a style="float:left;" href="/borough/d-<?php echo $v->id;?>.html"><?php echo $v->b_name;?></a>  <a style="float:right; color:#00F" href="/borough/d-<?php echo $v->id;?>.html"></a>
                                        
                                        <span>【<?php echo Config::item('borough_area.'.$v->b_area1);?>】</span>
                                        
                                        
                                        </dt>
										<dd <?php if($k != 0) echo 'style="display:none"';?>><a href="/borough/d-<?php echo $v->id;?>.html"><img src="<?php echo Util::getpicthumb($v -> getdefaultpic(),'small') ;?>" width="79" height="64" alt=""></a>
											<p><a href="/borough/d-<?php echo $v->id;?>.html" class="gray"><?php echo $v->b_name;?></a></p>
											<p><a href="/borough/d-<?php echo $v->id;?>.html"><?php echo Config::item('borough_area.'.$v->b_area1);?>-<?php echo Config::item('area_'.$v->b_area1.'.'.$v->b_area2);?></a></p>
											<p><a href="/borough/d-<?php echo $v->id;?>.html"  class="red"><?php echo $borough->gethousenum(2);?>&nbsp;套在售&nbsp;&nbsp;<?php echo $borough->gethousenum(1);?>&nbsp;套在租</a></p>
										</dd>
									</dl>
								</li>
								<?php }?>
							</ul>
						</div>
						<div class="hot_s  fn-hide">
							<ul>
								<li>
									<dl>
										<dt style="display:none;"><a href="#">平安国际[人民南路]</a><span>140</span></dt>
										<dd><a href=""><img src="../img/x_03.jpg" width="79" height="64" alt=""></a>
											<p><a href="#" class="gray">中加国际</a></p>
											<p><a href="#">锦江区-成龙路</a></p>
											<p><a href="#"  class="red">57.00元/m2/月</a></p>
										</dd>
									</dl>
								</li>
								<li>
									<dl>
										<dt ><a href="#">平安国际[人民南路]</a><span>140</span></dt>
										<dd style="display:none;"><a href=""><img src="../img/x_03.jpg" width="79" height="64" alt=""></a>
											<p><a href="#" class="gray">中加国际</a></p>
											<p><a href="#">锦江区-成龙路</a></p>
											<p><a href="#"  class="red">57.00元/m2/月</a></p>
										</dd>
									</dl>
								</li>
								<li>
									<dl>
										<dt ><a href="#">平安国际[人民南路]</a><span>140</span></dt>
										<dd style="display:none;"><a href=""><img src="../img/x_03.jpg" width="79" height="64" alt=""></a>
											<p><a href="#" class="gray">中加国际</a></p>
											<p><a href="#">锦江区-成龙路</a></p>
											<p><a href="#"  class="red">57.00元/m2/月</a></p>
										</dd>
									</dl>
								</li>
								<li>
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
				<div class="mark_b"></div>
			</div>
			<!----------------------------热租楼盘和热售楼盘end----------------------------------->
		</div>
	</div>
	<!-----------------------------楼盘信息end----------------------------------->
	<!-----------------------------具体的地图----------------------------------->
	<div class="map_a" style="clear:both;">
		<div class="map_title"><?php echo $borough->b_name;?></div>
		<iframe name="map" frameborder="0" width="1000" height="340" src="/iframe.map.php?id=<?php echo $borough->id;?>" scrolling="No"></iframe>
	</div>
	<!-----------------------------具体的地图end----------------------------------->
	<!-----------------------------具体的每个楼盘照片----------------------------------->
	<div class="map_a Real_photo">
		<div class="map_title">
			<p><?php echo $borough->b_name;?></p>
			<span>楼盘相册</span><!--a href="#">楼盘照片（21）</a><a href="#">周边照片（8）</a><a href="#">平面图（21）</a--></div>
		<div class="r_p">
			<ul>
				<?php foreach($allpic as $v){?>
				<li><a href="<?php echo Util::getpicthumb($v->pic_thumb,'reset');?>"><img src="<?php echo Util::getpicthumb($v->pic_thumb,'small');?>" width="100" height="75" alt=""></a></li>
				<?php }?>
			</ul>
		</div>
	</div>
	<!-----------------------------具体的每个楼盘照片end----------------------------------->
	<!---------------------------经纪人信息----------------------------------->
	<div class="map_a Real_photo r">
		<div class="map_title"></div>
		<div class="phone_num phone_num_left"><span class="phone_num_main">028-68611333</span></div>
		<div class="phone_num_right_text">
			<p class="two">对该楼盘房源感兴趣？  联系<a href="/borker">好楼帮</a>经纪人，给您提供更多方案</p>
		</div>
		<div style="clear:both; height:20px;"></div>
	</div>
	<!---------------------------经纪人信息end----------------------------------->
	<!---------------------------你可能感兴趣----------------------------------->
	<?php require_once( ROOTPATH . '/interestrent.php');?>
</div>

<script type="text/javascript" src="/js/jquery.lightbox-0.5.js"></script>
<link rel="stylesheet" type="text/css" href="/css/jquery.lightbox-0.5.css" media="screen" />
<script type="text/javascript">
    $(function() {
        $('.r_p a').lightBox();
		$('.cur a').lightBox();
    });
    </script>