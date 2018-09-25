<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php

class A
{
}

class B
{
}

/**
 * 设计一个工厂类：这个工厂类，有一个静态方法；
 * 通过该方法可以获得指定类的对象！
 */
class GongChang
{
    static function getObj($className)
    {
        $obj = new $className();//使用可变类
        return $obj;
    }
}

$o1 = GongChang::getObj('A');
$o2 = GongChang::getObj('B');
$o3 = GongChang::getObj('A');
var_dump($o1);
echo "<br/>";
var_dump($o2);
echo "<br/>";
var_dump($o3);
echo "<br/>";


?>
</body>
</html>