<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
//演示递推思想：
//目标：要求5的阶乘：
$qian = 1;
for ($i = 1; $i <= 5; ++$i) {
    $jieguo = $qian * $i;
    echo "<br/>{$i}的阶乘是{$jieguo}";
    $qian = $jieguo;
}
echo "<br/>结果为:" . $jieguo;


echo '<hr/>';
/*
下面用递推思想来完成刚才的数列题：
以下数列：1， 1， 2， 3， 5， 8， 13， .......
求第20项：
*/
$qian1 = 1;
$qian2 = 1;
for ($i = 3; $i <= 20; ++$i) {
    $jieguo1 = $qian1 + $qian2;
    $qian1 = $qian2;
    $qian2 = $jieguo1;
}

echo "<br />数列的第20项为：" . $jieguo1;

?>
</body>
</html>