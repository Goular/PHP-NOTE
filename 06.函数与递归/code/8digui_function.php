<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
//递归的使用(注意迭代和递归的区别)
function jiesheng($n)
{
    echo "<br/>开始，有人要求{$n}的阶乘";
    if ($n == 1) {
        echo "<br/>结束:终于求到了{$n}的阶乘了";
        return 1;
    }
    $jieguo = $n * jiesheng($n - 1);
    echo "<br/>结束:终于求到了{$n}的阶乘了";
    return $jieguo;
}

$v2 = jiesheng(6);

echo "<hr/>";

//练习题:数列
//以下数列：1， 1， 2， 3， 5， 8， 13， .......
//说明：
//第1项是1，第2项也是1（都是已知）；
//其他项，是其前两项的和；
//求：第20项；
function shulie($n)
{
    if ($n == 1 || $n == 2) {
        return 1;
    }
    return shulie($n - 2) + shulie($n - 1);
}

$v3 = shulie(20);

echo "数列20::" . $v3;

?>
</body>
</html>