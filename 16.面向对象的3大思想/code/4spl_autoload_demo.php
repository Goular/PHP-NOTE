<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
//这里，演示自定义的自动加载函数的使用：
spl_autoload_register("autoload1");
spl_autoload_register("autoload2");

function autoload1($class_name)
{
    echo "<br/>准备在autoload1加载这个类:$class_name";
    $file = './class/' . $class_name . ".class.php";

    if (file_exists($file)) {
        include_once $file;
    }
    //如果不存在，则本函数就没有成功加载该类文件，就会继续找后续加载函数！
}

function autoload2($class_name)
{
    echo "<br/>准备在autoload2加载这个类:$class_name";
    $file = './libs/' . $class_name . ".class.php";

    if (file_exists($file)) {
        include_once $file;
    }
    //如果不存在，则本函数就没有成功加载该类文件，就会继续找后续加载函数！
}

$a1 = new A();
echo '<br/>';
var_dump($a1);


$b1 = new B();
echo "<br/>";
var_dump($b1);


/**
 * 结果发现，
 * 执行的顺序是，按照注册的前后顺序，依次执行，
 * 1.如果第一个方法找到该类的的引用地址的时候，那么不会执行第二个方法
 * 2.若第一个方法找不到，会执行第二个自动加载的注册方法，如此类推，如果按照队列执行完还是不能找到的话，那么就会执行形同的报错
 */
?>
</body>
</html>