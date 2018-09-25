<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
/**
 * PHP内置标准类
 * php语言内部，有许多现成可用的类，其中有一个叫做，内指标准类
 * 但是这个类内容没有任何内容，作用是用于存储一些临时的简单的数据:
 */
$obj1 = new stdClass();
$obj1->p1 = 'tmep data';
echo "<pre>";
var_dump($obj1);
echo "</pre>";

echo "<hr/>";

class A
{
    function __set($name, $value)
    {
        // TODO: Implement __set() method.
    }

}

$obj2 = new A();
$obj2->p1 = 'tmep data';
var_dump($obj2);
echo $obj2->p1;


/**
 * 结果显示，PHP内置了stdClass类，stdClass没有任何的属性与其他内容，
 */
?>
</body>
</html>