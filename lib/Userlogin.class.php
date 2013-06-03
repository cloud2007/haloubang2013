<?php   if(!defined('INCPATH')) exit('Request Error!');
/**
 * 管理员登陆类
 *
 */
session_start();

/**
 *  检验用户是否有权使用某功能
 * @access    public
 * @param     string  $n  功能名称
 * @return    mix  如果具有则返回TRUE
 */
function TestGrant($n)
{
    $rs = FALSE;
    $grant = $GLOBALS['cuserLogin']->getUserGrant();
    if(preg_match('/all/i',$grant))
    {
        return TRUE;
    }
    if($n=='')
    {
        return TRUE;
    }
	if(!isset($GLOBALS['groupRanks']))
    {
        $GLOBALS['groupRanks'] = explode(',',$grant);
    }
    $ns = explode(',',$n);
    foreach($ns as $n)
    {
        //只要找到一个匹配的权限，即可认为用户有权访问此页面
        if($n=='')
        {
            continue;
        }
        if(in_array($n,$GLOBALS['groupRanks']))
        {
            $rs = TRUE;
			break;
        }
    }
    return $rs;
}

/**
 *  对权限检测后返回操作对话框
 *
 * @access    public
 * @param     string  $n  功能名称
 * @return    string
 */
function CheckGrant($n)
{
    if(!TestGrant($n))
    {
        ShowMsg("对不起，你没有权限执行此操作！<br/><br/><a href='javascript:history.go(-1);'>点击此返回上一页&gt;&gt;</a>",'javascript:;');
        exit();
    }
}

/**
 *  是否没权限限制(超级管理员)
 *
 * @access    public
 * @param     string
 * @return    bool
 */
function TestAdmin()
{
    $grant = $GLOBALS['cuserLogin']->getUserGrant();
    if(preg_match('/admin/i',$grant))
    {
        return TRUE;
    }
    else
    {
        return FALSE;
    }
}


//登录类
class userLogin
{
    var $userName = '';
    var $userPwd = '';
    var $userID = '';
    var $adminDir = '';
    var $userGrant = '';
    var $keepUserIDTag = 'admin_id';
    var $keepUserNameTag = 'admin_name';
    var $keepUserGrantTag = 'admin_grant';
	var $keepUserLogintimeTag = 'admin_logintime';

    //php5构造函数
    function __construct($admindir='')
    {
        global $admin_path;
        if(isset($_SESSION[$this->keepUserIDTag]))
        {
            $this->userID = $_SESSION[$this->keepUserIDTag];
            $this->userName = $_SESSION[$this->keepUserNameTag];
            $this->userGrant = $_SESSION[$this->keepUserGrantTag];
			$this->userLogintime = $_SESSION[$this->keepUserLogintimeTag];
        }

        if($admindir!='')
        {
            $this->adminDir = $admindir;
        }
        else
        {
            $this->adminDir = $admin_path;
        }
    }

    function userLogin($admindir='')
    {
        $this->__construct($admindir);
    }

    /**
     *  检验用户是否正确
     *
     * @access    public
     * @param     string    $username  用户名
     * @param     string    $userpwd  密码
     * @return    string
     */
    function checkUser($username, $userpwd)
    {
        global $Mysql;
        //只允许用户名和密码用0-9,a-z,A-Z,'@','_','.','-'这些字符
        //$this->userName = preg_replace("/[^0-9a-zA-Z_@!\.-]/", '', $username);
        //$this->userPwd = preg_replace("/[^0-9a-zA-Z_@!\.-]/", '', $userpwd);
        $this->userName = $username;
        $this->userPwd = $userpwd;
		$pwd = md5($this->userPwd);
        $sql = "SELECT * FROM `hlb_user` WHERE userid = '".$this->userName."' and used=1 LIMIT 0,1";
        $row = $Mysql->fetchArray($sql);
        if(!isset($row['pwd']))
        {
            return -1;
        }
        else if($pwd!=$row['pwd'])
        {
            return -2;
        }
        else
        {
            $this->userID = $row['id'];
            $this->userName = $row['userid'];
            $this->userGrant = $row['grant'];
            $this->userLogintime = $row['logintime'];
            $sql = "UPDATE `hlb_user` SET `logintime`='".time()."' WHERE id='".$row['id']."'";
            $Mysql->query($sql);
            return 1;
        }
    }

    /**
     *  保持用户登录session
     *
     * @access    public
     * @return    int    成功返回 1 ，失败返回 -1
     */
    function keepUser()
    {
        if($this->userID != '')
        {
            @session_register($this->keepUserIDTag);
            $_SESSION[$this->keepUserIDTag] = $this->userID;

            @session_register($this->keepUserNameTag);
            $_SESSION[$this->keepUserNameTag] = $this->userName;

            @session_register($this->keepUserGrantTag);
            $_SESSION[$this->keepUserGrantTag] = $this->userGrant;

			@session_register($this->keepUserLogintimeTag);
            $_SESSION[$this->keepUserLogintimeTag] = $this->userLogintime;

            return 1;
        }
        else
        {
            return -1;
        }
    }

    //
    /**
     *  结束用户的会话状态
     *
     * @access    public
     * @return    void
     */
    function exitUser()
    {
        @session_unregister($this->keepUserIDTag);
        @session_unregister($this->keepUserNameTag);
        @session_unregister($this->keepUserGrantTag);
        $_SESSION = array();
    }

    /**
     *  获得用户的权限值
     *
     * @access    public
     * @return    int
     */
    function getUserGrant()
    {
        if($this->userGrant != '')
        {
            return $this->userGrant;
        }
        else
        {
            return -1;
        }
    }

    /**
     *  获得用户的ID
     *
     * @access    public
     * @return    int
     */
    function getUserID()
    {
        if($this->userID != '')
        {
            return $this->userID;
        }
        else
        {
            return -1;
        }
    }

    /**
     *  获得用户的笔名
     *
     * @access    public
     * @return    string
     */
    function getUserName()
    {
        if($this->userName != '')
        {
            return $this->userName;
        }
        else
        {
            return -1;
        }
    }

	/**
     *  获得用户上次登录时间
     *
     * @access    public
     * @return    string
     */
    function getLogintime()
    {
        if($this->userLogintime != '')
        {
            return $this->userLogintime;
        }
        else
        {
            return -1;
        }
    }

}

?>