<?php
/**
 * 打印Session的内容，证明了一点是，若没有执行session_start()那么预定义变量$_SESSION是没有意义的
 */
var_dump($_SESSION);

session_start();

echo "<hr/>";

var_dump($_SESSION);