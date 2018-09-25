<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>shiwu</title>
</head>
<body>
<?php
/**
 * 在PHP上实现事务的使用
 */


//创建连接
$link = mysql_connect('localhost', 'root', '123456');
if (!$link) {
    echo '连接数据库失败' . mysql_error($link);
    exit();
}
mysql_query("set names utf8;");//选定php与mysql交互的语言
mysql_query("use php39;");//使用PHP39数据库
mysql_query("start transaction;");//开启事务,在后面如果没有提交的话，那么也是不会成功写入数据的

//开始插入数据
$sql = "insert into tab_int3 (f1,f2) values (15,25)";
$result1 = mysql_query($sql);

$sql = "insert into tab_int3 (f1,f2) values (155,'ty')";
$result2 = mysql_query($sql);//这里会报错，原因是tinyint 在unsigned状态下，只支持到255

if ($result1 && $result2) {
    mysql_query("commit;");
    echo "插入数据成功，事务执行成功.";
}else{
    mysql_query("rollback;");
    echo "插入数据失败，事务执行失败.";
}


?>
</body>
</html>