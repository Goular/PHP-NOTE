<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
//单例模式：
//就是设计这样一个类，这个类只能“创造”出它的一个对象（实例）；
class SingleIntance
{
    //第一步：私有化构造方法：
    /**
     * SingleIntance constructor.
     */
    private function __construct()
    {
    }

    //第二步：定义一个静态属性，初始为null
    static private $instance = null;

    //第三步：顶一个静态方法，从中判断对象是否生成并适当返回该对象；
    static function getObject()
    {
        //准备在这里，根据自己的逻辑，控制好对象的数量：就一个：
        //然后“返回给人家”
        if (!isset(self::$instance)) {
            $obj = new self();
            self::$instance = $obj;
            return $obj;
        } else {
            return self::$instance;
        }
    }
}

//$obj1 = new SingleIntance();//该类的构造方法私有化了，出错！
//$obj2 = new SingleIntance();//即无法new出对象了

$obj1 = SingleIntance::getObject();
//SingleIntance::$instance = null;
$obj2 = SingleIntance::getObject();
var_dump($obj1);
echo "<br/>";
var_dump($obj2);
echo "<br/>";

?>
</body>
</html>