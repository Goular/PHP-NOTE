<?php

class  AdminController extends PlatformController
{

    function LoginAction()
    {
        // 载入视图层没模板
        include VIEW_PATH . 'login.html';
    }

    /**
     * 生成验证码
     */
    public function CaptchaAction()
    {
        //通过验证码工具类，生成验证码，输出到客户端进行校验即可
        $t_captcha = new Captcha();
        $t_captcha->makeImage();
    }


    /**
     * 登录验证，记住要将相关的验证码也要校验了
     */
    function CheckLoginAction()
    {
        //首先需要判断验证码是否正确，这样才去做后面的登录操作
        $t_captcha = new Captcha();
        if (!$t_captcha->checkCode($_POST['captcha'])) {
            //不正确的话，转跳到登录的页面，先提示，等待两秒钟转跳
            $this->GotoUrl('验证码不正确', 'index.php?p=back&c=Admin&a=Login', 2);
            //由于验证码错误，直接结束后面的代码，一般使用header的转跳网页，都需要进行die()操作
            die();
        }


        //接收登录表单的2个数据项：
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $model = ModelFactory::M("AdminModel");
        // 下面的方法，返回的true或false，表示否是合法
        // $result = $model->CheckAdmin($user, $pass);

        // 下面的方法，当管理员合法时，返回管理员信息（array）
        // 当管理员信息非法时，返回false
        $admin_info = $model->CheckAdminInfo($user, $pass);
        // 直接判断即可，非空数组，可以自动转换为布尔型true
        if ($admin_info) {
            // 登陆成功
            // 分配登陆标识, session
            session_start();
            $_SESSION['admin_info'] = $admin_info;// $_SESSION['admin_info']['admin_name']

            if (isset($_POST['remember'])) {
                //记得在添加保存的加密字符串时，最好加上混淆字符串再去MD5
                //记得不要把账号密码都写到cookie，只要能表达该账号唯一的值就可以了，例如用户id和密码，这样他就不能直接破解后就登录进去，因为账号名是不对的，有密码也没有用
                setcookie('admin_id', md5($admin_info['id'] . 'SALT'), PHP_INT_MAX);
                setcookie('admin_pass', md5($admin_info['admin_pass'] . 'SALT'), PHP_INT_MAX);
            }
            // 跳转到后台首页
            header('Location: index.php?p=back&c=Manage&a=Index');
            die();
        } else {
            //失败就提示，并可以自动跳转到登录界面
            $this->GotoUrl("登录失败", "?p=back&c=Admin&a=login", 2);
        }
    }

}