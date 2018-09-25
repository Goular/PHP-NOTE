<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
//冒泡排序
$a = array(9, 3, 5, 8, 2, 7);    //下标为0,1,2,3,4,5
/*
规律描述：
１，假设数组的数据有ｎ个。
２，要进行比较的“趟数”为ｎ－１；
３，每一趟要比较的数据个数都比前一趟少一个，第一趟要比较ｎ个（即比较ｎ－１次）
４，每一次比较，如果发现“左边数据”大于“右边数据”，就对这两者进行交换位置。
*/
echo "排序前:";
show_arr($a);

$len = count($a);
for ($i = 0; $i < $len - 1; ++$i) {
    for ($j = 0; $j < $len - $i - 1; ++$j) {
        if ($a[$j] > $a[$j + 1]) {
            $t = $a[$j];
            $a[$j] = $a[$j + 1];
            $a[$j + 1] = $t;
        }
    }
}


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