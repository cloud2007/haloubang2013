<?php
//楼盘字典参数
require_once('config.admin.php');
CheckGrant('set');
$setcache = new Setcache();
$setcache -> updatecache();
$setcache -> updatecache1();
echo "楼盘参数缓存更新完毕！更新时间：".date('Y-m-d H:i:s',time());
?>