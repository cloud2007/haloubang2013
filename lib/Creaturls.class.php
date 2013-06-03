<?php
//根据搜索条件生成URL
class Creaturls {
	function __construct(){//类初始化操作
		$filter = array(
			'level' => Config::item('borough_level'),
			'fitment' => Config::item('house_fitment'),
			'area1' => Config::item('borough_area'),
			'metro' => Config::item('borough_metro'),
			'is_present' => array('1' => '礼品'),
			'price' => array(
				'1' => '30元/平米·月以下',
				'2' => '30-60元',
				'3' => '60-90元',
				'4' => '90-120元',
				'5' => '120-150元',
				'6' => '150元以上',
			),
			'saleprice' => array(
				'1' => '8000元/平米以下',
				'2' => '8000-15000元',
				'3' => '15000-20000元',
				'4' => '20000元以上',
			),
			'area' => array(
				'1' => '100平米以下',
				'2' => '100-150平米',
				'3' => '150-200平米',
				'4' => '200-300平米',
				'5' => '300-500平米',
				'6' => '500-1000平米',
				'7' => '1000平米以上',
			),
			'fangling' => array(
				'1' => '2年以下',
				'2' => '2-5年',
				'3' => '5-10年',
				'4' => '10年以上',
			),
			'order' => array(
				'1' => '面积',//升序
				'2' => '单价',//降序
				'3' => '时间',
			),
		);
		$this -> filter = $filter;
	}

	//首页搜索自定义输出
	public function creaturl_index($option){
		$html = array();
		foreach ($this -> filter[$option] as $key => $val) {
			$html[] = "<li class=\"CRselectBoxItem2\"><a href=\"javascript:void(0);\" rel=\"{$key}\">{$val}</a></li>";
		}
		echo join("\n", $html);
	}

	//排序输出
	public function creaturl_order($option){
		$html = array();
		foreach ($this -> filter[$option] as $key => $val) {
			$params = isset($_GET[$option]) && $_GET[$option] == $key ? $this -> filterParams($option, array($option => $key)) : $this -> filterParamss_order($option, array($option => $key));
			if(isset($_GET[$option]) && $_GET[$option] == $key && !$_GET['by']) $params.="&by=desc";
			if(isset($_GET[$option]) && $_GET[$option] == $key && $_GET['by']) $params=$this -> unsetfilterParams('by');
			$className = isset($_GET['by']) && isset($_GET[$option]) && $_GET[$option] == $key ? ' class="nofollow" ' : ' class="bottom" ';
			if(isset($_GET[$option]) && $_GET[$option] == $key && !isset($_GET['by'])) $className = '  class="nofollow" ';
			if(isset($_GET[$option]) && $_GET[$option] == $key && isset($_GET['by'])) $className = '  class="bottom" ';
			$html[] = " <a href=\"{$params}\"{$className}>{$val}</a> ";
		}
		echo join("\n", $html);
	}

	//普通一级条件
	public function creaturl($option){
		$html = array();
		$params = !isset($_GET[$option]) ? 'javascript:void(0)' : $this -> filterParams($option);
		$className = !isset($_GET[$option]) ? ' class="s"' : null;
		$html[] = "<a href=\"{$params}\" {$className}>全部</a>";
		foreach ($this -> filter[$option] as $key => $val) {
			$params = isset($_GET[$option]) && $_GET[$option] == $key ? 'javascript:void(0)' : $this -> filterParams($option, array($option => $key));
			$className = isset($_GET[$option]) && $_GET[$option] == $key ? ' class="s"' : null;
			$html[] = " <a href=\"{$params}\"{$className}>{$val}</a> ";
		}
		echo join("\n", $html);
	}

	//区域一级条件
	public function creaturl_area1($option){
		$html = array();
		$params = !isset($_GET[$option]) ? $this -> unsetfilterParams('area2') : $this -> filterParams($option);
		$className = !isset($_GET[$option]) ? ' class="s"' : null;
		$html[] = "<a href=\"{$params}\" {$className}>全部</a>";
		foreach ($this -> filter[$option] as $key => $val) {
			$params = isset($_GET[$option]) && $_GET[$option] == $key ? 'javascript:void(0)' : $this -> filterParamss($option, array($option => $key));
			$className = isset($_GET[$option]) && $_GET[$option] == $key ? ' class="s"' : null;
			$html[] = " <a href=\"{$params}\"{$className}>{$val}</a> ";
		}
		echo join("\n", $html);
	}

	//二级条件（主要用于区域2）
	public function creaturl_area2($filter,$option){
		$html = array();
		$params = !isset($_GET[$option]) ? $this -> unsetfilterParams('area2') : $this -> filterParams($option);
		$className = !isset($_GET[$option]) ? ' class="s"' : null;
		$html[] = "<a href=\"{$params}\" {$className}>全部</a>";
		foreach ($filter as $key => $val) {
			$params = isset($_GET[$option]) && $_GET[$option] == $key ? 'javascript:void(0)' : $this -> filterParams('area2', array('area2' => $key));
			$className = isset($_GET[$option]) && $_GET[$option] == $key ? ' class="s"' : null;
			$html[] = " <a href=\"{$params}\"{$className}>{$val}</a> ";
		}
		echo join("\n", $html);
	}

	//单选框
	public function creatradio($option){
		$html = array();
		$params = !isset($_GET[$option]) ? 'javascript:void(0)' : $this -> filterParams($option);
		$className = !isset($_GET[$option]) ? ' checked="checked" ' : null;
		$clickName = ' onclick=" javascript:location.href= this.value;"';
		$html[] = '<li><label><input type="radio" name="'.$option.'" value="'.$params.'" '. $className . $clickName . '><span>全部</span></label></li>';
		foreach ($this -> filter[$option] as $key => $val) {
			$params = isset($_GET[$option]) && $_GET[$option] == $key ? 'javascript:void(0)' : $this -> filterParams($option, array($option => $key));
			$className = isset($_GET[$option]) && $_GET[$option] == $key ? ' checked="checked" ' : null;
			$clickName = 'onclick="javascript:location.href= this.value;"';
			$html[] = '<li><label><input type="radio" name="'.$option.'" '.$className.' value="'.$params.'" '.$clickName .'><span>'.$val.'</span></label></li>';
		}
		echo join("\n", $html);
	}

	//复选框（单一条件）
	public function creatcheckbox($option){
		$html = array();
		foreach ($this -> filter[$option] as $key => $val) {
			$params = isset($_GET[$option]) && $_GET[$option] == $key ? $this -> unsetfilterParams($option) : $this -> filterParams($option, array($option => $key));
			$className = isset($_GET[$option]) && $_GET[$option] == $key ? ' checked="checked" ' : null;
			$html[] = '<li class="gift"><label><input name="present" type="checkbox" '.$className.' onclick="javascript:location.href= this.value;" value="'.$params.'"><span>礼品</span></label></li>';
		}
		echo join("\n", $html);
	}

	//生成链接
	public function filterParams($except = null, $addition = array()) {
		$effectParams = array_filter($_GET);
		if (isset($effectParams[$except])) unset ($effectParams[$except]);
		$queryString = http_build_query($addition + $effectParams);
		return empty($queryString) ? str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']) : "?{$queryString}";
	}

	//删除某一参数 生成链接 生成链接（区域1）
	public function filterParamss($except = null, $addition = array()) {
		$effectParams = array_filter($_GET);
		if (isset($effectParams[$except])) unset ($effectParams[$except]);
		unset ($effectParams['area2']);
		$queryString = http_build_query($addition + $effectParams);
		return empty($queryString) ? str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']) : "?{$queryString}";
	}

	//删除某一参数 生成链接 生成链接（排序order））
	public function filterParamss_order($except = null, $addition = array()) {
		$effectParams = array_filter($_GET);
		if (isset($effectParams[$except])) unset ($effectParams[$except]);
		unset ($effectParams['by']);
		$queryString = http_build_query($addition + $effectParams);
		return empty($queryString) ? str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']) : "?{$queryString}";
	}

	//删除某一参数后生成链接
	public function unsetfilterParams($except = null) {
		$effectParams = array_filter($_GET);
		unset ($effectParams[$except]);
		$queryString = http_build_query($effectParams);
		return empty($queryString) ? str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']) : "?{$queryString}";
	}

}
?>