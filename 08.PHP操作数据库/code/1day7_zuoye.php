<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
//.求一个整数数组中的最小的奇数，如果没有奇数，则直接输出“没有奇数”，否则输出该数。
$a = array(11, 13, 1, 8, 9, 33);
$jishu_arr = array();    //空数组，准备用于存放所有奇数
foreach ($a as $key => $value) {
    if ($value % 2 == 1) {
        $jishu_arr[] = $value;
    }
}
if (count($jishu_arr) == 0) {
    echo "数组中不存在奇数.";
} else {
    //找奇数的最小值
    $min = $jishu_arr[0];
    foreach ($jishu_arr as $value) {
        if ($value < $min) {
            $min = $value;
        }
    }
    echo "最小奇数为:${min}";
}


?>
</body>
</html>