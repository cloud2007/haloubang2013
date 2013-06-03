var flash_buttonImg = "/img/upload_bigbottom.gif";
var flash_buttonImg_small = "/img/upload_smallbottom.gif";
var upload_list = $('#info');//图片群根节点
var subcate_class_prefix = 'subcate_class_';//分类概况节点id前缀
var z_index=99;
$(document).ready(function() {
	if(initype==2){
		uploadbuttonshow1();
	}else{
		$('.myuploadbutton1').hide();
		uploadbuttonshow();
		$('.myuploadbutton').show();
	}
					//uploadbuttonshow(flash_buttonImg);	   
						   /*
	$("#upload_button_js").uploadify({
		'uploader'       : '../swfupload/scripts/uploadify.swf',
		'script'         : '../swfupload/class/upload.php?cfg=house|true|house|true',
		'scriptAccess'   : 'always',
		'cancelImg'      : '../swfupload/images/cancel.png',
		'width'          : '110',
		'height'         : '30',
		'wmode'          : 'transparent',  //falsh透明
		'buttonImg'      : flash_buttonImg,
		'fileDesc'       : '允许上传的文件列表',
		'fileExt'        : '*.gif;*.jpg;*.bmp;*.png;*.jpeg;*.png',
		'queueID'        : 'infos',
		'auto'           : true, //自动上传
		'multi'          : true, //允许上传多个文件
		'sizeLimit'      : 1024*1024*3, //控制上传文件的大小，单位byte
		'onSelect'       : function(event,ID,fileObj) {
      						$('#info ul').append('<li id="'+ID+'" style="z-index:'+z_index+';"><div class="wait">等待中</div></li>');
							show();
							z_index=z_index-1;
		},
		'onopen'         : function(event,ID,fileObj) {
      						$('#'+ID).html('<div class="waiting">照片上传中</div>');
		},
		'onSelectOnce'   : function(event,data){},
		'onProgress' : function(event,ID,fileObj,data){
						 	$('#'+ID).html('<div class="waiting">照片上传中</div>');
							$('#'+ID).append('<div class="uping" style="width:'+(data.percentage-10)+'%"></div>');
		},
		'onComplete'	 : function(event, ID, fileObj, response, data) {						
							var json = eval("(" + response + ")");        
							$('#'+ID).html('<div class="list_img"><img src="'+ json['msg'] +'" /></div>');
							$('#'+ID).append('<div class="default_box" style="display: none;"><span class="default_picbg"></span><span class="default_pictext"><a>设为默认图</a></span></div>');
							$('#'+ID).append('<span class="closed"></span>');
							$('#'+ID).append('<div id="select_'+ ID +'" class="list_select"><em>选择分类</em><div class="choice" style="display: none;"><i></i><span subcate="1_1">外立面</span><span subcate="2_2">大楼入口</span><span subcate="3_3">大堂</span><span subcate="4_4">电梯厅</span><span subcate="5_5">公共走廊</span><span subcate="6_6">卫生间</span><span subcate="7_7">楼内配套</span><span subcate="8_8">办公区域</span><span subcate="9_9">停车场</span><span subcate="10_10">高层景观</span><span subcate="11_11">周边环境</span><span subcate="12_12">户型图</span><span style="width:110px;" subcate="13_13">楼层平面图</span></div></div>');
							//$('#'+ID).append('排序:<input type="text" name="pic_order[]" size="4" value="">');
							$('#'+ID).append('<input type="hidden" name="pic_thumb[]" value="'+json['msg']+'">');
							$('#'+ID).append('<input type="hidden" name="pic_sub_cate[]" id="subcate_'+ ID +'" value="0">');
							$('#'+ID).append('<input type="hidden" name="pic_is_default[]" value="0">');
							$('#'+ID).append('<input type="hidden" name="pic_category[]" value="0">');							
			},
			
			'onError'     : function (event,ID,fileObj,errorObj) {
								$("#upload_button_js").uploadifyCancel(ID);
								BatchUploaderOnError(ID,errorObj.type+errorObj.info);
							}
	
	});*/
	
	
	//选择分类div打开和隐藏
	$(".list_select").live('mouseover mouseout',function(event){
		if(event.type =='mouseover'){ 
			$(this).addClass("list_select_on");
			$(this).children(".choice").show();
		}else if(event.type =='mouseout'){
			$(this).removeClass("list_select_on");
			$(this).children(".choice").hide();
		}
	});
	
	//选择分类项背景色变化
	$(".choice span").live('mouseover mouseout',function(event){
			if(event.type =='mouseover'){
				$(this).addClass("choice_span");
			}else if(event.type =='mouseout'){
				$(this).removeClass("choice_span");
			}
	});
	
	
	//设置默认图事件
	$(".default_box a").live('click',function(){
		BatchSetDefault($(this).parent().parent());
	});
	
	//选择一个分类点击事件
	$(".choice span").live('click',function(){
			on_change_subcate(0,$(this));
	});


	//绑定删除事件
	$(".closed").live('click',function(event){
		BatchDeleteImgBox($(this).parents('li').eq(0),event);
	});
	
	//默认图片是否显示控制
	$('.list_img').live('mouseover mouseout',function(event){
		if(event.type =='mouseover'){
                $(this).next(".default_box").show();
				var button = $(this).next(".default_box");
                button.hover(
                    function(){
                        button.show();
                    },
                    function(){
                        if(button.find('.default_pictext').text()!='默认图片'){
                            button.hide();
                        }
                    }
                );
		}else if(event.type =='mouseout'){
				var button = $(this).next(".default_box");
                if(button.find("a").text()=='默认图片'){
                    button.show();
                }else{
                    button.hide();
				}
		}
	});

})//DOCUMENT END

/*变更分类*/
function on_change_subcate(id,span){
    if(typeof(id) == 'undefined' || !id){
        var valArr = span.parents('li').eq(0).find('[name="pic_sub_cate[]"]').attr('id').split('_');
        id = valArr[1];
    }
    var CateValArr = span.attr('subcate').split('_');
    var subCateVal = CateValArr[0];
    var CateVal = CateValArr[1];
	$('#select_'+id).find('em').html(span.html());
    updCatesClassifyNums($('#subcate_'+id).val(),-1);
	$('#subcate_'+id).val(subCateVal);
    span.parents('li').eq(0).find('[name="pic_category[]"]').val(CateVal);
    updCatesClassifyNums(subCateVal,1);
}

$(document).ready(function(){
	for(i=1;i<13;i++){
		updCatesClassifyNums(i,0);
		}
})
/*更新分类概况数字*/
function updCatesClassifyNums(subCate,addNums){
    if(subCate>0){
         var keyName = subCate.toString();
        if(typeof(category_data_assemble[keyName]) != 'undifined'){
            var classNum = category_data_assemble[keyName];
            var subCateInfo = category_data_all[keyName];
            var subCateName = subCateInfo[0];
            var numTips = '';
            if(parseInt(classNum) + parseInt(addNums) > 0){
                numTips = '('+(parseInt(classNum) + parseInt(addNums))+')';
                $('#'+subcate_class_prefix+subCate).addClass('list_has');
            }else{
                $('#'+subcate_class_prefix+subCate).removeClass('list_has');
            }
            $('#'+subcate_class_prefix+subCate).html(subCateName+numTips);
            category_data_assemble[keyName] = parseInt(classNum) + parseInt(addNums);
        }   
    }
}

/*删除已经上传、选择、曾经上传过的图片节点*/
function BatchDeleteImgBox(box,e) {
	box.remove();
    /*更新分类概况*/
	showuploadstyle();
    updCatesClassifyNums(box.find('[name="pic_sub_cate[]"]').val(),-1);
}

/*检测显示默认框还是小图上传框*/
function showuploadstyle(){
	var nnn=$("#info li").length;
	if(nnn<1){
		showstyle(1);
	}else{
		showstyle(2);
	}
}

/*显示上传按钮方式*/
function showstyle(style){
	//1为默认大图框  其他为小图框
	if(style==1){
		$('.upload_class').hide();
		$('.myuploadbutton1').remove();
		$('.myuploadbutton').remove();
		$('#uuuppp').append('<div class="myuploadbutton1"><input id="upload_button_js1" type="file" name="file" size="1"/><p class="tips">上传高清照片(像素比例660*450),图片大小不要超过2M</p></div>');
		uploadbuttonshow1();
	}else{
		$('.upload_class').show();
		$('.myuploadbutton1').remove();
		$('.myuploadbutton').remove();
		$('#uuuppp').append('<div class="myuploadbutton"><input id="upload_button_js" type="file" name="file" size="1"/></div>');
		uploadbuttonshow();
	}
}

//Action “设置默认”
function BatchSetDefault(button, catId) {
	if(typeof(catId) == 'undefined' || !catId){
		catId = button.parent().find('[name="pic_category[]"]').val();
	}
	/*if(catId == PIC_CATEGORY_PLAN){//*写字楼平面图不允许设置默认*//*//todo?
		return false;
	}*/
	var button_old = upload_list.find('li').has('[name="pic_is_default[]"][value!=0]').find('.default_box');
	if(button.parent().find('[name="pic_is_default[]"]').val()!=1){
		if(button_old.length>0){
			BatchCreateSetDefaultButton(button_old, catId);//变更原“默认图”为“设置默认”按钮
			button_old.hide();
		}
		
		$('input[name="pic_is_default[]"]').val(0);//处理全部图片为非默认图
		button.parent().find('[name="pic_is_default[]"]').val(1);//将当前节点设为“默认图”
		button.html('');//移除原文案
		BatchCreateDefaultIcon(button, catId);
	}
}

//将当前节点设为“默认图”
function BatchCreateDefaultIcon(op, catId) {
	op.show();
	$("<span></span>").addClass('default_picbg').appendTo(op);
	$("<span></span>").addClass('default_pictext').append($("<a></a>").text('默认图片')).appendTo(op);
}

//构造“设置默认”按钮
function BatchCreateSetDefaultButton(op, catId) {//op-图片节点
	op.html('');
	$("<span></span>").addClass('default_picbg').appendTo(op);
	var default_pictext = $("<span></span>").addClass('default_pictext').appendTo(op);
	var button = $('<a></a>');
	button.html('设为默认图').prependTo(default_pictext);
}

/*上传失败，保存出错信息*/
function BatchUploaderOnError(id,err_msg){
	alert('一张图片上传失败，可能的原因是：'+err_msg+'，请检查后重试！');
	/*移除上传节点*/
	removeErrorUploaderBox(id);
	return false;
}

/*移除节点*/
function removeErrorUploaderBox(id){
    if($('#'+id).length>0){
        $('#'+id).remove();
    }
}

/*添加一张图片到房源图库中*/
function addthispic(ID,picthumb,pic_sub_cate,pic_show_name){
	$('#load_li_'+ID).find('.house_ok').css('display','block');
	$('#load_li_'+ID).find('.list_selects1').css('display','none');
	/*
	var house_ok = $('#pic_load').find('li[key="'+ID+'"]').find('.house_ok');
    var is_selected = house_ok.attr('is_selected');
   	if (is_selected==1) {
           //house_ok.hide();
           house_ok.attr('is_selected',0);
           //house_ok.parent().removeClass('housepic_img_on');
   		   //BatchDeleteImgBox(imgBox);
   	}
	*/
	
	$('#info ul').append('<li id="' + ID + '" style="z-index:'+z_index+';"></li>');
	z_index=z_index-1;
	$('#'+ID).html('<div class="list_img"><img src="'+ picthumb +'" /></div>');
	$('#'+ID).append('<div class="default_box" style="display: none;"><span class="default_picbg"></span><span class="default_pictext"><a>设为默认图</a></span></div>');
	$('#'+ID).append('<span class="closed"></span>');
	$('#'+ID).append('<div id="select_'+ ID +'" class="list_select"><em>'+pic_show_name+'</em><div class="choice" style="display: none;"><i></i><span subcate="1_1">外立面</span><span subcate="2_2">大楼入口</span><span subcate="3_3">大堂</span><span subcate="4_4">电梯厅</span><span subcate="5_5">公共走廊</span><span subcate="6_6">卫生间</span><span subcate="7_7">楼内配套</span><span subcate="8_8">办公区域</span><span subcate="9_9">停车场</span><span subcate="10_10">高层景观</span><span subcate="11_11">周边环境</span><span subcate="12_12">户型图</span><span style="width:110px;" subcate="13_13">楼层平面图</span></div></div>');
	//$('#'+ID).append('排序:<input type="text" name="pic_order[]" size="4" value="">');
	$('#'+ID).append('<input type="hidden" name="pic_thumb[]" value="'+picthumb+'">');
	$('#'+ID).append('<input type="hidden" name="pic_sub_cate[]" id="subcate_'+ ID +'" value="'+pic_sub_cate+'">');
	$('#'+ID).append('<input type="hidden" name="pic_is_default[]" value="0">');
	$('#'+ID).append('<input type="hidden" name="pic_category[]" value="0">');		
}

function uploadbuttonshow(){
	
	$("#upload_button_js").uploadify({
		'uploader'       : '../swfupload/scripts/uploadify.swf',
		'script'         : '../swfupload/class/upload.php?cfg=house|true|house|true',
		'scriptAccess'   : 'always',
		//'cancelImg'      : '../swfupload/images/cancel.png',
		//'width'          : '147',
		//'height'         : '43',
		'wmode'          : 'transparent',  //falsh透明
		'buttonImg'      : flash_buttonImg_small,
		'fileDesc'       : '允许上传的文件列表',
		'fileExt'        : '*.gif;*.jpg;*.bmp;*.png;*.jpeg;*.png',
		'queueID'        : 'infos',
		'auto'           : true, //自动上传
		'multi'          : true, //允许上传多个文件
		'sizeLimit'      : 1024*1024*2, //控制上传文件的大小，单位byte
		'onSelect'       : function(event,ID,fileObj) {
      						$('#info ul').append('<li id="'+ID+'" style="z-index:'+z_index+';"><div class="wait">等待中</div></li>');
							//$('.upload_class').show();
							z_index=z_index-1;
		},
		'onopen'         : function(event,ID,fileObj) {
      						$('#'+ID).html('<div class="waiting">照片上传中</div>');
		},
		'onAllComplete'  : function(event,data){
							$('.wait').parent().remove();
							showuploadstyle();
		},
		'onSelectOnce'   : function(event,data){},
		'onProgress' : function(event,ID,fileObj,data){
						 	$('#'+ID).html('<div class="waiting">照片上传中</div>');
							$('#'+ID).append('<div class="uping" style="width:'+(data.percentage-10)+'%"></div>');
		},
		'onComplete'	 : function(event, ID, fileObj, response, data) {
							var json = eval("(" + response + ")");        
							$('#'+ID).html('<div class="list_img"><img src="'+ json['msg'] +'" /></div>');
							$('#'+ID).append('<div class="default_box" style="display: none;"><span class="default_picbg"></span><span class="default_pictext"><a>设为默认图</a></span></div>');
							$('#'+ID).append('<span class="closed"></span>');
							$('#'+ID).append('<div id="select_'+ ID +'" class="list_select"><em>选择分类</em><div class="choice" style="display: none;"><i></i><span subcate="1_1">外立面</span><span subcate="2_2">大楼入口</span><span subcate="3_3">大堂</span><span subcate="4_4">电梯厅</span><span subcate="5_5">公共走廊</span><span subcate="6_6">卫生间</span><span subcate="7_7">楼内配套</span><span subcate="8_8">办公区域</span><span subcate="9_9">停车场</span><span subcate="10_10">高层景观</span><span subcate="11_11">周边环境</span><span subcate="12_12">户型图</span><span style="width:110px;" subcate="13_13">楼层平面图</span></div></div>');
							//$('#'+ID).append('排序:<input type="text" name="pic_order[]" size="4" value="">');
							$('#'+ID).append('<input type="hidden" name="pic_thumb[]" value="'+json['msg']+'">');
							$('#'+ID).append('<input type="hidden" name="pic_sub_cate[]" id="subcate_'+ ID +'" value="0">');
							$('#'+ID).append('<input type="hidden" name="pic_is_default[]" value="0">');
							$('#'+ID).append('<input type="hidden" name="pic_category[]" value="0">');							
			},
			
			'onError'     : function (event,ID,fileObj,errorObj) {
								alert('文件上传发生错误,错误类型:'+errorObj.type+',提示信息：'+errorObj.info+',请重新选择文件上传');
								//$('.wait').parent().remove();
								//$('.myuploadbutton').remove();
								//$('#uuuppp').append('<div class="myuploadbutton"><input id="upload_button_js" type="file" name="file" size="1"/></div>');
								//uploadbuttonshow();
								
							}
	
	});

}
	
	
	
	
	
	function uploadbuttonshow1(){
	
	$("#upload_button_js1").uploadify({
		'uploader'       : '../swfupload/scripts/uploadify.swf',
		'script'         : '../swfupload/class/upload.php?cfg=house|true|house|true',
		'scriptAccess'   : 'always',
		'cancelImg'      : '../swfupload/images/cancel.png',
		'width'          : '148',
		'height'         : '45',
		'wmode'          : 'transparent',  //falsh透明
		'buttonImg'      : flash_buttonImg,
		'fileDesc'       : '允许上传的文件列表',
		'fileExt'        : '*.gif;*.jpg;*.bmp;*.png;*.jpeg;*.png',
		'queueID'        : 'infos',
		'auto'           : true, //自动上传
		'multi'          : true, //允许上传多个文件
		'sizeLimit'      : 1024*1024*2, //控制上传文件的大小，单位byte
		'onSelect'       : function(event,ID,fileObj) {
      						$('#info ul').append('<li id="'+ID+'" style="z-index:'+z_index+';"><div class="wait">等待中</div></li>');
							$('.upload_class').show();
							$('.myuploadbutton1').addClass("hide1");
							$('.tips').hide();
							z_index=z_index-1;
		},
		'onopen'         : function(event,ID,fileObj) {
      						$('#'+ID).html('<div class="waiting">照片上传中</div>');
		},
		'onSelectOnce'   : function(event,data){},
		'onAllComplete'  : function(event,data){
							$('.wait').parent().remove();
							showuploadstyle();
		},
		'onProgress' : function(event,ID,fileObj,data){
						 	$('#'+ID).html('<div class="waiting">照片上传中</div>');
							$('#'+ID).append('<div class="uping" style="width:'+(data.percentage-10)+'%"></div>');
		},
		'onComplete'	 : function(event, ID, fileObj, response, data) {
							
							var json = eval("(" + response + ")");        
							$('#'+ID).html('<div class="list_img"><img src="'+ json['msg'] +'" /></div>');
							$('#'+ID).append('<div class="default_box" style="display: none;"><span class="default_picbg"></span><span class="default_pictext"><a>设为默认图</a></span></div>');
							$('#'+ID).append('<span class="closed"></span>');
							$('#'+ID).append('<div id="select_'+ ID +'" class="list_select"><em>选择分类</em><div class="choice" style="display: none;"><i></i><span subcate="1_1">外立面</span><span subcate="2_2">大楼入口</span><span subcate="3_3">大堂</span><span subcate="4_4">电梯厅</span><span subcate="5_5">公共走廊</span><span subcate="6_6">卫生间</span><span subcate="7_7">楼内配套</span><span subcate="8_8">办公区域</span><span subcate="9_9">停车场</span><span subcate="10_10">高层景观</span><span subcate="11_11">周边环境</span><span subcate="12_12">户型图</span><span style="width:110px;" subcate="13_13">楼层平面图</span></div></div>');
							//$('#'+ID).append('排序:<input type="text" name="pic_order[]" size="4" value="">');
							$('#'+ID).append('<input type="hidden" name="pic_thumb[]" value="'+json['msg']+'">');
							$('#'+ID).append('<input type="hidden" name="pic_sub_cate[]" id="subcate_'+ ID +'" value="0">');
							$('#'+ID).append('<input type="hidden" name="pic_is_default[]" value="0">');
							$('#'+ID).append('<input type="hidden" name="pic_category[]" value="0">');							
			},
			
			'onError'     : function (event,ID,fileObj,errorObj) {
								alert('文件上传发生错误,错误类型:'+errorObj.type+',提示信息：'+errorObj.info+',请重新选择文件上传');
								//$('.wait').parent().remove();
								//$('.myuploadbutton1').hide();
								//uploadbuttonshow();
								//$('.myuploadbutton').show();
							}
	
	});
	
	}