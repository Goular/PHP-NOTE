//php��memcache�Ĳ���
//�� ʵ����Memcache�����
$mem = new  Memcache();
//�� ����memcache������
$flag = $mem->connect('192.168.5.76', 11211);
//�� ��ȡ�洢�ĸ����������͵���Ϣ
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