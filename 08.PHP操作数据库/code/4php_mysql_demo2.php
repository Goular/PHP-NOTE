<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
$link = mysql_connect('localhost', 'root', '123456');
mysql_query('set names utf8');
mysql_query('use php39');
$sql = "select * from tab_temp1;";
$result = mysql_query($sql);

if ($result == false) {
    echo '执行失败，请参考:' . mysql_error();
} else {
    //此时，$result就是“结果集”（数据集）；
    echo '执行成功！数据如下：';
    while ($rec = mysql_fetch_array($result)) {
        //mysql_fetch_array()会取出该结果集中的“一行数据”，并取得该行数据后赋值给$rec；
        //此$rec就是一个数组，其下标就是字段名；
        //在此while循环中，mysql_fetch_array()会一次次（一行行）取出结果集中的所有数据；
        //然后，在这里就可以处理该数组$rec了：
        echo "<br/>f1:" . $rec['id'];
        echo "<br/>f2:" . $rec['name'];
    }
}

?>
</body>
</html>