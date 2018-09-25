//php对memcache的操作
//① 实例化Memcache类对象
$mem = new Memcache();
//② 连接memcache服务器(分布式)
$mem->addServer("192.168.5.76", 11211);
$mem->addServer("192.168.5.76", 11212);
$mem->addServer("192.168.5.76", 11213);
//③设置key
//$mem->set('city1','beijing',0);
//$mem->set('city2','shanghai',0);
//$mem->set('city3','guangzhou',0);
//④获取key
var_dump($mem->get('city1'));
var_dump($mem->get('city2'));
var_dump($mem->get('city3'));