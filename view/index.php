<?php $news = new News()?>
<div class="content">
	<div id="search">
		<form id="form1" name="form1" method="post" action="/search.php">
			<div id="search_l">
				<div class="bg_t"></div>
				<div class="bg">
					<div class="search_nav">
						<label>
						<input type="radio" name="type" value="1" checked="checked">
						找出租</label>
						<label>
						<input type="radio" name="type" value="2">
						找出售</label>
						<label>
						<input type="radio" name="type" value="3">
						找新盘</label>
					</div>
					<div class="search_infor">
						<div class="search_form">
							<input type="text" name="q" value="请输入楼盘名称、街道名称......" class="t">
							<button class="btn"></button>
						</div>
						<div class="line"></div>
						<div id="menu_list">
							<div class="CRselectBox" style="display:block">
								<input type="hidden" value=""  name="area1" id="area1"/>
								<input type="hidden" value=""  name="area1_CRtext" id="area1_CRtext"/>
								<a class="CRselectValue" href="javascript:void(0);" rel="0">选择区域</a>
								<ul class="CRselectBoxOptions">
									<?php foreach(Config::item('borough_area') as $k=>$v){?>
									<li class="CRselectBoxItem"><a href="javascript:void(0);" rel="<?php echo $k;?>"><?php echo $v;?></a></li>
									<?php }?>
								</ul>
							</div>
							<div class="CRselectBox1">
								<input type="hidden" value=""  name="level" id="level"/>
								<input type="hidden" value=""  name="level_CRtext1" id="level_CRtext1"/>
								<a class="CRselectValue1" href="javascript:void(0);" rel="0">选择写字楼级别</a>
								<ul class="CRselectBoxOptions1">
									<?php foreach(Config::item('borough_level') as $k=>$v){?>
									<li class="CRselectBoxItem1"><a href="javascript:void(0);" rel="<?php echo $k;?>"><?php echo $v;?></a></li>
									<?php }?>
								</ul>
							</div>
							<div class="CRselectBox2">
								<input type="hidden" value=""  name="area" id="area"/>
								<input type="hidden" value=""  name="area_CRtext2" id="area_CRtext2"/>
								<a class="CRselectValue2" href="javascript:void(0);" rel="0">选择面积区间</a>
								<ul class="CRselectBoxOptions2">
									<?php $Creaturl = new creaturls();?>
									<?php $Creaturl -> creaturl_index('area');?>
								</ul>
							</div>
						</div>
					</div>
					<p class="hot" id="hotsearch">热门搜索：
						<?php
					$hotsearch = Config::item('hotsearch');
					shuffle($hotsearch);
					?>
						<?php foreach( $hotsearch as $k => $v){?>
						<a href="/rent/?q=<?php echo $v;?>" class="hot_c"><?php echo $v;?></a>
						<?php
					if($k==4)break;
					}
					?>
						<a href="javascript:void(0);" onclick="changehotsearch();">手气不错</a> </p>
				</div>
				<div class="bg_b"></div>
			</div>
		</form>
		<!------------------------------------------公告------------------------------------------->
		<div id="gonggao">
			<div class="gg"> <span>公告：</span>
				<div class="gg_ad">
					<div class="new_ad" id="con">
						<ul>
							<?php foreach(Config::item('notice') as $v){?>
							<li><?php echo $v;?></li>
							<?php }?>
						</ul>
					</div>
				</div>
				<div class="button_to_zc"> <a href="/trust" ><img src="/img/bg_fb.jpg"  width="145" height="31"/></a> </div>
			</div>
		</div>
		<!------------------------------------------公告end------------------------------------------->
	</div>
	<!------------------------------------------搜素栏和广告区域end------------------------------------------->
	<!------------------------------------------热门租赁------------------------------------------->
	<div class="rent">
		<div class="rent_t"></div>
		<div class="rent_bg">
			<div class="rent_bg_l">
				<div class="rent_title">
					<p class="rent_title_l"><a href="" onmouseover='loadhouse(1,"","houtrenthouse")'>热门租赁</a></p>
					<p class="rent_title_r">
						<?php foreach(Config::item('borough_area') as $k => $v){echo "<a href='rent/?area1={$k}' onmouseover='loadhouse(1,{$k},\"houtrenthouse\")'  class='bg_choose'   >{$v}</a>";}?>
					</p>
				</div>
				<div class="rent_list">
					<ul id="houtrenthouse">
						<?php
						if (is_array($hotrenthouse)){
						foreach($hotrenthouse as $k => $v){
						?>
						<li <?php if(($k+1)%4==0) echo 'class="r1"';?>> <a href="/rent/d-<?php echo $v->id;?>.html"><img style="margin-bottom:10px;" src="<?php echo Util::getpicthumb($v->getdefaultpic(),'small');?>" width="119" height="87" alt=""></a>
							<p><a href="/rent/d-<?php echo $v->id;?>.html" class="one"><?php echo $v->b_name;?></a></p>
							<p ><a href="/rent/d-<?php echo $v->id;?>.html" class="h11"><?php echo $v->h_floor;?>F <?php echo $v->roomnum;?>号</a></p>
							<p><a href="/rent/d-<?php echo $v->id;?>.html">[<?php echo Config::item('area_'.$v->b_area1.'.'.$v->b_area2);?>]</a>
							<p><a href="/rent/d-<?php echo $v->id;?>.html" class="s">租&nbsp;<span><?php echo $v->price;?>元/平米•月</span></a></p>
						</li>
						<?php }}?>
					</ul>
				</div>
			</div>
			<div class="rent_bg_r">
				<h2>热租排行</h2>
				<ul>
					<?php
					if (is_array($hotrent)){
					foreach($hotrent as $k => $v){
					?>
					<li><span <?php if( $k<5 ) echo 'class="yellow"';?>><?php echo ($k+1) ;?></span>
						<dl>
							<dt <?php if($k==0) echo 'style="display:none"';?>><a href="/rent/d-<?php echo $v->id;?>.html"><?php echo $v->b_name;?></a><span><?php echo $v->price;?>元/平米•月</span><span class="d"><?php echo $v->roomnum;?>号</span></dt>
							<dd <?php if($k>0) echo 'style="display:none"';?>><a href="/rent/d-<?php echo $v->id;?>.html"><img src="<?php echo Util::getpicthumb($v->getdefaultpic(),'small');?>" width="79" height="64" alt=""></a>
								<p><a class="blue" href="/rent/d-<?php echo $v->id;?>.html" ><?php echo $v->b_name;?></a><a href="/rent/d-<?php echo $v->id;?>.html" class="s_b"><?php echo $v->roomnum.'号';?></a></p>
								<p><a href="/rent/d-<?php echo $v->id;?>.html" ><?php echo Config::item('borough_area.'.$v->b_area1);?>-<?php echo Config::item('area_'.$v->b_area1.'.'.$v->b_area2);?></a></p>
								<p><a href="/rent/d-<?php echo $v->id;?>.html"  class="red"><?php echo number_format($v -> area * $v -> price,0,'.','') ;?>元/月</a> <a href="/<?php if($v->type==1)echo 'rent'; else echo 'sale';?>/d-<?php echo $v->id;?>.html" class="c_b"><?php echo $v->area;?>平米</a> </p>
							</dd>
						</dl>
					</li>
					<?php }}?>
				</ul>
			</div>
		</div>
		<div class="rent_b"></div>
	</div>
	<!------------------------------------------热门租赁end------------------------------------------->
	<!------------------------------------------图片广告展示------------------------------------------->
	<div id="picture_shows"> <a href="/supply" style="width:692px; height:95px; display:block;float:left; position:relative; overflow:hidden; background:url(img/t_03.jpg) no-repeat;">
		<script type="text/javascript" src="js/swfobject.js"></script>
		<embed src="tagcloud.swf" style="position:absolute; top:-90px; left:0px;" width="400" height="400" tplayername="SWF" splayername="SWF" type="application/x-shockwave-flash" mediawrapchecked="true" pluginspage="http://www.macromedia.com/go/getflashplayer" id="tagcloudflash" name="tagcloudflash"  quality="high" wmode="transparent" allowscriptaccess="always" flashvars="tcolor=0x333333&amp;tcolor2=0x666666&amp;hicolor=0xf5f5f5&amp;tspeed=100&amp;distr=true"> </embed>
		</a> <a target="_blank" href="/map"><img src="img/t_05.jpg" width="295" height="95" alt="" style="float:right;"></a> </div>
	<!------------------------------------------图片广告展示end------------------------------------------->
	<!------------------------------------------热门出售------------------------------------------->
	<div class="rent">
		<div class="rent_t"></div>
		<div class="rent_bg">
			<div class="rent_bg_l">
				<div class="rent_title">
					<p class="rent_title_l"><a href="" onmouseover='loadhouse(2,"","houtsalehouse")'>热门出售</a></p>
					<p class="rent_title_r">
						<?php foreach(Config::item('borough_area') as $k => $v){echo "<a href='rent/?area1={$k}' onmouseover='loadhouse(2,{$k},\"houtsalehouse\")'  class='bg_choose'   >{$v}</a>";}?>
					</p>
				</div>
				<div class="rent_list">
					<ul id="houtsalehouse">
						<?php
						if (is_array($hotsalehouse)){
						foreach($hotsalehouse as $k => $v){
						?>
						<li <?php if(($k+1)%4==0) echo 'class="r1"';?>> <a href="/sale/d-<?php echo $v->id;?>.html"><img style="margin-bottom:10px;" src="<?php echo Util::getpicthumb($v->getdefaultpic(),'small');?>" width="119" height="87" alt=""></a>
							<p><a href="/sale/d-<?php echo $v->id;?>.html" class="one"><?php echo $v->b_name;?></a></p>
							<p><a href="/sale/d-<?php echo $v->id;?>.html"><?php echo $v->h_floor;?>F <?php echo $v->roomnum;?>号</a></p>
							<p><a href="/sale/d-<?php echo $v->id;?>.html">[<?php echo Config::item('area_'.$v->b_area1.'.'.$v->b_area2);?>]</a></p>
							<p><a href="/sale/d-<?php echo $v->id;?>.html" class="s">售&nbsp;<span><?php echo $v->price;?>元/平米</span></a></p>
						</li>
						<?php }}
						?>
					</ul>
				</div>
			</div>
			<div class="sale_r">
				<h2>热售排行</h2>
				<ul>
					<?php
					if (is_array($hotsale)){
					foreach($hotsale as $k => $v){
					?>
					<li><span <?php if( $k<5 ) echo 'class="yellow"';?>><?php echo ($k+1) ;?></span>
						<dl>
							<dt <?php if($k==0) echo 'style="display:none"';?>><a href="/sale/d-<?php echo $v->id;?>.html"><?php echo $v->b_name?></a><span class="d"><?php echo $v->roomnum;?>号</span><span><?php echo $v->price;?>元/平米
								<?php if($v->type==1) echo '•月';?>
								</span></dt>
							<dd <?php if($k>0) echo 'style="display:none"';?>><a href="/sale/d-<?php echo $v->id;?>.html"><img src="<?php echo Util::getpicthumb($v->getdefaultpic(),'small');?>" width="79" height="64" alt=""></a>
								<p><a href="/<?php if($v->type==1)echo 'rent'; else echo 'sale';?>/d-<?php echo $v->id;?>.html" class="blue"><?php echo $v->b_name?></a><a href="/<?php if($v->type==1)echo 'rent'; else echo 'sale';?>/d-<?php echo $v->id;?>.html" class="s_b"><?php echo $v->roomnum;?>号</a></p>
								<p ><a style=" width:145px" href="/<?php if($v->type==1)echo 'rent'; else echo 'sale';?>/d-<?php echo $v->id;?>.html"><?php echo Util::csubstr($v->b_addr,0,10);?></a></p>
								<p><a href="/<?php if($v->type==1)echo 'rent'; else echo 'sale';?>/d-<?php echo $v->id;?>.html" class="s_red"><?php echo $v->price;?>元/平米
									<?php if($v->type==1) echo '•月';?>
									</a><a href="/<?php if($v->type==1)echo 'rent'; else echo 'sale';?>/d-<?php echo $v->id;?>.html" class="c_b"><?php echo $v->area;?>平米</a></p>
							</dd>
						</dl>
					</li>
					<?php }}?>
				</ul>
			</div>
		</div>
		<div class="rent_b"></div>
	</div>
	<!------------------------------------------热门出售end------------------------------------------->
	<!-----------------------------------招聘信息----------------------------->
	<div style="  height:96px; margin-top:19px;"><a href="/news/list.php?bid=79"><img src="img/zp.jpg" width="692" height="95" alt="" style="float:left;"></a> <a href="/"><img src="img/yzfy_0.jpg" width="295" height="95" alt="" style="float:right;"></a></div>
	<!-------------------------------------招聘信息end-------------------------------->
	<!------------------------------------------开发商直供------------------------------------------->
	<!--- <div class="  rent rent_for_kf">
		<div class="rent_t"></div>
		<div class="rent_bg rent_bg_for_kf">
			<div class="rent_bg_l supply">
				<div class="rent_title">
					<p class="rent_title_l ">开发商直供<span>直接代理，价格最低</span></p>
					<p class="rent_title_r">  <a style="width:140px;" href="javascript:void(0);" onclick="getsupply();">换一批，随便看看！</a> </p>
				</div>
				<div class="supply_pic">
					<ul id="ajax_supply">
						Loading
					</ul>
					<script language="javascript">
					function getsupply(){
						$("#ajax_supply").load("ajax.supply.php?"+Math.random());
					}
					$("#ajax_supply").load("/ajax.supply.php?"+Math.random());
					</script>
				</div>
			</div>
			<div class="resources ">
				<h2>楼盘优惠</h2>
				<ul>
                	<?php foreach($news ->
	getattnews(77,1,'h') as $v){?>
	<div class="zx_des_0"> <img src="<?php echo Util::getpicthumb($v->pic(),'thumb');?>" width="116" height="84" alt="">
		<p class="zx_des_0_p"><a href="/news/d-<?php echo $v->id;?>.html"><?php echo $v->title;?></a></p>
		<p class="zx_des_0_p"><a href="/news/d-<?php echo $v->id;?>.html" class="close"><?php echo Util::csubstr(strip_tags($v->content),0,55);?></a></p>
		<div style="clear:both"></div>
	</div>
	<?php }?>
	<?php foreach($news ->getnews(77,4) as $v){?>
	<li><a href="/news/d-<?php echo $v->id;?>.html"><?php echo $v->title;?></a></li>
	<?php }?>
	</ul>
</div>
</div>
<div class="rent_b"></div>
</div>
--->
<div class="building_new" style="margin-top:15px; margin-bottom:0px;">
	<div class="building_new_l">
		<div class="building_new_l_t"></div>
		<div class="  build_index">
			<div class="rent_bg_l supply">
				<div class="rent_title">
					<p class="rent_title_l ">开发商直供<span>直接代理，价格最低</span></p>
					<p class="rent_title_r"> <a style="width:140px;" href="javascript:void(0);" onclick="getsupply();">换一批，随便看看！</a> </p>
				</div>
				<div class="supply_pic">
					<ul id="ajax_supply">
						Loading
					</ul>
					<script language="javascript">
					function getsupply(){
						$("#ajax_supply").load("ajax.supply.php?"+Math.random());
					}
					$("#ajax_supply").load("/ajax.supply.php?"+Math.random());
					</script>
				</div>
			</div>
		</div>
		<div class="building_new_l_b"></div>
	</div>
	<div class="building_new_right_0">
		<div class="building_new_right_t"></div>
		<div class="building_new_right_bg" style="height:247px;">
			<h4>最新房源</h4>
			<ul class="building_ul">
				<li class="ar">名称</li>
				<li class="mj">面积</li>
				<li class="price">价格</li>
				<!--li>时间</li-->
			</ul>
			<ul class="b_ul">
				<?php foreach($newhouse as $v){?>
				<li><a href="/<?php if($v->type==1)echo 'rent'; else echo 'sale';?>/d-<?php echo $v->id;?>.html" class="h <?php if($v->type==2) echo 's';?>"><?php echo $v->b_name;?></a><span class="m"><?php echo number_format($v->area,0,'.','');?>平米</span><span class="p"><?php echo $v->price;?>元·平米
					<?php if($v->type==1)echo '·月';?>
					</span></li>
				<?php }?>
			</ul>
		</div>
		<div class="building_new_right_b"></div>
	</div>
</div>
<!------------------------------------------开发商直供end------------------------------------------->
<!------------------------------------------各地咨询+站内咨询+每周盘点------------------------------------------->
<div id="infor">
	<div class="zx">
		<div class="zx_bg">
			<p class="zx_title"><font><a href="/news/list.php?bid=75">更多</a></font>各地资讯</p>
			<?php foreach($news ->getattnews(75,1,'h') as $v){?>
			<div class="zx_des"> <a href="/news/d-<?php echo $v->id;?>.html"><img src="<?php echo Util::getpicthumb($v->pic(),'thumb');?>" width="116" height="84" alt=""></a>
				<p><a href="/news/d-<?php echo $v->id;?>.html"><?php echo $v->title;?></a></p>
				<p><a href="/news/d-<?php echo $v->id;?>.html" class="close"><?php echo Util::csubstr(strip_tags($v->content),0,40);?></a></p>
			</div>
			<?php }?>
			<ul style="clear:both;" class="zx_ul">
				<?php foreach($news ->getnews(75,6) as $v){?>
				<li><a href="/news/d-<?php echo $v->id;?>.html"><?php echo Util::csubstr($v->title,0,22);?></a></li>
				<?php }?>
			</ul>
		</div>
	</div>
	<div class="zx">
		<div class="zx_bg">
			<p class="zx_title"><font><a href="/news/list.php?bid=76">更多</a></font>站内资讯</p>
			<?php foreach($news ->getattnews(76,1,'h') as $v){?>
			<div class="zx_des"> <a href="/news/d-<?php echo $v->id;?>.html"><img src="<?php echo Util::getpicthumb($v->pic(),'thumb');?>" width="116" height="84" alt=""></a>
				<p><a href="/news/d-<?php echo $v->id;?>.html"><?php echo $v->title;?></a></p>
				<p><a href="/news/d-<?php echo $v->id;?>.html" class="close"><?php echo Util::csubstr(strip_tags($v->content),0,40);?></a></p>
			</div>
			<?php }?>
			<ul style="clear:both;" class="zx_ul">
				<?php foreach($news ->getnews(76,6) as $v){?>
				<li><a href="/news/d-<?php echo $v->id;?>.html"><?php echo $v->title;?></a></li>
				<?php }?>
			</ul>
		</div>
	</div>
	<div class="zx inventory">
		<div class="zx_bg">
			<p class="zx_title"><span style="float:left">每周盘点</span><span class="r" ><a href="/news/list.php?bid=78">查看前几周</a></span></p>
			<?php foreach($news ->getnews(78,1) as $v){?>
			<div class="inventory_des"> <a href="/news/d-<?php echo $v->id;?>.html"><img src="<?php echo Util::getpicthumb($v->pic(),'thumb');?>" width="182" height="121" alt=""></a>
				<p> <a href="/news/d-<?php echo $v->id;?>.html"><?php echo Util::csubstr(strip_tags($v->content),0,50);?></a> </p>
			</div>
			<?php }?>
		</div>
	</div>
</div>
<!------------------------------------------各地咨询+站内咨询+每周盘点end------------------------------------------->
<!------------------------------------------楼盘相册------------------------------------------->
<div class="big_box">
	<h2 class="title"><a href="/photo">楼盘相册</a></h2>
	<div class="box">
		<div class="arc_ul blk_29">
			<DIV class=LeftBotton id=LeftArr></DIV>
			<DIV class=Cont id=ISL_Cont_1>
				<?php
						if (is_array($boroughphoto)){
						foreach($boroughphoto as $k => $v){
						?>
				<div class="box"> <a href="/photo/d-<?php echo $v->id;?>.html"><img src="<?php echo Util::getpicthumb($v->getdefaultpic(),'small');?>" width="125" height="94"></a>
					<p><a href="/photo/d-<?php echo $v->id;?>.html"><?php echo $v->b_name?> </a> 
				</div>
				<?php }}?>
			</div>
			<DIV class=RightBotton id=RightArr></DIV>
		</div>
		<SCRIPT src="js/ScrollPic.js" type=text/javascript></SCRIPT>
		<SCRIPT language=javascript type=text/javascript>
		<!--//--><![CDATA[//><!--
		var scrollPic_02 = new ScrollPic();
		scrollPic_02.scrollContId   = "ISL_Cont_1"; //内容容器ID
		scrollPic_02.arrLeftId      = "LeftArr";//左箭头ID
		scrollPic_02.arrRightId     = "RightArr"; //右箭头ID

		scrollPic_02.frameWidth     = 908;//显示框宽度
		scrollPic_02.pageWidth      = 152; //翻页宽度

		scrollPic_02.speed          = 10; //移动速度(单位毫秒，越小越快)
		scrollPic_02.space          = 10; //每次移动像素(单位px，越大越快)
		scrollPic_02.autoPlay       = true; //自动播放
		scrollPic_02.autoPlayTime   = 3; //自动播放间隔时间(秒)

		scrollPic_02.initialize(); //初始化
							
		//--><!]]>
</SCRIPT>
	</div>
</div>
<!------------------------------------------楼盘相册end------------------------------------------->
<!------------------------------------------友情链接------------------------------------------->
<div id="friendly_link" style="clear:both;"> <span>友情链接:</span>
	<?php foreach($linklist as $v){?>
	<a href="<?php echo $v['link'];?>" target="_blank"><?php echo $v['title'];?></a>
	<?php }?>
</div>
<!------------------------------------------友情链接end------------------------------------------->
</div>
<script type="text/javascript" src="../js/js.js"></script>
