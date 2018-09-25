<?php
header('Content-Type: text/html; charset=utf-8');

$file = "./data.txt";
$mode = 'r';
$handle = fopen($file, $mode);

//返回由 handle 指定的文件指针的位置，也就是文件流中的偏移量。
echo '位置：', ftell($handle), '<br/>';

//在与 handle 关联的文件中设定文件指针位置。 新位置从文件头开始以字节数度量，是以 whence 指定的位置加上 offset。
fseek($handle, 5);

echo '位置：', ftell($handle), '<br/>';

echo fgets($handle, 3);
