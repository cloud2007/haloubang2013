<?php
define('BASEDIR', strtr(dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR, "\\", '/'));
$cfg = explode('|',$_GET['cfg']);
define('UPLOAD_PATH', '/uploadfiles/' . $cfg[0] . '/');

//自动加载类库处理
function __autoload($classname)
{
    $classname = preg_replace("/[^0-9a-z_]/i", '', $classname);
    if( class_exists ( $classname ) )
    {
        return TRUE;
    }
    $classfile = $classname.'.php';
    $libclassfile = $classname.'.class.php';
        if ( is_file ( $libclassfile ) )
        {
            require $libclassfile;
        }
        else if( is_file ( $classfile ) ) 
        {
            require $classfile;
        }
        else
        {
            echo '<pre>';
			echo $classname.'发生错误！';
			echo '</pre>';
			exit ();
        }
}
?>