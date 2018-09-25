<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
if (empty($_GET["name"])) {
    exit("获取参数异常");
}

$database_name = $_GET['name'];
$sql = "show tables;";
$link = require_once("mysql_connect.php");

if (!$link) {
    echo '连接失败';
    exit;
}

mysql_query("use {$database_name};");
$result = mysql_query($sql);
$column_count = mysql_num_fields($result);
echo "<table border='1' cellspacing='0' cellpadding='5'>";

echo "<tr>";
for ($i = 0; $i < $column_count; ++$i) {
    echo "<td style='text-align: center'   colspan='3'>";
    $resc = mysql_field_name($result, $i);
    echo $resc;
    echo "</td>";
}
echo "</tr>";

while ($rec = mysql_fetch_array($result)) {
    echo "<tr>";
    for ($i = 0; $i < $column_count; ++$i) {
        echo "<td style='text-align: left'>";
        $name = mysql_field_name($result, $i);
        echo $rec[$name];
        echo "</td>";

        echo "<td><a href='./select_table.php?database={$database_name}&name={$rec[$name]}'>查看表的内容</a></td>";
        echo "<td><a href='./desc_table.php?database={$database_name}&name={$rec[$name]}'>查看表的结构</a></td>";
    }
    echo "</tr>";
}


echo "</table>";

?>
</body>
</html>