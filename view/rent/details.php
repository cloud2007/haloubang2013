<div class="content">
	<div id="position_title">我的位置：<?php echo $postion;?></div>
	<?php
	if($house->states == 2 )
	echo '<div class="Error" style="border:1px solid #ece05b; line-height:30px; background:#FF9; font-size:18px; padding-left:15px; color:red; margin-bottom:15px;">此房源已下架,<font style="font-size:12px; padding-left:15px;">点击查看<a style="color:#000;" href="/borough/d-'.$house->id.'.html">该楼盘其他房源</a></font></div>';
	?>
	<div id="houses">
		<div class="houses_l">
			<DIV  class="wrap picshow" >
				<!--大图轮换区-->
				<div class="slides">
					<ul class="slide-pic">
						<?php foreach($piclist as $key => $value){?>
						<li class="cur"><a href="<?php echo Util::getpicthumb($value->pic_thumb,'reset');?>" target="_blank"> <IMG alt="" src="<?php echo Util::getpicthumb($value->pic_thumb,'big');?>" width=415 height=288></a></li>
						<?php }?>
					</ul>
					<ul class="slide-li op">
						<?php foreach($piclist as $key => $value){?>
						<li <?php if($key==3){echo 'class="one"';}?> <?php if($key==0){echo 'class="cur"';}?> ></li>
						<?php }?>
					</ul>
					<ul class="slide-li slide-txt">
						<?php foreach($piclist as $key => $value){?>
						<li <?php if($key==3){echo 'class="one"';}?> <?php if($key==0){echo 'class="cur"';}?> ><a href="<?php echo $value->pic_thumb;?>">
							<?php if(Config::item('borough_pictype.'.$value->pic_sub_cate))echo Config::item('borough_pictype.'.$value->pic_sub_cate); else echo "房源图片";?>
							</a></li>
						<?php }?>
					</ul>
				</div>
				<div style=" text-align:center;  height:20px; line-height:20px;"><a href="/photo/h-<?php echo $house->id;?>.html" target="_blank">查看全部相册</a></div>
			</DIV>
		</div>
		<div class="houses_r h_information">
			<!---- <?php if($house->
			is_present) echo '
			<div class="tip_for_house_info">'.$house->present.'</div>
			';?>  ---> <span class="house_title">房源基本概况</span>
			<ul class="houses_des">
				<li><span class="f"><span class="f1">楼盘：</span><span class="t"><a href="/borough/d-<?php echo $borough->id;?>.html"><?php echo $borough->b_name;?></a><font style="font-size:12px;">【<?php echo Config::item('area_'.$borough->b_area1.'.'.$borough->b_area2);?>】</font></span></span> </li>
				<li> <span class="f"> <span class="f1">租金：</span> <span class="r"><?php echo $house->price;?></span> 元/平米•月 </span> <span class="f1">总租金：</span> <span class="r"><?php echo $house -> area * $house -> price ;?></span>元/月 </li>
				<li > <span class="f"> <span class="f1">房号：</span> <span class="r"><?php echo $house->roomnum;?></span>号</span> <span class="f1">面积：</span><span class="r"><?php echo $house->area;?> </span>平方米</li>
				
			</ul>
			<div class="phone_num img_1"> <span class="phone_num_less"><?php echo $borker->get('tel');?></span> </div>
			<img src="<?php echo $borker->avatar();?>" width="78" height="103" alt="" class="img_2"> <img src="../img/info_02.jpg" width="22" height="15" alt="" class="img_3"> <img src="../img/info_03.jpg" width="22" height="15" alt="" class="img_4">
			<p class="hp">经纪人：<a href="/borker/details.php?id=<?php echo $borker->id?>"><?php echo $borker->uname;?></a></p>
			<p class="hp1">打电话请告诉经纪人,您是从<span>好楼帮</span>上看见的</p>
            
            <!-- Baidu Button BEGIN -->
<div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">
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
            
            <ul class="houses_des_0">
            <li ><span class="f"><span class="f1">物管费：</span><span > <?php echo $borough->get('wuyefei');?>元/平方米 </span></span> <span class="f1">类别：</span><span ><?php echo Config::item("borough_level.".$borough->b_level);?></span></span></li>
                <li  style="border:none;"><span class="f"><span class="f1">地址：</span><span > <?php echo $borough->b_addr;?> </span></span> </span></li>
                </ul>
           
		</div>
	</div>
	<div id="house_information">
		<div class="house_infor_l">
        
        <div class="nav_for_details">
        <a class="one"  href="#h_Availability">房源介绍</a> <a href="#photo_pb_box">房源照片</a> <a href="#parameter">楼盘参数</a> <a href="#map_a">楼盘地图</a> <a href="#Real_photo">楼盘相册</a>
        </div>
        
        
			<?php if($house->is_present) echo '<div class="house_gift"><div class="house_gift_z">'.$house->present.'</div></div>';?>
			<div id="h_Availability">
				<p class="h_title">房源介绍</p>
				<?php echo $house->content;?> </div>
			<div class="photo_pb_box" id="photo_pb_box">
				<p class="h_title">房源照片</p>
				<?php foreach($piclists as $key => $value){?>
				<IMG alt="" src="<?php echo Util::getpicthumb($value->pic_thumb,'reset');?>">
				<p align="center">
					<?php if(Config::item('borough_pictype.'.$value->pic_sub_cate))echo Config::item('borough_pictype.'.$value->pic_sub_cate); else echo "房源图片";?>
				</p>
				<?php }?>
			</div>
			<div id="parameter">
				<?php require('../iframe.borough.php');?>
			</div>
		</div>
		<div class="house_infor_r r_s">
			<!------------------------------------优惠服务--------------------------->
			<div class="mark h1">
				<div class="mark_t"></div>
				<div class="mark_bg h">
					<h2>优惠服务</h2>
					<p class="s">  </p>
				</div>
				<div class="mark_b"></div>
			</div>
			<!-----------------------------优惠服务end----------------------------------->
			<!-------------------------------其他房源推荐------------------------------------------->
			<div class="mark h2">
				<div class="mark_t"></div>
				<div class="mark_bg h3">
					<p><span><?php echo $borough->b_name;?></span>其他房源推荐</p>
					<ul>
						<?php if( is_array($likehouse) ) {?>
						<?php foreach($likehouse as $value){?>
						<li> <a href="/rent/d-<?php echo $value->id;?>.html">
							<dl style="width:80px;float:left;">
								<?php echo $value->roomnum;?>号
							</dl>
							<dl style="width:60px;float:left;">
								<?php echo $value->area;?>平米
							</dl>
							<dl style="width:90px;float:left;">
								<?php echo $value->price;?>元/平米•月
							</dl>
							</a></li>
						<?php }}?>
					</ul>
				</div>
				<div class="mark_b"></div>
			</div>
			<!-------------------------------其他房源推荐end------------------------------------------->
			<!-----------------------------热租楼盘和热售楼盘----------------------------------->
			<div class="mark">
				<div class="mark_t"></div>
				<div class="mark_bg hot_rent" style="height:210px;">
					<ul class="md_ul">
						<li class="hover_li">热门租赁</li>
						<li>热门出售</li>
					</ul>
					<div class="md_content">
						<div class="hot_r rent_bg_r" style="height:210px;">
							<ul>
								<?php foreach($hotrenthouse as $k => $v){?>
								<li>
									<dl>
										<dt <?php if($k==0)echo 'style="display:none"';?>><a style="float:left; height: 18px;
    overflow: hidden;
    width: 105px; " href="/rent/d-<?php echo $v->id;?>.html"><?php echo $v->b_name.$v->roomnum.'号';?></a> <a style="float:right; color:#00f;" href="/rent/d-<?php echo $v->id;?>.html">【<?php echo Config::item('area_'.$v->b_area1.'.'.$v->b_area2);?>】</a> </dt>
										<dd <?php if($k>0)echo 'style="display:none"';?>><a href="/rent/d-<?php echo $v->id;?>.html"><img src="<?php echo Util::getpicthumb($v -> getdefaultpic(),'small') ;?>" width="79" height="64" alt=""></a>
											<p><a href="/rent/d-<?php echo $v->id;?>.html" class="gray"><?php echo $v->b_name.$v->roomnum.'号';?></a></p>
											<p><a href="/rent/d-<?php echo $v->id;?>.html"><?php echo Config::item('borough_area.'.$v->b_area1);?>-<?php echo Config::item('area_'.$v->b_area1.'.'.$v->b_area2);?></a></p>
											<p style="float:left;width:70px"><a href="/rent/d-<?php echo $v->id;?>.html"  class="red"><?php echo $v->price;?>元/平米</a></p>
											<p style=" float:right; width:50px"><a href="/rent/d-<?php echo $v->id;?>.html"  class="red"><?php echo $house->area;?>平米</a></p>
										</dd>
									</dl>
								</li>
								<?php }?>
							</ul>
						</div>
						<div class="hot_s  fn-hide">
							<ul>
								<?php foreach($hotsalehouse as $kk => $v){?>
								<li>
									<dl>
										<dt <?php if($kk==0)echo 'style="display:none"';?>><a style="float:left; height: 18px;
    overflow: hidden;
    width: 105px; " href="/rent/d-<?php echo $v->id;?>.html"><?php echo $v->b_name.$v->roomnum.'号';?></a> <a style="float:right; color:#00f" href="/sale/d-<?php echo $v->id;?>.html">【<?php echo Config::item('area_'.$v->b_area1.'.'.$v->b_area2);?>】</a> </dt>
										<dd <?php if($kk>0)echo 'style="display:none"';?>><a href="/rent/d-<?php echo $v->id;?>.html"><img src="<?php echo Util::getpicthumb($v -> getdefaultpic(),'small') ;?>" width="79" height="64" alt=""></a>
											<p><a href="/sale/d-<?php echo $v->id;?>.html" class="gray"><?php echo $v->b_name.$v->roomnum.'号';?></a></p>
											<p><a href="/sale/d-<?php echo $v->id;?>.html"><?php echo Config::item('borough_area.'.$v->b_area1);?>-<?php echo Config::item('area_'.$v->b_area1.'.'.$v->b_area2);?></a></p>
											<p style="float:left;width:70px"><a href="/sale/d-<?php echo $v->id;?>.html"  class="red"><?php echo $v->price;?>元/平米</a></p>
											<p style=" float:right; width:50px"><a href="/rent/d-<?php echo $v->id;?>.html"  class="red"><?php echo $house->area;?>平米</a></p>
										</dd>
									</dl>
								</li>
								<?php }?>
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
	<div class="map_a" id="map_a" style="clear:both;">
		<div class="map_title"><?php echo $borough->b_name;?></div>
		<iframe name="map" frameborder="0" width="1000" height="340" src="/iframe.map.php?id=<?php echo $borough->id;?>" scrolling="No"></iframe>
	</div>
	<!-----------------------------具体的地图end----------------------------------->
	<!-----------------------------具体的每个楼盘照片----------------------------------->
	<div class="map_a Real_photo" id="Real_photo">
		<div class="map_title">
			<p><?php echo $borough->b_name;?></p>
			<span>楼盘相册</span>
			<!--a href="#">楼盘照片（21）</a><a href="#">周边照片（8）</a><a href="#">平面图（21）</a-->
		</div>
		<div class="r_p">
			<ul>
				<?php foreach($borough_pic as $v){?>
				<li><a href="<?php echo Util::getpicthumb($v->pic_thumb,'reset');?>"><img src="<?php echo Util::getpicthumb($v->pic_thumb,'small');?>" width="100" height="75" alt=""></a></li>
				<?php }?>
			</ul>
		</div>
	</div>
	<!-----------------------------具体的每个楼盘照片end----------------------------------->
	<!---------------------------经纪人信息----------------------------------->
	<div class="map_a Real_photo r">
		<div class="map_title"></div>
		<div class="phone_num phone_num_left"> <span class="phone_num_less"><?php echo $borker->get('tel');?></span> </div>
		<div class="phone_num_right_text">
			<p class="one">联系经纪人：<a href="/borker/details.php?id=<?php echo $borker->id;?>"><?php echo $borker->uname;?></a></p>
			<p class="two">对该楼盘房源感兴趣？  联系<a href="/">好楼帮</a>经纪人，给您提供更多方案</p>
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
	
jQuery(window).scroll(function () {
	var fold = jQuery(window).height() + jQuery(window).scrollTop();
	if (fold > 1300) {
		jQuery(".Floating").css("display", "block");
	}
	else {
		jQuery(".Floating").css("display", "none");
	}
});
</script>
<style type="text/css">
.Floating{width:100%;height:43px; display:none; background:url(../img/Floating.png) repeat-x;position:fixed; bottom:0; left:0; z-index:10000; font-size:14px; font-weight:bold; color:#fff; line-height:43px;}
.floating_box { width:1003px; margin:0 auto;}
</style>
<div class="Floating">
	<div class="floating_box">租金：<?php echo $house->price;?>元/平方/月&nbsp;&nbsp;&nbsp;&nbsp;面积：<?php echo $house->area;?>平方米&nbsp;&nbsp;&nbsp;&nbsp;楼盘：<?php echo $borough->b_name;?>【<?php echo Config::item('area_'.$borough->b_area1.'.'.$borough->b_area2);?>】&nbsp;&nbsp;&nbsp;&nbsp; 经纪人：<?php echo $borker->uname;?>&nbsp;&nbsp;&nbsp;<font color="#FFFF00"><?php echo $borker->get('tel');?></font> </div>
</div>
