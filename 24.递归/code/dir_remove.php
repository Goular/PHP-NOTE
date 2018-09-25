<?php
$path = "E:/delete";
$result = rmDirs($path);

var_dump($result);

//递归删除
//需要值得注意的是，删除文件夹必须是文件夹的没有文件和其他的东西，证明是空文件，才能进行相关的删除
function rmDirs($path)
{
    $handle = opendir($path);
    //防止文件夹名字为'0'的情况的发生
    while (false !== ($filename = readdir($handle))) {
        // ., .. 直接跳过
        if ($filename == '.' || $filename == '..') continue;
        if (is_dir($path . DIRECTORY_SEPARATOR . $filename)) {
            //是目录，所以进行递归的处理
            rmDirs($path . DIRECTORY_SEPARATOR . $filename);
        } else {
            //如果是文件，应该先删除文件
            unlink($path . DIRECTORY_SEPARATOR . $filename);
        }
    }
    closedir($handle);
    return rmdir($path);
}