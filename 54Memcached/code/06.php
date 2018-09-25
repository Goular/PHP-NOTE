//php对memcache的操作
//① 实例化Memcache类对象
$mem = new  Memcache();
//② 连接memcache服务器
$flag = $mem->connect('192.168.5.76', 11211);
//③ 各种数据类型的存储
$mem->set('age', 20, 0);
$mem->set('name', 'tom', 0);
$mem->set('ismarried', false, 0);
$mem->set('pai', 3.1415926, 0);

//php对memcache的操作
//① 实例化Memcache类对象
$mem = new  Memcache();
//② 连接memcache服务器
$flag = $mem->connect('192.168.5.76', 11211);
//③ 各种数据类型的存储
var_dump($mem->get('age'));
var_dump($mem->get('name'));
var_dump($mem->get('ismarried'));
var_dump($mem->get('pai'));