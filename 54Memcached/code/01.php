//php对memcache的操作
//① 实例化Memcache类对象
$memcache = new Memcache();
//② 连接memcache服务器
$flag = $memcache->connect("192.168.5.76", 11211);
var_dump($flag);