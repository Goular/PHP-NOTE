<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<!--常量的使用-->
<?php
//常量定义的语法，有两种
//第一是define("常量名",常量值);
define("PI", 3.14);
define("SCHOOL", "伟伦体校");

//常量的定义形式二
//const 常量名 = 常量值;
//需要注意的是 const只能创建于顶级区域，不能使用与函数和存在循环，大括弧定义区域，对象除外
const CC1 = 1234;
const CC2 = "ABCD";

//使用的形式1,:直接使用它的名字
echo "<br/>常量PI的值是:" . PI;//注意一点，常量是不能包在双引号中被获取的
echo "<br/>常量SCHOOL的值是:" . SCHOOL;

//使用方式2，使用函数constant()获得一个常量的值
$s1 = constant("PI") * 3 * 3;
$s2 = PI * 3 * 3;
echo "<br/>s1={$s1},s2 = {$s2}";
echo "<br/>" . SCHOOL . constant("CC1") . constant("CC2");

//利用可变变量获取常量值
$i = 1;
$c1 = "CC" . $i;
echo "<br/>常量{$c1}的值为:" . constant($c1);

if (defined("PI")) {
    echo "<br/>常量PI已经存在。";
} else {
    echo "<br/> 常量PI不存在";
    define("PI", 3.14);
}

if (defined("G")) {
    echo "<br/> 常量G已经存在";
} else {
    echo "<br/>常量G不存在";
    define("G", 9.8);
}

$s4 = G * 6;
echo "<br/>速度为:" . $s4;

//注意一个点，就是若使用直接没有定义的常量，会出现报错，但是常量的标识符会变为新常量的值
echo "<br/>";
echo "<hr/>";
echo "v1的值为:" . $v1 . "<br/>";
echo "c1的值为:" . $c1;


//魔术常量
echo "<br/>" . __FILE__;
echo "<br/>" . __DIR__;
echo "<br/>" . __LINE__;
echo "<br/>" . __LINE__;
echo "<br/>" . __LINE__;


?>
</body>
</html>