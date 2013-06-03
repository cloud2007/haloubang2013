<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/base.css" rel="stylesheet" type="text/css" />
<link href="css/login.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-1.4.2.min.js" language="javascript" type="text/javascript"></script>
<title>后台管理 - 用户登录</title>
<script type="text/javascript">
$ = jQuery;
function changeAuthCode() {
	var num = 	new Date().getTime();
	var rand = Math.round(Math.random() * 10000);
	num = num + rand;
	$('#ver_code').css('visibility','visible');
	if ($("#vdimgck")[0]) {
		$("#vdimgck")[0].src = "../inc/vdimgck.php?tag=" + num;
	}
	return false;	
}
</script>
</head>
<body>
<div id="login-box">
	<div class="login-top"><a href="../index.php" target="_blank" title="返回网站主页">返回网站主页</a></div>
	<div class="login-main">
		<form name="form1" method="post" action="login.php">
			<input type="hidden" name="dopost" value="login" />
			<dl>
				<dt>用户名：</dt>
				<dd><input type="text" name="userid"/></dd>
				<dt>密&nbsp;&nbsp;码：</dt>
				<dd><input type="password" class="alltxt" name="pwd"/></dd>
				<dt>验证码：</dt>
				<dd>
					<input id="vdcode" type="text" name="validate" style="text-transform:uppercase;"/>
					<img id="vdimgck" align="absmiddle" onClick="this.src=this.src+'?'" style="cursor: pointer;" alt="看不清？点击更换" src="../inc/vdimgck.php"/> <a href="javascript:void(0);" onClick="changeAuthCode();">看不清?</a></dd>
				<dt>&nbsp;</dt>
				<dd><button type="submit" name="sm1" class="login-btn" onclick="this.form.submit();">登录</button></dd>
			</dl>
		</form>
	</div>
	<div class="login-power">Powered by<a href="javascript:void(0);"><strong>Haoloubang</strong></a>&copy; 2013-2013</div>
</div>
</body>
</html>
