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
        //if (!isset($is_login)) {//尝试使用变量作为保存的参数，让登录操作可以直接内容
        if (file_exists('.is_login.txt')) {//使用文件进行读取
            header("Location:index.php?p=back&c=Admin&act=Login");
            die();
        } else {
            echo "这里是后台首页! 不久会被更好的实现！";
        }
    }
}
