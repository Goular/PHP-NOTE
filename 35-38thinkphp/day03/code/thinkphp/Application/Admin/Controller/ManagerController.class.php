<?php
/**
 * 后台管理类
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Think;
use Think\Verify;

class ManagerController extends Controller
{
    /**
     * 登录系统
     */
    function login()
    {
        if (!empty($_POST)) {
            //dump($_POST);
            //验证码的校验
            $vry = new \Think\Verify();
            //对比验证码的内容
            if ($vry->check($_POST['captcha'])) {
                //验证"用户名和密码",$_POST['admin_user']  $_POST['admin_psd']
                $manager = new \Model\ManagerModel();
                //checkNamePwd()验证成功返回整条记录，否则返回null
                $info = $manager->checkNamePwd($_POST['admin_user'], $_POST['admin_psd']);
                //dump($info);
                //exit();
                if ($info) {
                    //给用户信息session持久化操作(名字和id)
                    //添加账号信息存到session中，但是不标记密码，因为没有用，而且容易密码被破解
                    session('admin_id', $info['mg_id']);
                    session('admin_name', $info['mg_name']);
                    //转跳到后台首页
                    $this->redirect("Index/index");
                } else {
                    echo "用户名或密码错误";
                    //exit;
                }
            } else {
                echo "验证码错误";
                //exit;
            }
        }
        $this->display();
    }

    /**
     * 输出验证码
     */
    function verifyImg()
    {
        //配置验证码的选项
        $cfg = array(
            'imageH' => 30, // 验证码图片高度
            'imageW' => 100, // 验证码图片宽度
            'length' => 4, // 验证码位数
            'fontSize' => 15, // 验证码字体大小(px)
            'fontttf' => '4.ttf' // 验证码字体，不设置随机获取
        );
        //实例化对象
        $very = new \Think\Verify($cfg);
        $very->entry();//$cfg的配置需要覆盖Verify默认的同名配置参数
    }

    /**
     * 退出账号
     */
    function logout()
    {
        session(null);
        $this->redirect('login', [], 2, "成功退出账号");
    }
}