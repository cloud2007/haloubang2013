<?php
//楼盘字典参数
require_once('config.admin.php');
CheckGrant('borough');
//保存 编辑
if($_GET['action']=='save'){
        $check = new Borough();

        if(!$_POST['id']){
            $res = $check -> find(
                array(
                    'whereAnd'=>array(array('b_name',"='".$_POST['b_name']."'")),
                )
            );
            if($res){
                ShowMsg('楼盘字典已经存在，请勿重复添加！','borough.php?action=add',0,1000);exit();
            }
        }

        if($check ->complete()<60){
            ShowMsg('楼盘参数填写太少！无法保存','-1',0,1000);exit();
        }
        //die;

	$savecolumns = array(
		'b_addid' => 'b_addid',
		'b_addname' => 'b_addname',
		'b_name' => 'b_name',
		'b_level' => 'b_level',
		'b_addr' => 'b_addr',
		'b_map' => 'b_map',
		'b_area1' => 'b_area1',
		'b_area2' => 'b_area2',
		'b_used' => 'b_used',
		'b_avatar' => 'b_avatar',
		'b_company' => 'b_company',
		//'b_content' => 'b_content',
		'b_rentprice1' => 'b_rentprice1',
		'b_rentprice2' => 'b_rentprice2',
		'b_saletprice1' => 'b_saletprice1',
		'b_saletprice2' => 'b_saletprice2',
		'b_salenum' => 'b_salenum',
		'b_salenum' => 'b_salenum',
		//'b_opentime' => 'b_opentime',
		//'b_begintime' => 'b_begintime',
		'b_states' => 'b_states',
	);
	$Borough = new Borough();
        if($_POST['id'])$Borough -> id = $_POST['id'];
	$Borough -> b_letter = Util::instance() -> getletter($_POST['b_name']);//首字母
	$Borough -> b_support = $_POST['b_support'] ? implode(',',$_POST['b_support']) : '';//周边配套
        $Borough -> b_subway = $_POST['b_subway'] ? implode(',',$_POST['b_subway']) : '';//地铁线路
        $Borough -> b_sight = $_POST['b_sight'] ? implode(',',$_POST['b_sight']) : '';//公园景观
        $Borough -> b_creattime = $_POST['id'] ? $_POST['b_creattime'] : time();
	$Borough -> b_opentime = $_POST['b_opentime'] ? strtotime($_POST['b_opentime']) : NULL;//开盘时间
        $Borough -> b_begintime = $_POST['b_begintime'] ? strtotime($_POST['b_begintime']) : NULL;//开盘时间
        $Borough->b_content = stripslashes($_POST['b_content']);
	$Borough -> b_edittime = time();
        $Borough -> b_complete = $check ->complete();
	foreach($savecolumns as $k){
		$Borough -> $k = $_POST[$k];
	}
	foreach($_POST['wy'] as $key => $value){
		$Borough -> set ("{$key}","{$value}");
	}
	foreach($_POST['jz'] as $key => $value){
		$Borough -> set ("{$key}","{$value}");
	}
	foreach($_POST['sb'] as $key => $value){
		$Borough -> set ("{$key}","{$value}");
	}
	foreach($_POST['qt'] as $key => $value){
		$Borough -> set ("{$key}","{$value}");
	}
        foreach($_POST['zb'] as $key => $value){
		$Borough -> set ("{$key}","{$value}");
	}
	try{
		$borough_id = $Borough -> save() ->id;
                $borough_pic = new Borough_pic();
                $borough_pic ->signs('borough_id='.$borough_id);
                if($_POST['pic_thumb']){
                foreach($_POST['pic_thumb'] as $key=>$value){
                    $borough_pic = new Borough_pic();
                    $borough_pic -> id = $_POST['pic_id'][$key];
                    $borough_pic -> pic_thumb = $_POST['pic_thumb'][$key];
                    $borough_pic -> pic_sub_cate = $_POST['pic_sub_cate'][$key];
                    $borough_pic -> pic_is_default = $_POST['pic_is_default'][$key];
                    $borough_pic -> pic_creattime = mktime();
                    $borough_pic -> borough_id = $borough_id;
                    $borough_pic -> is_use = 1;
                    $borough_pic -> save();
                }
                $borough_pic ->deletes('is_use = 0 and borough_id='.$borough_id);
                }
		ShowMsg('楼盘保存完毕','borough.php',0,1000);exit();
	}catch(Exception $e){
		echo $e->getMessage();
		exit();
	}
}

if($_GET['action']=='del'){
	$Borough = new Borough();
	$Borough_pic = new Borough_pic();
	$Borough ->delete($_GET['id']);
        $Borough_pic ->deletes('borough_id='.$_GET['id']);
        ShowMsg('楼盘删除完毕','borough.php',0,1000);exit();
}
//保存 编辑

if($_GET['action']=='add'){
	$view = new View('borough_edit');
	$datainfo = new Borough();
	if($_GET['id'])$datainfo -> load($_GET['id']);
	$view -> set('datainfo',$datainfo);

        $datainfo = new Borough();
        $borough_pic = new Borough_pic();
        if($_GET['id']){
            $datainfo -> load($_GET['id']);
            $borough_pic -> borough_id = $_GET['id'];
            $borough_pic -> is_use = 1;
            $piclist = $borough_pic -> find();

            $piclist1= $borough_pic ->groupBy(array('pic_sub_cate'), array('count'=>'id'));
            $jsons = array();
            foreach($piclist1 as $k){
                $jsons[$k['pic_sub_cate']]=$k['count'];
            }

        }
        $view -> set('jsons',$jsons);
        $view -> set('datainfo',$datainfo);
        $view -> set('piclist',$piclist);

}else{
	$view = new View('borough');
	$Borough = new Borough();
	$pager = new Pager();
	$pagesize = 20;
        //检测是否传入当前页数----------------------
	if(isset($_GET['PageNo'])&&is_numeric($_GET['PageNo'])){
 		$currentpage=$_GET['PageNo'];
	}
	else{
 		$currentpage=1;
	}
	$PageNum=($currentpage-1)*$pagesize;

        $options=array();
        $whereAnd=array();
        if($_POST['btime']) $whereAnd[]=array('b_creattime','>'.strtotime($_POST['btime']));
        if($_POST['etime']) $whereAnd[]=array('b_creattime','<'.strtotime($_POST['etime']));
        if($_POST['bname']) $whereAnd[]=array('b_addname',"='".$_POST['bname']."'");
        if($_POST['cityarea']) $whereAnd[]=array('b_area1','='.$_POST['cityarea']);
        if($_POST['q']!=='请输入楼盘名称,楼盘地址'&&$_POST['q']!=="") $whereAnd[]=array('b_name',"like '%".$_POST['q']."%' or b_addr like '%".$_POST['q']."%'");
        $options['limit']="{$PageNum},{$pagesize}";
        $options['whereAnd']=$whereAnd;
	$datalist = $Borough -> find($options);
	$view -> set('datalist',$datalist);

	$pagerData=$pager->getPagerData($Borough->count($options),$currentpage,'?',4,$pagesize);//参数记录数 当前页数 链接地址 显示样式 每页数量
	$view -> set('pagerData',$pagerData);
}

$view -> set('user',$user);

$view->renderHtml($view->render());
?>