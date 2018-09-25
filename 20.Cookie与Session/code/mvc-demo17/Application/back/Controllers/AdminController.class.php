<?php

class AdminController extends BaseController
{
    function LoginAction()
    {
        include VIEW_PATH . '/login.html';
    }

//旧的写法
//    function CheckLoginAction()
//    {
//        //echo "检测用户名密码。。。";
//        //接收登录表单的2个数据项：
//        $user = $_POST['username'];
//        $password = $_POST['password'];
//        $model = ModelFactory::M('AdminModel');
//        $result = $model->CheckAdmin($user, $password);
//        if ($result == true) {
//            echo '登录成功!!';
//        } else {
//            $this->GotoUrl('登录失败!', "?p=back&c=Admin&act=Login", 2);
//        }
//    }

    //todo:新的写法
    public function CheckLoginAction()
    {
        //接收登录表单的2个数据项：
        $user = $_POST['username'];
        $password = $_POST['password'];
        $model = ModelFactory::M('AdminModel');
        $result = $model->CheckAdmin($user, $password);

        if ($result == true) {
            // 登陆成功
            // 分配登陆标识
            session_start();
            $_SESSION['is_login'] = 'yes';

            header('Location: index.php?p=back&c=Manage&act=Index');
        } else {
            $this->GotoUrl('登录失败', "?p=back&c=Admin&act=login", 2);
        }
    }

}