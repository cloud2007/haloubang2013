<?php
//楼盘字典参数
require_once('config.admin.php');
CheckGrant('house');
//保存 编辑
if($_GET['action']=='del'){
        $house = new House();
        $house ->delete($_GET['id']);
        ShowMsg('房源删除完毕','house.php',0,1000);exit();
}else{
        $view = new View('house');
        $house = new House();
        $pager = new Pager();
        $pagesize = 20;
        //检测是否传入当前页数----------------------
        if(isset($_GET['PageNo'])&&is_numeric($_GET['PageNo'])){
            $currentpage=$_GET['PageNo'];
        }else{
            $currentpage=1;
        }
            $PageNum=($currentpage-1)*$pagesize;

	$options=array();
        $whereAnd=array();
        $options['limit']="{$PageNum},{$pagesize}";
        //$options['whereAnd']=$whereAnd;
        $datalist = $house -> find($options);
        $view -> set('datalist',$datalist);

        $pagerData=$pager->getPagerData($house->count($options),$currentpage,'?',4,$pagesize);//参数记录数 当前页数 链接地址 显示样式 每页数量
        $view -> set('pagerData',$pagerData);
}

$view -> set('user',$user);

$view->renderHtml($view->render());
?>