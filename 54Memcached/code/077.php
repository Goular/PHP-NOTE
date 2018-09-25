<?php

//php对memcache的操作
//① 实例化Memcache类对象
$mem = new Memcache();

//② 连接memcache服务器
$flag = $mem -> connect('localhost',11211);

//③ 获取存储的各种数据类型的信息
var_dump($mem -> get('arr'));
echo "<hr />";
var_dump($mem -> get('dui'));
echo "<hr />";
var_dump($mem -> get('kong'));