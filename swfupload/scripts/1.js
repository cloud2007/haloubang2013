/**/
/**/
/**/
/**/

var divPopup 	= $('div.popup');
var iptBinput 	= $('.building_in');
var tdBlock 	= $('.office_block');
var tdBusiness 	= $('.office_business').children('td');
var tdAddress 	= $('.office_address').children('td');
var tdManagefee	= $('.office_manage_fee');
var hdnBid 		= $('[name="office_building_id"]');
var btnPublish 	= $('.publish_button').children('input').eq(0);
var frmPublish 	= $('form.publish');
var hdnImgDel 	= $('[name="pic_del_img"]');
var mp_type 	= $('#type').val();
var save_draft  = $("#save_to_draft");
//var total_price = $('#totalprice');
var aPublish = $('#save_a');

var int_reg       	= /^\d+$/;
var t_double_reg    = /^\d{1,2}(\.\d{1,2})?$/;
var f_double_reg    = /^\d{1,5}(\.\d{1,2})?$/;
var s_double_reg    = /^\d{1,6}(\.\d{1,2})?$/;
var price_reg    	= 200000;
var U_code_js 		= /^[U][0-9_]{12,12}$/;
var code_js 		= /^[0-9]{12}$/;

//房源编码
var code 	 	   = 'txt_code';
var ipt_code 	   = $('[name="office_'+code+'"]');
var first_txt_code = $('#first_txt_code');

var memberCityID = $('#memberCityID').val();

//房源编码 失焦
ipt_code.blur(function(e){
    if (ipt_code.val().length != 0 && (code_js.test(ipt_code.val()) || U_code_js.test(ipt_code.val()))) {
        hideRed(code);
        showGreen(code);
        first_txt_code.hide();
    } else {
        hideGreen(code);
        showRed(code);
        first_txt_code.hide();
        flag = false;
    }
});

var divClose = divPopup.children('div.p2');
divClose.click(function(e){
    hidePopup();
});

var hidePopup = function(){
    divPopup.hide();
};


/********selected build ajax***************************************************************/
var AjaxBuilding = function(cityId){
    var ul = divPopup.children('ul');
    var myDate = new Date();
    var time   = myDate.getTime();

    this.search = function(kw){
        var uri = '/ajax/building/get_publish_buildings';
        uri += '?name=' + encodeURIComponent(kw);
        uri += '&cityid=' + cityId + '&time='+time,
        $.getJSON(uri, callback);
    };

    callback = function(d){
        if (typeof d.status == 'undefined' || d.status != 'ok') {
            return false;
        }
        clearLis();
        createLis(d.data);
        showPopup();
    };

    clearLis = function(){
        ul.html('');
        hdnBid.val(0);
    };

    createLis = function(building){
        $.each(building, function(i, b){
            var l = $('<li>' + b.name + '</li>');

            if (!window.XMLHttpRequest) {
                l.mouseover(function(e){
                    l.css('color', 'white').css('background-color', '#3F92D8');
                });

                l.mouseout(function(e){
                    l.css('color', 'black').css('background-color', 'white');
                });
            }

            l.click(function(e){
                iptBinput.val(b.name);
                hdnBid.val(b.id);
                //先清除内容
                $('#uploadpicBbox #plan_block').html('');
                $('#uploadpicBbox #building_block').html('');
                $('#uploadpicBbox #around_block').html('');
                iptBinput.trigger('blur');
                //tdBusiness.html(b.business_cycle);
                tdAddress.html(b.address);
                if(memberCityID){
                    business_tips = "&nbsp;&nbsp;<font color='red'>如果选择不到符合的商圈，请致电400-620-8018</font>";
                    manage_tips	  = "&nbsp;&nbsp;<font color='red'>如果物业费有误，请致电400-620-8018</font>";
                    manage_tip	  = "&nbsp;&nbsp;<font color='red'>如果您愿意提供物业费信息，请致电400-620-8018</font>";
                }else{
                    business_tips = "";
                    manage_tips   = "";
                    manage_tip   = "";
                }
                var fee = b.manage_fee;
                if(!fee){
                        $('#office_manage_fee2').val('');
                	fee = '暂无';
                	var fees = fee;
                }else{
                        $('#office_manage_fee2').val(fee);
                	fee =fee + '&nbsp;&nbsp;元/平米?月';
                	var fees = fee;
                        
                }
                
                var lock = "";
                var property_company = "--";
                if(b.property_company_lock == "0"){
                    if(b.property_company){
                        property_company = utf8Substr(b.property_company,15);
                        lock = '<em class="success_tip" style="display:none;">已提交，非常感谢您。</em><a href="javascript:void(0);" id="update_property_company">我要纠错</a>';
                    }else{
                        lock = '<em class="success_tip" style="display:none;">已提交，非常感谢您。</em><a href="javascript:void(0);" id="update_property_company">我要添加</a>';
                    }
                }else{
                    if(b.property_company){
                        property_company = b.property_company;
                    }
                }
                tdBlock.html( '地&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;址：' + b.district + '&nbsp;' + b.block + '&nbsp;' + b.address );
                
                $("#show_property_company").html(property_company+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+lock);
                $("#update_property_company").click(function(){
                    $("#show_property_company").css('display','none');
                    $("#edit_property_company").css('display','block');
                });
                //tdManagefee.html( '物业费：' + fees );
                //改变楼盘删除已选择的公共图
                if(hdnBid.val()>0){
                    $('.upload_images ul li').each(function(){
                        var tt=$(this);
                        var pidDef=$($(this).find('[name="pic_pub_img[]"]')[0]);
                        if($(pidDef).val()>0&&$(pidDef.val()!=hdnBid.val())){
                            BatchDeleteImgBox($(this));
                        }
                    });
                }

                hidePopup();
                //追加物业名到uploadpic标题上
                var wz = cutString($('[name="office_building_name"]').val(),14);
                $('#uploadpic_prompt_boxH2 span').html(wz);

                //get PerSonal & Public PicGallery
                getPicGallery(b.id,0,'update_time','desc',true,true);
                ClickPopShowStatus(true);
            });
            l.appendTo(ul);
        });
    };

    showPopup = function(){
        divPopup.show();
    };

};

function cutString( str, len) { 
    var reg = /[\\u4e00-\\u9fa5]/g,    //专业匹配中文 
        slice = str.substring(0,len), 
        realen = len - ( ~~( slice.match(reg) && slice.match(reg).length ) ); 
        return slice.substring(0, realen ? realen : 1); 
}
/**********selected build end****************************************************************/

/*******************verify start********************************************************************/
var flag = true;
var c1 = 'area';
var ipt1 = $('[name="office_'+c1+'"]');
var c2 = 'efficient_rate';
var ipt2 = $('[name="office_'+c2+'"]');
var c3 = 'total_price';
var ipt3 = $('[name="office_'+c3+'"]');
var c4 = 'unit_price';
var ipt4 = $('[name="office_'+c4+'"]');
var c5 = 'floor_id';
var ipt5 = $('[name="office_'+c5+'"]');
var c6 = 'monthly_rent';
var ipt6 = $('[name="office_'+c6+'"]');
var c7 = 'daily_rent';
var ipt7 = $('[name="office_'+c7+'"]');
var ipt99 = $('#office_money');

ipt1.blur(function(e){
    if (ipt1.val().length != 0 && f_double_reg.test(ipt1.val()) && parseFloat(ipt1.val()) != 0) {
        hideRed(c1);
        showGreen(c1);
        if(price_type){
            large_auto_value();
        }else{
            small_auto_value();
        }
        if(mp_type != 'rent'){
	    	if(ipt4.val() > 0 && ipt3.val() > 0){
	    		if(checkPrice()){
	    			$('.city_unit_price').hide();
	    			//$('.g_total_price').show();
	        	}else{
	        		$('.city_unit_price').show();
	        		hideGreen(c3);
	        		hideGreen(c4);
	        	}
	    	}
        }
    } else {
        hideGreen(c1);
        showRed(c1);
        if(mp_type == 'rent'){
            if(price_type){
                ipt6.val('');
                hideGreen(c6);
                hideRed(c6);
            }else{
                ipt7.val('');
                hideGreen(c7);
                hideRed(c7);
            }
        } else{
            if(price_type){
                ipt3.val('');
                hideGreen(c3);
                hideRed(c3);
            } else{
                ipt4.val('');
                hideGreen(c4);
                hideRed(c4);
            }
        }
        //total_price.hide();
        if(price_type){
            show_ppc_tips(false);
        }
        flag = false;
    }
});

ipt2.blur(function(e){
    if (checkNumber(ipt2.val(), 1, 100)) {
        hideRed(c2);
        showGreen(c2);
    } else {
        hideGreen(c2);
        showRed(c2);
        flag = false;
    }
});

ipt5.blur(function(e){
	var type_value = $(":input[name=office_floor_id][checked]").val();
    if (checkNumber(type_value, 1, 9)) {
        hideRed(c5);
        showGreen(c5);
    } else {
        hideGreen(c5);
        showRed(c5);
        flag = false;
    }
});

var c8 = 'title';
var ipt8 = $('[name="office_'+c8+'"]');
ipt8.blur(function(e){
    if (checkLength(ipt8.val(), 2, 30)) {
        hideRed(c8);
        showGreen(c8);
    } else {
        hideGreen(c8);
        showRed(c8);
        flag = false;
    }
});

var c9 = 'desc';
var c10 = 'building_name';
var c11 = 'building_id';
var c12 = 'manage_fee';
var c13 = 'manage_fee2';
var ipt10 = $('[name="office_'+c10+'"]');
var ipt11 = $('[name="office_'+c11+'"]');
var ipt12 = $('[name="office_'+c12+'"]');
var ipt13 = $('[name="office_'+c13+'"]');
ipt10.blur(function(e){
    if (ipt10.val().length == 0) ipt11.val(0);

    if (checkNumber(ipt11.val(), 1, 99999999)) {
        hideRed(c10);
        showGreen(c10);

        $(".office_building_address").show();
    } else {
        hideGreen(c10);
        showRed(c10);

        $(".office_building_address").hide();
        flag = false;
    }
});

ipt12.blur(function(){
    if($.trim(ipt12.val()).length == 0){
        hideRed(c12);
        hideGreen(c12);
    }else{
        if( checkFloat(ipt12.val(),0,99)){
            hideRed(c12);
            showGreen(c12);
        }else{
            hideGreen(c12);
            showRed(c12);
        }
    }
});

ipt13.blur(function(){
    if($.trim(ipt13.val()).length == 0){
        hideRed(c13);
        hideGreen(c13);
    }else{
        if( checkFloat(ipt13.val(),0,99)){
            hideRed(c13);
            showGreen(c13);
        }else{
            hideGreen(c13);
            showRed(c13);
        }
    }
});



btnPublish.click(function(e){
    $('#goto_next_step').val(1);
    $("#is_draft").val(0);
    submit_check();
});
aPublish.click(function(e){
    $('#goto_next_step').val(0);
    $("#is_draft").val(0);
    submit_check();
});

save_draft.bind("click", function(){
    $("#is_draft").val(1);
    submit_check();
});

var is_available = $('#is_available').val();
$(".office_agree_rule input:checkbox").click(function(){
	if($("#is_agree").is(':checked')==false){
		$('#save_submit').attr('disabled','disabled');
		$('#save_button').attr('disabled','disabled');
		save_draft.removeClass("draft").addClass("add_draft");
		save_draft.unbind("click");
	} else{
		if(is_available == 1){
			$('#save_submit').removeAttr("disabled");
			$('#save_button').removeAttr("disabled");
		}
		save_draft.removeClass("add_draft").addClass("draft");
		save_draft.bind("click", function(){
		    $("#is_draft").val(1);
		    submit_check();
		});
	}
});

function submit_check(){
    flag = true;
    if(price_type){
        flag = large_checkAuto();
    }else{
        flag = small_checkAuto();
    }
    ipt_code.trigger('blur');
    ipt2.trigger('blur');
    ipt5.trigger('blur');
    ipt8.trigger('blur');
    CKEDITOR.instances.office_desc.fire('blur');
    ipt10.trigger('blur');

    if (flag == true) {
        btnPublish.attr("disabled", "disabled");
        save_draft.unbind("click");
        aPublish.hide();
        frmPublish.submit();
    }else{
        if($('.nd:not(:hidden)').first().get(0)){
            $('.nd:not(:hidden)').first().get(0).scrollIntoView();
        }
    }
}

var checkNumber = function(num, min, max) {
    var regexp = /^[0-9]+$/;
    var ret = regexp.test(num);
    if (ret == false) return false;

    num = parseInt(num);
    if (num < min) return false;
    if (num > max) return false;

    return true;
};

var checkFloat = function(num, min, max) {
    var regexp = /^[0-9]+$/;
    var ret = regexp.test(num);

    if (ret == false) {
        regexp = /^[0-9]+\.[0-9]+$/;
        ret = regexp.test(num);
        if (ret == false) return false;
    }

    num = parseFloat(num);
    if (num < min) return false;
    if (num > max) return false;

    return true;
};

var checkLength = function(str, min, max) {
    if (str.length < min) return false;
    if (str.length > max) return false;
    return true;
};

var showGreen = function(name) {
    var green = $('.g_'+name);
    green.fadeIn();
};

var hideGreen = function(name) {
    var green = $('.g_'+name);
    green.hide();
};

var showRed = function(name) {
    var red = $('.r_'+name);
    red.fadeIn();
    var arrNames = ['monthly_rent','unit_price','daily_rent','total_price'];
    if($.inArray(name,arrNames)>=0){
        show_ppc_tips(false);
    }
    if(name == 'area' && price_type){
        show_ppc_tips(false);
    }
};

var hideRed = function(name) {
    var red = $('.r_'+name);
    red.hide();
};

var checkPrice = function(){
	var cityId = $('#memberCityID').val();
	var price = ipt4.val();
	if(cityId==11 || cityId==12 || cityId==13 || cityId==14){
		if(price < 4500){
			hideGreen(c4);
            hideGreen(c3);
            hideRed(c3);
            hideRed(c4);
            //total_price.hide();
            if(price_type){
                show_ppc_tips(false);
            }
    		$('.city_unit_price').show();
			$('.city_unit_price').html("<img src='http://pages.beta.dev.jinpu.com/images/building/new_red_notice.gif' />" +
					"&nbsp;&nbsp;单价不得低于4500元/平米");
			return false;
		}
	}else{
		if(price < 1000){
			hideGreen(c4);
            hideGreen(c3);
            hideRed(c3);
            hideRed(c4);
            //total_price.hide();
            if(price_type){
                show_ppc_tips(false);
            }
    		$('.city_unit_price').show();
			$('.city_unit_price').html("<img src='http://pages.beta.dev.jinpu.com/images/building/new_red_notice.gif' />" +
					"&nbsp;&nbsp;单价不得低于1000元/平米");
			return false;
		}
	}
	return true;
};

//price start
if(price_type){
    ipt4.blur(function(e){
		hideGreen(c4);
        if (ipt4.val().length != 0 && parseFloat(ipt4.val()) != 0) {
        	if(checkPrice()){
        		$('.city_unit_price').hide();
        		if(checkNumber(ipt4.val(), 1000, 999999)){
        			hideRed(c4);
                    large_auto_value();
        		}else{
        			ipt3.val('');
                    showRed(c4);
                    hideGreen(c3);
                    hideRed(c3);
                    flag = false;
        		}
        	}else{
        		ipt3.val('');
        		flag = false;
        	}
        }else{
        	ipt3.val('');
        	$('.city_unit_price').hide();
            //total_price.hide();
        	showRed(c4);
        	hideGreen(c3);
            flag = false;
        }
    });

    ipt7.blur(function(e){
        if(cityType == 'no2'){
            hideGreen(c7);
            if ((ipt7.val() != '') && (checkNumber(ipt7.val(), 1, 999))) {
                hideRed(c7);
                large_auto_value();
            } else {
                hideGreen(c7);
                showRed(c7);
                ipt6.val('');
                hideGreen(c6);
                hideRed(c6);
                //total_price.hide();
                flag = false;
            }
        } else {
            if ((ipt7.val() != '') && (t_double_reg.test(ipt7.val())) && (parseFloat(ipt7.val()) != 0)) {
                hideRed(c7);
                large_auto_value();
            } else {
                showRed(c7);
                ipt6.val('');
                hideGreen(c6);
                hideRed(c6);
                //total_price.hide();
                flag = false;
            }
        }
    });
}else{
    ipt3.blur(function(e){
        if (ipt3.val().length != 0 && s_double_reg.test(ipt3.val()) && parseFloat(ipt3.val()) != 0 && ipt3.val() <= price_reg) {
        	small_auto_value();
            if(checkPrice()){
            	$('.city_unit_price').hide();
            	hideRed(c3);
                //showGreen(c3);
            }else{
            	$('.city_unit_price').show();
            	hideGreen(c4);
            }
            hideGreen(c3);
        } else {
            ipt4.val('');
            $('.city_unit_price').hide();
            //total_price.hide();
            hideGreen(c3);
            showRed(c3);
            hideGreen(c4);
            hideRed(c4);
            flag = false;
        }
    });

    ipt6.blur(function(e){
        if (ipt6.val().length != 0 && checkNumber(ipt6.val(), 1, 99999999)) {
            hideRed(c6);
            //showGreen(c6);
            small_auto_value();
        } else {
            ipt7.val('');
            hideGreen(c7);
            hideRed(c7);
            hideGreen(c6);
            showRed(c6);
            //total_price.hide();
            flag = false;
        }
    });
}

//large
function large_auto_value(){
    var area_value = ipt1.val();
    var monthly_rent_value = ipt6.val();
    var daily_rent_value = ipt7.val();
    var unit_price_value = ipt4.val();
    var total_price_value = ipt3.val();

    if(cityType == 'no2'){
        if(checkNumber(daily_rent_value, 1, 999) && f_double_reg.test(area_value) && area_value.length != 0 && daily_rent_value.length != 0 && parseFloat(area_value) != 0 && parseFloat(daily_rent_value) != 0){
            var value = Math.round(daily_rent_value*area_value);
            ipt6.val(value);
            ipt99.html(value);
            if (value != 0) {
            	hideGreen(c7);
                hideRed(c6);
                showGreen(c6);
                $('#totalprice').show();
                show_ppc_tips(true,parseFloat(value).toFixed(2),value);
                return true;
            } else {
            	//showGreen(c7);
                hideGreen(c6);
                showRed(c6);
                //total_price.hide();
                return false;
            }
        }
    } else {
        if(t_double_reg.test(daily_rent_value) && f_double_reg.test(area_value) && area_value.length != 0 && daily_rent_value.length != 0 && parseFloat(area_value) != 0 && parseFloat(daily_rent_value) != 0){
            var value = Math.round(daily_rent_value*30.42*area_value);
            ipt6.val(value);
            ipt99.html(value);
            if (value != 0) {
            	hideGreen(c7);
                hideRed(c6);
                showGreen(c6);
                $('#totalprice').show();
                show_ppc_tips(true,parseFloat(value).toFixed(2),value);
                return true;
            } else {
            	//showGreen(c7);
                hideGreen(c6);
                showRed(c6);
                //total_price.hide();
                return false;
            }
        }
    }
    if(checkNumber(unit_price_value, 1, 999999) && f_double_reg.test(area_value) && unit_price_value !=0 && area_value.length != 0 && unit_price_value.length != 0 && area_value != 0){
        var value = unit_price_value*area_value/10000;
        ipt3.val(value.toFixed(2));
        ipt99.html(value.toFixed(2));
        if (s_double_reg.test(value.toFixed(2)) && parseFloat(value.toFixed(2)) != 0 && value.toFixed(2) <= price_reg) {
            hideRed(c3);
            showGreen(c3);
            hideGreen(c4);
            $('#totalprice').show();
            show_ppc_tips(true,value*10000,value.toFixed(2));
            return true;
        }else if(!checkPrice()){
        	return false;
        } else {
            hideGreen(c3);
            showRed(c3);
            //total_price.hide();
            return false;
        }
    }
    return false;
}


function large_checkAuto(){
    flag = true;
    if (ipt1.val().length == 0 || !f_double_reg.test(ipt1.val()) || parseFloat(ipt1.val()) == 0) {
        hideGreen(c1);
        showRed(c1);
        flag = false;
    }
    if(mp_type == 'rent'){
        if (parseFloat(ipt6.val()) == 0) {
            hideGreen(c6);
            showRed(c6);
            flag = false;
        }
        if(cityType == 'no2'){
            if ((ipt7.val() == '') || (!checkNumber(ipt7.val(), 1, 999)) || (parseFloat(ipt7.val()) == 0)) {
                hideGreen(c7);
                showRed(c7);
                flag = false;
            }
        }
        else {
            if ((ipt7.val() == '') || (!t_double_reg.test(ipt7.val())) || (parseFloat(ipt7.val()) == 0)) {
                hideGreen(c7);
                showRed(c7);
                flag = false;
            }
        }
    }else{
    	if (ipt4.val().length == 0 || !checkNumber(ipt4.val(), 1, 999999) || parseFloat(ipt4.val()) == 0) {
            hideGreen(c4);
            showRed(c4);
            return false;
    	}
        if(!checkPrice()){
       	 return false;
       }
        if (ipt3.val().length == 0 || !s_double_reg.test(ipt3.val()) || parseFloat(ipt3.val()) == 0 || ipt3.val() > price_reg) {
            hideGreen(c3);
            showRed(c3);
            return false;
        }
    }

    return flag;

}

function small_checkAuto(){
    flag = true;
    if (ipt1.val().length == 0 || !f_double_reg.test(ipt1.val()) || parseFloat(ipt1.val()) == 0) {
        hideGreen(c1);
        showRed(c1);
        flag = false;
    }
    if(mp_type == 'rent'){
        if (ipt6.val().length == 0 || !checkNumber(ipt6.val(), 1, 99999999)) {
            hideGreen(c6);
            showRed(c6);
            return false;
        }
        if(cityType == 'no1'){
        	if (parseFloat(ipt7.val()) == 0 || !t_double_reg.test(ipt7.val())) {
                hideGreen(c7);
                showRed(c7);
                return false;
            }
        } else {
        	if (parseFloat(ipt7.val()) == 0 || !checkNumber(ipt7.val(), 1, 999)) {
                hideGreen(c7);
                showRed(c7);
                return false;
            }
        }

    }else{
        if (ipt3.val().length == 0 || !s_double_reg.test(ipt3.val()) || parseFloat(ipt3.val()) == 0 || ipt3.val() > price_reg) {
            hideGreen(c3);
            showRed(c3);
            return false;
        }
        if(!checkPrice()){
          	 return false;
        }
    	if (parseFloat(ipt4.val()) == 0 || !checkNumber(ipt4.val(), 1, 999999)) {
            hideGreen(c4);
            showRed(c4);
            return false;
        }
    }

    return flag;

}

function small_auto_value(){
	var area_value = ipt1.val();
    var monthly_rent_value = ipt6.val();
    var daily_rent_value = ipt7.val();
    var unit_price_value = ipt4.val();
    var total_price_value = ipt3.val();

	if(checkNumber(monthly_rent_value, 1, 99999999) && f_double_reg.test(area_value) && area_value.length != 0 && monthly_rent_value.length != 0 && area_value != 0 && monthly_rent_value != 0){
		hideGreen(c6);
		if(cityType == 'no3'){
			var value = Math.round(monthly_rent_value/area_value);
	        ipt7.val(value);
            ipt99.html(value);
	        if(!checkNumber(value, 1, 999)){
                //total_price.hide();
	            hideGreen(c7);
	            showRed(c7);
	            return false;
			}
		} else {
			var value = (monthly_rent_value/area_value/30.42).toFixed(2);
	        if(!t_double_reg.test(value) || parseFloat(value) == 0){
                //total_price.hide();
	            hideGreen(c7);
	            showRed(c7);
	            return false;
			} else {
				ipt7.val(value);
	            ipt99.html(value);
				$('#totalprice').show();
	            hideRed(c7);
	            showGreen(c7);
                show_ppc_tips(true,monthly_rent_value,value);
	            return true;
			}
		}
        if (parseFloat(value) != 0) {
            $('#totalprice').show();
            hideRed(c7);
            showGreen(c7);
            show_ppc_tips(true,monthly_rent_value,value);
            return true;
        }else {
            hideGreen(c7);
            showRed(c7);
            //total_price.hide();
            return false;
        }

    }
    if(s_double_reg.test(total_price_value) && total_price_value <= price_reg && f_double_reg.test(area_value) && total_price_value !=0 && area_value.length != 0 && total_price_value.length != 0 && area_value != 0){
        var value = Math.round(total_price_value/area_value*10000);
        ipt4.val(value);
        ipt99.html(value);
        if(!checkNumber(value, 1, 999999)){
            //total_price.hide();
            hideGreen(c3);
            hideGreen(c4);
            showRed(c4);
            return false;
		}
        if (parseFloat(value) != 0) {
            $('#totalprice').show();
            hideRed(c4);
            showGreen(c4);
            show_ppc_tips(true,total_price_value,value);
            return true;
        }
        else {
            //total_price.hide();
            hideGreen(c4);
            showRed(c4);
            return false;
        }
    }
    return false;
}
/***************************************verify end************************************************/

$(document).ready(function(){
	//根据物业名称长短调整input框宽度
	var len = $('#office_name').width();
	if(len>0){
		var widths = len>245?365:125+len;
		var widtht = widths>250?widths:250;
//		document.getElementById('office_address').style.left=widtht+'px';
	}

	//总租金是否显示
	if(is_edit){
		$('#totalprice').show();
	}

    //get Personal & Public Pics
	if (building_id && building_id != '0') {
        getPicGallery(building_id,0,'update_time','desc',false);
        ClickPopShowStatus(true);
	}

});
/*发房四选一*/
$(function(){
    var planBox = new layerBox();
    planBox.init({
		innerId:'type_house'
	});
    planBox.showLayer();
});
/*处理退回的图片*/
$(".handle_sel").click(function(){//查看可重新选择的分类
	$(this).addClass("handle_sel_on");
});
$(".big_img span").click(function(){//查看大图
	var link=$(this).attr("src");
	redirect(link,'_blank');
});
$(".verify_del").click(function(){//删除
	var img_id = $(this).attr("att_id");
	$("#show_" + img_id).hide();
	$("#verify_is_del_" + img_id).val(1);
});

//物业公司提交
$('#submit_property_company').click(function(){
    var val = $.trim($('#office_property_company').val());
    
    $.ajax({
        type: 'POST',
        url: '/ajax/pcompany',
        data: 'com='+val+'&id='+$('#property_id').val(),
        async:false,
        success: function(data){
            if(data == "succ"){
                $('#edit_property_company').css('display','none');
                $('#show_property_company').css('display','block');
                $('#show_property_company').html(utf8Substr(val,15)+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em class='success_tip'>已提交，非常感谢您。</em>");
            }
        }
    });
});

function redirect(url){
    if (!/*@cc_on!@*/0) {
        window.open(url,'_blank');
    } else {
        var a = document.createElement('a');            
        a.href = url;            
        a.target = '_blank';            
        document.body.appendChild(a);            
        a.click();        
    }
}
/*展示定价价格*/
function show_ppc_tips(show,value,value2){
    if(obj_ppc_prange.length>0){
        var len = obj_ppc_prange.length;
        var ppc = 0;
        if(show){
            for(var i=0;i<len;i++){
                if(obj_ppc_prange[i].lower <= value && value <= obj_ppc_prange[i].upper){
                    ppc = parseFloat(obj_ppc_prange[i].ppc/100).toFixed(2);
                }
            }
            if(price_type == "1"){
                if(city_type == 'no1' && office_type == 'rent'){
                    var fix_tip_msg = '<div class="fix_tip"><p>此房源单次定价推广<b>点击价格：</b><span><b class="price">'+ppc+'</b>元</span></p><p><b>总租金：</b> <span><b class="price">'+value2+'</b> 元/月</span></p></div>';
                }else if(city_type == 'no2' && office_type == 'rent'){
                    var fix_tip_msg = '<div class="fix_tip"><p>此房源单次定价推广<b>点击价格：</b><span><b class="price">'+ppc+'</b>元</span></p><p><b>总租金：</b> <span><b class="price">'+value2+'</b> 元/月</span></p></div>';
                }else if(office_type == 'rent'){
                    var fix_tip_msg = '<div class="fix_tip"><p>此房源单次定价推广<b>点击价格：</b><span><b class="price">'+ppc+'</b>元</span></p><p><b>月租金：</b> <span><b class="price">'+value2+'</b> 元/平米?月</span></p></div>';
                }else{
                    var fix_tip_msg = '<div class="fix_tip"><p>此房源单次定价推广<b>点击价格：</b><span><b class="price">'+ppc+'</b>元</span></p><p><b>总价：</b> <span><b class="price">'+value2+'</b> 万元</span></p></div>';
                }
            }else{
                if(city_type == 'no1' && office_type == 'rent'){
                    var fix_tip_msg = '<div class="fix_tip"><p>此房源单次定价推广<b>点击价格：</b><span><b class="price">'+ppc+'</b>元</span></p><p><b>日租金：</b> <span><b class="price">'+value2+'</b> 元/月</span></p></div>';
                }else if(city_type == 'no3' && office_type == 'rent'){
                    var fix_tip_msg = '<div class="fix_tip"><p>此房源单次定价推广<b>点击价格：</b><span><b class="price">'+ppc+'</b>元</span></p><p><b>月租金：</b> <span><b class="price">'+value2+'</b> 元/平米?月</span></p></div>';
                }else{
                    var fix_tip_msg = '<div class="fix_tip"><p>此房源单次定价推广<b>点击价格：</b><span><b class="price">'+ppc+'</b>元</span></p><p><b>单价：</b> <span><b class="price">'+value2+'</b> 元/平米?月</span></p></div>';
                }
            }
            if(office_type == 'rent'){
                var bid_tip_msg = '<div class="bid_tip">注：此房源参加了竞价推广，修改总租金后竞价推广会结束。</div>';
            }else{
                var bid_tip_msg = '<div class="bid_tip">注：此房源参加了竞价推广，修改总价后竞价推广会结束。</div>';
            }

            $('#note-price-cont_msg').html('');
            if(bid_spread_id){
                var office_money_now = value;
                if(office_money_last != office_money_now){
                    var fix_tip_msg = '<div class="fix_tip" style="padding-top:0px;padding-left:30px;">此房源单次定价推广点击价格为<b>'+ppc+'</b>元</div>';
                    $('#note-price-cont_msg').html(bid_tip_msg+fix_tip_msg);
                }else{
                    $('#note-price-cont_msg').html(fix_tip_msg);
                }
            }else{
                $('#note-price-cont_msg').html(fix_tip_msg);
            }
            
            $('.note-box').show();

        }else{
            $('.note-box').hide();
            $('.note-price-cont').html('');
        }
    }
    return false;
}

//弹层二级分类
window.is_process_ok = 0;
var sub_choice_id;
$(".sub_choice").click(function(){
	if(sub_choice_id ){
		clearTimeout(sub_choice_id);
	}
	var subcatDom = $(this);
	sub_choice_id = setTimeout(function(){
		var sub_cate = subcatDom.attr('subcate');
		$("#selected_sub_category").val(sub_cate);
		$('#current_sub_category').html(subcatDom.html());
		var pi =$('#property_id').val();
		if(window.is_process_ok ==0 ){
			window.is_process_ok =1;
			getPicGallery(pi,sub_cate,'update_time','desc',true)
		}
	},400);
});

window.is_process_ok = 0;
var updateId;
$("#updatetime").click(function(){
	$(this).next().removeClass('updatetime');
	$(this).children("span").addClass('click_span');
	if(updateId ){
		clearTimeout(updateId);
	}
	updateId = setTimeout(function(){
		var sub_cate = $('#selected_sub_category').val();
		var pi =$('#property_id').val();
		if(window.is_process_ok ==0 ){
			window.is_process_ok =1;
			getPicGallery(pi,sub_cate,'update_time','desc',true);
		}
	},400);
	
});

window.is_process_ok = 0;
var splitClassId;
$("#split_class").click(function(){
	$(this).prev().children("span").removeClass('click_span');
	$(this).addClass('updatetime');
	if(splitClassId ){
		clearTimeout(splitClassId);
	}
	splitClassId = setTimeout(function(){
		var sub_cate = $('#selected_sub_category').val();
		var pi =$('#property_id').val();
		if(window.is_process_ok ==0  && sub_cate==0 ){
			window.is_process_ok =1;
			getPicGallery(pi,sub_cate,'sub_cate','desc',true);
		}
	},400);
});


$("#update_property_company").click(function(){
    $("#show_property_company").css('display','none');
    $("#edit_property_company").css('display','block');
});

function utf8Substr(str,len){
    var strlen = 0;   
    var s = "";  
    for(var i = 0;i < str.length;i++)  {   
        strlen++;   
        s += str.charAt(i);   
        if(strlen >= len){     if(str.length > len) return s+"..."; else return s ;   }  
    } 
    return s;
}

//**/
/**/
/**/
/**/

$(document).ready(function(){
	upload_cont.hide();
    if(upload_button_current=='big'){
		upload_box.hide();
        upload_tip.hide();
        showUploadDefault();
    }else{
        upload_box.show();
        hideUploadDefault();
        createUploaderButton();
        upload_tip.hide();
    }
    ClickPopShowStatus();
    UpdateUploadNumTip();
    chooseUploader();
    if(!checkImgNum()){
        hideUploaderSmallOne();
        hideUploadDefault();
    }

    if($('#'+upload_string_prefix+'_js').length > 0){
        $('#'+upload_string_prefix+'_js').unbind();
        $('#'+upload_string_prefix+'_js').bind('change',function(event){
            jpIFrameFileUpload(upload_string_prefix+'_js',event,'from_ready');
        });
    }


    $("#err_tips").hover(
        function(){
            $("#look_reason").show();
        },
        function(){
           $("#look_reason").hide();
        }
    );
	$('.list_img').live('mouseover mouseout',function(event){
		if(event.type =='mouseover'){
                $(this).prev(".default_box").show();
				var button = $(this).prev(".default_box");
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
				var button = $(this).prev(".default_box");
                if(button.find("a").text()=='默认图片'){
                    button.show();
                }else{
                    button.hide();
				}
		}
	});
	$(".list_select").live('mouseover mouseout',function(event){
		if(event.type =='mouseover'){ 
			$(this).addClass("list_select_on");
            $(this).children(".choice").show();
		}else if(event.type =='mouseout'){
			$(this).removeClass("list_select_on");
            $(this).children(".choice").hide();
		}
	});
	$(".choice span").live('mouseover mouseout',function(event){
		if(event.type =='mouseover'){
			$(this).addClass("choice_span");
		}else if(event.type =='mouseout'){
			$(this).removeClass("choice_span");
		}
	});
		
	$(".default_box a").live('click',function(){
		BatchSetDefault($(this).parent().parent());
	});
    $(".choice span").live('click',function(){
        on_change_subcate(0,$(this));
    });
    $(".list_closed").live('click',function(event){
        BatchDeleteImgBox($(this).parents('li').eq(0),event);
    });

});
/*批量上传初始化*/
function BatchUploaderInitProcess() {
    process_queue = new Array();
    process_queue_overload = new Array();
    process_total_num = 0;
    process_complete_num = 0;
    process_error_num = 0;
}
/*上传按钮不可点*/
function UploadifyUploaderHide() {
    if(flash===true){
        $('#'+upload_string_prefix+'Uploader').css('height',0);
        if(upload_button_current != 'big'){
            btn_disable_small.prependTo($('#'+upload_string_prefix+'Uploader').parent()).show();
        }
    }else{
        $('#'+upload_string_prefix).addClass(btn_disable_class);
        $('#'+upload_string_prefix+'_js').hide();
    }
    $('#'+uploaded_pop_id).hide();
}
/*上传按钮可点*/
function UploadifyUploaderShow() {
    if(flash===true){
        $('#'+upload_string_prefix+'Uploader').css('height',30);
        $('#'+upload_string_prefix+'Uploader').css('visibility','visible');
        btn_disable_small.hide();
    }else{
        $('#'+upload_string_prefix).removeClass(btn_disable_class);
        $('#'+upload_string_prefix+'_js').show();
        $('#'+upload_string_prefix+'_js').unbind();
        $('#'+upload_string_prefix+'_js').bind('change',function(event){
            jpIFrameFileUpload(upload_string_prefix+'_js',event,'from_ready');
        });
    }
    ClickPopShowStatus();
}
/*点击上传隐藏或者展示*/
function ClickPopShowStatus(show){
    if(show === true){
        show_pop = true;
    }
    if((building_id && building_id != '0') || show_pop){
        $('#'+uploaded_pop_id).show();
    }else{
        $('#'+uploaded_pop_id).hide();
    }
}
/*隐藏默认上传图大按钮框*/
function hideUploadDefault(hide_height){
    if(hide_height === true){//flash must shown in window
        if($.browser.msie){
            $('#'+upload_string_prefix+'Uploader').removeClass(btn_enable_class);
            upload_default.css(hide_upload_default);
        }else{
            if(upload_button_current == 'big'){
                upload_default.css(hide_upload_default_oth);
                $(upload_bigpic_class).hide();
                $('#'+upload_string_prefix+'Uploader').css({margin:0,visibility:'hidden'});
            }
        }

    }else{
        upload_default.hide();
    }
}
/*显示默认上传图大按钮框*/
function showUploadDefault(e){
    if($.data(upload_default,'is_removed')!=1){//upload_default.length>0 && 
        upload_default.addClass(upload_default_class);
        upload_default.css(show_upload_default);
        upload_default.show();
    }else{
        $.data(upload_default,'is_removed',0);
        createUploaderButton(true);
    }
    $(upload_bigpic_class).show();
	upload_cont.show();
}
/*移除小上传框按钮*/
function hideUploaderSmallOne(){
    $('#'+uploader_small_id).remove();
}
/*构建上传按钮*/
function createUploaderButton(big_button){
    var div_button = $('<div></div>').attr('id','upload_button');
    var pop_txt = '使用<a href="###" id="uploaded_pop_button">上传过的照片&gt;&gt;</a>';
    var pop = $('<p></p>').attr('id','uploaded_pop').html(pop_txt).css({display:'none'});
    var p_tips = p_tips;
    if(big_button===true){
        if($.data(upload_default,'is_removed')!=1){
            div_button.addClass(btn_enable_class);
            upload_default.prependTo(upload_cont).show();
            hideUploaderSmallOne();
            showUploadDefault();
            chooseUploader();
        }

    }else{
        if($('#'+uploader_small_id).length==0){
            upload_box.show();
            upload_button_current='small';
            var li = $('<li></li>').attr('id',uploader_small_id).appendTo(upload_list);
            var div = $('<div></div>').addClass('list_upload').appendTo(li);
            div_button.addClass(btn_enable_class_small).append('<input id="upload_button_js" type="file" name="file" size="1"/>');
            div.append(div_button).append(pop).append(p_tips);
            upload_default.remove();
            $.data(upload_default,'is_removed',1);
            chooseUploader();
        }else{
            UploadifyUploaderShow();
        }
    }
	upload_cont.show();
    /*是否显示“上传过”按钮*/
    ClickPopShowStatus();
}
/*用户浏览器flash版本*/
function _uFlash() {
    var f = "-", n = navigator;
    if (n.plugins && n.plugins.length) {
        for (var ii = 0; ii < n.plugins.length; ii++) {
	          if (n.plugins[ii].name.indexOf('Shockwave Flash') != -1) {
	              f = n.plugins[ii].description.split('Shockwave Flash ')[1];
	              break;
            }
        }
    } else if (window.ActiveXObject) {
        for (var ii = 10; ii >= 2; ii--) {
            try {
                var fl = eval("new ActiveXObject('ShockwaveFlash.ShockwaveFlash." + ii + "');");
                if (fl) {
                    f = ii + '.0';
                    break;
                }
            } catch (e) {
            }
        }
    }
    return f;
}
/*验证上传图的类型并设置*/
function chooseUploader(force_single) {
    var fv = parseFloat(_uFlash());
    var upload_state = 0;//未使用
    if (isNaN(fv)) {
        upload_state = 1;//js//单张 无flash
    } else {
        if (force_single===true) {
       // if (force_single!==true) {//test
            upload_state = 2;//force js//单张 强制
        } else {//flash
            if (fv >= 10.0) {
                upload_state = 4;//advanced flash//批量 flash>=10.0
                flash = true;
            } else if (fv < 9.0) {
                upload_state = 1;//too low to use batch//单张 无flash
        	} else {//9.0~10.0
                upload_state = 3;//lower flash//批量 flash<10.0
                flash = true;
            }
        }
    }
    BatchEnableUploader();
    $('#upload_state').val(upload_state);
}
//选择flash批量上传 或者js单张上传
function BatchEnableUploader(){
    /*默认绑定大的上传按钮*/
    var button_current = upload_button;
    var flash_ButtonImg = flash_buttonImg;
    var current = $(upload_default);
    var btn_enable_Class = btn_enable_class;
    if(upload_button_current=='small'){
        /*当前绑定小的上传按钮*/
        button_current = $('#'+uploader_small_id);
        flash_ButtonImg = flash_buttonImg_small;
        current = $('#'+uploader_small_id);
        btn_enable_Class = btn_enable_class_small;
    }
    if(flash === true) {
        //当前不是flash的批处理元素 则切换为flash版本的批上传
        if($('#'+upload_string_prefix+'Uploader').length!=0 && upload_button_current == 'big'){
            $('#'+upload_string_prefix+'Uploader').remove();
        }
        if($('#'+upload_string_prefix+'Uploader').length==0){
            button_current.find('#'+upload_string_prefix+'_js').hide();
            UploadifyUploader(current,btn_enable_Class,flash_ButtonImg);
        }
    } else {
        button_current.find('#'+upload_string_prefix+'_js').removeClass(btn_disable_class).show();
    }
    UploadifyUploaderShow();
}

function UploadifyUploader(current,btn_enable_class,flash_buttonImg){
    current.find('#'+upload_string_prefix).uploadify({
            uploader : 'http://pages.jinpu.com/js/uploadify/uploadify.swf?var='+Math.random()+'',
            script : 'http://upd1.ajkimg.com/upload-jinpu',
            scriptAccess : 'always',
            fileDataName : 'file',
            multi : true,
            buttonImg : flash_buttonImg,
            onSWFReady : function() {
                $('#'+upload_string_prefix+'Uploader').addClass(btn_enable_class);
            },
            onComplete : function(event,id,fileObj,response) {
                ImageCallBack(id,response);
            },
            onSelect : function(event,id,fileObj) {
                BatchUploaderOnSelect(id,fileObj.size,fileObj.name,fileObj.type);
            },
            onSelectOnce : function(event,data) {
                BatchUploaderUploadQueue(current.find('#'+upload_string_prefix),'uploadifyUpload()','uploadifyCancel(id)');
            },
            onProgress : function(event,id,fileObj,data) {
                BatchCreateProgressBox(id,data.percentage);
            },
            onOpen : function(event,id,fileObj) {
                BatchCreateProgressBox(id,0);
            },
            onError : function(event,id,fileObj,errorObj) {
                BatchUploaderOnError(id,'');
            },
            fileExt : '*.jpg;*.jpeg;*.png;*.gif',
            fileDesc : 'Web Image Files (JPG,JPEG,PNG,GIF)'
        });
        $('#'+upload_string_prefix+'Queue').remove();
        BatchUploaderInitProcess();
}

/*批量传图结束回调*/
    function ImageCallBack(id,dfsResponse){
        $.getJSON(
    		'http://my.jinpu.com/imagecallback',
    		{w : 180,h : 135,q : dfsResponse},
    		function(response) {
    			BatchUploaderOnComplete(id,response,'服务器上传回调失败');
    		});
    }
    /*一张传图结束处理回调*/
    function BatchUploaderOnComplete(id,response,message) {
    	var error = '';

    	if (response == '' || response.status != 'ok') {
    		BatchUploaderOnError(id, message);

        } else {
            error = checkImg(id,response.image.size,response.image.width,response.image.height,response.image.id);
            if(error != 'ok'){
                BatchUploaderOnError(id, error);
            }else{
            	++process_complete_num;
                BatchCreateImgBox(id,response.image.url,0,response.image.host,response.image.id,0,0,'',0,response.image.width,response.image.height,response.image.size,'',response.comment, 0, response.exif.model);
                BatchResetDefault();
            }
        }
        if ((process_complete_num + process_error_num) >= process_total_num) {
        	BatchUploaderOnAllComplete();
        }
    }
    /*上传失败，保存出错信息*/
    function BatchUploaderOnError(id,err_msg,show_errtips,bol_remove){
        ++process_error_num;
        if(show_errtips!==false){
            /*获取filename，构造出错信息*/
            var filename = getFileName(id);
            var li = $("<li></li>");
            $("<span></span>").addClass('look_title').html(filename+'&nbsp;').appendTo(li);
            $("<span></span>").addClass('look_reason').html("原因："+err_msg).appendTo(li);
            li.appendTo(err_tips_list);
            err_tips.show();
            err_tips.find('b').html(process_error_num);
        }

        if(bol_remove!==false){
            /*移除上传节点*/
            removeErrorUploaderBox(id);
        }

        return false;
    }
    /*选择上传中*/
    function BatchUploaderOnSelect(id,size,filename,filetype) {
        /*是否显示“上传过”按钮*/
        ClickPopShowStatus();
        /*影藏大的框*/
        hideUploadDefault(true);
        upload_box.show();
        /*在报错信息标签上绑定上传图片的name信息*/
        BindUploadFileInfo(id,filename,filetype);
        if ((process_total_num + BatchTotalUploaded()) >= MAX_UPLOAD_NUM) {
            process_queue_overload[id] = size;
            return false;
        }
        /*创建排队等待中box*/
        ++process_total_num;
        BatchCreateWaitingBox(id);
        process_queue[id] = size;
    }
    /*批量上传选择后*/
    function BatchUploaderUploadQueue(uploader,start,cancel) {
        err_tips.hide();
        err_tips_list.html('');
        UploadifyUploaderHide();
        for (id in process_queue_overload) {
            eval('uploader.'+cancel);
        }
        for (id in process_queue) {
            var errmsg = '';
            errmsg=checkImg(id,process_queue[id]);
        	if ( errmsg != 'ok') {
        		eval('uploader.'+cancel);
                BatchUploaderOnComplete(id, '', errmsg);
            }
        }
        if (process_total_num == 0) {
        	BatchUploaderOnAllComplete();
        } else {
            eval('uploader.'+start);//test
        }
    }
    /*本批次上传全部完成后处理*/
    function BatchUploaderOnAllComplete() {
        UnbindUploadFileInfo(0,true);
        UpdateUploadNumTip(true);
        BatchUploaderInitProcess();
        createUploaderButton();
//        BatchEnableUploader();
        if(!checkImgNum()){
            hideUploaderSmallOne();
        }
    }
/*绑定每次选择的图片的数据在元素上*/
function BindUploadFileInfo(id,filename,type){
    var upload_file_data = $.data(upload_tip,'upload_fdata');//上传图片数据 id、filename、type
     var data = {'id':id,'fname':filename,'type':type};
    if(typeof(upload_file_data) == 'undefined'){
        upload_file_data = new Object();
    }
    upload_file_data[id] = data;
    $.data(upload_tip,'upload_fdata',upload_file_data);
}
/*获取上传的图片名称*///todo mix name problem
function getFileName(id){
    var filename = '';
    var upload_file_data = $.data(upload_tip,'upload_fdata');//上传图片数据 id、filename、type
    if(upload_file_data && upload_file_data[id]){
        filename = upload_file_data[id].fname;
        var pos = filename.lastIndexOf('.');
        var file_suffix = filename.substring(pos);
        var file_type = upload_file_data[id].type;
        if(file_suffix.length>0){
            file_type = file_suffix;
        }
        filename = filename.substring(0,filename.length - file_type.length);
//        if(filename.replace (/[^\x00-\xff]/g,"rr").length>18){//保留文件名的最多9个汉字字长
        if(filename.length>6){//保留文件名的最多6个汉字字长
            var last_str = filename.substring(filename.length-1,filename.length);
            filename = filename.substring(0,6)+'...'+last_str;
        }
        filename = filename+file_type;
    }
    return filename;
}
/*删除绑定的图片信息*/
function UnbindUploadFileInfo(id,bol_clear_all){
    var upload_file_data = $.data(upload_tip,'upload_fdata');//上传图片数据 id、filename、type
    if(bol_clear_all===true){
        upload_file_data = new Object();
        $.data(upload_tip,'upload_fdata',upload_file_data);
    }else if(typeof(upload_file_data) != 'undefined'){
        delete $.data(upload_tip,'upload_fdata')[id];
    }
}
/*构造等待中imgBox*/
function BatchCreateWaitingBox(id) {
    BatchCreateUploaderBox(id).append(
        $('<div></div>').addClass('waiting').append(
        				$('<div></div>').html('等待中').addClass('text')
        		)
    );
}
/*处理上传中，构造上传中进度条*/
function BatchCreateProgressBox(id,percent) {
    var li = BatchCreateUploaderBox(id);
    li.append(
        $('<div></div>').addClass('waiting').append(
        				$('<div></div>').addClass('text').addClass('process').append(
        						$('<div></div>').addClass('processing').css('width',percent+'%')
        				).append(
        						$('<span></span>').addClass('processingtext').html('照片上传中')
        				)
        		)
    );
}

/*构造图片节点li元素*/
function BatchCreateUploaderBox(id,create_zindex) {
    upload_box.show();
    var imgnum = checkImgNum(true);
    var li = $('<li></li>');
    if(create_zindex===true){
        if(!z_index){
            z_index = 99;
        }else{
            z_index = z_index-1;
        }
    }

    li.css('z-index',z_index);
    if ($('#'+uploader_box_prefix+id).length>0) {
        li.replaceAll($('#'+uploader_box_prefix+id));
    } else {
        if(imgnum <= MAX_UPLOAD_NUM && $('#'+uploader_small_id).length>0){
            li.insertBefore($('#'+uploader_small_id));
        }else{
            li.appendTo(upload_list);
        }
    }

    if (id) {
        li.attr('id',uploader_box_prefix+id);
    }
    return li;
}
/*构造图片节点*/
function BatchCreateImgBox(id, imgUrl, imgId, hostId, key, catId, subCate, txtCmt, isDef, width, height, size ,pubImgId, comments, personalImgId, exif_model, is_lock, from_pop){//type public\personal\upload
    UnbindUploadFileInfo(id);
    if(is_lock != 1){/*是否需要锁定选择分类*/
   		is_lock = 0;
   	}
   if (!personalImgId) {/*是否是个人图库的图片*/
        personalImgId = 0;
   }

   var box = BatchCreateUploaderBox(id,true);
    $("<span></span>").addClass('list_closed').appendTo(box);
    var op = $('<div></div>').addClass('default_box').appendTo(box);
    if (isDef == 1) {
        	BatchCreateDefaultIcon(op, catId);
    } else {
        	BatchCreateSetDefaultButton(op, catId);
    }
    box.append($("<div></div>").addClass('list_img').append($('<img/>').attr({width:'120px',height:'90px',src:imgUrl})));

   var subtype;
   var disableSelect = false;
   if ((pubImgId && pubImgId > 0) || is_lock == 1) {/*公共图不能选分类*/
       	disableSelect = true;
   }
   subtype = getSubCateAll(id, catId, subCate, disableSelect,pubImgId);
   box.append(subtype);

   var cmt = $('<input/>').attr({type:'hidden',name:'pic_comment[]'}).val('').appendTo(box);
   $('<input/>').attr({type:'hidden',name:'pic_exif_model[]'}).val(exif_model).appendTo(box);
   $('<input/>').attr({type:'hidden',name:'pic_img_id[]'}).val(imgId).appendTo(box);
   $('<input/>').attr({type:'hidden',name:'pic_host_id[]'}).val(hostId).appendTo(box);
   $('<input/>').attr({type:'hidden',name:'pic_key[]'}).val(key).appendTo(box);
   $('<input/>').attr({type:'hidden',name:'pic_category[]'}).val(catId).appendTo(box);
   if(subCate == 32){//todo?
       	subCate = 0;
   }
   $('<input/>').attr({type:'hidden',name:'pic_sub_cate[]',id:'subcate_'+id}).val(subCate).appendTo(box);
   $('<input/>').attr({type:'hidden',name:'pic_is_default[]'}).val(isDef).appendTo(box);
   $('<input/>').attr({type:'hidden',name:'pic_width[]'}).val(width).appendTo(box);
   $('<input/>').attr({type:'hidden',name:'pic_height[]'}).val(height).appendTo(box);
   $('<input/>').attr({type:'hidden',name:'pic_size[]'}).val(size).appendTo(box);
   $('<input/>').attr({type:'hidden',name:'pic_illegal[]'}).val(comments).appendTo(box);
   $('<input/>').attr({type:'hidden',name:'pic_order[]'}).val(comments).appendTo(box);
   $('<input/>').attr({type:'hidden',name:'personal_is_lock[]'}).val(is_lock).appendTo(box);
   if (pubImgId && pubImgId > 0) {
       cmt.attr('readonly','readonly').addClass('disabled').focus(function(){
           $(this).blur();
       });
   } else {
       pubImgId = 0;
   }
   $('<input/>').attr({type:'hidden',name:'pic_pub_img[]'}).val(pubImgId).appendTo(box);
   $('<input/>').attr({type:'hidden',name:'pic_personal_img[]'}).val(personalImgId).appendTo(box);
    if(from_pop===true){
        updCatesClassifyNums(subCate,1);
        createUploaderButton();
        if(!checkImgNum()){
            hideUploaderSmallOne();
        }
    }

}

/*当前图片数目和验证--（上传、选择、反选时候判断；Y-相关数目变更；N-禁止上传和选择操作*/
function checkImg(id,size,width,height,key){
    var maxSize = 3145728;
    var maxSizeError = '照片大于3M';
    var minSize = 20480;
    var minSizeError = '照片小于20kb';
    var minWidth = 400;
    var minHeight = 400;
    var minWidthHeightError = '照片像素小于400*400';
    var biliError = '边长比例大于2';
    var sameError = '照片重复';
    if(id){
        if (size < minSize) {
        	return minSizeError;
        }
        if (size > maxSize) {
        	return maxSizeError;
        }
        if (!isNaN(width) && !isNaN(height)) {
        	if (width < minWidth) {
                return minWidthHeightError;
            }
            if (height < minHeight) {
                return minWidthHeightError;
            }
            if (height > (2 * width) || width > (2 * height)) {
                return biliError;
            }
        }
    }
    if (key) {
    	if (upload_list.find('li').has('[name="pic_key[]"][value="'+key+'"]').length > 0) {
    		return sameError;
    	}
    }
    return 'ok';
}
/*全部现有图片节点 包括退回的图*/
function BatchTotalUploaded(bol_default) {
    if(bol_default == true){
        return $('[name="pic_is_default[]"]').length;
    }else{
        return $('[name="pic_is_default[]"]').length + $('.big_img').length;
    }
}
/*获取当前图片节点数*/
function getImgNum(bol_default){
    return parseInt(process_total_num + BatchTotalUploaded(bol_default));
}
/*更新本次上传成功和剩余可上传数目*/
function UpdateUploadNumTip(show){
    commplete_num.html(process_complete_num);
    left_num.html(MAX_UPLOAD_NUM-BatchTotalUploaded());
    if(show === true){
        upload_tip.show();
    }
//    if(err_tips.css('display') == 'none'){
//        upload_tip.fadeOut(10000);
//    }
}
/*带上传按钮的图片节点数目检查*/
function checkImgNum(rtn_num,bol_default){
    var total_num = getImgNum(bol_default);
    if(rtn_num===true){/*是否返回图片数目*/
        return total_num;
    }
    if( total_num < MAX_UPLOAD_NUM ){
        return true;
    }else{
        return false;
    }
}

/*检查按钮的显示*/
function checkButtonAfterRemove(e){
    if(checkImgNum(true)>0 && !$('#'+uploader_small_id).length){
        /*有图片节点但是没有上传小按钮，则创建按钮*/
        createUploaderButton();
    }else if(checkImgNum(true,true)==0){
        /*删除至没有图片了，则展示默认框*/
        hideUploaderSmallOne();
        upload_box.hide();
        upload_button_current = 'big';
        showUploadDefault();
    }
}
/*移除节点*/
function removeErrorUploaderBox(id){
    if($('#'+uploader_box_prefix+id).length>0){
        $('#'+uploader_box_prefix+id).remove();
    }
}
/*删除已经上传、选择、曾经上传过的图片节点*/
function BatchDeleteImgBox(box,e) {
	box.remove();
    checkButtonAfterRemove(e);
	var imgId = box.find('[name="pic_img_id[]"]').val();
	if (imgId > 0) {
		hdnImgDel.val(hdnImgDel.val() + imgId + ',');
	}
	var isDefault = box.find('[name="pic_is_default[]"]').val() == 1;
	if (isDefault) {
		BatchResetDefault();
	}
	var catId = box.find('[name="pic_category[]"]').val();
    if (process_total_num == 0) {/*在非上传情况下*/
    	UpdateUploadNumTip();
    }
    /*更新分类概况*/
    updCatesClassifyNums(box.find('[name="pic_sub_cate[]"]').val(),-1);
    //删除图片，如果是个人图库里面的图片，个人图库里面的图片为未选中状态
    var imgKey = box.find('[name="pic_key[]"]').val();
    removePicGallery(imgKey);//todo ?
}
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
/*默认图设置*/
{
    //Action 自动选择默认图
    function BatchResetDefault() {
        var defSet = upload_list.find('li').find('[name="pic_is_default[]"][value=1]').length > 0;
        if (!defSet && house_type == HOUSE_TYPE_OFFICE) {//没有设置默认图 => 设置写字楼平面图的第一张上传图为默认图
            defSet = BatchSetFirstDefault(PIC_CATEGORY_BUILDING);
        }
        if(!defSet && house_type == HOUSE_TYPE_SHOP){
            defSet = BatchSetFirstDefault(PIC_CATEGORY_SHOP);
        }
        if (!defSet) {
            defSet = BatchSetFirstDefault(PIC_CATEGORY_AROUND);
        }
        return defSet;
    }
    //系统自动设置某分类下第一张上传的图片为默认图 todo
    /*编辑情况下，由于展示的排序以分类优先，则默认设置的不是第一张上传……除非用数据记下当前各个大分类下的第一个被选出来的图片（选择的或者上传后选择的）*/
    function BatchSetFirstDefault(catId) {
        var img = upload_list.find('li').has('[name="pic_category[]"][value='+catId+']').first();
        if (img.length>0) {
        	var button = img.find('.default_box');
            var buttonTxt = button.find('.default_pictext').text();
            if (button.length>0 && buttonTxt != '默认图片') {//重置“设置默认”按钮
                BatchSetDefault(button, catId);
            }
            return true;
        }
        return false;
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

}

////----------【单张上传】-----------////
var jpIFrameFileUpload = function(fileElementId,event,flag){
    err_tips.hide();
    err_tips_list.html('');
    upload_tip.hide();

    hideUploadDefault();
    UploadifyUploaderHide();
    $('.single_loading').show();

    var fileName = $('#'+upload_string_prefix+'_js').val().toString();
    fileName = fileName.match(/[^\\]*$/)[0];
    if(fileName.length == 0){
        fileName = fileName.match(/[^\/]*$/)[0];
    }

    $.jpIFrameFileUpload({
        fileElementId: fileElementId,
        url: 'http://upd1.ajkimg.com/upload-jinpu',
        params: {
            rt: 'http://my.jinpu.com/imagecallback?w=120&h=90'
        },
        callback: function(response){
            $('#'+fileElementId).unbind();
            $('#'+fileElementId).bind('change',function(event){
                jpIFrameFileUpload(fileElementId,event,'from_callback');
            });

            BindUploadFileInfo(response.image.id,fileName,'.'+response.image.format);

            $('.single_loading').hide();
            if (typeof(response.status) == undefined) {
                alert('response error');
                BatchUploaderOnAllComplete();
                return false;
            }
            if (response.status == 'ok') {
            	var singError=checkImg(response.image.id,response.image.size,response.image.width,response.image.height,response.image.id);
                if(singError != 'ok'){
                	BatchUploaderOnError(response.image.id, singError,true,false);
                    BatchUploaderOnAllComplete();
                    return false;
                }
				var cntImgs =BatchTotalUploaded();
                if (cntImgs >= MAX_UPLOAD_NUM) {
                    alert('一套房源最多发布'+MAX_UPLOAD_NUM+'张图片');
                    BatchUploaderOnAllComplete();
                    return false;
                }

                var isDef = 0;
                BatchCreateImgBox(response.image.id, response.image.url, 0, response.image.host, response.image.id, 0, 0, '', isDef, response.image.width, response.image.height, response.image.size,'',response.comment, 0, response.exif.model);
                process_complete_num = 1;
                BatchUploaderOnAllComplete();
                return true;
            }else {
                BatchUploaderOnError(response.image.id,'照片格式错误');
                BatchUploaderOnAllComplete();
            }

        },
        fail: function(err){//response is not a vaild json
            alert('上传失败:'+err+'('+flag+')');
            $('.single_loading').hide();
            BatchUploaderOnAllComplete();

        }
    });
};


/**/
/**/
/**/
/**/

var pic_gallery = 0;//识别是否有可以选择的两类弹层图片
var rest_num = 0;//剩余弹层可选图片数

$(document).ready(function(){
	//console.log(house_type);
    if(house_type == HOUSE_TYPE_OFFICE){
        uploadpic_title.find('span').html(cutString($('#'+building_name_id_office).html(),14));
    }else{
        uploadpic_title.find('span').html(cutString($('#'+building_name_id_shop).html(),14));
    }
    var picBox = new layerBox();
    picBox.init({
		innerId:uploadpicBbox
	});
    uploaded_pop_button.live('click',function(){
    	var pi =$('#property_id').val();
    	$('.list_select_layer em').html('选择分类');
    	getPicGallery(pi,0,'update_time','desc',true);
    	picBox.showLayer();
        var select_pic_num = getImgNum();
        rest_num = MAX_UPLOAD_NUM - select_pic_num;
        dis_select_num.text(rest_num);
		return false;
    });
    close_btn.live('click',function(){
        picBox.hideLayer();
		return false;
    });
	$(".list_select_layer").live('mouseover mouseout',function(event){
		if(event.type =='mouseover'){ 
			$(this).addClass("list_select_on");
            $(this).children(".choice_layer").show();
		}else if(event.type =='mouseout'){
			$(this).removeClass("list_select_on");
            $(this).children(".choice_layer").hide();
		}
	});
	$(".choice_layer span").live('mouseover mouseout',function(event){
		if(event.type =='mouseover'){
			$(this).addClass("choice_span");
		}else if(event.type =='mouseout'){
			$(this).removeClass("choice_span");
		}
	});

});

function cutString( str, len) {
    if(!str){
        return '';
    }
    var reg = /[\\u4e00-\\u9fa5]/g,    //专业匹配中文
        slice = str.substring(0,len),
        realen = len - ( ~~( slice.match(reg) && slice.match(reg).length ) );
        return slice.substring(0, realen ? realen : 1);
}
function getPicGallery(property_id,sub_cate,order_field,order_sort,clean,force_clean){
    pic_gallery = 2;
    if(clean){
        clearPicGallery();
    }
    if(house_type == HOUSE_TYPE_OFFICE && sub_cate ==0){
        getPublicPlanGallery(property_id,sub_cate,order_field,order_sort,clean,force_clean);
    }else{
    	getPersonalGallery(property_id,sub_cate,order_field,order_sort,clean,force_clean);
    }
}
function removePicGallery(key){
    var imgBox = housepic_box.find('li[key="'+key+'"]');
   	if (imgBox.find('.house_ok').length>0) {
		imgBox.find('.house_ok').hide();
		imgBox.find('.house_ok').attr('is_selected',0);
        imgBox.find('div').removeClass('housepic_img_on');
   	}
}
function reloadPicGallery(data_type){
    if(data_type == 'Personal'){
        var picGallery = personalGallery;
    }else if(data_type == 'Public'){
        var picGallery = publicPlanGallery;
    }
    var subName;
    var subCate;

   	for (i in picGallery) {
        if(data_type == 'Personal'){
            subName = getSubCateForPersonal(picGallery[i].category, picGallery[i].sub_cate);
            subCate = picGallery[i].sub_cate;
        }else{
            subName = '来自公共图库';//picGallery[i].sub_cate;
            subCate = picGallery[i].sub_category;
        }

   		void function(i){
   			if(picGallery[i].category != 0 && subCate != 0){
                   picGallery[i].is_lock = 1;
   			}
   		}(i);
   		var li  = $('<li></li>').attr('key',picGallery[i].key);
        var div = $('<div></div>');
        var selected = $('<span class="house_ok"></span>').attr('is_selected',0);
   		var img = div.append($('<img/>').attr('src',picGallery[i].url));
   		var chkbox = $('<p class="house_choise">'+subName+'</p>');

   		li.append(img);
   		li.append(chkbox);
        div.append(selected.css('display','none'));

//        pic_box_id.show();
        pic_block.append(li);

   		void function(i){
   			img.click(function(){
                selectPicGallery(data_type,picGallery[i]);
   			});
   		}(i);
   	}
    checkPicGallerySelected(data_type);

    showPersonalPlanGalleryWrapper();

}
function selectPicGallery(data_type, imgInfo){
    var imgBox = upload_list.find('li').has('[name="pic_key[]"][value="'+imgInfo.key+'"]');
    var house_ok = pic_block.find('li[key="'+imgInfo.key+'"]').find('.house_ok');
    var is_selected = house_ok.attr('is_selected');
   	if (is_selected==1) {
           house_ok.hide();
           house_ok.attr('is_selected',0);
           house_ok.parent().removeClass('housepic_img_on');
   		   BatchDeleteImgBox(imgBox);
   	} else {
           if(rest_num>0){
               house_ok.show();
               house_ok.attr('is_selected',1);
               house_ok.parent().addClass('housepic_img_on');
       		   createImgBoxByPersonal(imgInfo,data_type);
           }
   	}
   	//记=计数
   	rest_num = MAX_UPLOAD_NUM - BatchTotalUploaded();
   	if (rest_num < 0) rest_num = 0;
   	dis_select_num.text(rest_num);
    UpdateUploadNumTip();
}

function checkPicGallerySelected(data_type){
    if(data_type == 'Public'){
        checkPublicPlanGallerySelected();
    }
    checkPersonalGallerySelectedNew();
}

function clearPicGallery(){
    pic_block.html('');
}
////-----------------------------/////
//个人图库
var personalGallery = {};
/*入口函数，由选择物业触发*/
function getPersonalGallery(property_id,sub_cate,order_field,order_sort,clean,force_clean) {
	if (clean) {
		clearPersonalGallery(force_clean);
	}
    var params = new Object();
    if(house_type == HOUSE_TYPE_OFFICE){
        params = {
        		pi:property_id,
        		sub_cate:sub_cate,
        		order_field:order_field,
        		order_sort:order_sort,
        		_random:(new Date()).getTime()
        	};
    }else{
        params = {
            pi:property_id,
            ao:1,
            sub_cate:sub_cate,
    		order_field:order_field,
    		order_sort:order_sort,
            _random:(new Date()).getTime()
        };
    }
	$.getJSON('http://my.jinpu.com/ajax/personal/galleryv2',params,function(data){
		if (data.status == 'ok') {
			var total = data.data.length;
			var newestImg = '';

			//以下是取第一张图的逻辑
			for (var img=0;img< total; img++) {
				if(data.data[img].category == '1'){
					newestImg = (newestImg == '') ? data.data[img].url : newestImg;
				}
				if(data.data[img].category == '2'){
					newestImg = (newestImg == '') ? data.data[img].url : newestImg;
				}
				personalGallery[data.data[img].key] = data.data[img];
			}
			if(newestImg == ''){
				newestImg = data.data[0].url
			}

			$('.buildingname').html($('.building_in.in').val());
			setTimeout(function(){
                reloadPicGallery('Personal');
			},0);

		}else{
            pic_gallery = pic_gallery - 1;
            if(house_type == HOUSE_TYPE_SHOP || !pic_gallery){
                uploaded_pop.hide();
            }
		}
		window.is_process_ok =0;
	});
}

function checkPersonalGallerySelectedNew() {
	var li = upload_list.find('li').has('[name="pic_personal_img[]"][value!=0]');
	var house_ok = pic_block.find('li').find('.house_ok');
    house_ok.each(function(){
		if (li.has('[name="pic_key[]"][value="'+$(this).parents('li').attr('key')+'"]').length>0) {
			$(this).attr('is_selected',1);
            $(this).show();
            $(this).parent().addClass('housepic_img_on');
		}
	});
}
function createImgBoxByPersonal(imgInfo,data_type) {
	var id = imgInfo.key;
    var key = id;
	var imgBox = upload_list.find('li').has('[name="pic_key[]"][value="'+id+'"]');
    var imgUrl = imgInfo.url;
    var hostId = imgInfo.host_id;
    var catId = imgInfo.category;
    var subCate = data_type=='Public'?imgInfo.sub_category:imgInfo.sub_cate;
    var txtCmt = data_type=='Public'?imgInfo.sub_cate:imgInfo.comment;
    var width = data_type=='Public'?imgInfo.img_width:imgInfo.width;
    var height = data_type=='Public'?imgInfo.img_height:imgInfo.height;
    var size = data_type=='Public'?0:imgInfo.size;
    var imgId = 0;
    var exif_model = imgInfo.exif_model;
    var is_lock = data_type=='Public'?1:imgInfo.is_lock;
    var pubImgId = data_type=='Public'?imgInfo.id:0;
    var personalImgId = data_type=='Public'?0:imgInfo.id;
    var comments = 0;
    var isDef = 0;
    var from_pop = true;

	if (imgBox.length < 1) {
		var rst = BatchCreateImgBox(id, imgUrl,imgId,hostId,key,catId,subCate,txtCmt,isDef,width,height,size,pubImgId,comments,personalImgId, exif_model, is_lock,from_pop);
	    if(rst===false){
            rest_num = 0;
        }
    } else if(imgBox.length == 1) {
		BatchUploaderOnError(id, '照片重复',false,false);
	}
	UpdateUploadNumTip(true);
    BatchResetDefault();
}

function showPersonalPlanGalleryWrapper() {
	housepic_box.show();
}

function clearPersonalGallery(force_clean) {
    if(force_clean === true){
        var li = upload_list.find('li').has('[name="pic_personal_img[]"][value!=0]');
       	li.each(function(){
       		BatchDeleteImgBox($(this));
       	});
    }
	personalGallery = new Array();
}

//公共图库
var publicPlanGallery = new Array();
/*入口函数，由选择物业触发*/
function getPublicPlanGallery(property_id,sub_cate,order_field,order_sort,clean,force_clean) {
	if (clean) {
		clearPublicPlanGallery(force_clean);
	}
	$.getJSON('/ajax/get/buildingimg',{
		bi:property_id,
		it:PIC_CATEGORY_PLAN,
		t:(new Date()).getTime()
	},function(data){
		if ((data != null) && data.status == 'ok' && data.data.length > 0) {
			for (img in data.data) {
				if (!data.data[img].sub_cate) {
					data.data[img].sub_cate = '暂无分类';
				}
				publicPlanGallery[data.data[img].key] = data.data[img];
			}
            reloadPicGallery('Public');
		}else{
            pic_gallery = pic_gallery - 1;
            if(!pic_gallery){
                uploaded_pop.hide();
            }
        }
		if( (data != null) && data.status == 'ok'){
			getPersonalGallery(property_id,sub_cate,order_field,order_sort,clean,force_clean);
		}
	});
}

function clearPublicPlanGallery(force_clean) {
    if(force_clean === true){
        var li = upload_list.find('li').has('[name="pic_pub_img[]"][value!=0]');
       	li.each(function(){
       		BatchDeleteImgBox($(this));
       	});
    }
	publicPlanGallery = new Array();
}

function checkPublicPlanGallerySelected() {
    var li = upload_list.find('li').has('[name="pic_pub_img[]"][value!=0]');
   	var house_ok = pic_block.find('li').find('.house_ok');
       house_ok.each(function(){
   		if (li.has('[name="pic_key[]"][value="'+$(this).parents('li').attr('key')+'"]').length>0) {
   			$(this).attr('is_selected',1);
               $(this).show();
               $(this).parent().addClass('housepic_img_on');
   		}
   	});
}
/**/

//是否用的是flash
var flash = false;
//删除的图片
var hdnImgDel 	= $('[name="pic_del_img"]');

//图片大分类
var PIC_CATEGORY_BUILDING = 1;
var PIC_CATEGORY_AROUND = 2;
var PIC_CATEGORY_PLAN = 3;
var PIC_CATEGORY_SHOP = 4;

//发布类型 house_type
var HOUSE_TYPE_OFFICE = 'office';
var HOUSE_TYPE_SHOP = 'shop';
var building_name_id_office = 'office_name';
var building_name_id_shop = 'shop_name';

//上传中按钮灰色样式 | 按钮可点样式
var btn_disable_class = 'listup_bottom_no';
var btn_disable_small = $('<div class="listup_bottom_no"></div>');
var btn_enable_class = 'upload_bottom';
var btn_enable_class_small = 'listup_bottom';

var show_pop = false;

//点击上传按钮
var upload_string_prefix = 'upload_button';
var upload_button = $('#'+upload_string_prefix);
var upload_button_js = $('#'+upload_string_prefix+'_js');

//上传按钮 flash按钮图片背景
var flash_buttonImg = "http://pages.jinpu.com/images/newmy/upload_bigbottom.gif";
var flash_buttonImg_small = "http://pages.jinpu.com/images/newmy/upload_smallbottom.gif";
//上传图模块
var upload_cont = $('#upload_cont');
//无图片时候的大上传框
var upload_default = $('#upload_default');
var upload_default_class = 'upload_default';
//有图时候的小上传框
var uploader_small_id = 'uploader_small';

//z-index for ie 6
var z_index = 0;

var MAX_UPLOAD_NUM = 20;//上传图限制
var process_queue = new Array();//批量上传队列
var process_queue_overload = new Array();//超过上限的上传图片
var process_total_num = 0;//上传队列中总数
var process_error_num = 0;//上传出错数目
var process_complete_num = 0;//上传成功数目

var upload_fdata = new Array();//上传图片信息绑定

var upload_tip = $('#upload_tip');//上传张数tips
var show_err = $('#look_reason');//出错信息
var err_tips_list = $('#err_reason_list');//出错信息tips
var err_tips = $('#err_tips');//上传出错提示块
var commplete_num = $('#commplete_num');//成功上传num tips
var left_num = $('#left_num');//还可以上传num tips

var uploaded_pop_id = 'uploaded_pop';
var uploaded_pop_button_id = 'uploaded_pop_button';
var uploaded_pop_button = $('#uploaded_pop_button');//公共图库和个人图库弹层按钮
var uploaded_pop = $('#uploaded_pop');//使用“上传过的图片”
var hide_upload_default = {overflow:'hidden',height:0,border:0};//隐藏高度
var hide_upload_default_oth = {overflow:'visible',height:0,border:0};
var show_upload_default = {overflow:'visible',height:'298px',border:'1px solid #CCC'};//恢复高度
var p_tips = '<p class="upload_bigpic">上传高清照片(像素大于1280*960)，有机会入选楼盘精选库，并获得积分。</p>';
var upload_bigpic_class = '.upload_bigpic';

var upload_list = $('#upload_list');//图片群根节点
var uploader_box_prefix = 'uploader_box_';//图片节点id
var upload_box = $('#upload_box');//分类详情和图片群

var subcate_class_prefix = 'subcate_class_';//分类概况节点id前缀

var housepic_box = $('#housepic_box');//弹层正文盒子
var uploadpicBbox = 'uploadpicBbox';//弹层视窗
var uploadpic_title = $('#uploadpic_prompt_boxH2');//图库弹层title
var pic_box_id = $('#pic_box_id');//弹层一级根节点的父类，控制显示
var pic_block = $('#pic_block');//弹层图片一级根节点
var dis_select_num = $('#dis_select_num');//弹层底部图片数目提示
var determine_btn = $('#determine');//弹层确定按钮
var cancel_btn = $('#cancel');//弹层取消按钮
var close_btn = $('#close');//弹层关闭按钮



