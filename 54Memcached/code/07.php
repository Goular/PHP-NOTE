//php对memcache的操作
//① 实例化Memcache类对象
$mem = new  Memcache();
//② 连接memcache服务器
$flag = $mem->connect('192.168.5.76', 11211);
//③ 获取存储的各种数据类型的信息
$city = array(
    'liaoning' => 'shenyang',
    'hebei' => 'shijiazhuang',
    'shandong' => 'jinan'
);

class Person
{
    var $name = "Jim";
    var $height = 170;

    function run()
    {
        echo "Jim is running.";
    }
}

$per = new Person();
$mem->set('arr', $city, 0);
$mem->set('dui', $per);
$mem->set('kong', null, 0);