<?php
//所有的书籍都打两折
$sxe = simplexml_load_file('bookstore.xml');
foreach ($sxe->book as $book) {
    $book->price *= 0.2;
}
$sxe->asXML('sxe_update_book.xml');