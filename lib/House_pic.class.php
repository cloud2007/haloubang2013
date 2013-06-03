<?php
//测试类
class House_pic extends Data {
	function  __construct() {
	$options = array (
		'key' => 'id',
		'table' => 'hlb_house_pic',
		'columns' => array(
			'id' => 'id',
			'pic_thumb' => 'pic_thumb',
			'pic_sub_cate' => 'pic_sub_cate',
			'pic_is_default' => 'pic_is_default',
			'pic_creattime' => 'pic_creattime',
			'house_id' => 'house_id',
                        'is_use' => 'is_use',
			),
		'saveNeeds' => array('pic_thumb','house_id'),
		);
		parent::init($options);
	}

        public function showCate() {
            if($this -> pic_sub_cate == 0 ){
                return "选择分类";
            }else{
                return Config::item('borough_pictype.'.$this -> pic_sub_cate);
            }
        }
}
?>
