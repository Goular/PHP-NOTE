<?php
require './session_db.php';

//使用session
@session_start();

$_SESSION['new_key'] = 'new_value';