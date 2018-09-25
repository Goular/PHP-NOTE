<?php
// 引入autoload.php文件
require './vendor/autoload.php';


$data = [
    'name' => 'zs',
    'age' => 18
];

// 调用 Json的encode静态方法   序列化数据
$jsondata = \phptestsoft\Json::encode($data);

print_r($jsondata);


// 调用 Json的encode静态方法   反序列化数据
$data2 = \phptestsoft\Json::decode($jsondata);

print_r($data2);