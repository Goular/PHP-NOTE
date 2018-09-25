<?php
require './session_db.php';

//设定session的有效时间
ini_set('session.gc_maxlifetime', '20');
ini_set('session.gc_divisor','3');//divisor:除数
ini_set('session.gc_probability','1');//可能性; 几率，概率; 或然性;

//现在出现的可能型:
//现在是存在每次打开session，就有三分之一的概率会被调用session的GC垃圾回收方法

session_start();