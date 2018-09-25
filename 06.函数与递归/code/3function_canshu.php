<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
//函数默认值的使用
function f1($x = 3, $y = 4)
{
    $s = $x * $x + $y * $y;
    $result = sqrt($s);
    return $result;
}

$v1 = f1(30, 40);
$v2 = f1(30);
$v3 = f1();


function f2($a, $b = 3, $c = 'abc')
{
    echo '<br/>这是只是演示多个形参，部分有默认值情况';
    echo "a={$a},b={$b},c={$c}";
}

echo '<hr/>';

f2(1);
f2(1, 2);
f2(1, 2, 'xyz');
f2();

////演示形参的引用传递问题
function f3($a, &$b)//注意区分引用传递，与值传递的关系，函数的调用，一般没有"&符号"的，都是值传递，函数内部改变的数是在外部的数是不会被改变的
{
    $a = $a * $a;
    $b = $b * $b;
    return $a + $b;
}

//$v1 = f3(3, 4);

$s1 = 3;
$s2 = 4;
$v2 = f3($s1, $s2);
echo "<br /><br />v2 = $v2";
echo "<br />此时：s1 = $s1, s2 = $s2";

//定义一个没有形参的函数,利用函数可以传入各种各样的参数，不一定必须要定义好，这是脚本语言的特点
//func_get_arg($i)：	获取第i个实参值
//func_get_args()：	获取所有实参（结果是一个数组）
//func_num_args()：	获取所有实参的个数。
echo '<hr/>';
echo '<hr/>';
echo '<hr/>';

function f4()
{
    $arr = func_get_args();//返回的是填入参数的数组
    $number = func_num_args();//返回的是实参的个数
    echo "<p>函数f4被调用,实参个数是：" . $number;
    echo "<p>函数f4被调用，其实参为：";
    foreach ($arr as $value) {
        echo "<br/>参数是:,值是：{$value}";
    }
}

f4(1, 2, 3, 'x', 'xyq');
f4('aa', 'bbb', 'ttt');


?>
</body>
</html>