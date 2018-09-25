<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php

/*
设计一个类：mysql数据库操作类
设计目标：
1，该类一实例化，就可以自动连接上mysql数据库；
2，该类可以单独去设定要使用的连接编码（set  names  XXX）
3，该类可以单独去设定要使用的数据库（use  XXX）；
4，可以主动关闭连接；
*/

/*
设计一个类：mysql数据库操作类
设计目标：
1，该类一实例化，就可以自动连接上mysql数据库；
2，该类可以单独去设定要使用的连接编码（set  names  XXX）
3，该类可以单独去设定要使用的数据库（use  XXX）；
4，可以主动关闭连接；
*/

class MySQLDB
{
    public $link = null;

    function __construct($host, $port, $user, $pass, $charset, $dbname)
    {
        $this->link = @mysql_connect("$host:$port", "$user", "$pass") or die("数据库连接失败!");
        mysql_query("set names utf8;");
        mysql_query("use $dbname");
    }

    //设定要使用连接编码
    function setCharset($charset)
    {
        mysql_query("$charset");
    }

    //可以设定要使用的数据库
    function seleteDB($dbname)
    {
        mysql_query("use $dbname");
    }

    //可关闭连接
    function closeDB()
    {
        mysql_close($this->link);
    }
}

$host = "localhost";
$port = 3306;
$user = "root";
$pass = "123456";
$charset = "utf8";
$dbname = "php39";

$db1 = new MySQLDB($host, $port, $user, $pass, $charset, $dbname);

//测试是否连接成功
$result = mysql_query("select * from tab_int;");
var_dump($result);
$rec = mysql_fetch_array($result);
echo "<hr />";
echo $rec['pro_name'];

//关闭测试连接
$db1->closeDB();
$result = @mysql_query("select * from tab_int");
var_dump($result);

?>
</body>
</html>