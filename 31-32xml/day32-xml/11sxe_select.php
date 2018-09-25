<?php
$sxe = simplexml_load_file("bookstore.xml");
$tab = "<table border='1' width='600'>";
$tab .= "<tr><th>title</th><th>author</th><th>year</th><th>price</th></tr>";
foreach ($sxe->book as $book) {
    $tab .= "<tr>";

    $tab .= "<td>{$book->title}</td>";
    $tab .= "<td>{$book->author}</td>";
    $tab .= "<td>{$book->year}</td>";
    $tab .= "<td>{$book->price}</td>";

    $tab .= "</tr>";
}

$tab .= "</table>";

echo $tab;