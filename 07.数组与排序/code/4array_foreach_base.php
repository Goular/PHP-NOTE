<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
//数组的指针方法
//current();//获取的是当前的指针的value
//key();//获取的是当前的指针的key
//next();//获取当前指针的下一个指针的value，并把指针移动到下一点
//prev();//获取当前指针的上一个指针的value，并把指针移动到上一点
//end();//获取到数组的最后一个可用指针点的value，配合key()即可获取最后一个元素的索引或者关联名称
//reset();//重置数组的指针，设置值到数组的头部第一个节点，获取它的value

$arr4 = array(1 => 3, 'a1' => 11, 3 => 5, "mn" => 18, 88 => 2);
$v1 = current($arr4);
$v2 = key($arr4);
echo "<br />初始，单元的下标和值分别为：$v2,$v1";

echo "<hr/>";

$v3 = next($arr4);//移动到下一个，然后获取到其值
$v4 = key($arr4);//获取当前的key
echo "<br />然后，现在当前单元的下标和值分别为：$v4,$v3";

echo "<hr/>";
next($arr4);//后移一位；
next($arr4);//后移一位；
next($arr4);//后移一位；

//目前到达末尾
$v3 = current($arr4);    //移动到下一个，然后获得其值；
$v4 = key($arr4);    //
echo "<br />连移3次next后，则当前单元的下标和值分别为：$v4,$v3";

echo "<hr/>";

//到达末尾后，继续往前走，此时内容为NULL
next($arr4);
$v3 = current($arr4);
$v4 = key($arr4);

var_dump($v4);//key为NULL
echo "<br/>";
var_dump($v3);//value为bool(false);若是遍历的话，遇到false，马上停止
echo "<br />然后，现在当前单元的下标和值分别为：$v4,$v3";

echo "<hr/>";

$arr5 = array(1 => 3, 'a1' => 11, 3 => 5, "mn" => 18, 88 => 2);
foreach ($arr5 as $key => $value) {
    echo "<br/>$key => $value";
}

$k = key($arr5);
$v = current($arr5);

echo "<br />此时（遍历之后）,“位置”为：";
var_dump($k);
echo "<br />此时（遍历之后）,对应“值”为：";
var_dump($v);

echo "<hr/>";

$arr6 = array(1 => 3, 'a1' => 11, 3 => 5, "mn" => 18, 88 => 2);
foreach ($arr6 as $key => $value) {
    echo "<br/>$key => $value";
}
$v = reset($arr6);
$k = key($arr6);

$v = next($arr6);
$k = key($arr6);

$v = next($arr6);
$k = key($arr6);

$v = prev($arr6);
$k = key($arr6);

echo "<br />此时（遍历之后）,“位置”为：";
var_dump($k);
echo "<br />此时（遍历之后）,对应“值”为：";
var_dump($v);

echo "<hr/>";

$v = end($arr6);
$k = key($arr6);

echo "<br />此时（遍历之后）,“位置”为：";
var_dump($k);
echo "<br />此时（遍历之后）,对应“值”为：";
var_dump($v);

?>
</body>
</html>