<table border="0" borderolor="#ccc" width="738" cellpadding="10">
	<tr>
		<td colspan="4" class="s">楼盘参数</td>
	</tr>
	<tr class="bg_gray_fortable">
		<td class="one">楼盘名称：</td>
		<td class="two"><?php echo $borough->b_name;?></td>
		<td class="one">楼盘地址：</td>
		<td class="two"><?php echo $borough->b_addr;?></td>
	</tr>
	<tr>
		<td class="one">楼盘级别：</td>
		<td class="two"><?php echo Config::item("borough_level.".$borough->b_level);?></td>
		<td class="one">区域：</td>
		<td class="two"><?php echo Config::item("borough_area.".$borough->b_area1).'-'.Config::item("area_".$borough->b_area1.".".$borough->b_area2);?></td>
	</tr>
	<tr class="bg_gray_fortable">
		<td class="one">用途：</td>
		<td class="two"><?php echo Config::item("borough_type.".$borough->b_used);?></td>
		<td class="one">标准层面积：</td>
		<td class="two">10000 平米 </td>
	</tr>
	<tr>
		<td colspan="4" class="s">物业概况</td>
	</tr>
	<tr >
		<td class="one">物业公司：</td>
		<td class="two"><?php echo $borough->get('wuyegongsi');?></td>
		<td class="one">物业费：</td>
		<td class="two"><?php echo $borough->get('wuyefei');?>元/平方米</td>
	</tr>
	<tr class="bg_gray_fortable">
		<td class="one">物业支付方式：</td>
		<td class="two"><?php echo $borough->get('zhifufangsi');?></td>
		<td class="one"></td>
		<td class="two"></td>
	</tr>
	<tr>
		<td class="one">地上车位：</td>
		<td class="two"><?php echo $borough->get('chewei1');?>个</td>
		<td class="one">地下车位：</td>
		<td class="two"><?php echo $borough->get('chewei2');?>个</td>
	</tr>
	<tr class="bg_gray_fortable">
		<td class="one">停车费用：</td>
		<td class="two">1.8L以下:<?php echo $borough->get('tingchefei1');?>元/月<br />1.8L至2.0L:<?php echo $borough->get('tingchefei2');?>元/月<br />2.0L以上:<?php echo $borough->get('tingchefei3');?>元/月</td>
		<td class="one"></td>
		<td class="two"></td>
	</tr>
	<tr >
		<td colspan="4" class="s">建筑参数</td>
	</tr>
	<tr >
		<td class="one">总建筑面积：</td>
		<td class="two"><?php echo $borough->get('zongmianji');?>平方米</td>
		<td class="one">占地面积：</td>
		<td class="two"><?php echo $borough->get('zandimianji');?>平方米</td>
	</tr>
	<tr class="bg_gray_fortable">
		<td class="one">标准层面积：</td>
		<td class="two"><?php echo $borough->get('cengmianji');?>平方米</td>
		<td class="one">外墙：</td>
		<td class="two"><?php echo $borough->get('waiqiang');?></td>
	</tr>
	<tr >
		<td class="one">总 楼 层：</td>
		<td class="two"><?php echo $borough->get('zonglouceng');?>层</td>
		<td class="one">标准层高：</td>
		<td class="two"><?php echo $borough->get('cenggao');?>米</td>
	</tr>
	<tr class="bg_gray_fortable">
		<td class="one">净  高：</td>
		<td class="two"><?php echo $borough->get('jinggao');?>米</td>
		<td class="one">大堂层高：</td>
		<td class="two"><?php echo $borough->get('datangcenggao');?>米</td>
	</tr>
	<tr >
		<td class="one">容 积 率：</td>
		<td class="two"><?php echo $borough->get('rongjilv');?>%</td>
		<td class="one">绿 化 率：</td>
		<td class="two"><?php echo $borough->get('lvhualv');?>%</td>
	</tr>
	<tr class="bg_gray_fortable">
		<td class="one">总 户 数：</td>
		<td class="two"><?php echo $borough->get('zonghushu');?>户</td>
		<td class="one">开盘时间：</td>
		<td class="two"><?php echo $borough->dateConvert($borough->get('b_opentime'));?></td>
	</tr>
	<tr >
		<td class="one">楼盘售价区间：</td>
		<td class="two"><?php echo $borough->b_saletprice1;?>元-<?php echo $borough->b_saletprice2;?>元</td>
		<td class="one">楼盘租金区间：</td>
		<td class="two"><?php echo $borough->b_rentprice1;?>-<?php echo $borough->b_rentprice2;?></td>
	</tr>
	<tr class="bg_gray_fortable">
		<td class="one">交房时间：</td>
		<td class="two"><?php echo $borough->dateConvert($borough->get('b_begintime'));?></td>
		<td class="one">结构：</td>
		<td class="two"><?php echo $borough->get('jiegou');?></td>
	</tr>
	<tr >
	
        
        <td class="one">面积参数:</td>
    
    <td colspan="3" class="three"><?php echo $borough->get('mianjicanshu');?></td>
    
    
		
	</tr>
	<tr class="bg_gray_fortable">
		<td class="one">避难层或者设备层：</td>
		<td class="two"><?php echo $borough->get('shebeiceng');?></td>
		<td class="one">办公楼层：</td>
		<td class="two"><?php echo $borough->get('bangongceng');?></td>
	</tr>
	<tr>
		<td class="one">建筑高度：</td>
		<td class="two"><?php echo $borough->get('jianzhugaodu');?>米</td>
		<td class="one">写字楼架高地板高度：</td>
		<td class="two"><?php echo $borough->get('loujiagaodu');?>米</td>
	</tr>
	<tr class="bg_gray_fortable">
		<td class="one">楼板载重：</td>
		<td class="two"><?php echo $borough->get('zaizhong');?>公斤/平米</td>
	<td class="one">得房率：</td>
		<td class="two"><?php echo $borough->get('defanglv');?>%</td>
	</tr>
    <tr >
		<td colspan="4" class="s">设备参数</td>
	</tr>
	<tr>
		<td class="one">电梯：</td>
		<td class="two">客梯:<?php echo $borough->get('keti');?>部 货梯:<?php echo $borough->get('huoti');?>部 转乘梯:<?php echo $borough->get('zhuancengti');?>部</td>
		<td class="one">电梯品牌：</td>
		<td class="two"><?php echo $borough->get('diantipinpai');?>平方米</td>
	</tr>
    
    	<tr class="bg_gray_fortable">
		<td class="one">电梯有无分区：</td>
		<td class="two"><?php echo $borough->get('diantifenqu')==1 ? '有' : '无';?></td>
		<td class="one">空调品牌：</td>
		<td class="two"><?php echo $borough->get('kongtiaopinpai');?></td>
	</tr>
    
    	<tr>
		<td class="one">空调系统：</td>
		<td class="two"><?php echo $borough->get('kongtiaoxitong');?></td>
		<td class="one">空调开放时间：</td>
		<td class="two"><?php echo $borough->get('kaifangshijian');?></td>
	</tr>
    
    	<tr class="bg_gray_fortable">
		<td class="one">备注：</td>
		<td class="two"><?php echo $borough->get('beizhu');?></td>
		<td class="one">电费：</td>
		<td class="two"><?php echo $borough->get('dianfei');?>元/度</td>
	</tr>
    
    	<tr>
		<td class="one">供电系统：</td>
		<td class="two"><?php echo $borough->get('gongdianxitong');?></td>
		<td class="one">通讯系统：</td>
		<td class="two"><?php echo $borough->get('tongxunxitong');?></td>
	</tr>
    
    	<tr class="bg_gray_fortable">
		<td class="one">安防系统：</td>
		<td class="two"><?php echo $borough->get('anfangxitong');?></td>
		<td class="one"></td>
		<td class="two"></td>
	</tr>
    
    
       <tr>
		<td colspan="4" class="s">周围环境</td>
	</tr>
    
 
			
			

    
	<tr class="bg_gray_fortable">
		<td class="one">公交线路：</td>
		<td class="two"><?php echo $borough->get('gongjiao');?></td>
		<td class="one">地铁线路：</td>
		<td class="two"><?php foreach( explode(',',$borough->b_subway) as $v){echo Config::item('borough_metro.'.$v);}?></td>
	</tr>
    
    <tr>
		<td class="one">银行邮政：</td>
		<td class="two"><?php echo $borough->get('yinhang');?></td>
		<td class="one">划片小学：</td>
		<td class="two"><?php echo $borough->get('xiaoxue');?></td>
	</tr>
    
    <tr class="bg_gray_fortable">
		<td class="one">划片中学：</td>
		<td class="two"><?php echo $borough->get('zhongxue');?></td>
		<td class="one">医院药房：</td>
		<td class="two"><?php echo $borough->get('yiyuan');?></td>
	</tr>
    
    <tr>
		<td class="one">超市商场：</td>
		<td class="two"><?php echo $borough->get('chaoshi');?></td>
		<td class="one">餐馆酒店：</td>
		<td class="two"><?php echo $borough->get('jiudian');?></td>
	</tr>
    
    <tr class="bg_gray_fortable"><td class="one">公园景观：</td>
    
    <td colspan="3" class="three"></td>
    </tr>
</table>