<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
/**
 * 禁止对象的克隆功能
 */
require_once './MySQLDB.class.php';

$config = array(
    'host' => "localhost",
    'port' => 3306,
    'user' => "root",
    'pass' => "123456",
    'charset' => "utf8",
    'dbname' => "php39"
);


/**
 * 只要覆盖__clone()方法，那么对象就不能直接克隆了
 */
$db1 = MySQLDB::getInstance($config);
var_dump($db1);
$db2 = clone $db1;
echo "<hr/>";
var_dump($db2);


?>
</body>
</html>