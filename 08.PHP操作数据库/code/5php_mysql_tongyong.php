<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
//数据库的名称
$dbName = "php39";
if (!empty($_GET['db'])) {
    $dbName = $_GET['db'];
}
$link = mysql_connect('localhost', 'root', '123456');
mysql_query('set names utf8;');
mysql_query('use php39;');
$sql = 'select * from tab_temp1;';
$sql = 'select * from user_info;';
$sql = 'select * from tab_int2;';
$sql = 'show tables;';
$sql = 'desc tab_temp2;';
$result = mysql_query($sql);
if ($result == false) {
    echo '执行成功!请参考:' . mysql_error();
} else {
    //此时，$result就是"结果集"
    echo '执行成功！数据如下:';
    echo '<table border=\'1\' cellspacing=\'0\'>';
    //获取fields的列数
    $field_count = mysql_num_fields($result);
    echo "<tr>";
    for ($i = 0; $i < $field_count; ++$i) {
        $field_name = mysql_field_name($result, $i);
        echo '<td>' . $field_name . '</td>';
    }
    echo "</tr>";
    while ($rec = mysql_fetch_array($result)) {
        echo "<tr>";
        for ($i = 0; $i < $field_count; ++$i) {
            $field_name = mysql_field_name($result, $i);
            echo "<td>" . $rec[$field_name] . "</td>";
        }
        echo "</tr>";
    }
    echo '</table>';
}
?>
</body>
</html>