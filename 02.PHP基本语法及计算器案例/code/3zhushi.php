<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>注释的使用</title>
</head>

<!--作用:注释的使用-->
<body>
<?php
//方法一:单行注释
//下面所使用的的是单行注释
//echo "<br />代码1";
//echo "<br />代码2";
//echo "<br />代码3,代表多行需要注释的代码";

/**
 * 方法二:多行注释
 * 这是一个多行注释
 */

//方法三是一种代码形式的注释，就是设定一个变量值，以变量值作为是否执行注释的依据
if (1 == 1) {
    echo "<br />代码1";
    echo "<br />代码2";
    echo "<br />代码3,代表多行需要注释的代码";
}


?>
</body>
</html>