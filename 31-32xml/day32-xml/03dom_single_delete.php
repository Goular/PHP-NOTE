<?php
//载入
$dom = new DOMDocument('1.0', 'utf-8');
$dom->load('bookstore.xml');

//处理
//删除操作
$year = $dom->getElementsByTagName('year')->item(1);
$year->parentNode->removeChild($year);//找到节点的父亲，同时删除节点

//保存
$dom->save('delete1_book.xml');
