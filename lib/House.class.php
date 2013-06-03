<?php
//测试类
class House extends Data {
	function  __construct() {
	$options = array (
		'key' => 'id',
		'table' => 'hlb_house',
		'columns' => array(
			'id' => 'id',
			'type' => 'type',
			'b_id' => 'b_id',
			'borker_id' => 'borker_id',
			'b_name' => 'b_name',
			'b_area1' => 'b_area1',
			'b_area2' => 'b_area2',
			'b_used' => 'b_used',
			'b_level' => 'b_level',
			'b_addr' => 'b_addr',
			'b_floor' => 'b_floor',
                        'b_opentime' => 'b_opentime',
                        'b_subway' => 'b_subway',
                        'roomnum' => 'roomnum',
                        'h_floor' => 'h_floor',
			'area' => 'area',
			'price' => 'price',
			'fitment' => 'fitment',
			'paystyle' => 'paystyle',
			'mzq' => 'mzq',
                        's_pact' => 's_pact',
			'l_pact' => 'l_pact',
			'present' => 'present',
			'is_present' => 'is_present',
			'is_quality' => 'is_quality',
			'pic_hxt' => 'pic_hxt',
                        'pic_pmt' => 'pic_pmt',
                        'states' => 'states',
                        'content' => 'content',
						'hits' => 'hits',
			'creattime' => 'creattime',
			'edittime' => 'edittime',
			'attributeData' => 'h_data',
			),
		'saveNeeds' => array('b_id','borker_id'),
		);
		parent::init($options);
	}

        public function fitment($key) {
            if($this -> fitment == $key) return 1;
            return 0;
        }

        public function dateConvert($timestamp) {
            return date('m-d', $timestamp);
        }

        public function creatTime() {
            return $this->dateConvert($this->creattime);
        }

        public function editTime() {
            if($this->edittime)return $this->dateConvert($this->edittime);
            return $this->dateConvert($this->creattime);
        }

        public function paystyle($key) {
            if($this -> paystyle == $key) return 1;
            return 0;
        }

        public function borker() {
            $borker = new Borker();
            $borker -> load($this -> borker_id);
            return $borker -> uname;
        }

        public function type() {
            if($this -> type ==1)return '<font color="green">出租</font>';
            if($this -> type ==2)return '<font color="blue">出售</font>';
            return '未知';
        }

        public function typeurl() {
            if($this -> type ==1)return 'rent';
            if($this -> type ==2)return 'sale';
            return '';
        }

        public function is_present() {
            if($this -> is_present == 1) return 1;
            return 0;
        }
        public function is_quality() {
            if($this -> is_quality == 1) return 1;
            return 0;
        }
        public function states($key) {
            if($this -> states == $key) return 1;
            return 0;
        }

        public function showstates(){
            if($this -> states==1){
                echo '<font color="green">正常</font>';
            }elseif($this -> states==2){
                echo '<font color="red">已下架</font>';
            }else{
                echo '<font color="red">草稿</font>';
            }
        }

        public function getdefaultpic() {
            $pic = new House_pic();
            $options=array();
            $options['whereAnd']=array(array('house_id','='.$this->id));
            $options['limit']='0,1';
            $options['order']['pic_is_default']='desc';
            try {
                $a = $pic ->find($options);
                if ( is_file ( ROOTPATH . $a[0] -> pic_thumb ) ) return $a[0] -> pic_thumb;
                return '/uploadfiles/default_house.jpg';
            } catch (Exception $exc) {
                return 'uploadfiles/default_house.jpg';
            }
        }


}
?>
