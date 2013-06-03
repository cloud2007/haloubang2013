// JavaScript Document
var time=setInterval(auto,5000);
var sta=0;
function auto (){
	sta++;
	sta=(sta==6)?0:sta;
	$("#news_mian img").hide();
	$("#news_mian img").eq(sta).fadeIn(300);
	$("#news_mian .main_ul li").removeClass("one")
	$("#news_mian .main_ul li").eq(sta).addClass("one")
	}
$("#news_mian .main_ul li").hover( 
 
function(){
	clearInterval(time)
	sta=$(this).index();
	$("#news_mian img").hide();
	$("#news_mian img").eq(sta).fadeIn(300);
	$("#news_mian .main_ul li").removeClass("one")
	$("#news_mian .main_ul li").eq(sta).addClass("one")
	
	},function(){
	time=setInterval(auto,5000)
		}

)