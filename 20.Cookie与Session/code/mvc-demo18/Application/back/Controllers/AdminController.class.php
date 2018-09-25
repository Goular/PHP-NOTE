<?php

class AdminController extends BaseController
{
    function LoginAction()
    {
        include VIEW_PATH . '/login.html';
    }

    //todo:新的写法
    public function CheckLoginAction()
    {
        //接收登录表单的2个数据项：
        $user = $_POST['username'];
        $password = $_POST['password'];
        $model = ModelFactory::M('AdminModel');
        //$result = $model->CheckAdmin($user, $password);

        $admin_info = $model->CheckAdminInfo($user, $password);

        //$admin_info有可能的值是：false或者是数组
        if ($admin_info) {
            // 登陆成功
            // 分配登陆标识
            session_start();
            //直接将查询内容复制到session中
            $_SESSION['admin_info'] = $admin_info;

            header('Location: index.php?p=back&c=Manage&act=Index');
        } else {
            $this->GotoUrl('登录失败', "?p=back&c=Admin&act=login", 2);
        }
    }

}