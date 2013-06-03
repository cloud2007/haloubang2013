// JavaScript Document
t=setInterval(autoarc,3000);//设置定时器
var arc_li=0;
function autoarc (){
	arc_li++;
	arc_li=(arc_li==10)?0:arc_li;
	var new_left=-arc_li*142;
	$(".big_box .box .arcpic .arc_ul").animate({"left":new_left+"px"},200);
	}
$(".big_box .box a").click(function(){
	if($(this).index()==0){
		if(arc_li!=0){
               arc_li--;
			}
	}else{
				if(arc_li!=9){
					arc_li++
					}		
   }
   var new_left=-arc_li*142;
	$(".big_box .box .arcpic .arc_ul").animate({"left":new_left+"px"},200);
	})
$(".big_box .box a").mouseover(function(){
	clearInterval(t)
	})
$(".big_box .box a").mouseout(function(){
	t=setInterval(autoarc,3000);
	})
	
	
