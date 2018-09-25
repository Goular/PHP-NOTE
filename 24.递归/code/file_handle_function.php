<?php
header('Content-Type:text/html;charset=utf-8');
$file = './data.txt';
$mode = 'r';
$handle = fopen($file, $mode);
//var_dump($handle);


//fgetc()从文件句柄中获取一个字符。
//$result = fgetc($handle);
//var_dump($result);
//$result = fgetc($handle);
//var_dump($result);
//$result = fgetc($handle);
//var_dump($result);


//fgets(),只会返回n-1个字符，
//从文件指针中读取一行。
//从 handle 指向的文件中读取一行并返回长度最多为 length - 1 字节的字符串。碰到换行符（包括在返回值中）、EOF 或者已经读取了 length - 1 字节后停止（看先碰到那一种情况）。如果没有指定 length，则默认为 1K，或者说 1024 字节。
//$str = fgets($handle,3);
//var_dump($str);
//$str = fgets($handle,3);
//var_dump($str);
//$str = fgets($handle,30);
//var_dump($str);
//
//$str = fgets($handle,30);
//var_dump($str);

//在没有达到文件末尾的时候
//while (!feof($handle)) {
//    $line = fgets($handle, 1024);
//    echo $line.'<br/>';
//}

//fread() 从文件指针 handle 读取最多 length 个字节。 该函数在遇上以下几种情况时停止读取文件：
//读取了 length 个字节
//到达了文件末尾（EOF）
//不受换行符\n的影响
$str = fread($handle, 1024);
echo nl2br($str);

fclose($handle);
