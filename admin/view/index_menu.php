<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>menu</title>
<link rel="stylesheet" href="css/base.css" type="text/css" />
<script language="javascript" type="text/javascript" src="/js/jquery-1.6.2.min.js"></script>
<script language="javascript" type="text/javascript" src="js/leftmenu.js"></script>
<style>
div {
	padding:0px;
	margin:0px;
}
body {
	padding:0px;
	margin:auto;
	text-align:center;
	background-color:#eff5ed;
	background:url(images/leftmenu_bg.gif);
	padding-left:3px;
	overflow:scroll;
	overflow-x:hidden;
	scrollbar-face-color: #eff8e6;
	scrollbar-shadow-color: #edf2e3;
	scrollbar-highlight-color: #ffffff;
	scrollbar-3dlight-color: #F2F2F2;
	scrollbar-darkshadow-color: #bdbcbd;
	scrollbar-arrow-color: #bdbcbd
}
dl.bitem {
	clear:both;
	width:140px;
	margin:0px 0px 5px 12px;
	background:url(images/menunewbg.gif) repeat-x;
}
dl.bitem2 {
	clear:both;
	width:140px;
	margin:0px 0px 5px 12px;
	background:url(images/menunewbg2.gif) repeat-x;
}
dl.bitem dt, dl.bitem2 dt {
	height:25px;
	line-height:25px;
	padding-left:35px;
	cursor:pointer;
}
dl.bitem dt b, dl.bitem2 dt b {
	color:#003158;
}
dl.bitem dd, dl.bitem2 dd {
	padding:3px 3px 3px 3px;
	background-color:#fff;
}
div.items {
	clear:both;
	padding:0px;
	height:0px;
}
.fllct {
	float:left;
	width:85px;
}
.flrct {
	padding-top:3px;
	float:left;
}
.sitemu li {
	padding:0px 0px 0px 18px;
	line-height:22px;
	background:url(images/arr4.gif) no-repeat 5px 9px;
}
ul {
	padding-top:3px;
}
li {
	height:22px;
}
a.mmac div {
	background:url(images/leftbg2.gif) no-repeat;
	height:37px!important;
	height:47px;
	padding:6px 4px 4px 10px;
	word-wrap: break-word;
	word-break : break-all;
	font-weight:bold;
	color:#0071ca;
}
a.mm div {
	background:url(images/leftmbg1.gif) no-repeat;
	height:37px!important;
	height:47px;
	padding:6px 4px 4px 10px;
	word-wrap: break-word;
	word-break : break-all;
	font-weight:bold;
	color:#00477f;
	cursor:pointer;
}
a.mm:hover div {
	background:url(images/leftbg2.gif) no-repeat;
	color:#0071ca;
}
.mmf {
	height:1px;
	padding:5px 7px 5px 7px;
}
#mainct {
	padding-top:8px;
	background: url(images/idnbg1.gif) repeat-y;
}
</style>
<base target="main" />

</head>
<body target="main">
<table width="180" align="left" border='0' cellspacing='0' cellpadding='0' style="text-align:left;">
	<tr>
		<td valign='top' style='padding-top:10px' width='20'>
			<a id='link1' class='mmac'><div onClick="loadmenu(1)">系统</div></a>
			<a id='link2' class='mm'><div onClick="loadmenu(2)">房源</div></a>
			<a id='link3' class='mm'><div onClick="loadmenu(3)">楼盘</div></a>
			<a id='link4' class='mm'><div onClick="loadmenu(4)">用户</div></a>
			<a id='link5' class='mm'><div onClick="loadmenu(5)">缓存</div></a>
			<div class='mmf'></div>
		</td>
		<td width='160' id='mainct' valign="top"></td>
	</tr>
	<tr>
		<td width='26'></td>
		<td width='160' valign='top'><img src='images/idnbgfoot.gif' /></td>
	</tr>
</table>
</body>
</html>