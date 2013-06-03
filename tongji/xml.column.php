<?php
//柱状图 xml
$str="";
$str.="<chart showFCMenuItem='0' palette='2' caption='最大值 [16:00]  3   最小值 [0:00]  0 ' canvasBorderAlpha='20' bgColor='FFFFFF' canvasBorderThickness='1' showBorder='0' legendBorderAlpha='0' bgAngle='360' showlegend='1' showValues='1' decimals='2' useRoundEdges='0' baseFontSize ='12' outCnvbaseFontSize='12' use3DLighting='0' numberScaleValue='10000,1,1,1000' formatNumberScale='1' numberScaleUnit=' , ,万,千万 ' toolTipSepChar=':' plotFillRatio='100,0' chartRightMargin='6' chartTopMargin='0' chartLeftMargin='0' chartBottomMargin='3' showShadow='0' labelStep='2' animation='0'>";
for($i=1;$i<20;$i++){
	$str.="<set label='".$i.":00'  value='".$i."' toolText='第".$i."条数据量' />";
}
$str.="</chart>";

echo iconv('utf-8','gb2312',$str);
?>