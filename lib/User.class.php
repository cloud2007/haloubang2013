<?php   if(!defined('INCPATH')) exit('Request Error!');
/**
 * 后台管理员管理
 */
class User
{
	private $Mysql;
    function __construct()
    {
        global $Mysql;
		$this->Mysql=$Mysql;
    }

    /**
     *  读取所有管理员
     */
    function getlist(){
		$sql="select * from hlb_user where userid<>'cloud' order by id";
		return $this->Mysql -> fetchRows($sql);
	}

	//读取要修改的管理员信息
	function getinfo(){
		return $this->Mysql -> getRowById('hlb_user','id',$_GET['id']);
	}

        //删除
	function del(){
                $sql="delete from hlb_user where id=".$_GET['id'];
		$this->Mysql -> query($sql);
	}

	//读取当前登录用户信息
	function getlogin(){
		return $this->Mysql -> getRowById('hlb_user','id',$_SESSION['admin_id']);
	}

	//修改用户密码
	function editpwd(){
		$id=$_POST['id'];
		$userid=$_POST['userid'];
		$pwd=$_POST['pwd'];
		$pwd1=$_POST['pwd1'];
		$pwd2=$_POST['pwd2'];
		if(!$userid){ShowMsg('用户名不能为空!','user.editpwd.php',0,1000);exit();}
		if(!$pwd){ShowMsg('旧密码不能为空!','user.editpwd.php',0,1000);exit();}
		if(!$pwd || !$pwd2){ShowMsg('登录密码不能为空!','user.editpwd.php',0,1000);exit();}
		if($pwd1!=$pwd2){ShowMsg('两次输入的密码不一致!','user.editpwd.php',0,1000);exit();}
		$sql="select * from hlb_user where `id`={$id} and `userid`='{$userid}' and pwd='".md5($pwd)."'";
		$rs = $this -> Mysql -> fetchArray($sql);
		if(!is_array($rs)){
			ShowMsg('旧密码不正确!','user.editpwd.php',0,1000);exit();
		}else{
			$sql="update hlb_user set `pwd`='".md5($pwd1)."' where id=".$rs['id'];
			$this->Mysql -> query($sql);
		}
	}

	//保存用户
	function save(){
		$id=$_POST['id'];
		$userid=$_POST['userid'];
		$pwd=$_POST['pwd'];
		$pwd2=$_POST['pwd2'];
		$beizhu=$_POST['beizhu'];
		$grant=implode(',',$_POST['grant']);
		$creatime=time();
		if(!$userid){ShowMsg('用户名不能为空!','user.manager.php',0,1000);exit();}
		if(!$pwd || !$pwd2){ShowMsg('密码不能为空!','user.manager.php',0,1000);exit();}
		if($pwd!=$pwd2){ShowMsg('两次输入的密码不一致!','user.manager.php',0,1000);exit();}

		if($id){
			$sql="update hlb_user set `userid`='$userid',`pwd`='".md5($pwd)."',`beizhu`='$beizhu',`grant`='$grant' where id=$id";
		}else{
			$sql="insert into hlb_user(id,userid,pwd,beizhu,`grant`,creattime,`used`) values('','$userid','".md5($pwd)."','$beizhu','$grant','$creatime',1)";
		}
		if($this->Mysql -> query($sql)){
			ShowMsg('保存成功!','user.manager.php',0,1000);exit();
		}else{
			ShowMsg('失败!','user.manager.php',0,1000);exit();
		}
	}

	//禁用账户
	function unused(){
		$id=$_GET['id'];
		$sql="update hlb_user set `used`=0 where id={$id}";
		if($this->Mysql -> query($sql)){
			ShowMsg('账户已禁用!','user.manager.php',0,1000);exit();
		}else{
			ShowMsg('操作失败!','user.manager.php',0,1000);exit();
		}
	}

	//启用账户
	function used(){
		$id=$_GET['id'];
		$sql="update hlb_user set `used`=1 where id={$id}";
		if($this->Mysql -> query($sql)){
			ShowMsg('账户已启用!','user.manager.php',0,1000);exit();
		}else{
			ShowMsg('操作失败!','user.manager.php',0,1000);exit();
		}
	}
}
?>