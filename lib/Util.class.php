<?php
/**
 * Util::instance()->get_letter();
 */
class Util {
    private static  $instance;

    private function __construct() {}
    private function __clone() {}
    /**
     * 这里必须注释一个return 才会有方法提示
     * @return Util
     */
    public static function instance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function strSplit($str) {
        $count = mb_strlen($str, 'UTF-8');
        $result = array();
        for ($i = 1; $i <= $count; $i++) {
            $result[] = mb_substr($str, $i - 1, 1, 'UTF-8');
        }
        return $result;
    }

    public function get_letter($s0) {
        $firstchar_ord = ord(strtoupper($s0{0}));
        if (($firstchar_ord >= 65 and $firstchar_ord <= 91) or ($firstchar_ord >= 48 and $firstchar_ord <= 57))
            return $s0{0};
        $s = iconv("UTF-8", "gb2312", $s0);
        $asc = ord($s{0}) * 256 + ord($s{1}) - 65536;
        if ($asc >= -20319 and $asc <= -20284)
            return "A";
        if ($asc >= -20283 and $asc <= -19776)
            return "B";
        if ($asc >= -19775 and $asc <= -19219)
            return "C";
        if ($asc >= -19218 and $asc <= -18711)
            return "D";
        if ($asc >= -18710 and $asc <= -18527)
            return "E";
        if ($asc >= -18526 and $asc <= -18240)
            return "F";
        if ($asc >= -18239 and $asc <= -17923)
            return "G";
        if ($asc >= -17922 and $asc <= -17418)
            return "H";
        if ($asc >= -17417 and $asc <= -16475)
            return "J";
        if ($asc >= -16474 and $asc <= -16213)
            return "K";
        if ($asc >= -16212 and $asc <= -15641)
            return "L";
        if ($asc >= -15640 and $asc <= -15166)
            return "M";
        if ($asc >= -15165 and $asc <= -14923)
            return "N";
        if ($asc >= -14922 and $asc <= -14915)
            return "O";
        if ($asc >= -14914 and $asc <= -14631)
            return "P";
        if ($asc >= -14630 and $asc <= -14150)
            return "Q";
        if ($asc >= -14149 and $asc <= -14091)
            return "R";
        if ($asc >= -14090 and $asc <= -13319)
            return "S";
        if ($asc >= -13318 and $asc <= -12839)
            return "T";
        if ($asc >= -12838 and $asc <= -12557)
            return "W";
        if ($asc >= -12556 and $asc <= -11848)
            return "X";
        if ($asc >= -11847 and $asc <= -11056)
            return "Y";
        if ($asc >= -11055 and $asc <= -10247)
            return "Z";
        return $s;
    }

    public function getletter($str) {
        $str = $this->strSplit($str);
        $res = '';
        foreach ($str as $k) {
            $res .= $this->get_letter($k);
        }
        return $res;
    }

    public function getpicthumb($pic,$type){
        if( is_file( ROOTPATH .str_replace('.', '_'.$type.'.',$pic)) ) return str_replace('.', '_'.$type.'.',$pic);
		if( is_file( ROOTPATH . $pic ) ) return $pic;
        return '/uploadfiles/default_house.jpg';
    }

    public function csubstr($str, $start=0, $length, $charset="utf-8", $suffix='...'){
        if(function_exists("mb_substr")){
            if(mb_strlen($str, $charset) <= $length) return $str;
            $slice = mb_substr($str, $start, $length, $charset);
        }else{
        $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk']          = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5']          = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        if(count($match[0]) <= $length) return $str;
            $slice = join("",array_slice($match[0], $start, $length));
        }
        if($suffix) return $slice.$suffix;
        return $slice;
    }
	
	//取得当前页面对应的搜索action
	public function get_search_action($pageurl){
		if(strpos($pageurl,'rent')>0) return 1;
		if(strpos($pageurl,'sale')>0) return 2;
		if(strpos($pageurl,'borough')>0) return 3;
		return 1;
	}
	
	public function maping($map){
		$mapping = array(
		   ':' => ',',
		   '：' => ',',
		   '(' => '',
		   '（' => '',
		   ')' => '',
		   '）' => ''
		);
		return str_replace(array_keys($mapping), $mapping, $map);
	}
	
}
?>