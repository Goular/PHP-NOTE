<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php

echo "<p>使用相对路径进行载入:</p>";
include('./page1.php');

echo "<p>使用绝对路径载入(方法1)</p>";
//使用绝对路径的时候，千万真的不要直接写真实路径，而是应该使用魔术常量__DIR__ ,或者时预定义常量$_SERVER的特殊属性进行处理
include(__DIR__ . '/page1.php');


echo "<p>使用绝对路径载入(方法2)</p>";
//使用绝对路径的时候，千万真的不要直接写真实路径，而是应该使用魔术常量__DIR__ ,或者时预定义常量$_SERVER的特殊属性进行处理
include($_SERVER['DOCUMENT_ROOT'] .'/PHP_Learning/day5'. '/page1.php');

?>
</body>
</html>