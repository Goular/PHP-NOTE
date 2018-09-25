<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php

/**
 * 与类有关的系统函数：
 *class_exists(“类名”), 判断一个类是否存在（是否定义过）
 *interface_exists(“接口名”), 判断一个接口是否存在（是否定义过）
 *get_class( $obj ),        获得某个对象$obj 的所属类
 *get_parent_class($obj ),        获得某个对象$obj 的所属类的父类
 *get_class_methods(),        获得一个类的所有方法名，结果是一个数组，里面存储的是这些方法的名称
 *get_class_vars(),            获得一个类的所有属性名。结果是一个数组，里面存储的是这些属性的名称get_declared_classes()        获得“整个系统”所定义的所有类名；
 *
 * 与对象有关的系统函数：
 * is_object( $obj )： 判断某个变量是否是一个对象；
 * get_object_vars( $obj )：获得一个对象的所有属性；结果是一个数组，里面存储的是这些属性的名称
 */
class A
{
}

class B
{
}

$v1 = get_declared_classes();
echo '<pre>';
echo '当前系统的全部类(系统类，包含自有类)';
var_dump($v1);
echo "</pre>";

echo "<br/>";
class_exists('A');


/*
 * 与类有关的运算符
 *
 * new，
 * instanceof：  判断一个“变量”（对象，数据），是否是某个类的“实例”；
 */
//——推论：一个类的对象，必然也属于这个类的上级类的对象；

?>
</body>
</html>