<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
/**
 * PDO的使用
 * DSN = "mysql：host=服务器地址/名称；port=端口号；dbname=数据库名";
 * Options = array(PDO::MYSQL_ATTR_INIT_COMMAND=>’set names utf8’);
 * $pdo = new pdo(DSN, "用户名", "密码", Options);
 */
//定义访问的资料
$dsn = "mysql:host=localhost;port=3306;dbname=php39";
//定义字符集，防止SQL注入攻击
$opt = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8');
//创建PDO对象
$pdo = new PDO($dsn, 'root', '123456', $opt);
var_dump($pdo);

/**
 * 打印的结果是:
 * object(PDO)#1 (0) {}
 */
?>
</body>
</html>