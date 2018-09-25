<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<!--利用预定义变量获取去表单的内容-->
<!--利用empty方法辨别内容是否为空,注意isset方法的应用范围没有empty方法广-->
<?php
//先逐个获取内容
if (!empty($_POST)) {//判断数组的内容是否为空
    $d1 = $_POST['data1'];
    $d2 = $_POST['data2'];

    //输出$d1,$d2
    echo "d1={$d1} ,d2={$d2}<hr/>";
    //输出预定义的变量数组
    print_r($_POST);


} else {
    echo "非法的页面访问";
}

?>
</body>
</html>