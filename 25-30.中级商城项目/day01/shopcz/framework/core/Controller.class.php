<?php

class Controller
{
    public function jump($url, $message, $wait = 3)
    {
        if ($wait = 0) {
            header("Location:$url");
        } else {
            include CUR_VIEW_PATH . 'message.html';
        }
        //die();
        exit();
    }

    //引入工具类模型方法
    public function library($lib)
    {
        include LIB_PATH . "{$lib}.class.php";
    }

    //引入辅助函数方法
    public function helper($helper)
    {
        include HELPER_PATH . "{$helper}.php";
    }
}