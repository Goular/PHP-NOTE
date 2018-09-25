<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
include_once './Xuliehua2.class.php';

$obj1 = new Xuliehua2();
$obj1->p1 = 11;
$obj1->p2 = 22;
$obj1->p3 = 33;

echo "<pre>";
var_dump($obj1);
echo "</pre>";

$str = serialize($obj1);
file_put_contents('./obj2.txt', $str);

?>
</body>
</html>