<?php $Creaturl = new Creaturls();?>
<?php $hs = Config::item('house.paystyle3');?>

<div class="content">
	<div id="position_title">我的位置：<?php echo $postion;?></div>
	<!-----------------------------楼盘列表----------------------------------->
	<div id="search_list">
		<div class="hight_search_l">
			<div class="hight_search">
				<p>高级搜索</p>
				<div class="hight_search_content">
					<dl class="sear1">
						<dt>写字楼级别:</dt>
						<dd>
							<ul>
								<?php $Creaturl -> creatradio('level');?>
							</ul>
						</dd>
						<div class="clear"></div>
					</dl>
					<div class="line_for_leftMenu"></div>
					<dl class="sear1 sear2">
						<dt>装修类别:</dt>
						<dd>
							<ul>
								<?php $Creaturl -> creatradio('fitment');?>
							</ul>
						</dd>
						<div class="clear"></div>
					</dl>
					<div class="line_for_leftMenu"></div>
					<dl class="sear1 sear3">
						<dt>写字楼房龄:</dt>
						<dd>
							<ul>
								<?php $Creaturl -> creatradio('fangling');?>
							</ul>
						</dd>
						<div class="clear"></div>
					</dl>
					<div class="line_for_leftMenu"></div>
					<dl class="sear1 sear4">
						<dt>地铁:</dt>
						<dd>
							<ul>
								<?php $Creaturl -> creatradio('metro');?>
							</ul>
						</dd>
						<div class="clear"></div>
					</dl>
				</div>
			</div>
			<?php require_once(ROOTPATH . '/houseHis.php');?>
		</div>
		<div class="hight_search_r">
			<div class="area_search">
				<p class="area_search1">区域：
					<?php $Creaturl -> creaturl_area1('area1');?>
				</p>
				<?php if ($_GET['area1']){?>
				<p class="area_search0">
					<?php $Creaturl -> creaturl_area2(Config::item('area_'.$_GET['area1']),'area2'); }?>
				</p>
				<p class="area_search1 area_search2"> 单价：
					<?php $Creaturl -> creaturl('saleprice');?>
				</p>
				<p class="area_search1 area_search3">面积：
					<?php $Creaturl -> creaturl('area');?>
				</p>
			</div>
			<div class="banana">
				<p class="ban_l">找到有效房源 <span><?php echo $totalcount;?></span> 套　<?php echo $totalarea ? "总出售面积 <span>{$totalarea}</span> 平米": NULL;?></p>
				<p class="ban_r">
					<?php $Creaturl -> creaturl_order('order');?>
				</p>
			</div>
			<div class="list_cent">
				<ul>
					<?php foreach($datalist as $v){?>
					<li>
						<div class="fang" onclick="window.open('/sale/d-<?php echo $v->id;?>.html')">
						<a href="/sale/d-<?php echo $v->id;?>.html" target="_blank"><img class="pro_img" src="<?php echo Util::getpicthumb($v->getdefaultpic($v->b_id),'middle');?>" width="125" height="85" alt=""></a>
						<p class="fangli"><a href="/sale/d-<?php echo $v->id;?>.html" style="font-size:16px;" class="red" target="_blank"><?php echo $v->b_name;?></a></p>
						<span class="fang_price" style="line-height:14px;"> <?php echo number_format($v -> area * $v -> price /10000 , 2) ;?>万<br />
						<br />
						<font style="font-size:12px;  color:#888; font-weight:200; text-decoration:none;">单价：<?php echo $v->price;?>元/平米</font> </span>
						<p class="fangcon"> 楼层：<font style="font-size:12px; font-weight:bold; color:#0000DD"><?php echo $v->h_floor;?>F</font> &nbsp;  &nbsp;房号：<font style="font-size:12px; font-weight:bold; color:#0000DD"><?php echo $v->roomnum;?>号</font> <br />
							面积：<font style="font-size:12px; font-weight:bold; color:#0000DD"><?php echo $v->area;?>平米</font> <br />
							地址： <?php echo $v->b_addr;?></p>
						<div class="list_house_right_box">
							<ul>
								<?php if($v->get('qt1'))echo '<li class="exemption">'.$hs[$v->get('qt1')].'</li>';?>
								<?php if($v->get('qt2') ==1 )echo '<li class="yj">免佣金</li>';?>
								<?php if($v->get('qt3') ==1 )echo '<li class="jz">急租</li>';?>
								<li class="qs" ><?php echo Config::item('house_fitment.'.$v->fitment);?></li>
							</ul>
						</div>
						</div>
					</li>
						<?php }?>
						
				</ul>
				<div class="pages"><?php echo $pagerData['linkhtml'];?></div>
			</div>
		</div>
	</div>
	<!-----------------------------楼盘列表end----------------------------------->
	<!-----------------------------楼盘信息end----------------------------------->
	<!---------------------------你可能感兴趣----------------------------------->
	<?php require_once( ROOTPATH . '/interestrent.php');?>
</div>
