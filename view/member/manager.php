<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="/public/css/base.css"/>
<link rel="stylesheet" type="text/css" href="/css/web_name.css"/>
<style type="text/css">
#listtable{ background:#FFFFFF; margin:10px 0 0 0; line-height:25px; text-align:center}
#listtable td{ border:1px solid #CCCCCC}
</style>
<title>成都写字楼出租出售专业网站 - 好楼帮</title>
</head>
<body id="b_bg">
<div class="content">

		<?php require('left.php');?>
	<div id="person_right">
    
    <div class="r_con">
   <span class="pic"><img src="<?php echo $Borker->avatar();?>" width="78" height="103" alt=""></span>
   <p class="name">真实姓名： <span><?php echo $Borker -> uname ;?></span></p>
   <p class="name tel">联系电话： <span><?php echo $Borker -> tel ;?></span></p>
   <p class="name zige">资格证号： <span><?php echo $Borker -> get('coding');?></span></p>
   <p class="name qq">QQ： <span><?php echo $Borker -> get('qqnum');?></span></p>
   <p class="name ema">E-mail： <span><?php echo $Borker -> get('email');?></span></p>
   <span class="pic_tel">
<span class="phone_num_less"><?php echo $Borker -> get('tel');?></span></span>
   <div class="dec"><span style="float:left; display:block; height:30px; color:#262626;">个人说明：</span><p><?php echo $Borker -> get('sign');?></p></div>
  </div>
			
			<table width="100%" border="0" cellpadding="0" cellspacing="0"  class="bordered" style="margin-top:15px;">
				<thead>  
                <tr>
					<th>ID</th>
					<th>所属楼盘</th>
					<th>楼层</th>
					<th>房间号</th>
					<th>面积</th>
					<th>租(售)价</th>
					<th>租房有礼</th>
					<th>优质房源</th>
					<th>状态</th>
					<th>操作</th>
				</tr>
                </thead>
				<?php foreach($datalist as $key){?>
				<tr>
					<td><?php echo $key->id;?></td>
					<td><a href="/<?php if($type==2){echo 'sale';}else{echo 'rent';}?>/details.php?id=<?php echo $key->id?>" target="_blank"><?php echo $key->b_name;?></a></td>
					<td><?php echo $key->h_floor;?></td>
					<td><?php echo $key->roomnum;?></td>
					<td><?php echo $key->area;?></td>
					<td><?php echo $key->price;?></td>
					<td><?php if($key->is_present==1) {echo '<font color="green">是</font>';}?></td>
					<td><?php if($key->is_quality==1) echo '<font color="green">是</font>';?></td>
					<td><?php echo $key->showstates();?></td>
					<td><a href="rent.php?action=edit&id=<?php echo $key->id;?>">修改</a> <a onclick="return confirm('真的要删除吗?')" href="rent.php?action=del&id=<?php echo $key->id;?>&type=<?php echo $key->type;?>">删除</a> <?php if ($key->states ==0) {?><a href="rent.php?action=up&id=<?php echo $key->id;?>">上架</a><?php }?>
					<?php if ($key->states ==1) {?><a href="rent.php?action=down&id=<?php echo $key->id;?>">下架</a><?php }?>
					<?php if ($key->states ==2) {?><a href="rent.php?action=up&id=<?php echo $key->id;?>">上架</a><?php }?>
					</td>
				</tr>
				<?php }?>
				<tr>
					<td colspan="10"><?php echo $pagerData['linkhtml'];?></td>
				</tr>
			</table>
		</div>
	
    
    <div style="clear:both;"></div>
</div>
</body>
</html>
