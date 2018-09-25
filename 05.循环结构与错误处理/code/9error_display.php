<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>


<!--显示或隐藏错误日志的办法-->
<!--1.修改php.ini内容 display_error=off/On,值得注意的是，这个是一个全局的操作，这样所有的错误都会隐藏，不能个性化，此时，第二种办法会比较好-->
<!--2.使用php的内置函数 ini_set('display_error','true 1/false 0')-->

<?php
//设置是否显示异常的内容
ini_set('display_errors', 0);
//设置是否记录到日志,如果是syslog，则会写入到php的日志中，否则自己写的文件名，会保留在本地
ini_set('error_log', 'mylog.txt');
ini_set('error_log', 'syslog');

echo "<br />aaa";
echo $v1;    //使用不存在的变量
echo C1;    //使用不存在的常量
echo "<br />bbb";
include './no_this_file.php';
echo "<br />ccc";
?>

</body>
</html>