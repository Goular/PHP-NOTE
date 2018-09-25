<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php

/**
 * 对象的遍历
 * 对象的遍历只能遍历对象对象的公共属性，protected，private，静态属性是属于类的内容，并不属于对象的属性，所以不会再打印出来
 *
 * 但是值得注意一个问题，就是如果想遍历当前对象的内容，那么的在外部是无法遍历使用访问权限的属性，此时可以使用在类中添加一个遍历当前对象的办法
 * $this->$key => $value
 */
class A
{
    public $p1 = 1;
    protected $p2 = 2;
    private $p3 = 3;
    static $p4 = 4;//静态属性，属于类的属性，不是与对象的属性
    public $p5 = 1;

    function showAllProperties()
    {
        //记住一点是这里的遍历还是不能直接访问static的今天属性，因为static还是属于类的不是属于对象的
        foreach ($this as $key => $value) {
            echo "<br/>属性$key ：$value";
        }
    }

}

$obj1 = new A();
foreach ($obj1 as $key => $value) {
    echo "<br/>属性$key : $value";
}

echo "<hr/>";

$obj1->showAllProperties();

?>
</body>
</html>