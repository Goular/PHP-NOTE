<?php
$myFile = fopen('log.txt', 'a+');
fwrite($myFile, date("Y-m-d H:i:s", time()) . '::web-inner-6::' . $_SERVER["REMOTE_ADDR"] . "\r\n");
echo '访问web-inner-6成功!';