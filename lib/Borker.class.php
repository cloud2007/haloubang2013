<?php
//测试类
class Borker extends Data {
	function  __construct() {
	$options = array (
		'key' => 'id',
		'table' => 'hlb_borker',
		'columns' => array(
			'id' => 'id',
			'tel' => 'tel',
			'pwd' => 'pwd',
                        'avatar' => 'avatar',
                        'cate' => 'cate',
                        'catenum' => 'catenum',
			'vcode' => 'vcode',
			'uname' => 'uname',
			'type' => 'type',
			'states' => 'states',
			'creattime' => 'creattime',
			'logintime' => 'logintime',
            'attributeData' => 'content',
		),
		'saveNeeds' => array(),
		);
		parent::init($options);
	}

        //登陆
        function login($tel,$pwd){
            $options=array();
            $whereAnd=array();
            $whereAnd[]=array('tel',"='".$tel."'");
            $whereAnd[]=array("pwd","='".$pwd."'");
            $options['limit']="0,1";
            $options['whereAnd']=$whereAnd;
            $rs = $this -> find($options);
            return $rs[0];
        }
        //保存登录信息session
        function keepborker($rs){

            @session_register('borker_id');
            $_SESSION['borker_id'] = $rs -> id;

            @session_register('borker_tel');
            $_SESSION['borker_tel'] = $rs -> tel;

            @session_register('borker_type');
            $_SESSION['borker_type'] = $rs -> type;

            @session_register('borker_name');
            $_SESSION['borker_name'] = $rs -> uname;

        }
        //退出登录
        function exitborker(){
            @session_unregister('borker_id');
            @session_unregister('borker_tel');
            @session_unregister('borker_type');
            @session_unregister('borker_name');
            $_SESSION = array();
            if($_COOKIE['LOGIN_REMEMBER']==1){
                    setcookie('LOGIN_REMEMBER', 0, time()-1,'/');
                    setcookie('LOGIN_ID', 0, time()-1,'/');
                    setcookie('LOGIN_TEL', 0, time()-1,'/');
                    setcookie('LOGIN_TYPE', 0, time()-1,'/');
                    setcookie('LOGIN_NAME', 0, time()-1,'/');
            }
        }

        //判断是否登录
        public function checkborker() {
            if($_SESSION['borker_id']){
                return 1;
            }else{
                return 0;
            }
        }
        //是否是某一类型用户
        function checkborkertype($type){
            if(!$_SESSION['borker_id']){
                return 0;
            }else{
                if($_SESSION['borker_type'] != $type) return 0;
            }
            return 1;
        }

        //是否是某一类型用户
        function showtype(){
            if($this -> type == 1 )return '<font color="green">经纪人</font>';
            if($this -> type == 2 )return '<font color="blue">个人用户</font>';
            return '<font color="red">未知</font>';
        }

        //是否是某一类型用户
        function showstates(){
            if($this -> states == 1 )return '<font color="green">正常</font>';
            if($this -> states == 0 )return '<font color="blue">未审核</font>';
            return '<font color="red">未知</font>';
        }

        public function dateConvert($timestamp) {
            return date('Y-m-d H:i', $timestamp);
        }

        public function creatTime() {
            return $this->dateConvert($this->creattime);
        }

        public function loginTime() {
            return $this->dateConvert($this->logintime);
        }

        public function checkSex($key) {
            if($this->get('sex')==$key){return 1;}
            return 0;
        }

        public function avatar() {
            if(is_file(ROOTPATH . $this->avatar)){return $this->avatar;}
            return '/uploadfiles/default_avatar.jpg';
        }

        public function cate() {
            if(is_file(ROOTPATH . $this->cate)){return $this->cate;}
            return '/uploadfiles/default_cate.jpg';
        }

        public function counthouse($type){
            $rent = new House();
            return $rent -> count(
                    array(
                        'whereAnd'=>array(array('type','='.$type),array('borker_id','='.$this->id)),
                    )
            );
        }

        public function countrent(){
            return $this ->counthouse(1);
        }

        public function countsale(){
            return $this ->counthouse(2);
        }

}
?>
