<?php
header("Content-Type:text/html;charset=UTF-8");

//求一个一维数组的平均值：
$arr = array(1, 11, 111, 1111, 11111, 111111);
$len = count($arr);
$sum = 0;
$c = 0;
for ($i = 0; $i < $len; ++$i) {
    $sum += $arr[$i];
    ++$c;
}
echo "<br/>平均值为:" . ($sum / $c);

echo "<hr/>";

//求一个二维数组的平均值：
$dd = array(
    array(1, 11, 111, 1111, 11111, 111111),
    array(2, 22, 222, 2222, 22222, 222222),
    array(3, 33, 333, 3333, 33333, 333333, 3333333)
);
$len = count($dd);
$sum = 0;
$c = 0;
for ($i = 0; $i < $len; ++$i) {
    $temp = $dd[$i];
    $len2 = count($temp);
    for ($k = 0; $k < $len2; ++$k) {
        $sum += $temp[$k];
        ++$c;
    }
}
echo "<br/>平均值:" . ($sum / $c);

echo "<hr/>";

//求一个一维数组的最大值，及其对应下标：
$arr3 = array(13, 8, 5, 11, 22, 2);
$max = $arr3[0];
$pos = 0;
$len = count($arr3);

for ($i = 0; $i < $len; ++$i) {
    if ($arr3[$i] > $max) {
        $max = $arr3[$i];
        $pos = $i;
    }
}
echo "<br />最大值为：" . ($max) . "，其下标为：$pos";

echo "<hr/>";

//求交换一个一维数组的最大值和最小值的位置：
$arr4 = array(13, 38, 5, 11, 22, 2);
echo "<br /><pre>交换之前：";
print_r($arr4);
echo "</pre>";

$max = $arr4[0];
$pos = 0;
$pos2 = 0;
$min = $arr4[0];
$len = count($arr4);
for ($i = 0; $i < $len; ++$i) {
    if ($arr4[$i] > $max) {
        $max = $arr4[$i];
        $pos = $i;
    }
    if ($arr4[$i] < $min) {
        $min = $arr4[$i];
        $pos2 = $i;
    }
}
echo "<br />最大值为：" . ($max) . "，其下标为：$pos";
echo "<br />最小值为：" . ($min) . "，其下标为：$pos2";
//然后才开始交换：
$t = $arr4[$pos];
$arr4[$pos] = $arr4[$pos2];
$arr4[$pos2] = $t;
echo "<br /><pre>交换之后：";
print_r($arr4);
echo "</pre>";