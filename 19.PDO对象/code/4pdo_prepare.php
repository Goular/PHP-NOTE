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


echo "<hr/>预处理的展示::";

/**
 * 防止SQL注入攻击的statement语句预处理
 */
$sql = "select user_id, user_name, age,edu from user_list where user_id= ? and user_name = ? ";
$stmt = $pdo->prepare($sql);
//下面使用的是占位符，数字占位,todo:注意占位符的标志从1开始
$stmt->bindValue(1, 6);//占位符按自然顺序，从1开始
$stmt->bindValue(2, 'user2');//第2项给值为“user2”；
$stmt->execute();
$arr = $stmt->fetch(PDO::FETCH_ASSOC);

echo "<hr/>";
echo "<pre>";
echo "?绑定关联参数<br/>";
var_dump($arr);
echo "</pre>";


$sql = "select user_id, user_name, age,edu from user_list where user_id= :v1 and user_name = :v2 ";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':v1', 6);
$stmt->bindValue(':v2', 'user2');
$stmt->execute();
$arr = $stmt->fetch(PDO::FETCH_ASSOC);

echo "<hr/>";
echo "<pre>";
echo ":v1,:v2绑定请求的参数<br/>";
var_dump($arr);
echo "</pre>";
?>
</body>
</html>