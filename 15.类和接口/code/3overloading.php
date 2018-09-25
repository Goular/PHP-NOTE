<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php

/**
 * 重载，
 * 值得注意的是:PHP中的重载的意思是，对没有定义的属相与方法利用魔术方法进行优雅的处理
 * 面向对象的重载的基本含义，与Java的重载一致
 * 另外由于PHP是脚本语言的问题，所以具有方法可变的参数的特性，所以没有强制的面向对象的重载的意义
 */
class A
{
    public $p1 = 1;

    /**
     *  魔术方法__get($prop_name)
     */
    function __get($prop_name)
    {
        //处理方法1:
        //echo "<br />你小心点阿，你正用的属性{$prop_name}我还没有定义呢";
        //处理方法2：
        //echo "<br/>属性{$prop_name}不存在!";
        //return "";
        //处理方法3：
        trigger_error("发生错误，属性不存在.", E_USER_ERROR);
        die();//发生错误后，不在执行下面的代码
    }
}

$a1 = new A();
echo $a1->p1;
echo $a1->p2;


?>
</body>
</html>