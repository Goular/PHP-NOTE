<?php
// 不仅仅是用COOKIE传输session-ID
ini_set('session.use_only_cookies', '0');//关闭仅以cookie作为传递session的介质
// 自动通过 url 或者  表单 传输 session_id
ini_set('session.use_trans_sid', '1');//允许使用url和表单项的形式添加sessionid

session_start();
?>
<hr>
<form action="session_no_cookie_2.php" method="post">
    <input type="submit">
</form>
<hr>
<a href="session_no_cookie_2.php"> no cookie</a>