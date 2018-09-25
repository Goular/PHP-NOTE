<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
/**
 * 含义：
 * 序列化：
 * 就是将一个变量所代表的“内存”数据，转换为“字符串”形式并持久保存在硬盘上的一种做法。
 * 反序列化：
 * 就是将序列化之后保存在硬盘上的“字符串数据”，恢复为其原来的内存形式的变量数据的一种做法。
 */

$v1 = 1;
$v2 = 'abc';
$v3 = false;
$v4 = array(42, 86, 1.12);

//首先就是要把变量变为字符串
/**
 * serialize() 返回字符串，此字符串包含了表示 value 的字节流
 */
$str1 = serialize($v1);
$str2 = serialize($v2);
$str3 = serialize($v3);
$str4 = serialize($v4);

//执行序列化的操作后，就可以直接进行保存到文件的操作了
file_put_contents('./file1.txt', $str1);
file_put_contents('./file2.txt', $str2);
file_put_contents('./file3.txt', $str3);
file_put_contents('./file4.txt', $str4);


?>
</body>
</html>