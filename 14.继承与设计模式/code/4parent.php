<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php

/**
 * 使用parent的关键字的使用
 */
class A
{
    static $p1 = 1;//没有写访问修饰符，就是static
    static protected $p2 = 2;
}

class B extends A
{
    static function show1()
    {
        echo "<p>这里是子类B中的方法";
        echo "<br/>这里要显示父类的属性p1:" . parent::$p1;
        echo "<br/>" . A::$p2;
    }
}

B::show1();//静态方法，直接使用类名来调用

//下面演示使用parent代表“对象”的情况（调用实例方法）：
class C
{
    public $p1 = 1;

    function showInfo()
    {
        echo "<br/>C中的属性p1:" . $this->p1;
        echo "<pre>";
        var_dump($this);//看看$this的真面貌
        echo "</pre>";
    }
}

class D extends C
{
    function show2()
    {
        echo "<p>调用父类中的实例方法:</p>";
        parent::showInfo();
    }
}

$d1 = new D();
$d1->show2();

?>
</body>
</html>