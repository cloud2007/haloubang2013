<?php
//测试类
class Borough extends Data {
	function  __construct() {
	$options = array (
		'key' => 'id',
		'table' => 'hlb_borough',
		'columns' => array(
			'id' => 'id',
			'b_addid' => 'b_addid',
			'b_addname' => 'b_addname',
			'b_name' => 'b_name',
			'b_letter' => 'b_letter',
			'b_level' => 'b_level',
			'b_addr' => 'b_addr',
			'b_map' => 'b_map',
			'b_area1' => 'b_area1',
			'b_area2' => 'b_area2',
			'b_used' => 'b_used',
			'b_support' => 'b_support',
			'b_subway' => 'b_subway',
                        'b_sight' => 'b_sight',
			'b_avatar' => 'b_avatar',
			'b_company' => 'b_company',
			'b_content' => 'b_content',
			'b_rentprice1' => 'b_rentprice1',
			'b_rentprice2' => 'b_rentprice2',
			'b_saletprice1' => 'b_saletprice1',
			'b_saletprice2' => 'b_saletprice2',
			'b_salenum' => 'b_salenum',
			'b_salenum' => 'b_salenum',
			'b_opentime' => 'b_opentime',
			'b_begintime' => 'b_begintime',
			'b_creattime' => 'b_creattime',
			'b_edittime' => 'b_edittime',
			'b_states' => 'b_states',
                        'b_complete' => 'b_complete',
			'attributeData' => 'b_data',
			),
		'saveNeeds' => array(),
		);
		parent::init($options);
	}

        public function b_states(){
            if ($this -> b_states == 0) return '<font color="red">草稿</font>';
            if ($this -> b_states == 1) return '<font color="green">正常</font>';
            return '未知的状态';
        }

        public function checkSupport($key) {
            return strpos($this->b_support,(string)$key);
        }

        public function checkSubway($key) {
            return strpos($this->b_subway,(string)$key);
        }

        public function checkSight($key) {
            return strpos($this->b_sight,(string)$key);
        }

        public function dateConvert($timestamp) {
            return date('Y-m-d', $timestamp);
        }

        public function creatTime() {
            return $this->dateConvert($this->b_creattime);
        }

        public function editTime() {
            return $this->dateConvert($this->b_edittime);
        }

        public function getdefaultpic() {
            $pic = new Borough_pic();
            $options=array();
            $options['whereAnd']=array(array('borough_id','='.$this->id));
            $options['limit']='0,1';
            $options['order']['pic_is_default']='desc';
            try {
                $a = $pic ->find($options);
                if ( is_file ( ROOTPATH . $a[0] -> pic_thumb ) ) return $a[0] -> pic_thumb;
                return '/uploadfiles/default_house.jpg';
            } catch (Exception $exc) {
                return '/uploadfiles/default_house.jpg';
            }
        }

        public function gethousenum($type){
            $house = new House();
            return $house -> count(
                    array(
                        'whereAnd'=>array(array('type','='.$type),array('b_id','='.$this->id)),
                    )
            );
        }

        public  function getpicnum(){
            $pic = new Borough_pic();
            return $pic -> count(
                    array(
                        'whereAnd'=>array(array('borough_id','='.$this->id)),
                    )
            );
        }

        public  function complete(){
            $arr = $_POST;
            $picnum = count($arr['pic_thumb']);
            if($picnum==0) $res=0;
            if($picnum<5) $res=12;
            if($picnum>4) $res=27;
            unset($arr['b_support']);
            unset($arr['b_subway']);
            unset($arr['b_sight']);
            unset($arr['pic_id']);
            unset($arr['pic_thumb']);
            unset($arr['pic_sub_cate']);
            unset($arr['pic_is_default']);
            unset($arr['pic_category']);
            unset($arr['sumbmit_x']);
            unset($arr['sumbmit_y']);
            //$i=1;
            foreach($arr as $k=>$v){
                if(is_array($v)){
                    foreach($v as $kk => $vv){
                        //echo $res.":"."$kk=".$vv."<hr />";
                        if($vv)$res++;
                    }
                }else{
                    //echo $res.":"."$k=".$v."<hr />";
                    if($v)$res++;
                }
            }
            return $res;
        }

}
?>
