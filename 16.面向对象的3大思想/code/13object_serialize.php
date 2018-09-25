<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
require './Xuliehua.class.php';

$obj1 = new Xuliehua();
echo "<pre>";
var_dump($obj1);
echo "</pre>";

//下面开始进行序列化操作
$s1 = serialize($obj1);
file_put_contents('./obj1.txt',$s1);


?>
</body>
</html>