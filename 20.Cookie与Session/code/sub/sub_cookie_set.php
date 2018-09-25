<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php

//默认设置下，就是说我们的cookie的属性路径默认是当前文件夹及其子文件夹，所以父亲节点是不能够查看刚才所设置的cookie的内容
setcookie("where_sub", "in sub directory");

//为了解决上面的问题，所以使用第四个参数来进行解决，即cookie设置
//注意第四个参数，标明的是有效路径，若"/"那么就是说，该cookie的有效区域是根目录下的所有页面
setcookie("where_sub_root", "in sub directory", 0, '/');

?>
</body>
</html>