<?php
/**
 * 文件的操作
 */
//利用好file_put_contents来进行保存
$file = './data.txt';

//演示的是文件的写入和续写
//$data = date('H:i:s') . "\n";
//$data = date('H:i:s');
//$result = file_put_contents($file, $data);
//$result = file_put_contents($file, $data, FILE_APPEND);
//var_dump($result);

//演示的是文件的展示
//$result = file_get_contents($file);
//echo $result;
//
//echo '<br/>';
//echo '<br/>';
//
////若存在"\n"，就换行输出
//echo nl2br($result);

//演示的是文件的大小的展示
//$result = file_get_contents($file);
//$file = './data.txt';
//$size = filesize($file);
//var_dump($size);

//判断文件是否存在
//var_dump(file_exists($file));

//获取文件最后一次修改的时间戳
$time = filemtime($file);
var_dump($time);
