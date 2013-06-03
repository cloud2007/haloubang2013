<?php
require_once('../config.php');
$Borker = new Borker();
if (!$Borker->checkborkertype(1)) {
    ShowMsg('你还未登陆！', '/user/login.php', 0, 1000);
    exit();
}
$view = new View('member/rent');
$Borker->load($_SESSION['borker_id']);
$type = $_GET['type'] ? $_GET['type'] : 1;
$House = new House();

if ($_POST['action'] == 'save') {
    if (!$_POST['b_id']) {
        ShowMsg('填写不完整！', '-1', 0, 1000);
        exit();
    }
    $savecolumns = array(
        'type' => 'type',
        'b_id' => 'b_id',
        'borker_id' => 'borker_id',
        'b_name' => 'b_name',
        'b_area1' => 'b_area1',
        'b_area2' => 'b_area2',
        'b_used' => 'b_used',
        'b_level' => 'b_level',
        'b_addr' => 'b_addr',
        'b_floor' => 'b_floor',
        'b_subway' => 'b_subway',
        'b_opentime' => 'b_opentime',
        'roomnum' => 'roomnum',
        'h_floor' => 'h_floor',
        'area' => 'area',
        'price' => 'price',
        'fitment' => 'fitment',
        'paystyle' => 'paystyle',
        'mzq' => 'mzq',
        's_pact' => 's_pact',
        'l_pact' => 'l_pact',
        'present' => 'present',
        'is_present' => 'is_present',
        'is_quality' => 'is_quality',
        'pic_hxt' => 'pic_hxt',
        'pic_pmt' => 'pic_pmt',
        'states' => 'states',
        //'content' => 'content',
    );
    if($_POST['id'])$House -> id = $_POST['id'];
    if($_POST['id'])$House ->edittime = time();
    if(!$_POST['id'])$House ->creattime = time();
    $House ->content = stripslashes($_POST['content']);
    foreach($savecolumns as $k){
        $House -> $k = $_POST[$k];
    }
	$House -> set('qt1',$_POST['qt1']);
	$House -> set('qt2',$_POST['qt2']);
	$House -> set('qt3',$_POST['qt3']);
    $House -> save();
    try{
		$house_id = $House ->id;
                $house_pic = new House_pic();
                $house_pic ->signs('house_id='.$house_id);
                if($_POST['pic_thumb']){
                foreach($_POST['pic_thumb'] as $key=>$value){
                    $house_pic -> id = $_POST['pic_id'][$key];
                    $house_pic -> pic_thumb = $_POST['pic_thumb'][$key];
                    $house_pic -> pic_sub_cate = $_POST['pic_sub_cate'][$key];
                    $house_pic -> pic_is_default = $_POST['pic_is_default'][$key];
                    $house_pic -> pic_creattime = mktime();
                    $house_pic -> house_id = $house_id;
                    $house_pic -> is_use = 1;
                    $house_pic -> save();
                }
                $house_pic ->deletes('is_use = 0 and house_id='.$house_id);
                }
		ShowMsg('楼盘保存完毕','manager.php?type='.$_POST['type'],0,1000);exit();
	}catch(Exception $e){
		echo $e->getMessage();
		exit();
	}
}

//下架
if($_GET['action']=='down'){
    try {
        $House->load($_GET['id']);
    } catch (Exception $e) {
        echo "Error";
        exit;
    }
    $House -> states = 2;
    $House ->save();
    ShowMsg('房源已下架','manager.php?type='.$House->type,0,1000);exit();
}

//下架
if($_GET['action']=='up'){
    try {
        $House->load($_GET['id']);
    } catch (Exception $e) {
        echo "Error";
        exit;
    }
    $House -> states = 1;
    $House ->save();
    ShowMsg('房源已上架','manager.php?type='.$House->type,0,1000);exit();
}
//删除
if($_GET['action']=='del'){
    try {
        $House->delete($_GET['id']);
    } catch (Exception $e) {
        echo "Error";
        exit;
    }
    $house_pic = new House_pic();
    $house_pic ->deletes('house_id='.$_GET['id']);//删除房源关联的图片
    ShowMsg('房源已删除','manager.php?type='.$_GET['type'],0,1000);exit();
}

//读取楼盘
if($_GET['action']=='edit'){
    try {
        $House->load($_GET['id']);
    } catch (Exception $e) {
        echo "Error";
        exit;
    }

    $view->set('datainfo', $House);

    $house_pic = new House_pic();
    $house_pic->house_id = $House->id;
    $house_pic->is_use = 1;
    $piclist = $house_pic->find();

    $piclist1 = $house_pic->groupBy(array('pic_sub_cate'), array('count' => 'id'));
    $jsons = array();
    foreach ($piclist1 as $k) {
        $jsons[$k['pic_sub_cate']] = $k['count'];
    }

    $view->set('jsons', $jsons);
    $view->set('piclist', $piclist);
}

$view->set('Borker', $Borker);
$view->set('type', $type);

$view->renderHtml_member($view->render());
?>