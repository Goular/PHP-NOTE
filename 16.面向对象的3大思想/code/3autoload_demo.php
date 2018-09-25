<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
function __autoload($name)
{
    require './class/' . $name . '.class.php';
}

$obj = new A();//此时需要"A"这个类，就会自动调用__autoload()函数
//并将“A”这个类名（字符串）传过去
echo "<pre>";
var_dump($obj);
A::print_q();
echo "</pre>";
?>
</body>
</html>