<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<!--第六天作业-->
<?php
/*
利用上一道题的逻辑思路，写一个函数，该函数能够判断一个数字是否是一个素数
（是就返回true，否则就返回false）。再利用该函数，输出2-200之间的所有素数。
*/
function panduan($n)
{
    $c = 0;//用于记录能被整除的个数.
    for ($i = 1; $i <= $n; ++$i) {
        if ($n % $i == 0) {
            $c++;//计数，就是数能整除的个数
        }
    }
    if ($c == 2) {
        return true;
    } else {
        return false;
    }
}

echo "2-200之间的素数有:";
for ($i = 2; $i <= 200; ++$i) {
    if (panduan($i) == true) {
        echo "<br/>{$i}";
    }
}

function runnain($n)
{
    if ($n % 4 == 0 && $n % 100 != 0 || $n % 400 == 0) {
        return true;
    } else {
        return false;
    }
}

/*
〉〉，
写一个函数，该函数可以将给定的任意个数的参数以指定的字符串串接起来成为一个长的字符串。该函数带2个或2个以上参数，其中第一个参数是用于将其他参数进行串联的连接字符串。比如调用该函数：
chuanlian(“-”, “ab”, “cd”, 123);	//得到结果为字符串：”ab-cd-123”
*/
function chuanlian()
{
    $arr = func_get_args();//获取所有的实参
    $s1 = $arr[0];//用于串接符
    $len = count($arr);//获取数组的长度
    $str = "";
    for ($i = 1; $i < $len; ++$i) {
        if ($i == $len - 1) {
            $str .= $arr[$i];
        } else {
            $str .= $arr[$i] . $s1;
        }
    }
    return $str;
}

$str = chuanlian('-', "ab", "cd", 123);
echo "<hr />串联后结果为：$str";

/*
〉〉，
数列如下：【1】，【2】，3，6，9，18，27… ，求第20项的值是多少？
（注意，规律就是第n个数是第n-2个数的3倍，已知第一个是1，第二个是2）。
*/

//方法1：
function shulie1($n)
{
    if ($n == 1) {
        return 1;
    } else if ($n == 2) {
        return 2;
    } else {
        $re = shulie1($n - 2) * 3;
        return $re;
    }
}

$v1 = shulie1(20);
echo "<hr />20项是" . $v1;

//方法2：
function shulie2($n)
{
    $qian1 = 1;
    $qian2 = 2;
    for ($i = 3; $i <= $n; ++$i) {
        $result = $qian1 * 3;
        $qian1 = $qian2;
        $qian2 = $result;
    }
}

$v1 = shulie1(20);
echo "<hr />方法2：20项是" . $v1;

/*
猴子吃桃问题：
有一堆桃子，猴子第一天吃了其中的一半，并再多吃了一个！
以后每天猴子都吃其中的一半，然后再多吃一个。
当到第十天时，想再吃时（即还没吃），发现只有1个桃子了。
问题：最初共多少个桃子？
分析：
天		数量
10		1
9		(1+1)*2=4
8		(4+1)*2=10
7		(10+1)*2=22
。。。。。。
第n天   （第n+1天的个数+1）*2
（可用递归法和递推法完成）
*/
echo "<hr />";
//方法1：递归
function taozi1($n)
{
    if ($n == 10) {
        return 1;
    } else {
        $re = (taozi1($n + 1) + 1) * 2;
        return $re;
    }
}

echo "<br />第1天桃子数为：" . taozi1(1);
echo "<br />第4天桃子数为：" . taozi1(4);

function taozi2($n)
{
    $qian = 1;
    for ($i = 9; $i >= $n; --$i) {
        $result = ($qian + 1) * 2;
        $qian = $result;
    }
    return $result;
}

echo "<hr/>";

echo "<br />第1天桃子数为：" . taozi2(1);
echo "<br />第4天桃子数为：" . taozi2(4);

?>

</body>
</html>