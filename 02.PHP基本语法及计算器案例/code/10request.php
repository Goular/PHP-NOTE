<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

<!--预定义变量的使用 $_REQUEST-->
<!--$_REQUEST是$_POST和$_GET的合集-->

<?php

if (!empty($_POST)) {
    echo "<p>post数据:</p>>";
    var_dump($_POST);
}
if (!empty($_GET)) {
    echo "<p>get数据:</p>>";
    var_dump($_GET);
}
if (!empty($_REQUEST)) {
    echo "<p>request数据:<br/>";
    var_dump($_REQUEST);
    echo "<br />也可以这样写：";
    echo "<br />" . $_REQUEST['d1'];
    echo "<br />" . $_REQUEST['d2'];
    echo "<br />" . $_REQUEST['age'];
    echo "<br />" . $_REQUEST['data1'];
    echo "<br />" . $_REQUEST['data2'];
}


?>

<form action="10request.php?d1=5&d2=cctv&age=18" method="post">
    数据1：<input type="text" name="data1"/>
    <br/>
    数据2：<input type="text" name="data2"/>
    <br/>
    <input type="submit" value="提交"/>
</form>
</body>
</html>