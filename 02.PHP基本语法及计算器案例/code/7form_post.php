<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<!--
以下表单的数据，点击提交后，会将所有表单数据提交给
8post_data.php这个页面（文件），并在该文件中去处理
其实就是指：程序进入该文件中运行。
-->
<form action="8post_data.php" method="post">

    数据1<input type="text" name="data1"/>
    <br/>

    数据2<input type="text" name="data2"/>
    <br/>
    <input type="submit" value="提交"/>
</form>


</body>
</html>