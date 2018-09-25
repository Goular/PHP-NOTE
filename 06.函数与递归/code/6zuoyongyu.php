<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
//作用域
//这里演示局部访问全局变量，出错：
$v1 = 1;
function f1()
{
    echo "<br/>在函数内部访问外部=>v1 {$v1}";//编译报错，原因是，函数内部不能调用全局变量
}

f1();

//这里演示全局访问局部变量，出错：
function f2()
{
    $v2 = 1;
}

f2();
echo "<br/>在函数外部访问局部变量：v2 = $v2;";
echo "<hr/>";

//使用静态变量的话，不会因为函数的生命周期而消失
function f3()
{
    static $c = 0;
    $c++;
    $d = 0;
    $d++;
    echo "<br/>c=$c, d=$d, (此函数被调用次数为：$c)";
}

f3();
f3();
f3();

echo "<hr/>";

$v4 = 4;

//在局部位置使用全局变量
//方法一:使用关键字global  ，但是需要注意的是，这里使用的是引用传递，而不是值传递
function f4()
{
    global $v4;

    echo "<br/>在局部访问全局变量:v4={$v4}";

    $v4 = 44;
}

f4();
echo "<br />在全局再次访问v4 = $v4";

//方法二：使用全局变量$GLOBALS[''];
echo "<hr />";
$v5 = 5;    //全局变量

function f5()
{
    echo "<br/>在局部访问全局变量:v5={$GLOBALS['v5']}";

    $GLOBALS['v5'] = 55;
}

f5();
echo "<br />在全局再次访问v5 = $v5";
echo "<br />在全局再次访问v5 = " . $GLOBALS['v5'];


echo "<hr/>";
$v6 = 6;//全局变量
function f6()
{
    echo "<br/>在局部访问全局变量v6 = " . $GLOBALS['v6'];
    $GLOBALS['v6'] = 66;
    unset($GLOBALS['v6']);
}

f6();
echo "<br/>在全局再次访问v6 = " . $v6;


echo "<hr/>";
$v7 = 7;//全局变量
function f7()
{
    global $v7;
    echo "<br/>在局部访问全局变量v7 = " . $v7;
    $v7 = 77;
    unset($v7);
}

f7();
echo "<br/>在全局再次访问v7 = " . $v7;

?>
</body>
</html>