//php��memcache�Ĳ���
//�� ʵ����Memcache�����
$mem = new  Memcache();
//�� ����memcache������
$flag = $mem->connect('192.168.5.76', 11211);
//�� ����
$mem->set('color', 'red', 0, 30);
$mem->set('age', 23, 0, time() + 30);
//��ʱ���
$mem->set('wea', 'sunshine', 0, 2591666);//ʱ����Ч�ڽ�30�죩
$mem->set('wea', 'rain', 0, 2592789);//ʱ���(ʱ���)��1970-1-31��