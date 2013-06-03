 
function initLink(){
    $("#aError").attr({href:"http://esf."+shortDomain+"/NewSecond/map/MapError.aspx?newcode="+searchInfo.projcode+"&district="+searchInfo.district+"&comarea="+searchInfo.comarea});
    if(searchInfo.isSchool=="1")
    {
     $("#aBig").attr({href:MapRoot+"/?newcode="+searchInfo.schoolId+"&schoolname="+escape(searchInfo.projName)+"&px="+searchInfo.px+"&py="+searchInfo.py});
    }
    else
    {
     $("#aBig").attr({href:MapRoot+"/?newcode="+searchInfo.projcode});
    }
}
function initDrive(){
    $("#txtProjName").val(searchInfo.projName);
    $("#txtProjCode").val(searchInfo.projcode);
    $("#endname").val(searchInfo.projName);
//    if($("#txtProjName").val()!=""){
//        $("#txtProjName").attr({"disabled":"disabled"});
//    }
}
function checkStartName(){
    if($("#startname").val()==""){
        alert("驾车起点不能为空，请重试！");
        $("#startname").focus();
        return false;
    }
    return true;
}
$(function(){

        window.map = new BMap.Map("divMap");
        map.setCurrentCity(cityName);
        var point = new BMap.Point(mapInfo.px,mapInfo.py);
        point = new BMap.Point(mapInfo.px,mapInfo.py);
        map.enableScrollWheelZoom(true);
        map.centerAndZoom(point,14);
        map.addControl(new BMap.NavigationControl());
        var ctrl_sca = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
	    map.addControl(ctrl_sca);

      
     if(mapInfo.isKey=="1")
     {
        addMarker(point,labelHtml);
     }
    initLink();
    initDrive();
});
function addProjectMarker(data){
    if(data.project){
        otherCondition[otherIndex].markers=new Array();
        for(i=0;i<data.project.length;i++){  
            var result=data.project[i];
            if(result.projcode!=searchInfo.projcode){
             var img =  imgurl+"/secondhouse/image/soufunmap/mapnew/icon_"+otherCondition[otherIndex].searchtype+".gif";         
                var markerOptions={offset:new BMap.Size(-11, -31),icon:new BMap.Icon(img, new BMap.Size(16,16))};
                var point =  new BMap.Point(result.px,result.py);  
                var  marker = new BMap.Marker(point,markerOptions);
               
            
               
                var html="<div style='padding:10px'>"; 
                if(result.projname!="") 
                {
                    html+=" 楼盘名称： <a href='http://esf."+shortDomain+"/housing/"+result.projcode+".htm' style='color:#f30;' target='_blank'>"+result.projname+"</a><br/><br/>";
                } 
                if(result.address!="") 
                {
                     html+=" 物业地址："+result.address;
                }
                html+="</div>";
				marker.provalue = html;
                 map.addOverlay(marker);
                 marker.addEventListener('click', function(){this.openInfoWindow(new BMap.InfoWindow(this.provalue));});
                otherCondition[otherIndex].markers.push(marker);
            
             
            }
        }
       
        $("#"+otherCondition[0].id).removeAttr("disabled");
    }
}
function searchProject(){
	var bounds = map.getBounds(); 
		var sw0 = bounds.getSouthWest();
	var ne0 = bounds.getNorthEast();
 

	var x10 = sw0.lng  ;
	var y10 = sw0.lat ; 
	var x20 = ne0.lng  ;
	var y20 = ne0.lat ;
	var x1 = x10-0.015;
    var y1 = y10- 0.0013; 
    var x2 = x20+0.015;
    var y2 = y20+0.0013; 
	var url=MapRoot+"/Interfaces/GetHousePoint.aspx?x1="+x1+"&y1="+y1+"&x2="+x2+"&y2="+y2+"&page=1"+"&v="+FileVision;
    $.getJSON(url,addProjectMarker);
}



  //创建marker
    window.addMarker = function (point,html){
            map.panTo(point);
            var marker = new BMap.Marker(point);
            var label = new BMap.Label("",{"offset":new BMap.Size(-2,-3.5)});
            label.setContent(html);
            marker.setLabel(label);
            marker.setZIndex(101);
            map.addOverlay(marker);
           
            label.setStyle({
                         border:"0",
                         height:"0",
                         padding :"0px 0px 0px 0px"
            });
    }