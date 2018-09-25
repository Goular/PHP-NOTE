<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php

//定义一个"人类"
class Person
{
    var $name;
    var $age;
    var $edu;
}

//创建一个新的Person类的对象,并“放入”变量$obj1中（其实就是赋值）
$obj1 = new Person();
$obj1->name = '张三';
$obj1->age = 18;
$obj1->edu = '本科';

echo '<pre>';
var_dump($obj1);
echo '</pre>';

//再次创建一个对象
$obj2 = new Person();
$obj2->name = '李四';
$obj2->age = 20;
$obj2->edu = '大专';
echo '<pre>';
var_dump($obj2);
echo '</pre>';


?>
</body>
</html>