<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
/**
 * 类的自动加载
 * 含义：
 * 当某行代码需要一个类的时候，php的内部机制可以做到“自动加载该类文件”，以满足该行需要一个类的这种需求。
 *
 *
 * 意思就是说，在编写代码的过程中，可能有与没有引用类(include,require)的操作，而导致类读不出来，或者是没有按需要在头部引用过多的类导致运行较慢的现象，此时就需要自动加载
 *
 * 什么时候需要一个类？
 * 1，new一个对象的时候；
 * 2，使用一个类的静态方法的时候；
 * 3，定义一个类（B）并以另一个类（A）作为父类的时候；
 *
 */
//require_once './MySQLDB.class.php';


/**
 * 定义这个函数来启用类的自动加载。
 */
function __autoload($name)
{
    require_once "./{$name}.class.php";
}

$config = array(
    'host' => "localhost",
    'port' => 3306,
    'user' => "root",
    'pass' => "123456",
    'charset' => "utf8",
    'dbname' => "php39"
);

$db1 = MySQLDB::GetInstance($config);
var_dump($db1);

?>
</body>
</html>