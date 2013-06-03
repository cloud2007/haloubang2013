<?php
require_once('config.php');
$hotsearch = Config::item('hotsearch');
shuffle($hotsearch);
echo '热门搜索：';
foreach( $hotsearch as $k => $v){
?>
<a href="/rent/?q=<?php echo $v;?>" class="hot_c"><?php echo $v;?></a>
<?php
	if($k==4)break;
}?>
<a href="javascript:void(0);" onclick="changehotsearch();">手气不错</a>