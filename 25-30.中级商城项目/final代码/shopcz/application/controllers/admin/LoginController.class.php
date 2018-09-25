<?php

/**
 * 后台登录控制器
 */
class LoginController extends Controller
{
    //显示登录页面
    public function loginAction()
    {
        //载入登录页面的视图
        include CUR_VIEW_PATH . "login.html";
    }

    //验证用户名和密码
    public function signinAction()
    {
        //1.获取用户名和密码
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        $username = addslashes($username);
        $password = addslashes($password);

        //获取验证码
        $captcha = trim($_POST['captcha']);
        //先转小写，在比较
        if (strtolower($_SESSION['captcha']) != strtolower($captcha)) {
            $this->jump('index.php?p=admin&c=login&a=login', '验证码错误');
        }


        //3.调用模型来完成验证操作并给出提示
        $adminModel = new AdminModel('admin');
        $user = $adminModel->checkUser($username, $password);
        if ($user) {
            //登录成功，保存登录的标识
            $_SESSION['admin'] = $user;
            //转跳页面
            $this->jump('index.php?p=admin&c=index&a=index', '', 0);
        } else {
            //登录失败
            $this->jump('index.php?p=admin&c=login&a=login', '用户名或密码错误');
        }
    }

    //注销账号
    public function logoutAction()
    {
        //删除session中的变量
        unset($_SESSION['admin']);
        //销毁session
        session_destroy();
        //转跳
        $this->jump('index.php?p=admin&c=login&a=login', '', 0);
    }

    //生成验证码
    public function captchaAction()
    {
        //引入验证码类
        $this->library('Captcha');
        //实例化对象
        $captcha = new Captcha();
        //生成验证码
        $captcha->generateCode();
        //将验证码保存到session中
        $_SESSION['captcha'] = $captcha->getCode();
    }
}
