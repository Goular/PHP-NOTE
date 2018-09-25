<?php
class  AdminController extends PlatformController{

  function LoginAction(){
   	// 载入视图层没模板
    include VIEW_PATH . 'login.html';
	}
	/**
	 * 生成验证码
	 */
	public function CaptchaAction() {
		// 通过 验证码工具类，完成即可！
		$t_captcha = new Captcha();
		$t_captcha->makeImage();
	}

	function CheckLoginAction() {
		// 验证码是否正确
		$t_captcha = new Captcha();
		if (! $t_captcha->checkCode($_POST['captcha'])) {
			// 不正确，跳转到登陆页面，提示
			$this->GotoUrl("验证码不正确", "index.php?p=back&c=Admin&a=Login", 2);
			// 停止脚本执行！
			die;
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
		if($admin_info){
			// 管理员合法

			// 分配登陆标识, session
			session_start();
			$_SESSION['admin_info'] = $admin_info;// $_SESSION['admin_info']['admin_name']

			// 设置记录登陆状态
			if (isset($_POST['remember'])) {
				// 需要记录，通常是在原始数据上，添加 混淆字符串（盐值）后，再加密
				setcookie('admin_id', md5($admin_info['id'] . 'SALT'), PHP_INT_MAX);
				setcookie('admin_pass', md5($admin_info['admin_pass'] . 'SALT'), PHP_INT_MAX);
			}
			// 跳转到后台首页
			header('Location: index.php?p=back&c=Manage&a=Index');
		}
		else{
			//失败就提示，并可以自动跳转到登录界面
			$this->GotoUrl("登录失败", "?p=back&c=Admin&a=login", 2);
		}
	}
}