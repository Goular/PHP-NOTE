<?php
$dom = new DOMDocument("1.0", "utf-8");
$dom->load("bookstore.xml");

//处理过程
$titles = $dom->getElementsByTagName('title');
$authors = $dom->getElementsByTagName('author');
$years = $dom->getElementsByTagName('year');
$prices = $dom->getElementsByTagName('price');

$len = $titles->length;
$tab = "<table border='1' width='600' cellspacing='0' cellpadding='0'>";
$tab .= "<tr><th>title</th><th>author</th><th>year</th><th>price</th></tr>";
for ($i = 0; $i < $len; $i++) {
    $tab .= "<tr>";
    $tab .= "<td>{$titles->item($i)->nodeValue}</td>";
    $tab .= "<td>{$authors->item($i)->nodeValue}</td>";
    $tab .= "<td>{$years->item($i)->nodeValue}</td>";
    $tab .= "<td>{$prices->item($i)->nodeValue}</td>";
    $tab .= "</tr>";
}
$tab .= "</table>";
echo $tab;
