<?php

//后台首页的控制器
class IndexController extends BaseController
{

    //生成二维码
    public function codeAction()
    {
        //手动载入验证码类
        $this->library('Captcha');
        $c = new Captcha();
        $c->generateCode();
    }

    public function indexAction()
    {
        include CUR_VIEW_PATH . 'index.html';
    }

    public function topAction()
    {
        include CUR_VIEW_PATH . 'top.html';
    }

    public function menuAction()
    {
        include CUR_VIEW_PATH . 'menu.html';
    }

    public function dragAction()
    {
        include CUR_VIEW_PATH . 'drag.html';
    }

    public function mainAction()
    {
        $adminModel = new AdminModel('admin');
        $admins = $adminModel->getAdmins();
        echo '<pre>';
        var_dump($admins);
        include CUR_VIEW_PATH . 'main.html';
    }
}