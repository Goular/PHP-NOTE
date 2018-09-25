<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

<?php

$v1 = 1 + 2;
echo $v1;
echo "<br/>";

$v2 = 1 + "2";
echo $v2;
echo "<br/>";

$v3 = "1" + "2";
echo $v3;
echo "<hr/>";

//在php中，算术运算符，就只是对数值进行计算
$v4 = 1 + "2abc";
echo $v4;
echo "<br/>";

$v5 = "1" + "2bbc";
echo $v5;
echo "<br/>";

$v6 = "1def" + "2dettt";
echo $v6;
echo "<br/>";

$v7 = "1def" + "tt2";
echo $v7;
echo "<br/>";

$v8 = "yd2f" + "k2dettt";
echo $v8;
echo "<br/>";

echo "<hr/>";
//以上运算中，也适用于-， *，  /   %号！
?>


</body>
</html>