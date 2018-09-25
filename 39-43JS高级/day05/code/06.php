<?php
//PHP正则表达式的使用
$str = "this is 20150913 day, tomorrow is 20150914";
$reg = "/\d+/";

//preg_match(模式，字符串，结果);//单次匹配
preg_match($reg, $str, $out);
echo "<pre>";
var_dump($out);
echo "</pre>";


echo "<br/>";

//preg_match_all(模式，字符串，结果); 全局匹配
preg_match_all($reg, $str, $out2);
print_r($out2);