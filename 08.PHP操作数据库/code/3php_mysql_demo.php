<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
//通常，php网页中完成有关数据库的操作，首先，需要如下代码：
//$link = mysql_connect(“数据库服务器地址”,”用户名”,”密码”);

//连接数据库系统
$link = mysql_connect('localhost', 'root', '123456');
//mysql_query(“set  names  网页文件编码名”);		//设定“连接编码”；
//设定客户端的字符集
mysql_query('set names utf8');

//mysql_query(“use  数据库名”);		//选定要使用的数据库
mysql_query('use php39');

//然后，才开始正式执行要完成的数据库操作任务（语句）：
//$result  =  mysql_query(“select /  delete  /update  / insert  /  desc  /  show  tables  /drop  .......”);


$num = rand(0, 355);
$sql = "insert into tab_int2(f1,f2,f3) values (123,$num,123);";
$result = mysql_query($sql);

if ($result == false) {
    echo "执行失败，请参考" . mysql_error();
} else {
    echo "执行成功";
}

?>
</body>
</html>