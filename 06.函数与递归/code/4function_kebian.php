<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
function f1()
{
    echo "<br/>这是一个普通的函数而已！";
}

//可变函数其实就是在调用函数的时候，使用一个变量名而已。
//该变量的内部，就是该函数名！
function jpg()
{
    echo "<br />处理jpg图片";
}

function png()
{
    echo "<br />处理png图片";
}

function gif()
{
    echo "<br />处理gig图片";
}

$file = "abc.png";

$houzhui = strrchr($file, ".");//获取尾缀的内容

$houzhui = substr($houzhui, 1);//去除"."

$houzhui();
?>
</body>
</html>