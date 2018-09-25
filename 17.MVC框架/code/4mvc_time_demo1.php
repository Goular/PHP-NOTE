<?php
require './MyDateTime.class.php';
if (!empty($_GET['f']) && $_GET['f'] == 'time') {
    $obj = new MyDateTime();
    $t = $obj->getTime();
} else if (!empty($_GET['f']) && $_GET['f'] == 'date') {
    $obj = new MyDateTime();
    $t = $obj->getDate();
} else {
    $obj = new MyDateTime();
    $t = $obj->getDateTime();
}

include "./4mvc_time_demo1.html";