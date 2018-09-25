<?php
// 给定任意的文件地址都可以下载，无论任何类型

$file = './pic.jpg';

//告诉浏览器，本次操作以附件的形式执行
header('Content-Disposition: attachment;filename=' . basename($file));//必须留一个空格在:后面

//获取文件的MIME类型
$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime = $finfo->file($file);

//告诉浏览器，本次操作的文件的类型是图片
header('Content-Type: ' . $mime);

//获取文件的大小
$file_size = filesize($file);

//告诉浏览器，本次操作的文件的大小
header('Content-Length: ' . $file_size);

$handle = fopen($file, 'r');
while (!feof($handle)) {
    echo fread($handle, 1024);
}
fclose($handle);
