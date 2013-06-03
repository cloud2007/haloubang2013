<?php
//楼盘字典参数
require_once('config.admin.php');
CheckGrant('news');
//保存 编辑
if ($_GET['action'] == 'save') {
    $savecolumns = array(
        'title' => 'title',
        'type' => 'type',
        'hits' => 'hits',
        'source' => 'source',
        //'content' => 'content',
        'addid' => 'addid',
        'addname' => 'addname',
        'pic' => 'pic',
        'states' => 'states',
    );
    $news = new News();
    if ($_POST['id'])$news->id = $_POST['id'];
    if(!$_POST['id'])$news->creattime = time();
    if($_POST['att']){
        $news -> att = implode(',',$_POST['att']);
    }else{
        $news -> att = '';
    }
    $news->edittime = time();
    $news->content = stripslashes($_POST['content']);

    foreach ($savecolumns as $k) {
        $news->$k = $_POST[$k];
    }
    try {
        $news -> save();
        ShowMsg('保存完毕', 'news.php', 0, 1000);
        exit();
    } catch (Exception $exc) {
        echo 'there is some wrong was happen!';
    }


}

if ($_GET['action'] == 'del') {
    $news = new News();
    $news->delete($_GET['id']);
    ShowMsg('删除完毕', 'news.php', 0, 1000);
    exit();
}
//保存 编辑

if ($_GET['action'] == 'add') {
    $view = new View('news_edit');
    $datainfo = new News();
    if ($_GET['id'])$datainfo->load($_GET['id']);
    $view->set('datainfo', $datainfo);
} else {
    $view = new View('news');
    $news = new News();
    $pager = new Pager();
    $pagesize = 20;
    //检测是否传入当前页数----------------------
    if (isset($_GET['PageNo']) && is_numeric($_GET['PageNo'])) {
        $currentpage = $_GET['PageNo'];
    } else {
        $currentpage = 1;
    }
    $PageNum = ($currentpage - 1) * $pagesize;

    $options = array();
    $whereAnd = array();
    if ($_POST['q'] !== '请输入关键字' && $_POST['q'])
        $whereAnd[] = array('title', "like '%" . $_POST['q'] . "%' or content like '%" . $_POST['q'] . "%'");
    $options['limit'] = "{$PageNum},{$pagesize}";
    $options['whereAnd'] = $whereAnd;
    $datalist = $news->find($options);
    $view->set('datalist', $datalist);

    $pagerData = $pager->getPagerData($news->count($options), $currentpage, '?', 4, $pagesize); //参数记录数 当前页数 链接地址 显示样式 每页数量
    $view->set('pagerData', $pagerData);
}

$view->set('user', $user);

$view->renderHtml($view->render());
?>