<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php

/**
 * 接口的创建,默认为成员与方法都是public
 * 1.成员属性方面只接纳常量，
 * 2.成员方法默认是abstract和public，所以不用添加
 */
interface Ia
{
    const PI = 3.1415926;
    const CC1 = 1;

    function show1();//

    function fun2($p1, $p2);
}

class A implements Ia{

    function show1()
    {
        // TODO: Implement show1() method.
    }

    function fun2($p1, $p2)
    {
        // TODO: Implement fun2() method.
    }
}


?>
</body>
</html>