//php��memcache�Ĳ���
//�� ʵ����Memcache�����
$mem = new  Memcache();
//�� ����memcache������
$flag = $mem->connect('192.168.5.76', 11211);
//�� ���ڴ�����key
//$obj -> set(key,value,�Ƿ���ѹ��,��Ч��);
echo "<pre>";
var_dump($mem->get("week"));
echo "</pre>";
echo "<pre>";
//key��������ɱȽ�����(����������ַ����)
var_dump($mem->get("slkd*^&%^5623923uKJ?<>"));
echo "</pre>";