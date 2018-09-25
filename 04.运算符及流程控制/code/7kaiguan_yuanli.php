<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<?php

define("D1", 1);
define("D2", 2);
define("D3", 4);
define("D4", 8);
define("D5", 16);

$state = 10;

if (($state & constant('D1')) > 0) {
    echo "<br/>灯1是亮的";
} else {
    echo "<br/>灯1是灭的";
}

//需求1b：请输出灯泡2的状态；
if (($state & constant('D2')) > 0) {
    echo "<br/>灯2是亮的";
} else {
    echo "<br/>灯2是灭的";
}


//做一个所有灯的整体显示：
function showAll()
{
    echo '<p>';

    for ($i = 1; $i <= 5; ++$i) {
        $s = 'D' . $i;
        if (($GLOBALS['state'] & constant($s)) > 0) {
            echo "<br/>灯{$i}是亮的";
        } else {
            echo "<br/>灯{$i}是灭的";
        }
    }

    echo '</p>';
}

echo "<br />初始所有灯的状态：";
showAll();

//需求2b：请打开灯5：
$state = $state | constant('D5');
echo "<br />灯5打开后：";
showAll();


//需求3,  可以关闭指定的任意一个灯泡
//也只要按照如下算法就可以打开：
//$state = $state & (~对应灯的常量值);
//需求3a：请关闭灯2：
$state = $state & (~constant('D2'));
echo "<br />灯2关闭后：";
showAll();
//需求3b：请关闭灯5：
$state = $state & (~constant('D5'));
echo "<br />灯5关闭后：";
showAll();

//需求3c：请关闭灯1（其实该灯本来就是关的）：
$state = $state & (~constant('D1'));
echo "<br />灯1关闭后：";
showAll();

?>

</body>
</html>