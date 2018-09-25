<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php

class A
{
    public $p1 = 1;

    function __clone()
    {
        echo "<br/>正在克隆的对象p1为:" . $this->p1;
    }
}

$a1 = new A();
$a1->p1 = 11;
$aa1 = clone $a1;

$a2 = new A();
$a2->p1 = 22;
$aa2 = clone $a2;


?>
</body>
</html>