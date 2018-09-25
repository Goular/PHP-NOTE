<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
//使用该数组来演示each()的含义和使用方法：
$arr4 = array(
    1 => 3,
    'a1' => 11,
    3 => 5,
);
//array each ( array &$array )
//返回数组中当前的键／值对并将数组指针向前移动一步
//键值对被返回为四个单元的数组，键名为0，1，key和 value。单元 0 和 key 包含有数组单元的键名，1 和 value 包含有数据。
$result1 = each($arr4);
echo "<br/>result1为:<pre>";
print_r($arr4);
echo "</pre>";


$result1 = each($arr4);
echo "<br/>result2为:<pre>";
print_r($arr4);
echo "</pre>";


?>
</body>
</html>