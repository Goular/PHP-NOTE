<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php

class C1
{
    var $p1 = 1;
}

$v1 = 1;
$v2 = $v1;//普通变量的值传递
$v1++;
echo "<br/>v1 = $v1,v2 = $v2";//2和1

$o1 = new C1();
$o2 = $o1; //使用的是值传递，值传递会复制一份对象的编号到$o2中
$o1->p1 = 2;


$o3 = new C1();
$o4 = &$o3;//引用传递，将$o4的指针指向$o3所指向的位置，并跟着$o3的变化而变化
$o3->p1 = 2;
echo "<br />o3->p1={$o3->p1}, o4->p1={$o4->p1}";//2和2

?>
</body>
</html>