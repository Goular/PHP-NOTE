<?php
header('Content-Type: text/html; charset=utf-8');
// 完成登陆（校验用户名密码，设置登陆标识）

$default_url = 'http://localhost/day24/index1.php';
$url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $default_url;
header('Refresh: 2; URL=' . $url);
echo '登陆成功<br/>' . $_SERVER['HTTP_REFERER'];
