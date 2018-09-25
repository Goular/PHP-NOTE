<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php

//任意给定2个数字，表示年份和月份
//输出该年该月的天数：
$year = 2016;
$month = 2;

//方法1：常规做法，但是有一些分支是在做“重复的事”
switch ($month) {
    case 1:
        echo "31天";
        break;
    case 3:
        echo "31天";
        break;
    case 5:
        echo "31天";
        break;
    case 7:
        echo "31天";
        break;
    case 8:
        echo "31天";
        break;
    case 10:
        echo "31天";
        break;
    case 12:
        echo "31天";
        break;
    case 4:
        echo "30天";
        break;
    case 6:
        echo "30天";
        break;
    case 9:
        echo "30天";
        break;
    case 11:
        echo "30天";
        break;
    case 2:
        //年份数字能被4整除并且不能被100整除，
        //或者能被400整除，都是闰年
        if ((($year % 4 == 0) && ($year % 100 != 0)) || ($year % 400 == 0)) {    //$year 是闰年
            echo "29天";
        } else {
            echo "28天";
        }
        break;

}

switch ($month) {
    case 1:
    case 3:
    case 5:
    case 7:
    case 8:
    case 10:
    case 12:
        echo "31天";
        break;
    case 4:
    case 6:
    case 9:
    case 11:
        echo "30天";
        break;
    case 2:
        //年份数字能被4整除并且不能被100整除，
        //或者能被400整除，都是闰年
        if ((($year % 4 == 0) && ($year % 100 != 0)) || ($year % 400 == 0)) {    //$year 是闰年
            echo "29天";
        } else {
            echo "28天";
        }
        break;
}
?>
</body>
</html>