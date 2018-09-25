<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
主文件开始的位置:
<?php


//include 加载的顺序是，显示没有php包裹的html代码，再去加载包含php包裹的代码，最后继续执行php外面的html部分的代码

echo("<br/>主文件中的位置A");

//利用相对位置进行文件路径的获取
include("./page2.php");//需要载入的文件

echo "<br/>主文件中的位置B";

?>

</body>
</html>