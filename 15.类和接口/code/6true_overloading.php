<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
//目标：设计一个类，这个类的实例，可以实现如下需求：
//调用方法f1：
//传入1个参数，就返回其本身，
//传入2个参数，就求其平方和，
//传入3个参数，就求其立方和;
//其他参数形式，报错！

//即实现一般面向对象的重载效果
class A
{
    //这是一个魔术方法，在A的对象调用不存在的方法的时候
    //会被自动调用来应对这种情况：
    function __call($name, $arguments)
    {
        //就表示要处理调用时形式上使用f1的这个不存在的方法
        if ($name == 'f1') {
            $len = count($arguments);//获取参数数量
            if ($len < 1 || $len > 3) {
                trigger_error("使用非法的方法!", E_USER_ERROR);
            } else if ($len === 1) {
                return $arguments[0];
            } else if ($len === 2) {
                return $arguments[0] * $arguments[0] + $arguments[1] * $arguments[1];
            } else if ($len === 3) {
                return pow($arguments[0], 3) + pow($arguments[1], 3) + pow($arguments[2], 3);
            }
        } else if ($name === 'f2') {
        } else if ($name === 'f3') {
        }
    }
}

$a1 = new A();
$v1 = $a1->f1(1);
$v2 = $a1->f1(2, 3);
$v3 = $a1->f1(4, 5, 6);

echo "v1 = $v1<hr/>";
echo "v2 = $v2<hr/>";
echo "v3 = $v3<hr/>";
?>
</body>
</html>