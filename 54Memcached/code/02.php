//php��memcache�Ĳ���
//�� ʵ����Memcache�����
$mem = new  Memcache();
//�� ����memcache������
$flag = $mem->connect('192.168.5.76', 11211);
//�� ���ڴ�����key
//$obj -> set(key,value,�Ƿ���ѹ��,��Ч��);
$mem->set("week", "Tuesday", 0, 3600 * 24);
//key��������ɱȽ�����(����������ַ����)
$mem->set("slkd*^&%^5623923uKJ?<>", "abccd", 0, 3699);