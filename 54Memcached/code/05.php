//php对memcache的操作
//① 实例化Memcache类对象
$mem = new  Memcache();
//② 连接memcache服务器
$flag = $mem->connect('192.168.5.76', 11211);
//③ 设置
$mem->set('color', 'red', 0, 30);
$mem->set('age', 23, 0, time() + 30);
//④时间差
$mem->set('wea', 'sunshine', 0, 2591666);//时间差（有效期近30天）
$mem->set('wea', 'rain', 0, 2592789);//时间差(时间戳)（1970-1-31后）