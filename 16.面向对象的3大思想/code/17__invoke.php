<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php

/**
 * __toString()的作用是，当对象当做字符串被调用的时候，就会自动调用相关的魔术方__toString()
 * 返回字符串即可
 */
class  A
{
    public function __construct()
    {
    }

    function __invoke()
    {
        echo '执行了对象加括号后的方法(invoke)';
    }
}

$obj1 = new A();
$obj1();


?>
</body>
</html>