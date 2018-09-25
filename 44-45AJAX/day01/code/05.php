<?php
//php的url编译和转义
//urlencode  urldecode

//对服务器端请求的同时传递get参数信息
$subject = "javascript&php=html";
$subject = urlencode($subject);

echo "<a href='./04.php?kemu={$subject}'>itcast</a>";