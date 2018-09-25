<?php
class  AdminController extends BaseController{

  function LoginAction(){
   	// 载入视图层没模板
    include VIEW_PATH . 'login.html';
	}

	function CheckLoginAction(){
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
			// 登陆成功
			// 分配登陆标识, session
			session_start();
			$_SESSION['admin_info'] = $admin_info;// $_SESSION['admin_info']['admin_name']
			// 跳转到后台首页
			header('Location: index.php?p=back&c=Manage&a=Index');
		}
		else{
			//失败就提示，并可以自动跳转到登录界面
			$this->GotoUrl("登录失败", "?p=back&c=Admin&a=login", 2);
		}
	}
}