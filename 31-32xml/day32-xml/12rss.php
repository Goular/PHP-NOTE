<?php
//制作自己的订阅源
//从数据库中读取数据库
$conn = mysql_connect('localhost', 'root', '123456');
mysql_query('use blog;');
mysql_query('set names utf8;');
$sql = "select * from blog;";
$res = mysql_query($sql);
$blogs = array();
while ($data = mysql_fetch_assoc($res)) {
    $blogs[] = $data;
}
//生成xml
$xml = "<?xml version='1.0' encoding='utf-8' ?>";
$xml .= "<rss version='2.0'>";
$xml .= "<channel>";
$xml .= "<title>传智播客PHP学院</title>";
$xml .= "<link>http://php.itcast.cn</link>";
$xml .= "<description>学PHP，首选传智播客</description>";
$xml .= "<language>zh-cn</language>";
foreach ($blogs as $blog) {
    $xml .= "<item>";
    $xml .= "<title>{$blog['title']}</title>";
    $xml .= "<link>http://php.itcast.cn/{$blog['id']}.php</link>";
    $xml .= "<pubDate>" . date("Y-m-d H:i:s", $blog['add_time']) . "</pubDate>";
    $xml .= "<description>{$blog['description']}</description>";
    $xml .= "</item>";
}

$xml .= "</channel>";
$xml .= "</rss>";

header("Content-type:text/html;charset=utf-8");
echo $xml;