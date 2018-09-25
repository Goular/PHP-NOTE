<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php
//最基本for循环语句
for($i = 1; $i <= 9;  ++$i){
    echo $i;
    echo "<br />";
}

echo "<hr />";
//嵌套循环语句
for($i = 1; $i <= 9;  ++$i){
    //这里，可以看做是“输出一行”
    //一行输出若干个“*”
    for($k = 1; $k <= $i; ++$k){
        echo "*";
    }
    echo "<br />";	//一行结束（换行）
}

//嵌套循环语句小应用：99乘法表
echo "<pre>";
for($i = 1; $i <= 9;  ++$i){
    //这里，可以看做是“输出一行”
    //一行输出若干个“*”
    for($k = 1; $k <= $i; ++$k){
        //echo "3 x 4 = 12";//要输出类似等式
        echo "$i x $k = " . ($i*$k) . "\t";
    }
    echo "<br />";	//一行结束（换行）
}
echo "</pre>";
?>
</body>
</html>