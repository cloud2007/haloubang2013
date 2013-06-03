//首页大广告
var gg960ShowTime = 5000; //播放时间
var gg960Time = null;

function open_gg960(showBtn){
    $('.gg_full .gg_fcon').html(gg960Con).slideDown(300,function(){
        if(showBtn !== false){
            $('.gg_full .gg_fbtn').fadeIn();
        }
        if(gg960Time){clearTimeout(gg960Time);}
        gg960Time = setTimeout(close_gg960,gg960ShowTime);
    });
}
function close_gg960(){
    $('.gg_full .gg_fcon').slideUp(500,function(){
        $(this).html('');
        $('.gg_fclose').hide();
        $('.gg_freplay').show();
    });
}
$('.gg_fclose').click(function(){
    if(gg960Time){clearTimeout(gg960Time);}
    close_gg960();
    return false;
});
$('.gg_freplay').click(function(){
    if(gg960Time){clearTimeout(gg960Time);}
    open_gg960(false);
    $('.gg_freplay').hide();
    $('.gg_fclose').show();
    return false;
});

var gg960Con;
var fullAdType = 'jpg';
var fullAdUrl = '/'
var fullAdName = 'img/bg_top_banner.jpg';;
if(fullAdName)
{
	if(fullAdType == 'jpg')
	{
		gg960Con = ' <img width="1003" height="247" src="img/bg_top_banner.jpg"/>';
	}
	else
	{
		gg960Con = '<a href="'+fullAdUrl+'" target="_blank"><img width="1003" height="247" src="img/bg_top_banner.jpg"/></a>';//flash无法显示时，显示JPG广告
	}
	
	setTimeout(open_gg960,1500);//延迟显示
}