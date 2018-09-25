<?php
//使用composer的自动加载
require "./vendor/autoload.php";

$class1 = new Class1();//内置标准类
$class2 = new Class2();//内置标准类
$class3 = new \T1\Class3();//内置标准类

var_dump($class1);
echo '<br/>';
var_dump($class2);
echo '<br/>';
var_dump($class3);//Fatal error: Class 'Class3' not found in E:\webroot\www\PHP_Learning\Composer\test02_PSR4.php on line 7

//自动加载成功