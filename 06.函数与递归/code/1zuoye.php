<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
//第一题：
$arr = array("E_ERROR", "E_WARNING", "E_PARSE", "E_NOTICE", "E_CORE_ERROR", "E_CORE_WARNING", "E_COMPILE_ERROR", "E_COMPILE_WARNING", "E_USER_ERROR", "E_USER_WARNING", "E_USER_NOTICE", "E_STRICT", "E_ALL");

function zhuanhuan($n)
{
    $s = decbin($n);
    $s = str_pad($s, 16, "0", STR_PAD_LEFT);
    $s = str_replace("1", "<span style='color: red'>1</span>", $s);
    return $s;
}

echo "<table border='1' width='600'>";
foreach ($arr as $key => $value) {
    echo "<tr>";
    echo "<td>${value}</td>";
    echo "<td>" . constant($value) . "</td>";
    echo "<td>" . zhuanhuan(constant($value)) . "</td>";
    echo "</tr>";
}
echo "<tr>";
echo "<td>E_ALL|E_STRICT</td>";
echo "<td>" . (E_ALL | E_STRICT) . "</td>";
echo "<td>" . zhuanhuan(E_ALL | E_STRICT) . "</td>";
echo "</tr>";
echo "</table>";

/*
写一个表单，可以输入一个数字，提交后判断该数字是否是一个“素数”。
如果是，就输出“数字xx是素数”，否则就输出“数字xx不是素数”。
提示：素数的概念（含义）是：只能被1和它自己本身整除——在大于1的整数范围内。
*/
if (!empty($_POST['number'])) {
    $n = $_POST['number'];
    $c = 0;//用于记录能被整除的个数！——计数
    for ($i = 1; $i <= $n; ++$i) {
        if ($n % $i == 0) {
            $c++;
        }
    }
    if ($c == 2) {
        echo "{$n}是素数";
    } else {
        echo "{$n}不是素数";
    }

}

?>
<form action="" method="post">
    <input type="text" name="number"/>
    <input type="submit" value="判断"/>
</form>

</body>
</html>