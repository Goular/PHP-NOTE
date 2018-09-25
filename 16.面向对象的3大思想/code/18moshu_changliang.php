<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php

/**
 * 与类有关的魔术常量：
 */
class A
{
    function f1()
    {
        echo "<br/>__DIR__:" . __DIR__;//获取的是当前文件的文件夹
        echo "<br/>__FILE__:" . __FILE__;//获取的是当前文件全路径
        echo "<br/>__LINE__:" . __LINE__;//当前的行数
        echo "<br/>__CLASS__:" . __CLASS__;//当前的类（只能在类中使用）
        echo "<br/>__METHOD__:" . __METHOD__;//当前的方法(只能在类中使用)
        echo "<br/>__LINE__:" . __LINE__;//当前的行数
    }
}

$obj1 = new A();
$obj1->f1();

?>
</body>
</html>