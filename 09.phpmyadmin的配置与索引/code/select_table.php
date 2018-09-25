<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
if (empty($_GET["name"])) {
    exit("name获取参数异常");
}
if (empty($_GET["database"])) {
    exit("database获取参数异常");
}

$table_name = $_GET['name'];
$database = $_GET["database"];
$sql = "select * from {$table_name};";


$link = require_once("mysql_connect.php");

if (!$link) {
    echo '连接失败';
    exit;
}

mysql_query("use {$database}");
$result = mysql_query($sql, $link);

$column_count = mysql_num_fields($result);
echo "<table border='1' cellpadding='5' cellspacing='0'>";

echo "<tr>";
for ($i = 0; $i < $column_count; ++$i) {
    echo "<td style='text-align: center'>";
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
    }
    echo "</tr>";
}


echo "</table>";


?>
</body>
</html>