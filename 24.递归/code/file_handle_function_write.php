<?php
$file = './data.txt';
//$mode = 'a';
$mode = 'w';
//$mode = 'x';
$handle = fopen($file, $mode);

$data = date('Y-m-d H:i:s') . "\n";
$result = fwrite($handle, $data);
var_dump($result);

fclose($handle);