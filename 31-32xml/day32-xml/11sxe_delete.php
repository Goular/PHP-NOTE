<?php

//unset方法用于除掉对象的变量

$sxe = simplexml_load_file('bookstore.xml');
foreach ($sxe->book as $book) {
    unset($book->year);
}
$sxe->asXML('sxe_delete_book.xml');