<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php

/**
 * static的用法
 * 1.在普通的函数/方法中，代表该方法的静态变量
 * 2.类与对象中，作为静态成员(属性和方法)
 * 3.与self的用法一样，当时代表的是调用方法的当前类，使用区域也是定义在类中，但与self不同的是，self代表的是定义类，static代表的是当前类，灵活性更高
 */
class A
{
    static $p1 = 1;

    static function show1()
    {
        echo "<br/>self：：p1=" . self::$p1;
        echo "<br/>static：：p1=" . static::$p1;
    }
}

class B extends A
{
    static $p1 = 11;
}

A::show1();
echo "<hr/>";
B::show1();

?>
</body>
</html>