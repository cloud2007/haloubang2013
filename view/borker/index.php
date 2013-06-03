<div class="content" >
	<div id="position_title">我的位置：<?php echo $postion;?> </div>
	<div id="agent">
		<div class="agent_l agent_list">
			<div class="agent_title">好楼帮经纪人</div>
			<ul class="ag_list">
				<?php foreach($datalist as $k => $v){?>
				<li> <img src="<?php echo $v->avatar();?>" width="74" height="98" alt="" class="img7">
					<p class="una">姓名： <?php echo $v->uname;?></p>
					<p class="tel"><?php echo $v->tel;?></p>
					<p class="paper">执业资格证号：<?php echo $v->get('catenum');?></p>
					<p class="t">累计出租房源：<font color="#FF0000" style="font-weight:bold"><?php echo $v->countrent();?></font> 套</p>
					<p class="tod">累计出售房源：<font color="#FF0000" style="font-weight:bold"><?php echo $v->countsale();?></font> 套</p>
					<a href="/borker/details.php?id=<?php echo $v->id?>" class="bt">查看经纪人房源</a>
				</li>
				<?php }?>
			</ul>
			<div class="pages_1"><?php echo $pagerData['linkhtml'];?></div>
		</div>
		<div class="agent_r">
			<div class="ag"><a href="/map"><img src="/img/fo_10.jpg"></a></div>
			<!--div class="ags">
				<ul class="ags_ul">
					<li class="hover_li">资讯</li>
					<li>问答</li>
				</ul>
				<div class="zhuyao">
					<div class="zhuyao1">
						<ul>
							<li><a href="#">付三押一 免租期：45天 总租金：</a></li>
							<li><a href="#">付三押一 免租期：45天 </a></li>
							<li><a href="#">付三押一 免租期：45最</a></li>
							<li><a href="#">付三押一 免租期：45 最</a></li>
							<li><a href="#">付三押一 免租期：451年 最</a></li>
							<li><a href="#">付三押一 免租期：45天1年 最</a></li>
							<span>更多&gt;&gt;</span>
						</ul>
					</div>
					<div class="zhuyao1 fn-hide">
						<ul>
							<li><a href="#">11付三押一免租期：45天总租金：</a></li>
							<li><a href="#">222付三押一免租期：45天 </a></li>
							<li><a href="#">333付三押一免租期：45最</a></li>
							<li><a href="#">3333付三押一免租期：45最</a></li>
							<li><a href="#">付33三押一免租期：451年最</a></li>
							<li><a href="#">付三33333押一 免租期45天1年最</a></li>
							<span>更多&gt;&gt;</span>
						</ul>
					</div>
				</div>
			</div-->
			<div class="af"><a href="/rent/?is_present=1"><img src="/img/fo_11.jpg" width="203" height="165" alt=""></a></div>
		</div>
	</div>
	<!---------------------------你可能感兴趣----------------------------------->
	<?php require_once( ROOTPATH . '/interestrent.php');?>
</div>
