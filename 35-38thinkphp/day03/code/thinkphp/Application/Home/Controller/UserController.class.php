<?php
/**
 * 创建前台分组会员的控制器
 */

//命名空间
namespace Home\Controller;

use Think\Controller;

class UserController extends Controller
{

    //登录系统
    public function login()
    {
        $this->display();
    }

    //注册系统
    public function register1()
    {
        //echo "Registering";
        //dump($_POST);

        $user = D('User');
        //两个逻辑:展示/收集
        if (!empty($_POST)) {
            //将爱好的数组组合起来
            $_POST['user_hobby'] = implode(',', $_POST['user_hobby']);
            $z = $user->add($_POST);
            dump($z);
//            if($z){
//                $this->redirect('\User\login',[],2,"添加用户成功!");
//            }else{
//                $this->redirect('register',[],2,"添加用户失败");
//            }
        } else {
            $this->display();
        }
    }

    function register()
    {
        $user = new \Model\UserModel();
        //两个逻辑：展示、收集
        if (!empty($_POST)) {
            //返回的$info为布尔值的内容
            $info = $user->create();//执行具有校验的方法
            //dump($user->getError());//打印异常的内容
            if ($info) {
                $_POST['user_hobby'] = implode(",", $_POST['user_body']);
                $z = $user->add($info);
                if ($z) {
                    //转跳到首页
                    $this->redirect('home/Index/index', [], 2, '角色添加成功!');
                    exit();
                }
            } else {
                //dump($user->getError());
                $this->assign('errorinfo', $user->getError());
            }
        }
        $this->display();
    }
}