// JavaScript Document
/*------------------------公告效果----------------------------------*/
(function (win){
var callboarTimer;
var callboard = $('#con');
var callboardUl = callboard.find('ul');
var callboardLi = callboard.find('li');
var liLen = callboard.find('li').length;
var initHeight = callboardLi.first().outerHeight(true);
win.autoAnimation = function (){
if (liLen <= 1) return;
var self = arguments.callee;
var callboardLiFirst = callboard.find('li').first();
callboardLiFirst.animate({
marginTop:-initHeight
}, 500, function (){
clearTimeout(callboarTimer);
callboardLiFirst.appendTo(callboardUl).css({marginTop:0});
callboarTimer = setTimeout(self, 8000);
});
}
callboard.mouseenter(
function (){
clearTimeout(callboarTimer);
}).mouseleave(function (){
callboarTimer = setTimeout(win.autoAnimation, 8000);
});
}(window));
setTimeout(window.autoAnimation, 8000); 

/*------------------------公告效果end----------------------------------*/
/*------------------------搜索栏----------------------------------*/
$(".search_form .t").focus(
  function(){
	  $(this).val("");
	  }

)
$(".search_form .t").blur(
 function(){
      if($(this).val()==""){
	  $(this).val("请输入楼盘名称、街道名称......")
	  
	  }
	 }
 

)
/*------------------------搜索栏end----------------------------------*/

/*------------------------下拉列表----------------------------------*/
$("#menu_list .CRselectBox .CRselectBoxOptions  li a").hover(function(){
	$(this).addClass("selected")
	
	
	},function(){
		
	$(this).removeClass("selected")	
		})
$(".CRselectValue").mousemove(function(){   
        $(this).blur();   
        $(".CRselectBoxOptions").show();
		$(".CRselectBoxOptions1").hide();
		$(".CRselectBoxOptions2").hide();   
        return false;   
    });

 
$(".CRselectBoxItem a").click(function(){   
        $(this).blur();   
        var value = $(this).attr("rel");   
        var txt = $(this).text();   
        $("#area1").val(value);   
        $("#area1_CRtext").val(txt);   
        $(".CRselectValue").text(txt);   
        $(".CRselectBoxItem a").removeClass("selected");   
        $(this).addClass("selected");   
        $(".CRselectBoxOptions").hide();   
        return false;   
    });

$("#menu_list .CRselectBox1 .CRselectBoxOptions1  li a").hover(function(){
	$(this).addClass("selected")
	
	
	},function(){
		
	$(this).removeClass("selected")	
		})
$(".CRselectValue1").mousemove(function(){   
        $(this).blur();   
        $(".CRselectBoxOptions1").show();
		$(".CRselectBoxOptions").hide();  
		$(".CRselectBoxOptions2").hide();     
        return false;   
    }); 
$(".CRselectBoxItem1 a").click(function(){   
        $(this).blur();   
        var value = $(this).attr("rel");   
        var txt = $(this).text();   
        $("#level").val(value);   
        $("#level_CRtext1").val(txt);   
        $(".CRselectValue1").text(txt);   
        $(".CRselectBoxItem1 a").removeClass("selected");   
        $(this).addClass("selected");   
        $(".CRselectBoxOptions1").hide();   
        return false;   
    });

$("#menu_list .CRselectBox2 .CRselectBoxOptions2  li a").hover(function(){
	$(this).addClass("selected")
	
	
	},function(){
		
	$(this).removeClass("selected")	
		})
$(".CRselectValue2").mousemove(function(){   
        $(this).blur();   
        $(".CRselectBoxOptions2").show();
		$(".CRselectBoxOptions").hide(); 
		$(".CRselectBoxOptions1").hide();    
        return false;   
    }); 
$(".CRselectBoxItem2 a").click(function(){   
        $(this).blur();   
        var value = $(this).attr("rel");   
        var txt = $(this).text();   
        $("#area").val(value);   
        $("#area_CRtext2").val(txt);   
        $(".CRselectValue2").text(txt);   
        $(".CRselectBoxItem2 a").removeClass("selected");   
        $(this).addClass("selected");   
        $(".CRselectBoxOptions2").hide();   
        return false;   
    });
/*------------------------下拉列表end----------------------------------*/
$(document).ready(function(){
	$('.CRselectBox,.CRselectBox1,.CRselectBox2').hover(function(){
			$(this).find('ul').show();
			$(this).hover(function(){},
				function(){
					$(this).find("ul").hide(); 
				}
				);
		},function(){}
	);
})


/*------------------------租赁图片效果----------------------------------*/
$(".rent_list ul li").hover(function(){
	$(this).addClass("rent_hover")
	       .siblings().removeClass("rent_hover")
	
	})
/*------------------------租赁图片效果end----------------------------------*/
/*------------------------热租排行----------------------------------*/
$(".rent_bg_r ul li").hover(function(){
	$(".rent_bg_r ul li dl dd").hide();
	$(".rent_bg_r ul li dl dt").show();
	$(".rent_bg_r ul li dl dd").eq($(this).index()).show();
	$(".rent_bg_r ul li dl dt").eq($(this).index()).hide();
	
	})
/*------------------------热租排行end----------------------------------*/
/*------------------------热门出售----------------------------------*/
$(".sale_r ul li").hover(function(){
	$(".sale_r ul li dl dd").hide();
	$(".sale_r ul li dl dt").show();
	$(".sale_r ul li dl dd").eq($(this).index()).show();
	$(".sale_r ul li dl dt").eq($(this).index()).hide();
	})
$(".hot_s ul li").hover(function(){
	$(".hot_s ul li dl dd").hide();
	$(".hot_s ul li dl dt").show();
	$(".hot_s ul li dl dd").eq($(this).index()).show();
	$(".hot_s ul li dl dt").eq($(this).index()).hide();
	})
/*------------------------热门出售end----------------------------------*/
/*------------------------相册动画----------------------------------*/

setInterval(roll,4000)
var page=0;
function roll(){
	page++;
	var jqwidth=$("#photo .photo_bg .roll").width();
	var  jq2=$("#photo .photo_bg .roll .roll_r");
	var jq2width=$("#photo .photo_bg .roll .roll_r").width();
	var page_count=parseInt(jq2width/jqwidth);
       if(page==page_count){
	        jq2.animate({"left":"0"},"100");
			page=0;
		 }else{
		  jq2.animate({"left":"-="+jqwidth},"100");
		 
			 }

$(".origin").find("span").eq(page).addClass("one").siblings().removeClass("one");
	
	}
	
/*------------------------相册动画end----------------------------------*/
/*------------------------楼盘出租信息----------------------------------*/
$(".h_bg .hover_1 li:gt(0)").hover(function(){
	 $(this).addClass("hover_li")
	
	},function(){
		$(this).removeClass("hover_li")
		})
$(".h_bg .hover_2 li:gt(0)").hover(function(){
	 $(this).addClass("hover_li")
	
	},function(){
		$(this).removeClass("hover_li")
		})

/*------------------------楼盘出租信息end----------------------------------*/
/*------------------------热租楼盘和热售楼盘----------------------------------*/
$(".hot_rent").children(".md_ul").children("li").hover(function(){
	
	$(this).addClass("hover_li").siblings().removeClass("hover_li")
	$(".hot_rent").children(".md_content").children("div").hide()
	$(".hot_rent").children(".md_content").children("div").eq($(this).index()).show()
	})
/*------------------------热租楼盘和热售楼盘end----------------------------------*/
/*------------------------房源列表----------------------------------*/
/*$(".list_cent ul li").click(function(){
	var _this=$(this).index();
	$(".list_cent ul li").children("div").css({"background":"#fefff3"})
	$(".list_cent ul li").eq(_this).children("div").css({"background":"#ffe49a"})
	})*/
$(".list_cent ul li").children("div").hover(function(){
	$(this).addClass("hover_div")
	       
	},function(){
	$(this).removeClass("hover_div")	
		})


/*------------------------房源列表end----------------------------------*/

/*------------------------房源列表----------------------------------*/
$(".list_cent ul li").children("div").hover(function(){
	$(this).addClass("hover_div")
	       
	},function(){
	$(this).removeClass("hover_div")	
		})
/*------------------------经纪人页面----------------------------------*/
$(".agent_l .agent_content .agent_rent .md_rent").children("li").hover(function(){
	$(this).addClass("md_hover")
	       .siblings().removeClass("md_hover")
    $(".agent_rent .content_con").children("div").hide();
	$(".agent_rent .content_con").children("div").eq($(this).index()).show();
  }
		)
/*------------------------经纪人页面end----------------------------------*/
/*------------------------经纪人页面资讯和问答----------------------------------*/
$(".ags .ags_ul").children("li").hover(function(){
	$(this).addClass("hover_li")
	       .siblings().removeClass("hover_li")
    $(".ags .zhuyao").children("div").hide();
	$(".ags .zhuyao").children("div").eq($(this).index()).show();
  }
		)
/*------------------------经纪人页面资讯和问答-end----------------------------------*/
/*------------------------开发商页面---------------------------------*/
$(".ads .cbtn").click(function(){
	$(this).parent(".ads").hide();
	})
/*------------------------开发商页面答end----------------------------------*/


//首页ajax切换
$(function(){
	$('.bg_choose').each(function(){
		$(this).bind('mousemove',function(){
			$('.bg_choose').removeClass('bg_choose_tab_dq');
			$(this).addClass('bg_choose_tab_dq');
		})
	})
})
function loadhouse(type,area,result){
	var data='type='+type+'&area='+area;
	data+='&rnd='+Math.random();
	var loading='<div style="text-align:center;padding:50px 0;width:100%;"><img src="/img/loading.gif" /><br />数据加载中...</div>';
	$('#'+result).html(loading);
		$.ajax({
			url:'/ajax.indexloadhouse.php',
			type:'post',
			data:data,
			error:function(){alert('request error');},
			success:function(msg){
				if(msg!='error'){
					$('#'+result).html(msg);
				}else{
					alert("抱歉,数据出错");
				}
			}
	})
}
//首页ajax切换搜索关键词
function changehotsearch(){
	$("#hotsearch").load("/ajax.hotsearch.php?"+Math.random());
}

//头部搜索控制
var myinput = document.getElementById("myinput");
function addListener(element,e,fn){    
	if(element.addEventListener){    
		element.addEventListener(e,fn,false);    
	} else {    
		element.attachEvent("on" + e,fn);    
	}    
}
addListener(myinput,"click",function(){
	if(myinput.value == "请输入楼盘名称、街道名称......"){myinput.value = "";}
})
addListener(myinput,"blur",function(){
	if(myinput.value == ""){myinput.value = "请输入楼盘名称、街道名称......";}
})