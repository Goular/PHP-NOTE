<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<!--变量的传值方式-->

<!--
变量的传值方式有两种：
1.值传递(标量类型的都是值传递，值得注意的是，数组的传递也是值传递)
2.引用传递(一般是指的是对象的传递)

注意:若想将值传递强制变为引用传递，可以使用符号"&"进行传递
-->


<?php

//值传递
$v1 = 1;
$v2 = $v1;
$v1 = 10;

echo "v1 = {$v1} <br/>";
echo "v2 = {$v2} <hr/>";

unset($v1);//移除变量  //unset unset()销毁指定的变量,释放给定的变量。

$r1 = isset($v2);
echo var_dump($r1) . "<hr/><hr/><hr/>";

//引用传递
$m1 = 1;
$m2 = &$m1; //使用"&"来执行引用传递的内容

echo "v1 = {$m1} <br/>";
echo "v2 = {$m2} <hr/>";

unset($m1);//移除变量  //unset unset()销毁指定的变量,释放给定的变量。但是数据的空间还是存在且依旧存在数据2进行绑定，所以数据2是不会报错的

$r2 = isset($m2);
echo var_dump($r2) . "<hr/>";

?>


</body>
</html>