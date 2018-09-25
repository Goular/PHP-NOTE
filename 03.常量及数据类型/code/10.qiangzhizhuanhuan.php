<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<!--强制转换-->
<?php
$v1 = 123;
$s1 = (float)$v1;//这里是将我们的变量v1取出后添加后变更类型值传递到变量s1进行保存
$s2 = (string)$v1;
$cctv = gettype($s2);
echo $cctv . "<br/>";//string
echo 'v1的数据类型' . var_dump($v1) . "<br/>";//int(123) v1的数据类型
echo 's1的数据类型' . var_dump($s1) . "<br/>";//float(123) s1的数据类型
echo 's2的数据类型' . var_dump($s2) . "<br/>";//string(3) "123" s2的数据类型


//下面是重点方法
//方法二，上面的方法仅仅将强转后的变量赋予给变量b，原本的变量本身并没有改变
$v3 = 12345667;
settype($v3, "float");
echo 'v3的1数据类型' . var_dump($v3) . "<br/>";
settype($v3, "string");
echo 'v3的2数据类型' . var_dump($v3) . "<br/>";

?>


</body>
</html>