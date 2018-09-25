<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<!--位运算-->
<?php

$v1 = 10 & 20;
echo "<br/>v1 = {$v1}";

$v1 = 10 | 10;
echo "<br/>v1 = {$v1}";

$v1 = 10 ^ 7;
echo "<br/>v1 = {$v1}";

$v1 = 7;
$v1 = ~$v1;
echo "<br/>v1 = {$v1}";

$v1 = 10 << 4;
echo "<br/>v1 = {$v1}";

$v1 = 10 >> 4;
echo "<br/>v1 = {$v1}";

?>
</body>
</html>