<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
require("./MySQLDB.class.php");

$config = array(
    'host' => "localhost",
    'port' => 3306,
    'user' => "root",
    'pass' => "123456",
    'charset' => "utf8",
    'dbname' => "php39"
);

$db1 = new MySQLDB($config);

$v1 = rand(0, 100);

$sql = "insert into tab_int2(f1,f2,f3) VALUES ($v1,14,16);";
$db1->exec($sql);
echo "执行插入语句成功<br/>";

$sql = "select * from user_list limit 1,2;";
$user = $db1->getOneRow($sql);

echo "<br />用户ID为：" . $user['user_id'];
echo "<br />用户名：" . $user['user_name'];
echo "<br />年龄：" . $user['age'];
echo "<br />学历：" . $user['edu'];
echo "<br />兴趣：" . $user['xingqu'];
?>
</body>
</html>