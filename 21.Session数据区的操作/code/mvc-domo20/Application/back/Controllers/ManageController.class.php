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

        // 判断是否具有登录标识, session
        session_start();
        if (!isset($_SESSION['admin_info'])) {
            // 没有标识，跳转到登陆页面
            header('Location: index.php?p=back&c=Admin&a=Login');
            die();
        }
        // 载入视图模板
        require VIEW_PATH . 'index.html';
    }

    public function TopAction() {
        // 载入top模板即可！
        require VIEW_PATH . 'top.html';
    }
    public function MenuAction() {
        // 载入top模板即可！
        require VIEW_PATH . 'menu.html';
    }
    public function DragAction() {
        // 载入top模板即可！
        require VIEW_PATH . 'drag.html';
    }
    public function MainAction() {
        // 载入top模板即可！
        require VIEW_PATH . 'main.html';
    }
}