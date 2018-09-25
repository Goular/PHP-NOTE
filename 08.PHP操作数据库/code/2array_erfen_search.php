<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
//二分查找的必要条件
//1.必须是排序好的数组
//2.必须是索引数组

$a = array(1, 3, 11, 18, 19, 22, 25, 33, 34, 38, 44, 55, 56, 58, 60, 61, 66, 70, 77, 88, 90, 91, 93, 95, 98);
$search = 33;    //要找的数据
$len = count($a);    //数量，自然，最大下标是len-1

//函数功能：从数组$arr中的位置$begin开始到位置$end之间找数据$s
function binary_search($arr, $s, $begin, $end)
{
    $mid = floor(($begin + $end) / 2);    //定位中间的位置
    $mid_value = $arr[$mid];    //取得中间项的值；
    if ($mid_value == $s) {
        return true;
    } else if ($mid_value > $s) {
        if ($begin > $mid - 1) {//如果开始位置都比结束位置大了，表示肯定找不到了
            return false;
        }
        //中间项比要找的$s大，就去左边找吧：
        $re = binary_search($arr, $s, $begin, $mid - 1);
    } else {
        if ($mid + 1 > $end) {//如果开始位置都比结束位置大了，表示肯定找不到了
            return false;
        }
        //中间项比要找的$s小，就去右边找吧：
        $re = binary_search($arr, $s, $mid + 1, $end);
    }
    return $re;
}

//使用binary_search()函数从$a中的0到len-1位置找$search
$v1 = binary_search($a, $search, 0, $len - 1);
echo "结果为：";
var_dump($v1);

?>
</body>
</html>