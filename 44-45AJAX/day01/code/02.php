<?php
$fp = fopen('./02.txt', 'a');//以a的方式打开02.txt文件资源

fwrite($fp, 'php07110');//给文件追加并写入内容

fclose($fp);