<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php

/**
 * 类的继承
 */
class A
{
    public $p1 = '这是A中属性';

    function f1()
    {
        echo '<br/>这是A中方法f1';
    }
}

class B extends A
{
    public $p2 = "这是B种属性";
}

$b1 = new B();
echo "<br/>" . $b1->p1;

$b1->f1();

?>
</body>
</html>