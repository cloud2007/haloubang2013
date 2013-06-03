<?php
//header("Content-Type: text/html; charset=utf-8");
require_once('common.func.php');
// 报错级别设定,一般在开发环境中用E_ALL,这样能够看到所有错误提示
// 系统正常运行后,直接设定为E_ALL || ~E_NOTICE,取消错误显示
//error_reporting(E_ALL);
//error_reporting(E_ALL || ~E_NOTICE);

define('INCPATH', str_replace("\\", '/', dirname(__FILE__) ) );
define('ROOTPATH', str_replace("\\", '/', substr(INCPATH,0,-4) ) );
define('CLASSPATH', ROOTPATH.'/lib');

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
        if ( is_file ( CLASSPATH.'/'.$libclassfile ) )
        {
            require CLASSPATH.'/'.$libclassfile;
        }
        else if( is_file ( CLASSPATH.'/'.$classfile ) )
        {
            require CLASSPATH.'/'.$classfile;
        }
        else
        {
            echo '<pre>';
			echo $classname.'发生错误！';
			echo '</pre>';
			exit ();
        }
}

function _RunMagicQuotes(&$svar)
{
    if(!get_magic_quotes_gpc())
    {
        if( is_array($svar) )
        {
            foreach($svar as $_k => $_v) $svar[$_k] = _RunMagicQuotes($_v);
        }
        else
        {
            if( strlen($svar)>0 && preg_match('#^(cfg_|GLOBALS|_GET|_POST|_COOKIE)#',$svar) )
            {
              exit('Request var not allow!');
            }
            $svar = addslashes($svar);
        }
    }
    return $svar;
}


//检查和注册外部提交的变量   (2011.8.10 修改登录时相关过滤)
function CheckRequest(&$val) {
	if (is_array($val)) {
		foreach ($val as $_k=>$_v) {
			if($_k == 'nvarname') continue;
			CheckRequest($_k);
			CheckRequest($val[$_k]);
		}
	} else
	{
		if( strlen($val)>0 && preg_match('#^(cfg_|GLOBALS|_GET|_POST|_COOKIE)#',$val)  )
		{
			exit('Request var not allow!');
		}
	}
}

//var_dump($_REQUEST);exit;
CheckRequest($_REQUEST);

foreach(Array('_GET','_POST','_COOKIE') as $_request)
{
	foreach($$_request as $_k => $_v)
	{
		if($_k == 'nvarname') ${$_k} = $_v;
		else ${$_k} = _RunMagicQuotes($_v);
	}
}

//数据库连接类
require_once( CLASSPATH .'/Mysql.class.php');
?>
