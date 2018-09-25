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
    //定义一个属性，这个属性意图存储“若干个”不存在的属性数据；
    protected $prop_list = array();

    //这个方法会在A的对象使用一个不存在的属性进行赋值的时候自动调用
    function __set($name, $value)
    {
        $this->prop_list[$name] = $value;
    }

    function __get($name)
    {
        if (isset($this->prop_list[$name])) {
            return $this->prop_list[$name];
        } else {
            return "该属性不存在!";
        }
    }

    function __isset($name)
    {
        return isset($this->prop_list[$name]);
    }

    function __unset($name)
    {
        unset($this->prop_list[$name]);
    }
}

$a1 = new A();
$a1->p1 = 1;//not exists
$a1->h2 = 2;//not exists
$a1->abc = '传智';//not exists

echo "<br />然后可以输出这些“不存在的属性”的值：";
echo "<br />a1->p1：" . $a1->p1;//不存在的属性名取值，此时会传过去'p1'
echo "<br />a1->h2：" . $a1->h2;
echo "<br />a1->abc：" . $a1->abc;
echo "<br />a1->abcddd：" . $a1->abcddd;    //这个显然不存在！

echo "<hr/>";

//下面演示isset判断一个不存在的属性
$v1 = isset($a1->p1);//之前执行代码保存了
$v2 = isset($a1->pppp1);//not exists

echo "<br/>";
var_dump($v1);
echo "<br/>";
var_dump($v2);

//下面演示销毁一个不存在的属性
echo "<hr/>";
unset($a1->h2);
unset($a1->h2222);
echo "<br/>a1->h2:" . $a1->h2;


?>
</body>
</html>