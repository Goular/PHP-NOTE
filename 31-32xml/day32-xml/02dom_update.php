<?php
//需求：所有的书籍打两折
//载入
$dom = new DOMDocument('1.0', 'utf-8');
$dom->load('bookstore.xml');
//处理
$prices = $dom->getElementsByTagName('price');

foreach ($prices as $price) {
    $price->nodeValue *= 0.2;
}
//保存
$dom->save('update_book.xml');