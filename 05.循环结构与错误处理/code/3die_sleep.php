<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<!--die和sleep的写法-->
<?php

echo "<br/>A";
echo "<br/>1.当前的时间:" . date("Y-m-d H:i:s");
//使用Sleep的方法
sleep(3);
echo "<br/>2.当前的时间:" . date("Y-m-d H:i:s");

echo "<br/>";
//die("啦啦啦");//为最后输出的内容


exit("222");
//echo "到达位置B";

echo "我是末尾";//不会执行到这里

?>
</body>
</html>