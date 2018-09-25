<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
//array list ( mixed $varname [, mixed $... ] )
//像 array() 一样，这不是真正的函数，而是语言结构。list() 用一步操作给一组变量进行赋值。


//这是一个数组：其中有整数数字下标：
$c = array(0 => 0, 1 => 11, 3 => 33, 2 => 22);
list($v1) = $c;
list($s1, $s2) = $c;
list($m1, $m2, $m3) = $c;

echo "<br/>v1 = $v1";
echo "<br/>s1 = $s1,s2 = $s2";
echo "<br/>m1 = $m1,m2 = $m2,m1 = $m3";

$arr1 = array(
    1 => 5,
    'value' => 5,
    0 => 2,
    'key' => 4
);


//这个列子说明的是我们的list中的变量与数组中的key是没有关系的，list()只是把索引按照顺序来进行输出到需要填充的变量上
list($key, $value) = $arr1;
echo "<hr/>key = $key,value = $value";//这里获取的是数组下标为0和下标为1的内容
//这里输出的是2,5 (即相关内容的索引0和索引1)

?>
</body>
</html>