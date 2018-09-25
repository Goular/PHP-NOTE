<?php
$sxe = simplexml_load_file('bookstore.xml');
//追加孩子节点
$newbook = $sxe->addChild('book');
$newtitle = $newbook->addChild('title', 'xml编程');
$newbook->addChild('author', 'wang');
$newbook->addChild('year', 2016);
$newbook->addChild('price', 10);

//增加属性
$newbook->addAttribute('category', 'IT');
$newtitle->addAttribute('lang', '中文');
$sxe->asXML('sxe_add_book.xml');