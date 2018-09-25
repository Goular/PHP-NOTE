<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
//函数使用的基础
function f1($x, $y)
{
    $s = $x * $x + $y * $y;
    $result = sqrt($s);
    return $result;
}


$v1 = f1(3, 4);

echo "v1 = {$v1}<br/>";
echo "f1(5,6) = " . f1(5, 6);

?>
</body>
</html>