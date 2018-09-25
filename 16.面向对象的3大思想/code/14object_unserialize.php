<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
/**
 * __wakeup：用于对象的反序列化
 * 1，对一个对象进行反序列化，其实是恢复其原来保存起来的属性数据，而且，此时必然需要依赖该对象原本的所属类；
 * 2，对象在反序列化的时候，会自动调用该对象所属类的这个魔术方法：__wakeup()
 * __wakeup()一般使用的都是用于对象读取对象的构建
 *
 * 在手册上讲，__wakeup() 经常用在反序列化操作中，例如重新建立数据库连接，或执行其它初始化操作。
 * 因为数据库的连接内容都在序列化完成的文件上
 */

require "./Xuliehua.class.php";
$str = file_get_contents('./obj1.txt');
$value = unserialize($str);

echo "<pre>";
var_dump($value);
echo "</pre>";

?>
</body>
</html>