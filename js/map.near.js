 var otherCondition=[
{index:0,id:"btnBuilding",searchtype:"building",searchname:"楼盘",markers:[]},
{index:1,id:"btnBus",searchtype:"bus",searchname:"公交车",markers:[]},
{index:2,id:"btnHotel",searchtype:"hotel",searchname:"餐饮",markers:[]},
{index:3,id:"btnBank",searchtype:"bank",searchname:"银行",markers:[]},
{index:4,id:"btnSuperMarket",searchtype:"supermarket",searchname:"超市",markers:[]},
{index:5,id:"btnShop",searchtype:"shop",searchname:"商场",markers:[]},
{index:6,id:"btnSchool",searchtype:"school",searchname:"学校",markers:[]},
{index:7,id:"btnHospital",searchtype:"hospital",searchname:"医院",markers:[]},
{index:8,id:"btnFurniture",searchtype:"furniture",searchname:"家居卖场",markers:[]},
{index:9,id:"btnDecoration",searchtype:"decoration",searchname:"装饰公司",markers:[]},
{index:10,id:"btnGasstation",searchtype:"gasstation",searchname:"加油站",markers:[]}];
var otherIndex;

function OnNearOpen()
{
hideAllOtherMarker();
var keywords=new Array();
for(var i=0;i<otherCondition.length;i++)
{
    otherIndex=i;
    if($("#"+otherCondition[otherIndex].id).attr("checked")){
        if(otherCondition[otherIndex].searchtype=="building"){
            if(window.showProjMarker){
                window.showProjMarker();
            }else{
                searchProject();
            }
        }else{
            keywords.push(otherCondition[otherIndex].searchname);
            $("#"+otherCondition[otherIndex].id).removeAttr("disabled");
        }
    }else{
        if(otherCondition[otherIndex].searchtype=="building"){
            if(window.hideProjMarker){
                window.hideProjMarker();
            }else{
                hideOtherMarker();
            }
        }else{
            hideOtherMarker();
        }
}
}
if(keywords.length>0)
{
nearon=true;
searchNearMul(keywords);
}
}
function NearInit()
{
   $("input.othersearch").bind("click",function(){
        otherIndex=$("input.othersearch").index($(this));
        if($(this).attr("checked")){
            //$(this).attr({"disabled":"disabled"});
            if(otherCondition[otherIndex].searchtype=="building"){
                if(window.showProjMarker){
                    window.showProjMarker();
                }else{
	                searchProject();
	            }
	        }else{
                showOtherMarker();
            }
        }else{
            if(otherCondition[otherIndex].searchtype=="building"){
                if(window.hideProjMarker){
	                window.hideProjMarker();
	            }else{
	                hideOtherMarker();
	            }
	        }else{
                hideOtherMarker();
            }
        }
    });
}

$(function(){
    $("input.othersearch").bind("click",function(){
        otherIndex=$("input.othersearch").index($(this));
        if($(this).attr("checked")){
            //$(this).attr({"disabled":"disabled"});
            if(otherCondition[otherIndex].searchtype=="building"){
                if(window.showProjMarker){
                    window.showProjMarker();
                }else{
	                searchProject();
	            }
	        }else{
                showOtherMarker();
                nearon=true;
            }
        }else{
            if(otherCondition[otherIndex].searchtype=="building"){
                if(window.hideProjMarker){
	                window.hideProjMarker();
	            }else{
	                hideOtherMarker();
	            }
	        }else{
                hideOtherMarker();
            }
        }
    });
     
});
function showOtherMarker(){
    var condition=otherCondition[otherIndex];
    searchNear(condition.searchname);
   $("#"+otherCondition[otherIndex].id).removeAttr("disabled");
}
function hideOtherMarker(){
    var condition=otherCondition[otherIndex];
    
    
     for(var i=0;i<condition.markers.length;i++)
       {map.removeOverlay(condition.markers[i]);}
       condition.markers=new Array();
       var j=1;
       while(j<11)
       {
         if(otherCondition[j].markers.length>0)
         {
          break;
         }
          j++;
       }
       if(j>10)
       {
        nearon=false;
       }
   
}
function hideAllOtherMarker(){
for(var j=1;j<11;j++)
{
    var condition=otherCondition[j];
     for(var i=0;i<condition.markers.length;i++)
       {map.removeOverlay(condition.markers[i]);}
       condition.markers=[];
}
nearon=false;   
} 

function searchNear(searchname){
   var options = {
   onSearchComplete: function(results){
    // 判断状态是否正确
    if (local.getStatus() == BMAP_STATUS_SUCCESS){
      var s = [];
       var img =imgurl+"/secondhouse/image/soufunmap/mapnew/icon_"+otherCondition[otherIndex].searchtype+".gif";
 
        var markerOptions={offset:new BMap.Size(-11, -31),icon:new BMap.Icon(img, new BMap.Size(16,16))};
        otherCondition[otherIndex].markers=new Array();
      for (var i = 0; i < results.getCurrentNumPois(); i ++){
         // addNearMarker(results.getPoi(i).point.lat,results.getPoi(i).point.lng,results.getPoi(i).address,results.getPoi(i).phoneNumber,results.getPoi(i).title); 
          var  marker = new BMap.Marker(results.getPoi(i).point,markerOptions);
       
           var sContent = '<div style="padding:5px;line-height:18px;color:#00468C;width:200px;">';
				sContent += '<b>'+results.getPoi(i).title.replace(/&#39;/g, '&acute;')+'</b><br/>';
				sContent += '<b>地址：</b>'+results.getPoi(i).address.replace(/&#39;/g, '&acute;')+'<br/>';
				if(results.getPoi(i).phoneNumber) {
					sContent += '<b>电话：</b>'+results.getPoi(i).phoneNumber+'<br/>';
				}
				sContent += '</div>';
				marker.provalue = sContent;
				
				
          map.addOverlay(marker);
          marker.addEventListener('click', function(){this.openInfoWindow(new BMap.InfoWindow(this.provalue));});
          otherCondition[otherIndex].markers.push(marker);
          
      }  
    }
  }
};
    var local = new BMap.LocalSearch(map, options);
       var point = map.getCenter();
    local.searchNearby(searchname,point);
}

function searchNearMul(searchname){
   var options = {
   onSearchComplete: function(results){
   var tempresults;
   for(var j=0;j<results.length;j++)
   {
   tempresults=results[j];
   switch(results[j].keyword)
   {
     case "公交车":
     otherIndex=1;
     break;
     case "餐饮":
     otherIndex=2;
     break;
     case "银行":
     otherIndex=3;
     break;
     case "超市":
     otherIndex=4;
     break;
     case "商场":
     otherIndex=5;
     break;
     case "学校":
     otherIndex=6;
     break;
     case "医院":
     otherIndex=7;
     break;
     case "家居卖场":
     otherIndex=8;
     break;
     case "装饰公司":
     otherIndex=9;
     break;
     case "加油站":
     otherIndex=10;
     break;
   default:
   break;
   }
    // 判断状态是否正确
    if (local.getStatus() == BMAP_STATUS_SUCCESS){
      var s = [];
       var img =imgurl+"/secondhouse/image/soufunmap/mapnew/icon_"+otherCondition[otherIndex].searchtype+".gif";
 
        var markerOptions={offset:new BMap.Size(-11, -31),icon:new BMap.Icon(img, new BMap.Size(16,16))};
        otherCondition[otherIndex].markers=new Array();
      for (var i = 0; i < tempresults.getCurrentNumPois(); i ++){
         // addNearMarker(results.getPoi(i).point.lat,results.getPoi(i).point.lng,results.getPoi(i).address,results.getPoi(i).phoneNumber,results.getPoi(i).title); 
          var  marker = new BMap.Marker(tempresults.getPoi(i).point,markerOptions);
       
           var sContent = '<div style="padding:5px;line-height:18px;color:#00468C;width:200px;">';
				sContent += '<b>'+tempresults.getPoi(i).title.replace(/&#39;/g, '&acute;')+'</b><br/>';
				sContent += '<b>地址：</b>'+tempresults.getPoi(i).address.replace(/&#39;/g, '&acute;')+'<br/>';
				if(tempresults.getPoi(i).phoneNumber) {
					sContent += '<b>电话：</b>'+tempresults.getPoi(i).phoneNumber+'<br/>';
				}
				sContent += '</div>';
				marker.provalue = sContent;
				
				
          map.addOverlay(marker);
          marker.addEventListener('click', function(){this.openInfoWindow(new BMap.InfoWindow(this.provalue));});
          otherCondition[otherIndex].markers.push(marker);
          
      }  
    }
    }
  }
};
    var local = new BMap.LocalSearch(map, options);
       var point = map.getCenter();
    local.searchNearby(searchname,point);
}