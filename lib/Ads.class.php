<?php
//测试类
class Ads extends Data {
	function  __construct() {
	$options = array (
		'key' => 'id',
		'table' => 'hlb_ads',
		'columns' => array(
			'id' => 'id',
			'title' => 'title',
			'place_id' => 'place_id',
                        'type' => 'type',
                        'link' => 'link',
                        'pic' => 'pic',
			'content' => 'content',
			'code' => 'code',
			'order' => 'order',
			'states' => 'states',
			'creattime' => 'creattime',
                        'beizhu' => 'beizhu',
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

}
?>
