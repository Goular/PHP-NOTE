<?php
require './session_db.php';

session_start();

$_SESSION['key'] = 'destory';//其实这个更区域还是内存，到脚本结束的时候，会执行write，然后保存好退出

session_destroy();