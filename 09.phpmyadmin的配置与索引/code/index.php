<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>

    <style>
        a {
            text-decoration: none;
        }

        a link: {
            text-decoration: none;
            color: blue;
        }

        a:hover {
            color: red;
            text-decoration: underline;
        }

        a:visited {
            text-decoration: none;
            color: blue;
        }


    </style>

</head>
<body>
<?php
$sql = "show databases;";
$link = require_once("mysql_connect.php");

if (!$link) {
    echo '连接失败';
    exit;
}

$result = mysql_query($sql);
$column_count = mysql_num_fields($result);
echo "<table border='1' cellspacing='0' cellpadding='5'>";

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
        echo "<a href='show_tables.php?name=$rec[$name]'>" . $rec[$name] . "</a>";
        echo "</td>";
    }
    echo "</tr>";
}


echo "</table>";
?>
</body>
</html>