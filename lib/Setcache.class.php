<?php   if(!defined('INCPATH')) exit('Request Error!');
/**
 * 楼盘参数修改类
 */
class Setcache
{
	private $Mysql;
    function __construct()
    {
        global $Mysql;
		$this->Mysql=$Mysql;
    }

    //缓存更新
	function updatecache(){
		$sql="select * from hlb_set order by order_id";
		$result = $this->Mysql -> fetchRows($sql);
		foreach($result as $key){
			$sql = "select id,set_caption from hlb_set_item where set_id=".$key['id']." and parent_id=0 order by order_id";
			$res=$this->Mysql->fetchRows($sql);
			$filename=$key['set_name'];
			$array=array();
			foreach($res as $k){
				$array[$k['id']]=$k['set_caption'];
			}
			file_put_contents( ROOTPATH . '/conf/'.$filename.'.php','<?php return '.var_export($array,true).' ;?>');
		}
	}
	
	//缓存更新
	function updatecache1(){
		$sql="select * from hlb_set_item where set_id=1 and parent_id=0 order by order_id";
		$result = $this->Mysql -> fetchRows($sql);
		foreach($result as $key){
			$sql = "select id,set_caption from hlb_set_item where set_id=1 and parent_id=".$key['id']." order by order_id";
			$res=$this->Mysql->fetchRows($sql);
			$filename='area_'.$key['id'];
			$array=array();
			foreach($res as $k){
				$array[$k['id']]=$k['set_caption'];
			}
			file_put_contents('../conf/'.$filename.'.php','<?php return '.var_export($array,true).' ;?>');
		}
	}
	
}
?>