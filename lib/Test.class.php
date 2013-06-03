<?php
//测试类
class Test extends Data {
        //public $id, $userid, $password, $creattime, $content;
        function  __construct() {
		$options = array (
		    'key' => 'id',
		    'table' => 'test',
		    'columns' => array(
				'id' => 'id',
				'title' => 'title',
				'attributeData' => 'content',
                ),
		    'saveNeeds' => array('title'),
            );
            parent::init($options);
        }
/*
        public function save() {
                if (is_null($this->id)) {
                        $obj = new $this->className;
                        $obj->mid = $this->mid;
                        $this->insertedTime = time();
                        $result = $obj->find();
                        if (!empty($result)) {
                                $this->id = $result[0]->id;
                                $this->set('thumbnailImage', $result[0]->get('thumbnailImage'));
                                $this->set('middleImage', $result[0]->get('middleImage'));
                                $this->set('updatedTime', date('Y-m-d H:i:s'));
                                $this->insertedTime = $result[0]->insertedTime;
                        }                        
                        $this->set('createdTimeStr', date('Y-m-d H:i:s',$this->createdTime));
                }
				$this->htmlspecialchars();
                parent::save();
        }*/
}

?>
