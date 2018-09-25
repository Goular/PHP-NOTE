<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

<!--进制转换-->
<!--值得注意的事情是::值赋予到变量上(不管是八进制，2进制，16进制)，其本地的保存形式还是十进制，但是会保存已转化后的过程-->

<?php
$n1 = 123;//十进制
$n2 = 0123;//八进制
$n3 = 0x123;//十六进制

echo "{$n1},{$n2},{$n3}";

$n1 = 123;
$s1 = decbin($n1);
$s2 = decoct($n1);
$s3 = dechex($n1);

echo "<br />{$n1} 的 2进制形式为：{$s1}";
echo "<br />{$n1} 的 8进制形式为：{$s2}";
echo "<br />{$n1} 的 16进制形式为：{$s3}";

$num2 = "1010110";
$num8 = "123";
$num16 = "123abc";

$m1 = bindec($num2);
$m2 = octdec($num8);
$m3 = hexdec($num16);

echo "<br />2进制数字：$num2 的对应10进制值为：$m1";
echo "<br />8进制数字：$num8 的对应10进制值为：$m2";
echo "<br />16进制数字：$num16 的对应10进制值为：$m3";

//值得注意的是:返回回来的是数据，传递过去的数字为十进制，但是自动转换把它看做16进制的字符串。，所以数字会变小

$m4 = 0x123abc;
echo "<hr/>m4={$m4}";

?>

</body>
</html>