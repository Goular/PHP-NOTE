<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

<?php
//有关数组单元的交换问题：
//需求1：交换数组第0项和第3项：
$a = array(3, 11, 5, 7, 20, 18);
echo "<br/>交换之前:";
echo "<pre>";
print_r($a);
echo "</pre>";

$v1 = $a[0];
$v2 = $a[3];

//$t = $v1;
//$v1 = $v2;
//$v2 = $t; ////这种做法根本不行，因为v1，v2只是2个变量，跟数组没有关系了！

$a[0] = $v2;
$a[3] = $v1;

echo "<br/>交换之后:";
echo "<pre>";
print_r($a);
echo "</pre>";


?>

</body>
</html>