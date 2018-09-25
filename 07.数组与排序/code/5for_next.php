<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

<?php
//需求：使用for循环和next()函数，遍历以下数组（输出其下标和对应值)：
$arr = array(1 => 3, 'a1' => 11, 3 => 5, "mn" => 18, 88 => 2);
$len = count($arr);
for ($i = 0; $i < $len; ++$i) {
    $key = key($arr);
    $value = current($arr);
    echo "<br/>$key=>$value";
    next($arr);//当对“当前项”的数据处理完毕，就将指针后移一位
}
echo "<hr/>";
$key = key($arr);
$value = current($arr);
echo "当前指针已经到最后的一个在前进一步，此时key为NULL,value为false;";
echo "<br/>此时(遍历之后),\"键为\":";
var_dump($key);
echo "<br/>此时(遍历之后),\"值为\":";
var_dump($value);

echo "<hr/>";


?>
</body>
</html>