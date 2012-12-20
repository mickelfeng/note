<?php

/**
 * 加密
 */

$data = '............';

/*
 * 密钥必需根据需要使用的密文具有特定的长度。
 * 本例使用Rijndael-256(又名:AES)
 * 258除以8所以密钥长度为32个字符
 */
$key = '012345678901234567890123456789ab';

/*
 * 加密模式主要有４种：ECB(电子码表)  CBC(密码块链接) CFB(密码反馈) 和　OFB(输出反馈)
 *
 * 第２，４个参数用于明确php在哪可以找到算法模块文件，一般不需要指定。
 */
$m = mcrypt_module_open('rijndael-256', '', 'cbc', '');

/*
 * 在window上需要使用:MCRYPT_RAND linux上是:MCRYPT_DEV_RANDOM
 */
$iv = mcrypt_create_vi(mcrypt_enc_get_vi_size($m), MCRYPT_DEV_RANDOM);

mcrypt_generic_init($m, $key, $iv);

$data2 = mcrypt_generic($m, $data);

//clse the encryption handler
mcrypt_generic_deinit($m);
//close the cipher
mcrypt_module_close($m);

/*
 * 注意：解码时需要同样的密钥与IV, IV与加密后的数据一起传输,这样对安全不会造成影响
 * 密码后的数据和IV是2进制的!,如果需要输出到页面中需要进行base64
 */
$data2;

/**
 * 解密
 */
$iv = '....';
$data = '........';

//密码
$key = '012345678901234567890123456789ab';

$m = mcrypt_module_open('rijndael-256', '', 'cbc', '');

mcrypt_generic_init($m, $key, $iv);

$data2 = mdecrypt_generic($m, $data);

//加密过程中可能会在数据未尾填冲空白,解密后用rtrim清除它们
$data2 = rtrim($data2);

//clse the encryption handler
mcrypt_generic_deinit($m);
//close the cipher
mcrypt_module_close($m);
