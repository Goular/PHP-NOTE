<?php
//对一个json的字符串进行反编码操作
//json字符串要求不要使用单引号定义
//$jn_city = "{'shandong':'jinan','zhejiang':'hangzhou','liaoning':'shenyang'}";
$jn_city = "{\"shandong\":\"jinan\",\"zhejiang\":\"hangzhou\",\"liaoning\":\"shenyang\"}";


$fan_city = json_decode($jn_city,true);
var_dump($fan_city);