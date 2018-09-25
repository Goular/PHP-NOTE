<?php

//实现session在memcache中存储
ini_set("session.save_handler","memcache");
ini_set("session.save_path","tcp://127.0.0.1:11211");


//正常操作session
session_start();
echo session_id(); //获得session_id信息

