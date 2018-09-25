//ÉèÖÃSessionÎªMemcachedµÄ´æ´¢
ini_set("session.save_handler", "memcache");
ini_set("session.save_path", "tcp://192.168.5.76:11211;tcp://192.168.5.76:11212;tcp://192.168.5.76:11213;");
session_start();
//$_SESSION['username'] = "xiaoming";
//$_SESSION['age'] = 26;
echo session_id();