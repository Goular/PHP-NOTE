<?php
require './session_db.php';

//使用session
@session_start();

if (isset($_SESSION['new_key'])) {
    var_dump($_SESSION['new_key']);
}