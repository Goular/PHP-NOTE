//php��memcache�Ĳ���
//�� ʵ����Memcache�����
$memcache = new Memcache();
//�� ����memcache������
$flag = $memcache->connect("192.168.5.76", 11211);
var_dump($flag);