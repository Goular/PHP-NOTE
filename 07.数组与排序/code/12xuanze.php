<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
//选择排序
$a = array(9, 3, 5, 8, 2, 7);    //下标为0,1,2,3,4,5
/*
规律描述：
１，假设数组的数据有ｎ个。
２，要进行查找最大值单元并进行交换的“趟数”为ｎ－１；
3，每一趟都要求出“剩余数据”中的最大值单元，并且，剩余数据的数量每一趟都少1个，第一趟有n个。
4，每一趟找出最大值单元后，都要进行交换：最大值单元，跟剩余数据中的最后一个单元交换。
*/
echo "<br/>";
echo "排序前:";
show_arr($a);

$len = count($a);
echo "数组的长度是::" . $len;

for ($i = 0; $i < $len - 1; ++$i) {
    $max = $a[0];
    $pos = 0;
    for ($k = 0; $k < $len - $i; ++$k) {
        if ($a[$k] > $max) {
            //交换数据
            $max = $a[$k];
            $pos = $k;
        }
    }
    $t = $a[$pos];
    $a[$pos] = $a[$len - $i - 1];
    $a[$len - $i - 1] = $t;
}


echo "<br/>";
echo "排序后:";
show_arr($a);

function show_arr($arr)
{
    echo "<br/>";
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}

?>
</body>
</html>