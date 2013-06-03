<?php
//测试类
class Trust extends Data {
	function  __construct() {
	$options = array (
		'key' => 'id',
		'table' => 'hlb_trust',
		'columns' => array(
			'id' => 'id',
			'type' => 'type',
			'uname' => 'uname',
                        'tel' => 'tel',
			'email' => 'email',
			'content' => 'content',
			'creattime' => 'creattime',
			'edittime' => 'edittime',
                        'states' => 'states',
                        'editid' => 'editid',
                        'editname' => 'editname',
                        'editcontent' => 'editcontent',
			),
		'saveNeeds' => array(),
		);
		parent::init($options);
	}

        public function dateConvert($timestamp) {
            return date('Y-m-d', $timestamp);
        }

        public function creatTime() {
            return $this->dateConvert($this->creattime);
        }

        public function editTime() {
            return $this->dateConvert($this->edittime);
        }

        public function type() {
            if ($this -> type == 1) return '委托发布房源';
            if ($this -> type == 2) return '委托帮忙选址';
            return '未知的信息';
        }

        public function states() {
            if ($this -> states == 1) return '<font color="red">未处理</font>';
            if ($this -> states == 2) return '<font color="green">已经处理</font>';
            return '未知的信息';
        }

        public function editcontent(){
            return str_replace('<br />','\n',str_replace('</p>','\n\n',str_replace('<p>', '', $this -> editcontent)));
        }

}
?>
