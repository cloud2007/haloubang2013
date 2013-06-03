<?php
//测试类
class News extends Data {
	function  __construct() {
	$options = array (
		'key' => 'id',
		'table' => 'hlb_news',
		'columns' => array(
			'id' => 'id',
			'title' => 'title',
			'type' => 'type',
			'hits' => 'hits',
			'source' => 'source',
                        'att' => 'att',
			'content' => 'content',
			'addid' => 'addid',
			'addname' => 'addname',
			'pic' => 'pic',
			'states' => 'states',
			'creattime' => 'creattime',
			'edittime' => 'edittime',
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

        public function states() {
            if($this ->states == 1) return '<font color="green">正常</font>';
            return '<font color="red">未发布</font>';
        }

        public function att($key) {
            return strpos($this->att,(string)$key);
        }

        public function showatt() {
            $res = $this -> att;
            $res = str_replace('h', '头条', $res);
            $res = str_replace('j', '推荐', $res);
            return $res;
        }

        public function pic() {
            if ( is_file ( ROOTPATH . $this -> pic ) ) return $this -> pic;
            return '/uploadfiles/default_news.jpg';
        }

        public function getnews($type,$limit){
            return self::find(
                array(
                    'whereAnd'=>array(array('type','='.$type),array('states','=1')),
                    'limit'=>'0,'.$limit,
                    'order'=>array('edittime'=>'desc'),
                )
            );
        }

        public function getnewss($limit){
            return self::find(
                array(
                    'whereAnd'=>array(array('states','=1')),
                    'limit'=>'0,'.$limit,
                    'order'=>array('edittime'=>'desc'),
                )
            );
        }

        public function getattnews($type,$limit,$att){
            return self::find(
                array(
                    'whereAnd'=>array(array('type','='.$type),array('states','=1'),array('att'," like '%".$att."%'")),
                    'limit'=>'0,'.$limit,
                    'order'=>array('edittime'=>'desc'),
                )
            );
        }

}
?>
