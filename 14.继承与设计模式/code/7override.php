<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php

//动物类
class Animal
{
    public $p1 = '能进食';

    function Move()
    {
        echo "<br/>能移动身体";
    }
}

//鱼类
class Fish extends Animal
{
    public $skin = "布满鱼鳞";    //皮肤
    public $p1 = "张开圆形的嘴巴吸入大量含食物的水";//覆盖了父类的同名属性

    function Move()
    {    //覆盖了父类的同名方法！
        echo "<br />摆动尾巴前进";
    }
}

//鸟类
class Bird extends Animal
{
    public $skin = "布满羽毛";    //皮肤
    public $p1 = "张开尖尖的嘴巴啄食物";//覆盖了父类的同名属性

    function Move()
    {    //覆盖了父类的同名方法！
        echo "<br />扇动翅膀飞翔前进";
    }
}

?>
</body>
</html>