<?php

//php对memcache的操作
//① 实例化Memcache类对象
$mem = new Memcache();

//② 连接memcache服务器
$flag = $mem -> connect('localhost',11211);

//③ 读取
var_dump($mem -> get('color'));
var_dump($mem -> get('age'));
var_dump($mem->get('wea'));
var_dump($mem->get('wea1'));