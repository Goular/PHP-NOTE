<?php
$t = date('Y-m-d H:i:s');

if (!empty($_GET['ban'])) {
    $ban = $_GET['ban'];
} else {
    $ban = 'red';
}
$files = "./3show_time_" . $ban . ".html";

include $files;