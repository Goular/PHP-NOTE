//php对memcache的操作
//① 实例化Memcache类对象
$mem = new  Memcache();
//② 连接memcache服务器
$flag = $mem->connect('192.168.5.76', 11211);
//③ 给内存设置key
//$obj -> set(key,value,是否有压缩,有效期);
$mem->set("week", "Tuesday", 0, 3600 * 24);
//key的名字组成比较随意(可以有许多字符组成)
$mem->set("slkd*^&%^5623923uKJ?<>", "abccd", 0, 3699);