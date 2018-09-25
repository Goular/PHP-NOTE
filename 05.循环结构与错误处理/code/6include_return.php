<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<?php

include "./page2.php";
$v1 = include_once "./page2.php";
echo "<br/>";
var_dump($v1);//在成功加载后没有进行其他返回的的话，默认将会返回一个布尔值

$v2 = include "./no_this_page.php";//加载不存在的文件，看返回的内容
echo "<br/>";
var_dump($v2);//返回的是warning，不是error,return返回的内容是false；即加载不成功

echo "<hr/>";
$v3 = include_once "./page3.php";
echo "<br/>";
var_dump($v3);//返回回来的内容是:NULL

echo "<hr/>";
$v3 = include_once "./page3.php";
echo "<br/>";
var_dump($v3);//返回回来的内容是:NULL


echo "<hr/>";
$v4 = include_once "./page4.php";
echo "<br/>";
echo "1111111111";
echo "<br/>";
var_dump($v4);//返回回来的内容是:NULL

?>

</body>
</html>