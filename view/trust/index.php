<script type="text/javascript" src="/js/FormValid.js"></script>
<div class="content">
	<div id="pic"> <a href="/map" target="_blank"> <img width="1003" height="102" style="float:left;" alt="" src="../img/banner_for_singe.jpg"> </a> </div>
	<div id="percon_left">
		<div class="percon_title"><span class="title_l">委托须知</span></div>
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
		<div class="percon_title "> <span class="title_l" > 委托发布房源/委托选址</span> </div>
		<div class="r_con_0">
			<form id="form1" name="form1" class="myform" method="post" onsubmit="return validator(this)" action="?">
						<input type="hidden" name="action" value="save">
						<div class="title_P">填写以下信息，好楼帮专业经纪人会主动联络您，为您提供优质服务。全程免费。</div>
						<div class="one">
							<input name="type" type="radio" value="1" checked="checked">
							<span class="ones">委托发布房源</span>
							<input name="type" type="radio" class="" value="2">
						<span class="ones">委托帮忙选址</span> </div>
						<div class="one">
							<label for="" class="box_2_1">姓名:<font style="color:red; font-size:12px; font-weight:normal;">*</font></label>
							<input name="uname" type="text" class="tt" valid="required" errmsg="姓名不能为空!" id="uname">
						</div>
						<div class="one">
							<label for="" class="box_2_1 box_2_2">电话号码:<font style="color:red; font-size:12px; font-weight:normal;">*</font></label>
							<input name="tel" type="text" class="tt" id="tel" valid="required" errmsg="电话号码不能为空!">
						</div>
						<div class="one">
							<label for="" class="box_2_1 box_2_3">E-mail:<font style="color:red; font-size:12px; font-weight:normal;">*</font></label>
							<input name="email" type="text" class="tt" id="email">
						</div>
						<div class="one ">
							<label for="" class="box_2_1 box_2_4">留言信息:<font style="color:red; font-size:12px; font-weight:normal;">*</font></label>
							<textarea name="content"  class="tex" id="content" onFocus="if(this.value=='在这里填写具体要求...')this.value='';" onBlur="if(this.value=='')this.value='在这里填写具体要求...';">在这里填写具体要求...</textarea>
						</div>
						<div class="two">
							<input type="submit" id="btn" class="btn" value="提交" >
						</div>
					</form>
		</div>
	</div>
	<div style="clear:both"></div>
</div>


