<?php
require_once('config.php');
$ajaxhouse = new House();
$whereand = array();
$whereand[] = array('type','='.$_POST['type']);
if($_POST['area']) $whereand[] = array('b_area1','='.$_POST['area']);
$ajax = $ajaxhouse ->find(
    array(
        'whereAnd'=>$whereand,
        'limit'=>'0,8',
        'order'=>array('hits'=>'desc'),
       )
);

if (is_array($ajax)){
    foreach($ajax as $k => $v){
?>
    <li <?php if(($k+1)%4==0) echo 'class="r1"';?>> <a href="/rent/details.php?id=<?php echo $v->id;?>"><img style="margin-bottom:10px;" src="<?php echo Util::getpicthumb($v->getdefaultpic(),'middle');?>" width="119" height="87" alt=""></a>
    <p><a href="/rent/details.php?id=<?php echo $v->id;?>" class="one"><?php echo $v->b_name;?></a></p>
    <p><a href="/rent/details.php?id=<?php echo $v->id;?>"><?php echo $v->h_floor;?>F <?php echo $v->roomnum;?>号</a></p>
     <p><a href="/rent/d-<?php echo $v->id;?>.html">[<?php echo Config::item('area_'.$v->b_area1.'.'.$v->b_area2);?>]</a>
    <p><a href="/rent/details.php?id=<?php echo $v->id;?>" class="s"><?php if($v->type==1){echo '租';}?><?php if($v->type==2){echo '售';}?>&nbsp;<span><?php echo $v->price;?>元/平米<?php if($v->type==1){echo '•月';}?></span></a></p>
    </li>
    
    <script type="text/javascript">$(".rent_list ul li").hover(function(){
	$(this).addClass("rent_hover")
	       .siblings().removeClass("rent_hover")
	
	})</script>
    
    
<?php }}?>