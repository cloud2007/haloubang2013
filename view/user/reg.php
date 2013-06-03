<script type="text/javascript" src="/js/FormValid.js"></script>
<script type="text/javascript" src="/js/FV_onBlur.js"></script>
<script type="text/javascript">
FormValid.showError = function(errMsg,errName,formName) {
	if (formName=='regform') {
		for (key in FormValid.allName) {
			document.getElementById('errMsg_'+FormValid.allName[key]).innerHTML = '';
		}
		for (key in errMsg) {
			document.getElementById('errMsg_'+errName[key]).innerHTML = errMsg[key];
		}
	}
}

var r = null;
function ckname (inp) {
	$.ajax({type:"GET", url:"/ajax.boker.check.php?r="+Math.random()+'&tel='+inp.value, dataType:"text",async:false,success:function (msg){
		r = msg;
	}});
	if (r=='0') {
		return false;
	} else {
		return true;
	}
}

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

<div class="content">
	<div id="pic"> <a href="/map" target="_blank"> <img width="1003" height="102" style="float:left;" alt="" src="../img/banner_for_singe.jpg"> </a> </div>
	<div id="percon_left">
		<div class="percon_title"><span class="title_l">经纪人注册须知</span></div>
		<div class="perlist" style="background:#e7f3ff">
			<ul class="list_ul" >
				<li style="height:auto;">
					<p style="font-size:14px; text-align:left; padding:15px; font-weight:normal;">·（1）、房地产经纪人注册申请表（一式两份）<br />
						<br />
						·（2）、申请人的近期一寸免冠照片两张，其中申请初始注册的需提交三张照片；<br />
						<br />
						·（3）、房地产经纪人执业资格证书以及复印件（含证书编号、姓名页）、身份证件（身份证、军官证或护照）复印件，并按要求贴在注册申请表指定的位置； <br />
						<br />
						·（4）、工作业绩证明材料；所在单位推荐意见及单位考核合格证明。</p>
				</li>
			</ul>
		</div>
	</div>
	<div id="person_right" >
		<div class="percon_title "> <span class="title_l" >经纪人注册信息填写</span> </div>
		<div class="r_con_0">
			<form name="regform" action="" class="myform" onsubmit="return validator(this)" method="POST">
				<input type="hidden" name="type" value="1" />
				<input type="hidden" name="action" value="save">
				<div class="one">
					<label  for="" class="la1">手机号码 <font class="red_for_w">*</font></label>
					<input class="t2" type="text" name="tel" id="tel" size="24" valid="required|isMobile|custom" custom="ckname" errmsg="手机号不能为空!|手机号码格式不正确!|手机号已被注册!" />
					<span class="prompt" id="errMsg_tel"><font class="err_tip"> 填写真实手机，手机号为找回密码唯一凭证</font></span> </div>
				<div class="one">
					<label  for="" class="la2">密码<font class="red_for_w">*</font></label>
					<input class="t2" type="password" name="pwd1" valid="required" errmsg="密码不能为空!" />
					<span class=" prompt" id="errMsg_pwd1"><font class="err_tip" > 请输入你的登录密码</font></span> </div>
				<div class="one">
					<label  for="" class="la3">确认密码<font class="red_for_w">*</font></label>
					<input type="password" class="t2" name="pwd2" valid="eqaul" eqaulName="pwd1" errmsg="两次密码不同!">
					<span class="prompt" id="errMsg_pwd2"><font class="err_tip" > 请再次填写密码</font></span> </div>
				<div class="one">
					<label  for="" class="la3">资格证号<font class="red_for_w">*</font></label>
					<input type="text" class="t2" name="catenum" valid="required" errmsg="资格证号不能为空!" />
					<span class="prompt" id="errMsg_catenum"><font class="err_tip"> 填写资格证号</font></span>
				</div>
				<div class="one">
					<label  for="" class="la3">上传从业资格证书<font class="red_for_w">*</font></label>
					<input type="hidden" class="t2" name="cate" id="cate" />
					<div id="cate_dis"></div>
					<iframe style="padding:0;float:right; margin-top:15px;" name="linkupload" width="70%" height="26" scrolling="No" frameborder="no"  src="/swfupload/class/cate.php" align="left"></iframe>
				</div>
				<div class="one">
					<label  for="" class="la3">上传头像(照片)<font class="red_for_w">*</font></label>
					<input type="hidden" class="t2" name="avatar" id="avatar" />
					<div id="avatar_dis"></div>
					<iframe style="padding:0; float:right;margin-top:15px;" name="linkupload" width="80%" height="26" scrolling="No" frameborder="no"  src="/swfupload/class/avatar.php" align="left"></iframe>
				</div>
				<div class="one">
					<label  for="">真实姓名<font class="red_for_w">*</font></label>
					<input type="text" name="uname" class="t2" valid="required" errmsg="姓名不能为空!" />
					<span class="prompt" id="errMsg_uname"><font class="err_tip"> 填写姓名</font></span>
				</div>
				<div class="one">
					<div  class="two_l">
						<label  for="" class="la4">验证码<font class="red_for_w">*</font></label>
						<input type="text" class="t4" name="vcode" valid="required" errmsg="验证码未填写!">
						<img id="vdimgck" align="absmiddle" onClick="this.src=this.src+'?'" style="cursor: pointer;" alt="看不清？点击更换" src="/inc/vdimgck.php"/> <a href="javascript:void(0);" onClick="changeAuthCode();">看不清?</a> </div>
					<div class="two_r"><span id="errMsg_vcode" class="prompt"><font class="err_tip" > 请填写图片中的字符,不区分大小写</font></span></div>
				</div>
				<div class="three"> <span class="top">
					<input type="checkbox" name="check[]" id="check" valid="requireChecked" onclick="reg();" min="1" max="1" errmsg="请阅读并同意服务条款">
					</span> <span class="secret">同意"<a href="#">服务条款</a>"和"<a href="#">隐私权相关政策</a>"(需阅读并同意方能注册)</span> </div>
				<div class="four">
					<input type="submit" id="btn" class="btn_wch1" value="完成注册" disabled="disabled">
				</div>
			</form>
		</div>
	</div>
	<div style="clear:both"></div>
</div>
<script type="text/javascript" src="/js/index.js"></script>
<script type="text/javascript">
initValid(document.regform);
</script>
<script type="text/javascript">
function reg(){
	if( document.getElementsByName("check[]")[0].checked==true ){
		document.getElementById('btn').disabled=false;
		document.getElementById('btn').className='btn_wch';
	}else{
		document.getElementById('btn').disabled=true;
		document.getElementById('btn').className='btn_wch1';
	}
}
</script>
<script language="javascript">
function linkupload( furl ){
	document.getElementById('avatar').value = furl;
	document.getElementById('avatar_dis').innerHTML = '<img  src="'+furl+'" width="75" height="100">';
}
</script>
<script language="javascript">
function linkupload1( furl ){
	document.getElementById('cate').value = furl;
	document.getElementById('cate_dis').innerHTML = '<img  src="'+furl+'"  height="200">';
}
</script>