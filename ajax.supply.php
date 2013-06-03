<?php
require_once('config.php');
function getDir($dir) {
    $dirArray[]=NULL;
    if (false != ($handle = opendir ( $dir ))) {
        $i=0;
        while ( false !== ($file = readdir ( $handle )) ) {
            //去掉"“.”、“..”以及带“.xxx”后缀的文件
            if ($file != "." && $file != ".."&&!strpos($file,".")) {
                $dirArray[$i]=$file;
                $i++;
            }
        }
        closedir ( $handle );
    }
    return $dirArray;
}
$arr = getDir( ROOTPATH . '/view/supply' );
shuffle( $arr );
$arr = array_slice ( $arr , 0 , 3 ) ;

foreach ( $arr as $v ){
$title = file_get_contents( ROOTPATH . '/view/supply/'.$v.'/title.txt') ;
$encode = mb_detect_encoding($title, array("ASCII","UTF-8","GB2312","GBK","BIG5"));
if($encode!='UTF-8') $title = iconv( $encode , 'UTF-8' ,  $title);
echo '<li><a href="/supply/d-'.$v.'.html"><img src="/view/supply/'.$v.'/logo.jpg" width="182" height="122" alt=""></a><p><a href="/supply/d-'.$v.'.html" class="blue">'.$title.'</a></p></li>';
}
?>