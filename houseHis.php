<?php
require_once('config.php');
if($_COOKIE['houseHis']){
    $wh = array();
    foreach(explode(',',$_COOKIE['houseHis']) as $v){
            $wh[$v] = $v;
    }
    $house = new House();
    $houseHislist = $house -> loads( $wh );
    if( is_array($houseHislist) ){
            echo '<div class="last_house"><ul><li><h1>最近浏览的房源</h1></li>';
            foreach($houseHislist as $v){
                    if ( $v->type==1 ){
						$link = 'rent';
						$price = $v->price .'元/平米·月'; 
					}else{
						$link = 'sale';
						$price = number_format(($v->price * $v->area)/10000,1,'.','') .'万'; 
					}
                    if ( $v->type==1 ) $pri = '·月';
					if ( $v->type==2 ) $pri = '';
                    echo '<li><a href="/'.$link.'/d-'.$v->id.'.html" target="_blank"><span class="c1">'.$v->b_name.'</span><span class="c2">'.$v->area.'平米</span><span class="c3">'.$price.'</span></a></li>';
            }
            echo '</ul></div>';
    }
}
?>