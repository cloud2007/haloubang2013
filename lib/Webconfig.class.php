<?php
/**
 * 网站配置管理
 */
class Webconfig extends Data {
	function __construct() {
        $options = array(
            'key' => 'id',
            'table' => 'hlb_webconfig',
            'columns' => array(
                'id' => 'id',
                'edittime' => 'edittime',
                'attributeData' => 'content',
            ),
            'saveNeeds' => array(),
        );
        parent::init($options);
    }


    function updatecache(){
        $array = array();
        foreach($this -> attris as $key => $value)$array[$key] = $value;
        $filename = 'webconfig';
        file_put_contents(ROOTPATH . '/conf/' . $filename . '.php', '<?php return ' . var_export($array, true) . ' ;?>');
    }

}
?>
