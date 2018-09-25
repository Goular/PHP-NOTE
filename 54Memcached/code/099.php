<?php

//php对memcache的操作
//① 实例化Memcache类对象
$mem = new Memcache();

//② 连接memcache服务器(分布式)
$mem -> addServer('127.0.0.1',11213);
$mem -> addServer('127.0.0.1',11211);
$mem -> addServer('127.0.0.1',11212);

//③ 设置key
var_dump($mem -> get('city1'));
var_dump($mem -> get('city2'));
var_dump($mem -> get('city3'));
