<?php
header('Content-Type: text/html; charset=utf-8');

//x
//$file = './data.txt';
//$file = './no_data.txt';
//$mode = 'x';
//$handle = fopen($file,$mode);

//r+
//$file = './data.txt';
//$mode = 'r+';
//$handle = fopen($file, $mode);
//echo '位置:', ftell($handle), '<br/>';
//
//$str = fgets($handle, 3);
//echo $str, '<br>';
//echo '位置：', ftell($handle), '<br>';
//$data = 'ABCDEFGHIJK';
//$result = fwrite($handle, $data);
//echo '写入结果:', $result, '<br>';

//w+
//$file = './data.txt';
//$mode = 'w+';
//$handle = fopen($file, $mode);
//echo '位置:', ftell($handle), '<br/>';
//
//$str = fgets($handle, 3);
//echo $str, '<br>';
//echo '位置：', ftell($handle), '<br>';
//$data = 'ABCDEFGHIJK';
//$result = fwrite($handle, $data);
//echo '写入结果:', $result, '<br>';


//a+
$file = './data.txt';
$mode = 'a+';
$handle = fopen($file, $mode);
echo '位置:', ftell($handle), '<br/>';

$str = fgets($handle, 3);
echo $str, '<br>';
echo '位置：', ftell($handle), '<br>';
$data = 'ABCDEFGHIJK';
$result = fwrite($handle, $data);
echo '写入结果:', $result, '<br>';