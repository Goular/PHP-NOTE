<?php
header('Content-Type: text/html; charset=utf-8');
// Fri, 14 Aug 2015 11:24:40 GMT
//Expire 请求缓存时间的定义必须使用的是格林威治时间
//缓存有效期设定为30秒；30秒内重复的操作，不会请求服务器，而是使用缓存进行应答
//$expire = gmdate('D,d M Y H:i:s', time() + 30) . 'GMT';
$expire = gmdate('D,d M Y H:i:s', time() - 1) . 'GMT';
//每一个头都需要在冒号的后面添加一个空格
header('Expires: ' . $expire);
echo date('H:i:s');
?>
<hr>
<a href="expires_cache.php">点击</a>
