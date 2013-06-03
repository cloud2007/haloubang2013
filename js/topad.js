
$(function(){
	//过两秒显示 showImage(); 内容
    setTimeout(showImage,3000);
    //alert(location);
});
function showImage()
{
    $("#adBig").slideUp(1000,function(){$("#adSmall").slideDown(1000);});
	$(" .btn").click(function(){
	 $(this).parent().hide();
	
	})
	$("#adSmall").mouseover(function(){
	 $(".slied_down").slideDown("slow");
	})
	$("#adSmall").mouseout(function(){
	 $(".slied_down").slideUp("fast");
	}) 
	
}







