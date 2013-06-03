$(function(){
loadmenu(1);
})

function loadmenu(itemid){
	$('#link'+itemid).className = 'mmac';
	var data='itemid='+itemid;
	data+='&rnd='+Math.random();
	var loading='<div style="text-align:center;padding:50px 0;width:100%;"><img src="images/loading.gif" /><br />数据加载中...</div>';
	$('#mainct').html(loading);
		$.ajax({
			url:'load.php',
			type:'post',
			data:data,
			error:function(){alert('request error');},
			success:function(msg){
				if(msg!='error'){
					$('#mainct').html(msg);
					for(i=1;i<6;i++){
						document.getElementById("link"+i).className = 'mm';
					}
					document.getElementById("link"+itemid).className = 'mmac';
				}else{
					$('#mainct').html('加载菜单失败，请重试！');
				}
			}
	})
}

function showHide(objname)
{
	var obj = document.getElementById(objname);
	if(obj.style.display == 'block' || obj.style.display =='')
		obj.style.display = 'none';
	else
		obj.style.display = 'block';
	return true;
}