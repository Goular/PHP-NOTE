<?php
mysql_connect("localhost:3306", 'root', '123456');
mysql_query('set names utf8;');
mysql_query('use php39;');

$sql = "select sess_content from session where sess_id='1234567890'";
$result = mysql_query($sql);
var_dump($result);
$row = mysql_fetch_assoc($result);
var_dump($row);