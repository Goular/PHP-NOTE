<?php

class PlatformController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->_check();
    }

    private function _check()
    {
        //开启session
        session_start();
        $curr_controller = strtolower(CONTROLLER);
        $curr_action = strtolower(ACTION);
        if ($curr_controller == 'admin' && ($curr_action == 'login' || $curr_action == 'checklogin')) {
            return;
        }
        if (!isset($_SESSION['admin_info'])) {
            // 没有标识，跳转到登陆页面
            header('Location: index.php?p=back&c=Admin&a=Login');
            die();
        }
    }
}