<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
//使用while和eache和list配合来遍历该数组
//list()函数用于一次性取得一个数组中从0开始的数字下标的多个单元的值！
//形式：
//list($变量1，$变量2，$变量3， .. ） = $数组；
//作用：
//上述一行代码相当于如下代码：
//$变量1 = $数组[0];
//$变量2 = $数组[1];
//$变量3 = $数组[2];

//while+each()+list()遍历数组
//使用while和eache和list配合来遍历该数组
$arr4 = array(1 => 3, 'a1' => 11, 3 => 5, "mn" => 18, 88 => 2);
while (list($key, $value) = each($arr4)) {//几乎是模式化的写法
    //这里就可以处理$key和value了
    echo "<br/>$key = $value";
}

//对比foreach的原始遍历语法：
echo "<hr/>";

$arr5 = array(1 => 3, 'a1' => 11, 3 => 5, "mn" => 18, 88 => 2);
foreach ($arr4 as $key => $value) {
    echo "<br/>$key = $value";
}


?>
</body>
</html>