<?php   if(!defined('INCPATH')) exit('Request Error!');
/**
 * 后台管理员管理
 */
class Link
{
    private $Mysql;
    function __construct()
    {
        global $Mysql;
	$this->Mysql=$Mysql;
    }

    /**
     *  读取所有
     */
    function getlist(){
		$sql="select * from hlb_link order by id";
		return $this->Mysql -> fetchRows($sql);
	}

	//读取要修改的
	function getinfo(){
		return $this->Mysql -> getRowById('hlb_link','id',$_GET['id']);
	}

        //删除
	function del(){
                $sql="delete from hlb_link where id=".$_GET['id'];
		$this->Mysql -> query($sql);
	}


	//保存
	function save(){
		$id=$_POST['id'];
                $title=$_POST['title'];
		$type=$_POST['type'];
		$logo=$_POST['logo'];
		$link=$_POST['link'];
		$beizhu=$_POST['beizhu'];
		$creatime=time();
		if(!$title){ShowMsg('链接名称不能为空!','link.manager.php',0,1000);exit();}
		if(!$link){ShowMsg('链接地址不能为空!','link.manager.php',0,1000);exit();}

		if($id){
			$sql="update hlb_link set `title`='$title',`type`='$type',`logo`='$logo',`link`='$link',`beizhu`='$beizhu' where id=$id";
		}else{
			$sql="insert into hlb_link(id,title,`type`,logo,link,beizhu,creattime,`used`) values('','$title','$type','$logo','$link','$beizhu','$creatime',1)";
		}
		if($this->Mysql -> query($sql)){
			ShowMsg('保存成功!','link.manager.php',0,1000);exit();
		}else{
			ShowMsg('失败!','link.manager.php',0,1000);exit();
		}
	}

	//禁用账户
	function unused(){
		$id=$_GET['id'];
		$sql="update hlb_link set `used`=0 where id={$id}";
		if($this->Mysql -> query($sql)){
			ShowMsg('已禁用!','link.manager.php',0,1000);exit();
		}else{
			ShowMsg('操作失败!','link.manager.php',0,1000);exit();
		}
	}

	//启用账户
	function used(){
		$id=$_GET['id'];
		$sql="update hlb_link set `used`=1 where id={$id}";
		if($this->Mysql -> query($sql)){
			ShowMsg('已启用!','link.manager.php',0,1000);exit();
		}else{
			ShowMsg('操作失败!','link.manager.php',0,1000);exit();
		}
	}
}
?>