<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="/public/css/base.css"/>
<link rel="stylesheet" type="text/css" href="/css/web_name.css"/>
<link rel="stylesheet" type="text/css" href="/js/Autocomlete/jquery.autocomplete.css" />
<script type="text/javascript" src="/public/js/jquery-1.6.2.min.js"></script>
<script type='text/javascript' src='/js/Autocomlete/jquery.autocomplete.js'></script>
<script type="text/javascript" src="/js/FormValid.js"></script>
<script type="text/javascript" src="/js/FV_onBlur.js"></script>
<script type="text/javascript" src="/kind/kindeditor-min.js"></script>
<script type="text/javascript" src="/js/thickbox-compressed.js" ></script>
<link href="/css/thickbox.css" media="screen" rel="stylesheet" type="text/css" />
<style type="text/css">
table.borough tr{ background:#FFFFFF; height:30px;}
table.borough td{ padding:0 5px;}
</style>
<script type="text/javascript">
$().ready(function() {

	$("#b_name").autocomplete("/ajax.borough.autocomlete.php", {
		selectFirst: false,
		formatItem: function(data, i, total) {
			return data[1];
		},
		formatResult: function(data, i, total) {
			return data[1];
		}
	});

	$("#b_name").result(function(event, data, formatted) {
		document.getElementById('borough_infos').style.display="block";
		if (data){
			$('#b_id').val(data[0]);
			$('#b_addr').val(data[2]);
			$('#b_area1').val(data[4]);
			$('#b_area2').val(data[5]);
			$('#b_used').val(data[6]);
			$('#b_level').val(data[3]);
			$('#b_floor').val(data[7]);
            $('#b_subway').val(data[8]);
			$('#b_opentime').val(data[9]);
			$("#pic_load").load("/ajax.borough_pic.php?bid="+data[0]+'&rnd='+Math.random());
		}
	});
	
	$("#pic_load").load("/ajax.borough_pic.php?bid="+$('#b_id').val()+'&rnd='+Math.random());
})

FormValid.showError = function(errMsg,errName,formName) {
	if (formName=='rent') {
		for (key in FormValid.allName) {
			document.getElementById('errMsg_'+FormValid.allName[key]).innerHTML = '';
		}
		for (key in errMsg) {
			document.getElementById('errMsg_'+errName[key]).innerHTML = errMsg[key];
		}
	}
}

function checkid(){
	if($('#b_id').val() == ""){
		alert('楼盘名称不允许自主输入,请输入首字母从下拉列表选择!');
	}
}
</script>
<title>成都写字楼出租出售专业网站 - 好楼帮</title>
</head>
<body id="b_bg">
<div class="content">
	<?php require('left.php');?>
	<div id="person_right">
		<?php if($Borker -> states==0){echo '<div class="percon_title"><span class="title_l">你的账户还未通过审核，暂时无法发布房源！</span></div>';}else{?>
		<div class="percon_title "> <span class="title_l" >
			<?php if ($type==1){?>
			发布出租房源信息
			<?php }?>
			<?php if ($type==2){?>
			发布出售房源信息
			<?php }?>
			</span> </div>
		<div class="r_con_0">
			<form name="rent" method="post" action="?" onsubmit="checkid();return validator(this)" class="myform">
				<input type="hidden" name="type" value="<?php if($datainfo -> type){echo $datainfo -> type ;} else {echo $type;}?>" />
				<input type="hidden" name="borker_id" value="<?php echo $Borker -> id ;?>" />
				<input type="hidden" name="id" value="<?php echo $datainfo -> id ;?>" />
				<input type="hidden" name="action" value="save" />
				<div class="one">
					<label>所属楼盘:</label>
					<input type="text" name="b_name" id="b_name" style="width:200px;" value="<?php echo $datainfo->b_name;?>" valid="required" errmsg="楼盘名称不能为空!" class="aa" />
					<span class="prompt" id="errMsg_b_name"><font class="err_tip">(楼盘名称不允许自主输入,请输入首字母从下拉列表选择!)</font></span>
					<input type="hidden" name="b_id" id="b_id" value="<?php echo $datainfo->b_id;?>" />
					<!--楼盘id-->
					<input type="hidden" name="b_area1" id="b_area1" value="<?php echo $datainfo->b_area1;?>" />
					<!--楼盘区域1-->
					<input type="hidden" name="b_area2" id="b_area2" value="<?php echo $datainfo->b_area2;?>" />
					<!--楼盘区域2-->
					<input type="hidden" name="b_used" id="b_used" value="<?php echo $datainfo->b_used;?>" />
					<!--物业类型-->
					<input type="hidden" name="b_level" id="b_level" value="<?php echo $datainfo->b_level;?>" />
					<!--楼盘级别-->
					<input type="hidden" name="b_subway" id="b_subway" value="<?php echo $datainfo->b_subway;?>" />
					<!--楼盘级别-->
					<input type="hidden" name="b_opentime" id="b_opentime" value="<?php echo $datainfo->b_opentime;?>" />
					<!--开盘时间-->
				</div>
				<div class="one" id="borough_infos" style="display:none;">
					<label>楼盘地址:</label>
					<input type="text" name="b_addr" id="b_addr" class="aa" style="width:350px;" readonly="true" value="<?php echo $datainfo->b_addr;?>" />
				</div>
				<div class="one">
					<label>所在楼层:</label>
					<input type="text" name="h_floor" id="h_floor" size="3" objectName="b_floor" operate="<=" valid="compare|isNumber"  errmsg="所在楼层不能比总楼层大!|只能输入数字" class="input" style="width:40px;" value="<?php echo $datainfo->h_floor;?>" />
					<span>/</span>
					<input type="text" name="b_floor" id="b_floor" size="3"  class="input" style="width:40px; background:#eee;" value="<?php echo $datainfo->b_floor;?>" readonly="true" />
					<span class="prompt" id="errMsg_h_floor"><font class="err_tip">输入所在楼层</font></span>
				</div>
				<div class="one">
					<label>房号:</label>
					<input type="text" name="roomnum" id="roomnum" class="aa roomnum1" valid="required|isNumber" errmsg="房号不能为空!|只能输入数字" value="<?php echo $datainfo->roomnum;?>" />
					<span class="prompt" id="errMsg_roomnum"><font class="err_tip">(输入房间号数字)</font></span>
				</div>
				<div class="one">
					<label>面积:</label>
					<input type="text" name="area" id="area" class="aa area1" valid="required|isNumber" errmsg="面积不能为空!|只能输入数字" onkeyup="javascript:count();" value="<?php echo $datainfo->area;?>" />
					<span >平方米</span>
					<span class="prompt" id="errMsg_area"></span>
				</div>
				<div class="one">
					<?php if($type==1){?>
					<label>租金:</label>
					<input type="text" name="price" id="price" class="aa rent1" onkeyup="javascript:count();" valid="required|isNumber" errmsg="租金不能为空!|只能输入数字" value="<?php echo $datainfo->price;?>" />
					<span >元/平米/月</span>
					<span class="prompt" id="errMsg_price"></span>
					<div class="calculator_price"><span>总价：</span><span id="count_tips" style="color:#FF0000; font-size:12px; font-weight:bold;"></span> </div>
					<?php }else{?>
					<label>售价:</label>
					<input type="text" name="price" id="price" class="aa rent1" onkeyup="javascript:count();" value="<?php echo $datainfo->price;?>" />
					<span >元/平米</span>
                    <span class="prompt" id="errMsg_price"></span>
					<div class="calculator_price"><span>总价：</span><span id="count_tips" style="color:#FF0000; font-size:12px; font-weight:bold;"></span> </div>
					<?php }?>
				</div>
				<div class="one none" >
					
					
					<label class="none">付款方式:</label>
					<select name="paystyle" class="select none">
						<?php foreach(Config::item('house.paystyle'.$type) as $key => $value){?>
						<option value="<?php echo $key;?>" <?php if ($datainfo ->paystyle && $datainfo ->paystyle($key)){echo "selected";}?>><?php echo $value;?></option>
						<?php }?>
					</select>
				</div>
				<div class="one none">
					<label>免租期:</label>
					<input type="text" name="mzq" id="mzq" class="aa" value="<?php echo $datainfo->mzq;?>" />
					<span class="prompt" id="errMsg_mzq"><font class="err_tip">天</font></span>
				</div>
				<div class="one none"> <span>
					<label>最短合同:</label>
					<input type="text" name="s_pact" id="s_pact" class="aa" style="width:40px; margin-right:5px" value="<?php echo $datainfo->s_pact;?>" />
					年 </span> <span>
					<label style="width:100px; display:inline-block;">最长合同:</label>
					<input type="text" name="l_pact" id="l_pact" class="aa" style="width:40px;margin-right:5px" value="<?php echo $datainfo->l_pact;?>" />
					年 </span> </div>
				<?php if ($type==1){?>
				<div class="one">
					<label>租房有礼:</label>
					<input type="text" name="present" id="present" class="aa" value="<?php echo $datainfo->present;?>" />
					<span>请统一填写:"送iPhone手机一部"等</span>
					<input type="checkbox" name="is_present" value="1" <?php if($datainfo->is_present && $datainfo->is_present()) {echo "checked";}?> />
					<span>勾选有效</span> </div>
				<?php }?>
				
                
				<div class="one">
					<label>其他属性:</label>
                    <select style="margin-right:15px;" name="fitment" class="select">
						<?php foreach(Config::item('house_fitment') as $key => $value){?>
						<option value="<?php echo $key;?>" <?php if ($datainfo -> fitment && $datainfo -> fitment($key)){echo "selected";}?> ><?php echo $value;?></option>
						<?php }?>
					</select>
                    
                    
					<select name="qt1" style="margin-right:15px;" class="select">
						<?php foreach(Config::item('house.paystyle3') as $key => $value){?>
						<option value="<?php echo $key;?>" <?php if ( $datainfo && $datainfo -> get('qt1') == $key ){echo "selected";}?> ><?php echo $value;?></option>
						<?php }?>
					</select>
					<input  type="checkbox" name="qt2" value="1" <?php if($datainfo && $datainfo->get('qt2')==1) {echo "checked";}?> /><span style="margin-right:15px;">免税</span>
					<input type="checkbox" name="qt3" value="1" <?php if($datainfo && $datainfo->get('qt3')==1) {echo "checked";}?> /><span style="margin-right:15px;">急租/售</span>
                    
                    <input type="checkbox" name="is_quality" value="1" <?php if($datainfo->is_quality && $datainfo->is_quality()) {echo "checked";}?> />
					<span >优质房源</span>
                    
				</div>
				<div style="clear:both"></div>
				<div  >
					<label style="font-size:16px; color:#666; font-weight:bold;">房源描述:</label>
					<textarea name="content" rows="20" id="content" style="width:99%; overflow:hidden; "><?php echo $datainfo->content;?></textarea>
				</div>
				<div style="clear:both"></div>
				<div class="update_photo_for_house"><a href="#TB_inline?height=400&width=680&inlineId=pic_load" title="选择上传过的照片" class="thickbox" type="button"><font style="font-size:24px; font-weight:bold;">+</font>从下列上传的照片中，设置楼盘相</a></div>
				<div id="pic_load" style="display:none; z-index:10000">
					<ul class="pic_load">
						请先选择楼盘
					</ul>
				</div>
				<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CFCFCF" align="center" style="margin-top:8px; border:1px solid #CCCCCC" class="borough">
					<tr bgcolor="#E7E7E7" >
						<td height="28" background="images/tbg.gif" style="padding-left:10px;"><strong>房源图片</strong> </td>
					</tr>
					<tr>
						<td><link href="../swfupload/css/uploadify.css" rel="stylesheet" type="text/css" />
							<link href="../swfupload/css/upload.css" rel="stylesheet" type="text/css" />
							<div class="upload_class <?php if(!is_array($piclist)) echo 'hide';?>">
								<!--p><b>分类详情</b>上传更多类型的照片，成为<a href="/help/content/help_center_66" target="_blank">精品房源</a>，获得更多的效果。</p-->
								<ul class="class_list">
									<?php
foreach(Config::item('borough_pictype') as $key => $value){
?>
									<li id="subcate_class_<?php echo $key;?>"><?php echo $value;?></li>
									<?php }?>
								</ul>
							</div></td>
					</tr>
					<tr>
						<td style="padding:10px 10px 40px 10px;" id="uuuppp"><div id="info">
								<ul>
									<?php
									if(is_array($piclist)){
									$z_index = 200;
									foreach($piclist as $key){
									?>
									<li id="<?php echo 'subcates_'.$key->id;?>" style="z-index:<?php echo $z_index;?>">
										<div class="list_img"> <img src="<?php echo $key->pic_thumb;?>"></div>
										<?php if($key->pic_is_default==1){?>
										<div class="default_box" style="display:block;"><span class="default_picbg"></span><span class="default_pictext"><a>默认图片</a></span></div>
										<?php }else{?>
										<div class="default_box" style="display:none;"><span class="default_picbg"></span><span class="default_pictext"><a>设为默认图</a></span></div>
										<?php }?>
										<span class="closed"></span>
										<div id="select_<?php echo $key->id;?>" class="list_select"><em> <?php echo $key->showCate();?> </em>
											<div class="choice" style="display: none;"><i></i>
												<?php
foreach(Config::item('borough_pictype') as $k => $v){
?>
												<span subcate="<?php echo $k."_".$k;?>"><?php echo $v;?></span>
												<?php }?>
											</div>
										</div>
										<input type="hidden" name="pic_id[]" value="<?php echo $key->id;?>">
										<input type="hidden" name="pic_thumb[]" value="<?php echo $key->pic_thumb;?>">
										<input type="hidden" name="pic_sub_cate[]" id="subcate_<?php echo $key->id;?>" value="<?php echo $key->pic_sub_cate;?>">
										<input type="hidden" name="pic_is_default[]" value="<?php echo $key->pic_is_default;?>">
										<input type="hidden" name="pic_category[]" value="<?php echo $key->pic_sub_cate;?>">
									</li>
									<?php 
									$z_index = $z_index-1;
									}}
									?>
								</ul>
							</div>
                            <div class="myuploadbutton_box"></div>
                            
							<div class="myuploadbutton1">
								<input id="upload_button_js1" type="file" name="file" size="1" value=""/>
								<p class="tips">上传高清照片(像素比例660*450),图片大小不要超过2M</p>
							</div>
							<div class="myuploadbutton" style="display:none">
								<input id="upload_button_js" type="file" name="file" size="1"/>
							</div>
                            
                            </td>
					</tr>
				</table>
				<div class="one">
					<label>保存选项:</label>
					<input name="states" type="radio" value="1" <?php if ($datainfo ->states && $datainfo ->states(1)){echo "checked";}?> />
					<span>正式发布</span>
					<input type="radio" name="states" value="0" <?php if ($datainfo ->states && $datainfo ->states(0)){echo "checked";}?> />
					<span>保存草稿</span> </div>
				<div class="two">
					<input type="submit" value="提交" class="btn">
					<input type="reset" value="返回" class="btn_back">
				</div>
			</form>
			<div style="clear:both"></div>
			<?php }?>
		</div>
	</div>
</div>
<div style="clear:both"></div>
</body>
</html>
<script type="text/javascript">initValid(document.rent);</script>
<script type="text/javascript" src="../swfupload/scripts/swfobject.js"></script>
<script type="text/javascript" src="../swfupload/scripts/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript">
function count(){
	var area = $("#area").val();
	var price = $("#price").val();
	var count;
	if(area>0 && price>0){
		count = area * price;
		$("#count_tips").html(count+' 元');
	}else{
		$("#count_tips").html("请先填写完整信息!");
	}
}

function pic_hxt_upload(msg){
	$("#pic_hxt").val(msg);
	$("#pic_hxt_tips").html('<a target="_blank" href="'+msg+'"><img style="border:1px solid #999999; padding:2px;" src="'+msg+'" width="100" height="60" /></a>');
}
function pic_pmt_upload(msg){
	$("#pic_pmt").val(msg);
	$("#pic_pmt_tips").html('<a target="_blank" href="'+msg+'"><img style="border:1px solid #999999; padding:2px;" src="'+msg+'" width="100" height="60" /></a>');
}
</script>
<script type="text/javascript">
//var z_index=99;
//var category_data_assemble = {"1":<?php if($jsons[1]){echo $jsons[1];}else{echo 0;}?>,"2":0,"3":0,"4":0,"5":0,"6":0,"7":0,"8":0,"9":0,"10":0,"11":0,"12":0};
var category_data_assemble = {
    <?php for($i=1;$i<13;$i++){?>
            "<?php echo $i;?>":<?php if($jsons[$i]){echo $jsons[$i];}else{echo 0;}?>,
    <?php }?>
}
var category_data_all = {"1":["\u5916\u7acb\u9762",0],"2":["\u5927\u697c\u5165\u53e3",0],"3":["\u5927\u5802",0],"4":["\u7535\u68af\u5385",0],"5":["\u516c\u5171\u8d70\u5eca",0],"6":["\u536b\u751f\u95f4",0],"7":["\u697c\u5185\u914d\u5957",0],"8":["\u529e\u516c\u533a\u57df",0],"9":["\u505c\u8f66\u573a",0],"10":["\u9ad8\u5c42\u666f\u89c2",0],"11":["\u5468\u8fb9\u73af\u5883",0],"12":["\u6237\u578B\u56FE",0],"13":["\u697C\u5C42\u5E73\u9762\u56FE",0]};
</script>
<script type="text/javascript">
var editor;
KindEditor.ready(function(K) {
	editor = K.create('textarea[name="content"]', {
		uploadJson : '/kind/php/upload_json.php',
        fileManagerJson : '/kind/php/file_manager_json.php',
		allowFileManager : true,
		resizeType : 1,
		allowPreviewEmoticons : true,
		allowImageUpload : true,
		items : [
			'source','fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
			'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright','|', 'emoticons', 'image', 'link']
	});
});
</script>
<script type="text/javascript" src="../swfupload/myupload_house.js"></script>
<script type="text/javascript" src="/js/jquery.lightbox-0.5.js"></script>
<link rel="stylesheet" type="text/css" href="/css/jquery.lightbox-0.5.css" media="screen" />
<script type="text/javascript">
    $(function() {
        $('.r_p a').lightBox();
    });
	
<?php if(is_array($piclist)) {?>
	var initype=1;
<?php }else{?>
	var initype=2;
<?php }?>
</script>