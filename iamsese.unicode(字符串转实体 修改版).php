<?php
/**
 * 时间: 2009-4-9 17:19:55
 * iamsese.cn 我是色色 
 * vb2005xu.javaeye.com
 * 
 * Unicode 编码和转换功能库
 */

class IAMSESE_UNICODE {

	/**
	 * ord 方法的utf-8支持
	 *
	 * @param utf-8::char $c
	 * @return int
	 */
	public static function ord($c) {
	    $h = ord($c{0});
	    if ($h <= 0x7F) { //0x7F == 127, 0x80 == 128
	        return $h;
	    } else if ($h < 0xC2) { //0xC2 == 194
	        return false;
	    } else if ($h <= 0xDF) { //0xDF == 223
	        return ($h & 0x1F) << 6 | (ord($c{1}) & 0x3F); //0x1F == 31, 0x3F == 63
	    } else if ($h <= 0xEF) { //0xEF == 239
	        return ($h & 0x0F) << 12 | (ord($c{1}) & 0x3F) << 6 //0x0F :: 00001111
	                                 | (ord($c{2}) & 0x3F);
	    } else if ($h <= 0xF4) { //0xF4 == 244
	        return ($h & 0x0F) << 18 | (ord($c{1}) & 0x3F) << 12
	                                 | (ord($c{2}) & 0x3F) << 6
	                                 | (ord($c{3}) & 0x3F);
	    } else {
	        return false;
	    }
	}
	
	/**
	 * chr 函数的unicode实现
	 *
	 * @param int $code
	 * @return String
	 */
	public static function chr ($code, $charset = 'UTF-8') {
		return html_entity_decode('&#'.$code.';', ENT_NOQUOTES, $charset);
	}
	
	/**
	 * 解码html实体
	 *
	 * @param String $str
	 * @return String
	 */
	public static function entity_decode($str, $charset = 'UTF-8'){
		return html_entity_decode($str, ENT_NOQUOTES, $charset);
	}
	
	/**
	 * 编码html实体
	 *
	 * @param String $str
	 * @return String
	 */
	// public static function entity_encode($str, $charset = 'UTF-8'){
		// $string = $str;
		// $strlen = mb_strlen($string, $charset);
		// $encode = '';
		
	    // while ($strlen) {
			// $encode .= "&#".self::ord(mb_substr($string, 0, 1, $charset)).";";
			// $string = mb_substr($string, 1, $strlen, $charset);
			// $strlen = mb_strlen($string, $charset);
	    // }
		
	    // return $encode;
	// }
	
	/**
	 * 编码html实体
	 *
	 * @param String $str
	 * @return String
	 */
	public static function entity_encode($str, $charset = 'UTF-8'){
		$string = $str;
		$strlen = iconv_strlen($string,$charset);
		$encode = '';
		
	    while ($strlen) {
			$encode .= "&#".self::ord(iconv_substr($string,0,1,$charset)).";";
	        $string = iconv_substr($string, 1, $strlen, $charset);
	        $strlen = iconv_strlen($string, $charset);
	    }
		
	    return $encode;
	}
}

// ---- Example  ----

$test1 ='abcde 我是色色 a|b-c+1,s';


$t1 = microtime(true);

// $encode = IAMSESE_UNICODE::entity_encode($test1);
// echo $encode  . "\n<br/>\n";

// echo htmlspecialchars($encode);

// echo IAMSESE_UNICODE::entity_decode($encode);

for ($i=0; $i < 100; $i++) {
	echo IAMSESE_UNICODE::entity_encode($test1)  . "\n<br/>\n";
}


$t2 = microtime(true);

echo "<div style='position:absolute;top:0;left:200px;'>".sprintf('%.4f', ($t2 - $t1) )."</div>";





