<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
//将一个匿名函数，赋值给一个变量f1
$f1 = function () {
    echo "<br />这是一个匿名函数！";
};

$f1();

$f2 = function ($p1, $p2) {
    $result = $p1 + $p2;
    return $result;
};

$re1 = $f2(3, 4);
echo "<br/>re1 = {$re1}";

echo "<hr/>";

function func1($x, $y, $z)
{
    $s1 = $x + $y;
    $s2 = $x - $y;
    $z($s1, $s2);
}

func1(3, 4, function ($m1, $m2) {
    $n = $m1 * $m2;
    echo "<br />两个数是和乘以2个数的差的结果为：$n";
});

func1(3, 4, function ($m1, $m2) {
    echo "<br />m1=$m1, m2 = $m2";
});

?>
</body>
</html>