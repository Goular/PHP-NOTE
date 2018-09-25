<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
/**
 * 其他类型转换为对象类型的时候
 *
 * 其他数据类型转换为对象类型，得到的结果是：内置标准类（stdclass）的一个对象！
 * 语法形式为：
 * $obj1  =  (object) 其他类型数据；
 */

//下面是数组的对象化
$config = array(
    'host' => "localhost",
    'port' => 3306,
    'user' => "root",
    'pass' => "123",
    'charset' => "utf8",
    'dbname' => "php39"
);

//将数组转为对象，这种数组类型的数据转为对象那个会变为stdClass的对象
$obj1 = (object)$config;
echo "<pre>";
var_dump($obj1);
echo "</pre>";

echo '<br/>单独取user出来：' . $obj1->user;

echo "<hr/>";
//-----------------------------------------------------
//将数组变为数组对象
$arr2 = array('pp1' => 1, 5 => 15);
$obj2 = (object)$arr2;
echo "<pre>";
var_dump($obj2);
echo "</pre>";
echo "<br />单独取pp1出来：" . $obj2->pp1;
//echo "<br />单独取pp1出来：" . $obj2->5;这行会直接报错，所以说PHP的索引数组不能直接读取数字属性的

//--------------------------------------------------
//基本类型对象转换
$v1 = 1;
$v2 = 1.23;
$v3 = 'abc';
$v4 = true;

$objv1 = (object)$v1;
$objv2 = (object)$v2;
$objv3 = (object)$v3;
$objv4 = (object)$v4;
$objv5 = (object)null;

echo "<hr/>";
var_dump($objv1);
echo "<br/>";
var_dump($objv2);
echo "<br/>";
var_dump($objv3);
echo "<br/>";
var_dump($objv4);
echo "<br/>";
//打印null转为内置标准类的var_dump
var_dump($objv5);
echo "<br/>";

/**
 * 其他标量数据转换为对象：属性名为固定的“scalar”，值为该变量的值
 */

?>
</body>
</html>