<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

<!--使用 isset()方法，
存在三种情况会出现false，其余使用该方法的内容都是true
1.即变量未定义时使用，虽然php很少情况是变量没有定义，但是在直接调用没有赋值的变量时就是实现了变量没有的定义的问题
2.null，
3.unfinded

其实我感觉就两种情况

-->

<?php
$v1 = isset($s1);
$s2 = 2;
$v2 = isset($s2);


$s3 = false;
$v3 = isset($s3);

$s4 = "";
$v4 = isset($s4);

$s5 = null;
$v5 = isset($s5);

echo "v1 = {$v1} <hr/>";
echo "v2 = {$v2} <hr/>";
echo "v3 = {$v3} <hr/>";
echo "v4 = {$v4} <hr/>";
echo "v5 = {$v5} <hr/>";

echo var_dump($v5) . "<hr/>";

?>


</body>
</html>