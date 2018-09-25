<?php

class AdminController extends BaseController
{
    function LoginAction()
    {
        include './Application/back/views/login.html';
    }


    function CheckLoginAction()
    {
        //echo "检测用户名密码。。。";
        //接收登录表单的2个数据项：
        $user = $_POST['username'];
        $password = $_POST['password'];
        $model = ModelFactory::M('AdminModel');
        $result = $model->CheckAdmin($user, $password);
        if ($result == true) {
            echo '登录成功!!';
        } else {
            $this->GotoUrl('登录失败!', "?p=back&c=Admin&act=Login", 2);
        }
    }

}