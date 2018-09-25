<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php

class C1
{
    public $p1 = 1;//实例属性
    static $p2 = 2;//静态属性

    function showInfo1()
    {
        echo "<br />实例方法被调用！";
        echo "<br/>p1的值为:" . $this->p1;
        echo "<br/>p2的值为:" . self::$p2;
    }

    static function showInfo2()
    {
        self::$p2++;
        echo '<br/>静态方法被调用!';
        //添加下面的这句话会报错，因为今天方法是类的方法，不能添加对象$this
        //echo "<br/>p1的值为:" . $this->p1;
        echo "<br/>p2的值为:" . self::$p2;
    }
}

$o1 = new C1();
$o1->showInfo1();//使用对象调用实例方法
C1::showInfo2();//使用类来调用静态方法


?>
</body>
</html>