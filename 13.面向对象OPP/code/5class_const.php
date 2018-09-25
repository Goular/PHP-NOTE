<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
const PP1 = 1;//定义常量PP1
define("PP2", 2);//定义常量PP2

class C1
{
    //定义类常量
    const PI = 3.14;
    const G = 9.8;
}

//使用类的常量
$v1 = C1::PI * 3 * 3;
echo "<br/>v1=$v1";
echo "<br/>C1::G = " . C1::G;

?>
</body>
</html>