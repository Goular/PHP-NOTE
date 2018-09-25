<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php

/**
 * 对象的克隆
 * 值得注意的是值传递与引用传递都是指向同一个对象，仅仅是各自的对象编号的形式是不一样的，值传递的对象编号有两份，对象编号指向的是同一个对象。而引用传递，指向的是对象编号只有一份，编号指向的对象也是同一个，但是引用传递的类似于地址的传递，所以只要随便一个变量改变了对象编号的的内容，那么就会丢失掉对象的应用，会让对象计数器-1，同时执行GC
 */
class A
{
    public $p1 = 1;
}

$obj1 = new A();
$obj1->p1 = 11;
$obj2 = $obj1;//值传递,总共会产生两份的对象编号的存储空间

echo "值传递<br/>";
var_dump($obj1);
echo "<br/>";
var_dump($obj2);
echo "<hr/>";


$obj3 = new A();
$obj3->p1 = 15;
$obj4 = &$obj3;//值传递,总共会产生两份的对象编号的存储空间

echo "引用传递<br/>";
var_dump($obj3);
echo "<br/>";
var_dump($obj4);
echo "<hr/>";


/**
 * 下面使用的是对象的克隆
 */
echo "对象克隆";
$obj5 = clone $obj3;
$obj3->p1 = 34;
echo '<br/>';
var_dump($obj5);
echo '<br/>';
var_dump($obj3);

/**
 * 实验结束,可以发现，克隆以后，克隆对象的对象编号和原对象的对象编号是不一样的，说明对象已经克隆成功，但是每个独立出来的对象都是具有最高独立性的对象内容
 */
?>
</body>
</html>