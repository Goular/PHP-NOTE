<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php

/**
 * 访问修饰符
 */
class A
{
    public $p1 = 1;
    protected $p2 = 2;
    private $p3 = 3;

    function showInfo()
    {
        echo "<br/>this->p1 = " . $this->p1;
        echo "<br/>this->p2 = " . $this->p2;
        echo "<br/>this->p3 = " . $this->p3;
    }
}

$a1 = new A();
$a1->showInfo();
echo "<br/>";
echo "<br/>a1->p1 = " . $a1->p1;
//echo "<br />a1->p2=" . $a1->p2;//出错,因为这里是“外部”，又是protected修饰
//echo "<br />a1->p3=" . $a1->p3;//出错,因为这里是“外部”，又是private修饰

class B extends A
{
    function showParentInfo()
    {
        echo "<br/>this->p1=" . $this->p1;
        echo "<br/>this->p2=" . $this->p2;
        //echo "<br/>this->p3=" . $this->p3;
    }
}

echo "<hr/>";
$b1 = new B();
$b1->showParentInfo();

?>
</body>
</html>