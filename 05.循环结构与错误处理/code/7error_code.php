<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<!--展示PHP的错误代码的内容-->
<?php
//额外演示str_pad()的作用！
//str_pad()方法用于字符串固定长度补齐内容，方向可自定义
echo "<br/>" . str_pad("123", 10, "0", STR_PAD_LEFT);
echo "<br/>" . str_pad("123", 10, "-", STR_PAD_LEFT);
echo "<br/>" . str_pad("123456", 10, "0", STR_PAD_LEFT);

function GetBinStr($e)
{
    $s = decbin($e);
    $s1 = str_pad($s, 16, "0", STR_PAD_LEFT);
    return $s1;
}


echo "<pre>";

echo "<br />E_ERROR=" . E_ERROR . ", \t\t其对应二进制值为：" . GetBinStr(E_ERROR);
echo "<br />E_WARNING=" . E_WARNING . ", \t\t其对应二进制值为：" . GetBinStr(E_WARNING);
echo "<br />E_NOTICE=" . E_NOTICE . ", \t\t其对应二进制值为：" . GetBinStr(E_NOTICE);
echo "<br />E_USER_ERROR=" . E_USER_ERROR . ", \t\t其对应二进制值为：" . GetBinStr(E_USER_ERROR);
echo "<br />E_USER_WARNING=" . E_USER_WARNING . ", \t\t其对应二进制值为：" . GetBinStr(E_USER_WARNING);
echo "<br />E_USER_NOTICE=" . E_USER_NOTICE . ", \t\t其对应二进制值为：" . GetBinStr(E_USER_NOTICE);
echo "<br />E_ALL=" . E_ALL . ", \t\t其对应二进制值为：" . GetBinStr(E_ALL);
echo "<br />E_STRICT=" . E_STRICT . ", \t\t其对应二进制值为：" . GetBinStr(E_STRICT);


echo "</pre>"

?>
</body>
</html>