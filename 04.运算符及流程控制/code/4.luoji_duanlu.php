<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<!--逻辑运算符的短路解释-->

<?php
//此函数只是为了说明要对2个数据(x,y)进行
//复杂的计算，然后返回计算结果
function f1($x, $y)
{
    $m1 = $x * 2;
    $m2 = $y * 3;
    return $m1 + $m2;
}

$n1 = 3;
$n2 = 4;

if ($n2 > $n2 && f1($n1, $n2) > 20) {
} else {
}
if (f1($n1, $n2) > 20 && $n1 > $n2) {
} else {
}

$n1 = 3;
$n2 = 2;
if ($n2 > $n2 || f1($n1, $n2) > 20) {
} else {
}
if (f1($n1, $n2) > 20 || $n1 > $n2) {
} else {
}
//写法1和写法2，最终计算结果是一样的！
//但写法1会具有优势：它有时候可能不需要进行“复杂”计算
//就可以得到判断结果，这就是“短路”现象
//而写法2却总是先去进行“复杂”计算，显然属于消耗资源行为

?>

</body>
</html>