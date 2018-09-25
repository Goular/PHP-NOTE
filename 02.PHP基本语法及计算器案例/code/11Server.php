<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>


<table cellspacing="0" border="1">

    <!--预定义变量 $Server的使用,包含了我们远端服务器，与本服务器的相关信息-->
    <?php

    //echo "<pre>";
    //var_dump($_SERVER);
    //echo "</pre>";
    //

    //打印属性
    //预定义数组变量仅仅需要会用就行，不用进行强行记住

    foreach ($_SERVER as $key => $value) {
        echo "<tr>";
        echo "<td>{$key}</td>";
        echo "<td>{$value}</td>";
        echo "</tr>";
    }


    ?>


</table>


</body>
</html>