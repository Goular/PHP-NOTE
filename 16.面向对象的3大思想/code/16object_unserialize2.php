<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
include_once './Xuliehua2.class.php';

//这里是演示对象的反序列化效果
$s1 = file_get_contents("./obj2.txt");
$o2 = unserialize($s1);
echo "<pre>";
var_dump($o2);
echo "</pre>";
$o2->f1();

?>
</body>
</html>