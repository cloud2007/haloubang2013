// 复杂的自定义覆盖物
    function ComplexCustomOverlay(point, text, mouseoverText,id){
      this._point = point;
      this._text = text;
      this._overText = mouseoverText;
	  this._id = id;
    }
    ComplexCustomOverlay.prototype = new BMap.Overlay();
    ComplexCustomOverlay.prototype.initialize = function(map){
      this._map = map;
      var div = this._div = document.createElement("div");
      div.style.position = "absolute";
      div.style.zIndex = BMap.Overlay.getZIndex(this._point.lat);
      div.style.backgroundColor = "#EE5D5B";
      div.style.border = "1px solid #BC3B3A";
      div.style.color = "white";
      div.style.height = "18px";
      div.style.padding = "2px";
      div.style.lineHeight = "18px";
      div.style.whiteSpace = "nowrap";
      div.style.MozUserSelect = "none";
      div.style.fontSize = "12px"
      var span = this._span = document.createElement("span");
      div.appendChild(span);
      span.appendChild(document.createTextNode(this._text));      
      var that = this;

      var arrow = this._arrow = document.createElement("div");
      arrow.style.background = "url(http://map.baidu.com/fwmap/upload/r/map/fwmap/static/house/images/label.png) no-repeat";
      arrow.style.position = "absolute";
      arrow.style.width = "11px";
      arrow.style.height = "10px";
      arrow.style.top = "22px";
      arrow.style.left = "10px";
      arrow.style.overflow = "hidden";
      div.appendChild(arrow);
     
      div.onmouseover = function(){
        this.style.backgroundColor = "#6BADCA";
        this.style.borderColor = "#0000ff";
		this.style.zIndex = "1";
        this.getElementsByTagName("span")[0].innerHTML = that._overText;
        arrow.style.backgroundPosition = "0px -20px";
      }

      div.onmouseout = function(){
        this.style.backgroundColor = "#EE5D5B";
        this.style.borderColor = "#BC3B3A";
		this.style.zIndex = "0";
        this.getElementsByTagName("span")[0].innerHTML = that._text;
        arrow.style.backgroundPosition = "0px 0px";
      }
	  
	  div.onclick = function(){
		loadhouse(that._id);
		var info = document.getElementById("info");
		info.style.display="block";
      }

      mp.getPanes().labelPane.appendChild(div);
      
      return div;
    }
    ComplexCustomOverlay.prototype.draw = function(){
      var map = this._map;
      var pixel = map.pointToOverlayPixel(this._point);
      this._div.style.left = pixel.x - parseInt(this._arrow.style.left) + "px";
      this._div.style.top  = pixel.y - 30 + "px";
    }
	
	
	function loadhouse(id){
		var id=id;
		var data='id='+id;
		data+='&rnd='+Math.random();
		var loading='<div style="text-align:center;padding:50px 0;width:100%;"><img src="images/loading.gif" /><br />数据加载中...</div>';
		$("#info").html(loading);
		$.ajax({
			url:'loadhouse.php',
			type:'post',
			data:data,
			error:function(){alert('request error');},
			success:function(msg){
				if(msg!='error'){
					$('#info').html(msg);
				}else{
					alert("抱歉,数据出错");
				}
			}
		})
	}
	
	function closeinfo(){
		var info = document.getElementById("info");
		info.style.display="none";
		}