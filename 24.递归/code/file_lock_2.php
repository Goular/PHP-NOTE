<?php
header('Content-Type: text/html; charset=utf-8');
$file = './data.txt';
$mode = 'a';

$handle = fopen($file, $mode);
//尝试加写锁
$lock_result = flock($handle, LOCK_EX | LOCK_NB);
if (!$lock_result) {
    // 锁定失败，不能操作
    trigger_error('不能锁定该文件，不能操作');
} else {
    $data = "12345678\n";
    $result = fwrite($handle, $data);
    var_dump($result);
}