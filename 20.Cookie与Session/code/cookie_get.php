<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
/**
 * 读取cookie
 * 读取使用预定义变量$_Cookie来读取Cookie内容
 */
//    获取当前Cookie的内容
//echo "<pre>";
//var_dump($_COOKIE);
//echo "</pre>";

var_dump(unserialize($_COOKIE['int']));
var_dump(unserialize($_COOKIE['boolean_false']));
var_dump(unserialize($_COOKIE['boolena_true']));
var_dump(unserialize($_COOKIE['arrat']));

?>
<hr/>
<button onclick="getCookie();">获取Cookie</button>
<script>
    function getCookie() {
        alert(document.cookie);
    }
</script>
</body>
</html>