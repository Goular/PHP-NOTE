<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php

//怪物类
abstract class Guai
{
    protected $blood = 100;

    abstract function Attach();
}

//蛇怪
class Snake extends Guai
{
    function Attach()////具体去实现该父类继承下来的抽象方法
    {
        echo "<br />俏销靠近主人公，然后迅猛咬一口";
        $this->blood--;    //自身掉血1点
    }
}

//虎怪
class Tiger extends Guai
{
    function Attach()
    {
        echo "<br />猛扑猛咬主人公";
        $this->blood--;    //自身掉血1点
    }
}

abstract class Yao extends Guai
{
    abstract function Eat();//新添加抽象方法
}

//八戒
class BaJie extends Yao
{

    function Attach()
    {
        echo "<br />抡起钉耙打下去";
        $this->blood -= 2;    //自身掉血1点
    }

    function Eat()
    {
        echo "<br />猪八戒吃人";
        $this->blood += 2;    //自身掉血1点
    }
}

$a1 = new BaJie();
$a1->Attach();
$a1->Eat();


?>
</body>
</html>