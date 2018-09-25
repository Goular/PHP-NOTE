<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
//定义访问的资料
$dsn = "mysql:host=localhost;port=3306;dbname=php39";
//定义字符集，防止SQL注入攻击
$opt = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8');
//创建PDO对象
$pdo = new PDO($dsn, 'root', '123456', $opt);
var_dump($pdo);

$sql = "select * from tab_int2 limit 0, 3";
$statement = $pdo->query($sql);
$arr1 = $statement->fetch(PDO::FETCH_ASSOC);//返回关联数组
$arr2 = $statement->fetch(PDO::FETCH_NUM);//返回索引数组
$arr3 = $statement->fetch(PDO::FETCH_BOTH);//两种都有
$arr4 = $statement->fetch();//与fetch(PDO::FETCH_BOTH)相同

echo "<hr/>";
echo "<pre>";
echo "关联数组<br/>";
var_dump($arr1);
echo "</pre>";

echo "<hr/>";
echo "<pre>";
echo "索引数组<br/>";
var_dump($arr2);
echo "</pre>";

echo "<hr/>";
echo "<pre>";
echo "both数组<br/>";
var_dump($arr3);
echo "</pre>";

echo "<hr/>";
echo "<pre>";
echo "默认不填的数组<br/>";
var_dump($arr3);
echo "</pre>";

?>
</body>
</html>