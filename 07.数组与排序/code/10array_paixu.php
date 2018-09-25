<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
//演示sort()排序
echo "sort()的返回的数组的之前的下标是会取消的，会重新使用索引来进行辨认";
$arr1 = array(1 => 3, 'a1' => 11, 3 => 5, "mn" => 18, 88 => 2);
echo "排序前:";
show_arr($arr1);
sort($arr1);
echo "排序后:";
show_arr($arr1);

echo "<hr/>";

//演示asort()排序
echo "asort()的返回的数组的之前的下标是会保留的";
$arr2 = array(1 => 3, 'a1' => 11, 3 => 5, "mn" => 18, 88 => 2);
echo "排序前:";
show_arr($arr2);
asort($arr2);
echo "排序后:";
show_arr($arr2);





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