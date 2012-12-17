<?php

/**
 * 计算图片旋转时需要的坐标
 */

//期望的坐标
$p_x = 50;
$p_y = 50;
//需要旋转的角度
$ro= 90;

//直径
$D = sqrt(pow($p_x,2)+pow($p_y,2));

$S = atan2($p_x, $p_y) + deg2rad($ro);

//实际的绘画时的坐
$p2_x = sin($S) * $D;
$p2_y = cos($S) * $D;

/**
 * 随机生成一个常用汉字
 */
$r_h = mt_rand(16,55) + 0xA0;
$r_l = mt_rand(1, ($r_h==55)?89:94) + 0xA0;
$str = mb_convert_encoding(chr($r_h).chr($r_l), 'utf-8', 'gb2312');
