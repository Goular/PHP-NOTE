<?php

/**
 * 后台管理首页相关控制器类
 */
class ManageController extends BaseController
{
    /**
     * 首页动作
     */
    public function IndexAction()
    {
        //判断是否具有登录的标识
        session_start();
        if (!isset($_SESSION['is_login'])) {
            header("Location:index.php?p=back&c=Admin&act=Login");
            die();
        } else {
            echo "这里是后台首页! 不久会被更好的实现！";
        }
    }
}
