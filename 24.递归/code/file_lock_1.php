<?php
/**
 * ◦LOCK_SH取得共享锁定（读取的程序）。
 * ◦LOCK_EX 取得独占锁定（写入的程序。
 * ◦LOCK_UN 释放锁定（无论共享或独占）。
 */


//使用锁资源必须是文件进入了读/写/读写模式才会这样
$file = './data.txt';
$mode = 'r';
$handle = fopen($file, $mode);

//尝试加锁
$lock_result = flock($handle, LOCK_SH );
//判断锁定结果
if (!$lock_result) {
    //即锁定不成功
    trigger_error('不能锁定该文件，不能操作');
    die();
} else {
    $str = fgets($handle, 1024);
    var_dump($str);

    sleep(5);
    echo '<br/>';
    $str = fgets($handle, 1024);
    var_dump($str);
}
