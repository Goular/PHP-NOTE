//php��memcache�Ĳ���
//�� ʵ����Memcache�����
$mem = new Memcache();
//�� ����memcache������(�ֲ�ʽ)
$mem->addServer("192.168.5.76", 11211);
$mem->addServer("192.168.5.76", 11212);
$mem->addServer("192.168.5.76", 11213);
//������key
//$mem->set('city1','beijing',0);
//$mem->set('city2','shanghai',0);
//$mem->set('city3','guangzhou',0);
//�ܻ�ȡkey
var_dump($mem->get('city1'));
var_dump($mem->get('city2'));
var_dump($mem->get('city3'));