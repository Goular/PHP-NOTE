<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
$link = mysql_connect('localhost', 'root', '123456');
mysql_query('set names utf8;');
mysql_query('use php39;');

$sql = 'desc tab_temp2';
$result = mysql_query($sql);
if ($result == false) {
    echo '执行失败，请参考:' . mysql_error();
} else {
    echo '执行成功!数据如下:';

    echo "<table border = '1' cellpadding='5' cellspacing='0'>";

    echo "<tr>";
    echo "<td>Field</td>";
    echo "<td>Type</td>";
    echo "<td>Null</td>";
    echo "<td>Key</td>";
    echo "<td>Default</td>";
    echo "<td>Extra</td>";
    echo "</tr>";

    while ($rec = mysql_fetch_array($result)) {
        echo "<tr>";

        echo "<td>" . $rec['Field'] . "</td>";
        echo "<td>" . $rec['Type'] . "</td>";
        echo "<td>" . $rec['Null'] . "</td>";
        echo "<td>" . $rec['Key'] . "</td>";
        echo "<td>" . $rec['Default'] . "</td>";
        echo "<td>" . $rec['Extra'] . "</td>";

        echo "</tr>";
    }
    echo "</table>";
}


?>
</body>
</html>