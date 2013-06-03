<?php   if(!defined('INCPATH')) exit('Request Error!');
/**
 * 楼盘参数修改类
 */
class Sethouse
{
	private $Mysql;
    function __construct()
    {
        global $Mysql;
		$this->Mysql=$Mysql;
    }

    /**
     *  保存参数
     */
    function save()
    {
		$set_id = $_POST['set_id'];
		$pid = $_POST['pid'];
		$sid = $_POST['sid'];
		$set_name = $_POST['set_name'];
		$set_caption = $_POST['set_caption'];
		//顶级参数添加
		if(!$set_id){
		if ($this->checkUnique()>0) {
			ShowMsg('值或名称已经存在!','borough.setconfig.php',0,1000);
			exit();
		}
		$sql="insert into hlb_set(`id`,`set_name`,`set_caption`) values ('','$set_name','$set_caption')";
		$this->Mysql -> query($sql);
		ShowMsg('保存成功','borough.setconfig.php',0,1000);
		exit();
		}

		//无父级id的参数添加
		if($set_id && !$pid && !$sid){
			if ($this->checkUnique1()>0) {
				ShowMsg('值或名称已经存在!','borough.setconfig.php?action=edit&set_id='.$set_id,0,1000);
				exit();
			}
			$sql="insert into hlb_set_item(`id`,`set_id`,`set_caption`) values ('','$set_id','$set_caption')";
			$this->Mysql -> query($sql);
			ShowMsg('保存成功','borough.setconfig.php?action=edit&set_id='.$set_id,0,1000);
			exit();
		}

		//有父级ID参数添加
		if($set_id && $pid && !$sid){
			if ($this->checkUnique2()>0) {
				ShowMsg('值或名称已经存在!','borough.setconfig.php?action=edit&set_id='.$set_id,0,1000);
				exit();
			}
			$sql="insert into hlb_set_item(`id`,`set_id`,`parent_id`,`set_caption`) values ('','$set_id','$pid','$set_caption')";
			$this->Mysql -> query($sql);
			ShowMsg('保存成功','borough.setconfig.php?action=edit&set_id='.$set_id,0,1000);
			exit();
		}

		if($pid && $sid){
			if ($this->checkUnique2()>0) {
				ShowMsg('值或名称已经存在!','borough.setconfig.php?action=edit&set_id='.$set_id,0,1000);
				exit();
			}
			$sql="update hlb_set_item set `set_id`=".$set_id.",`parent_id`=".$pid.",`set_caption`='".$set_caption."' where id=".$sid;
			$this->Mysql -> query($sql);
			ShowMsg('保存成功','borough.setconfig.php?action=edit&set_id='.$set_id,0,1000);
			exit();
		}

                if(!$pid && $sid){
			if ($this->checkUnique1()>0) {
				ShowMsg('值或名称已经存在!','borough.setconfig.php?action=edit&set_id='.$set_id,0,1000);
				exit();
			}
			$sql="update hlb_set_item set `set_id`=".$set_id.",`set_caption`='".$set_caption."' where id=".$sid;
			$this->Mysql -> query($sql);
			ShowMsg('保存成功','borough.setconfig.php?action=edit&set_id='.$set_id,0,1000);
			exit();
		}



	}

	/**
	 * 删除项目
	 */
	function del(){
		$sql="delete from hlb_set_item where set_id=".$_GET['set_id']." and id=".$_GET['id'];
		$sql1="delete from hlb_set_item where set_id=".$_GET['set_id']." and parent_id=".$_GET['id'];
		$this->Mysql -> query($sql);
		$this->Mysql -> query($sql1);
		ShowMsg('删除成功','borough.setconfig.php?action=edit&set_id='.$_GET['set_id'],0,1000);
		exit();
	}
	/**
	 * 排序
	 */
	function order(){
		if (!$_GET['set_id']){
			foreach($_POST['list_order'] as $key => $value){
				$sql="update hlb_set set `order_id`=".$value." where id=".$key;
				$this->Mysql -> query($sql);
			}
			ShowMsg('排序成功','borough.setconfig.php',0,1000);
			exit();
		}else{
			foreach($_POST['list_order'] as $key => $value){
				$sql="update hlb_set_item set `order_id`=".$value." where id=".$key;
				$this->Mysql -> query($sql);
			}
			ShowMsg('排序成功','borough.setconfig.php?action=edit&set_id='.$_GET['set_id'],0,1000);
			exit();
		}
	}

	/**
	 * 检查唯一性
	 */
	public function checkUnique() {
		$sql = " select id from hlb_set where set_name = '".$_POST['set_name']."' or set_caption='".$_POST['set_caption']."'";
		return $this->Mysql -> queryNum($sql);
	}

	public function checkUnique1() {
		$sql = " select id from hlb_set_item where set_id=".$_POST['set_id']." and set_caption='".$_POST['set_caption']."'";
		return $this->Mysql -> queryNum($sql);
	}

	public function checkUnique2() {
		$sql = " select id from hlb_set_item where set_id=".$_POST['set_id']." and parent_id=".$_POST['pid']." and set_caption='".$_POST['set_caption']."'";
		return $this->Mysql -> queryNum($sql);
	}

}
?>