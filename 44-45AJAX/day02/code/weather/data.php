<?php
header("content-type","text/html;charset=utf-8");

$url = "http://www.weather.com.cn/adat/sk/101010100.html";
echo file_get_contents($url);