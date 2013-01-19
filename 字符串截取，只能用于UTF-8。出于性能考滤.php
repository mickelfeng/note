<?php

//截取字符串长度。支持utf-8
function utf8_substr($str,$start,$end){
	$_start=0;//截取字符开始位置
	$_end=0;//截取字符结束位置

	for($i=0; $i < $end; $i++){
		//长度超出跳出
		$t = substr($str,$_end,1);
		if($t===false) break;

		//记录开始截取位置
		if($i == $start){ $_start = $_end; }
		
		//一个字节的编码
		$byte_code=ord($t);

		//字符是占用几个字节，utf-8是变长编码，根据每个字符的第一个字节可判断出该字符占几个字节
		if($byte_code>=0&&$byte_code<128){
			$_end++;
		}else if($byte_code>191&&$byte_code<224){
			$_end+=2;
		}else if($byte_code>223&&$byte_code<240){
			$_end+=3;
		}else if($byte_code>239&&$byte_code<248){
			$_end+=4;
		}else if($byte_code>248&&$byte_code<252){
			$_end+=5;
		}else{
			$_end+=6;
		}
	}
	return substr($str, $_start, $_end);
}
?>