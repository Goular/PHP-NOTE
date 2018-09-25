<?php

/**
 * 后台基础基础控制器
 * 只有登陆成功后，这里的内容才能使用
 */
class BaseController extends Controller
{

    //只要用到sessino，就一定要先开启session。在哪儿开启比较好？
    //宗旨：不要漏掉，避免重复。

    //构造方法
    public function __construct()
    {
        $this->checkLogin();
    }

    //验证用户是否登录
    private function checkLogin()
    {
        //注意，此处的admin是我在登录成功时保存的登录标识符
        if (!isset($_SESSION['admin'])) {
            $this->jump('index.php?p=admin&c=login&a=login', '您还没有登录');
        }
    }


}
