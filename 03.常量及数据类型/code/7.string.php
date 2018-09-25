<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<!--字符串的使用-->

<!--字符串的定义有四种办法-->

<?php
$v1 = 123;
//方法一，单引号字符串,转移字符的效果，和其他的标签效果都不认
$str1 = 'ab\cde\\d\'gav{$v1}';
echo '单引号字符串的使用:' . $str1 . '<hr/>';

echo "<hr/>";
echo '\n\n\n';
//方法二，双引号字符串
$str2 = "ab\"cde\nfg\tbdc{$v1}";
echo $str2;

echo "<hr/>";
echo "\n\n\n";
//方法三，单引号定界符字符串
//单字符的内容会直接进行输出,所有转义字符无效
$str3 = <<<'abc'
    \nnnn空间都说了分手{}$v1;;;
abc;
echo $str3;

echo "<hr/>";
echo "\n\n\n";

//方法四，双引号定界符字符串
//虽然没有双引号的定界符与完全没有引号的定界符是一样的，但是我们的为了更好地辨认内容和区别内容，还是需要自己强制加上双引号，这样才能记得牢，heredoc和nowdoc的区别
$str4 = <<<"abc"
    \nnnn空间都说了分手{}$v1;;;
abc;
echo $str4;

echo "<hr/>";
echo "\n\n\n";


//需要注意的是，定界符的末尾标识符和分号必须没有空格且内容必须和前面定义的一样，但不需要添加引号了，不然就会出现错误

?>


</body>
</html>