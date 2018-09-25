<?php
session_start();
//todo:可以增加@符号进行屏蔽
@session_start();//不要重复开启session，不要会忽略后面的开启，然后弹出notice的错误