<?php
//方法二：php层面禁止页面缓存的效果
header("Cache-Control:no-cache");
header("Pragma:no-cache");
header("Expires:-1");

$file = fopen("./10.txt", "a");
fwrite($file, "php2219");
fclose($file);