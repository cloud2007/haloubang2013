<!---------------------------你可能感兴趣----------------------------------->
<div class="like" style="clear:both;">
	<h2>你可能感兴趣的房源</h2>
	<ul class="like_ul">
		<?php foreach($interestrent as $v){?>
		<li> <a href="/<?php if($v->type==1)echo 'rent'; else echo 'sale';?>/d-<?php echo $v->id;?>.html"><img src="<?php echo Util::getpicthumb($v->getdefaultpic(),'small');?>" width="111" height="83" alt=""></a>
			<p class="c1"><a class="h <?php if($v->type==2) echo 's';?>" href="/<?php if($v->type==1)echo 'rent'; else echo 'sale';?>/d-<?php echo $v->id;?>.html"><span><?php echo $v->b_name;?></span></a></p>
			<p class="c2"><a href="/<?php if($v->type==1)echo 'rent'; else echo 'sale';?>/d-<?php echo $v->id;?>.html"><?php echo $v->area;?>平米 <span><?php echo $v->price;?>元/平米<?php if($v->type==1)echo '•月';?> </span></a></p>
		</li>
		<?php }?>
	</ul>
</div>
