//php��memcache�Ĳ���
//�� ʵ����Memcache�����
$mem = new  Memcache();
//�� ����memcache������
$flag = $mem->connect('192.168.5.76', 11211);
//�� �����������͵Ĵ洢
$mem->set('age', 20, 0);
$mem->set('name', 'tom', 0);
$mem->set('ismarried', false, 0);
$mem->set('pai', 3.1415926, 0);

//php��memcache�Ĳ���
//�� ʵ����Memcache�����
$mem = new  Memcache();
//�� ����memcache������
$flag = $mem->connect('192.168.5.76', 11211);
//�� �����������͵Ĵ洢
var_dump($mem->get('age'));
var_dump($mem->get('name'));
var_dump($mem->get('ismarried'));
var_dump($mem->get('pai'));