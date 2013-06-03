<?php
require_once('../config.php');
if($_COOKIE['LOGIN_REMEMBER']==1){
    ShowMsg('你已经登录了经纪人后台，如需更换登录用户，请在后台安全退出后重新登录','/member',0,1000);exit();
}
if($_POST['action']=='login'){
    if(!$_POST['tel'] || !$_POST['pwd']){ShowMsg('填写不完整，请重试','login.php',0,1000);exit();}
    if($_POST['tel']=='请输入手机号!' || $_POST['pwd']=='请输入密码!'){ShowMsg('填写不完整，请重试','login.php',0,1000);exit();}
    $Borker = new Borker();
    $rs = $Borker ->login($_POST['tel'],md5($_POST['pwd']));
    if($rs){
        if (isset($_POST['remember']) && intval($_POST['remember'])==1) {
            setcookie('LOGIN_REMEMBER',1,time()+60*60*24*365,'/');
            setcookie('LOGIN_ID',$rs->id,time()+60*60*24*365,'/');
            setcookie('LOGIN_TEL',$rs->tel,time()+60*60*24*365,'/');
            setcookie('LOGIN_TYPE',$rs->type,time()+60*60*24*365,'/');
            setcookie('LOGIN_NAME',$rs->uname,time()+60*60*24*365,'/');
        }else{
            setcookie('LOGIN_REMEMBER', 0, time()-1,'/');
            setcookie('LOGIN_ID', 0, time()-1,'/');
            setcookie('LOGIN_TEL', 0, time()-1,'/');
            setcookie('LOGIN_TYPE', 0, time()-1,'/');
            setcookie('LOGIN_NAME', 0, time()-1,'/');
        }
        $Borker -> keepborker($rs);
        $Borker -> load($rs -> id);
        $Borker -> logintime = time();
        $Borker -> save();
        if($rs -> type == 1){
            ShowMsg('登陆成功','/member',0,1000);exit();
        }else{
            ShowMsg('登陆成功','/index.php',0,1000);exit();
        }
    }else{
        $Borker -> exitborker();
        ShowMsg('电话号码或密码错误，请重新输入','login.php',0,1000);exit();
    }
}

$view = new View('user/login');
$view->renderHtml($view->render());
?>