<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>


<!--需要注意的是GLOBALS是没有"_"的-->

<?php

$v1 = 101;
echo "<pre>";
print_r($GLOBALS);
echo "</pre>";

$v2 = 2;
echo "<pre>";
print_r($GLOBALS);
echo "</pre>";


echo "<hr/>";

echo "<br/>{$v1}";
echo "<br/>{$GLOBALS['v1']}";

echo "<hr/>";

echo "<br/>{$v2}";
echo "<br/>{$GLOBALS['v2']}";

echo "<hr/>";

echo "<br/>{$v3}";
echo "<br/>{$GLOBALS['v3']}";

?>

</body>
</html>