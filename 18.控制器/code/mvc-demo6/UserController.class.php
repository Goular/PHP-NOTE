<?php
header("content-type:text/html; charset=utf-8");//设置输出的字符编码为utf8
require './UserModel.class.php';
require './ModelFactory.class.php';

/**
 * todo:进行逻辑的归类于压缩
 */
class UserController
{
    function DetailAction()
    {
        //获取一个用户的信息
        $id = $_GET['id'];
        $obj = ModelFactory::M('UserModel');
        $data = $obj->GetUserInfoById($id);

        //显示到“一个用户的视图”中
        include './userInfo.html';
    }

    function ShowFormAction()
    {
        include './form_view.html';
    }

    function AddUserAction()
    {
        //接收表单数据：
        $user_name = $_POST['username'];
        $user_pass = $_POST['password'];
        $age = $_POST['age'];
        $edu = $_POST['xueli'];
        $aihao = $_POST['aihao'];    //这是数组，需要额外处理
        $xingqu = implode(",", $aihao);//将数组的所有项，用英文逗号","连接起来
        $from = $_POST['from'];

        $obj = ModelFactory::M('UserModel');
        $result = $obj->InsertUser($user_name, $user_pass, $age, $edu, $xingqu, $from);
        echo "<font color=red>添加用户成功！</font>";
        echo "<a href='?'>返回</a>";
    }

    function DelAction()
    {
        $id = $_GET['id'];
        $obj = ModelFactory::M('UserModel');
        $result = $obj->delUserById($id);
        echo "<font color=red>删除成功！</font>";
        echo "<a href='?'>返回</a>";
    }

    function IndexAction()
    {
        //$obj_user = new UserModel();	//这一行使用下一行代替
        $obj_user = ModelFactory::M('UserModel');
        $data1 = $obj_user->GetAllUser();    //是一个二维数组
        $data2 = $obj_user->GetUserCount();    //是一个数字
        //载入视图文件，以显示该2份数据：
        include './showAllUser_view.html';
    }

    function EditAction()
    {
        $id = $_GET['id'];
        //从数据库中取出该用户的所有数据信息：
        $obj_user = ModelFactory::M('UserModel');
        $user = $obj_user->GetUserInfoById($id);
        //兴趣数据，需要单独处理
        $aihao = explode(",", $user['xingqu']);//这里，将这种字符串数据"排球,篮球,足球"
        //使用指定的字符(,)，去分割为一个数组
        include './user_form_view.html';
    }

    function UpdateUserAction()
    {
        //接收表单数据：
        $id = $_POST['id'];
        $user_name = $_POST['username'];
        $user_pass = $_POST['password'];
        $age = $_POST['age'];
        $edu = $_POST['xueli'];
        $aihao = $_POST['aihao'];    //这是数组，需要额外处理
        $xingqu = implode(",", $aihao);//将数组的所有项，用英文逗号","连接起来
        $from = $_POST['from'];

        $obj = ModelFactory::M('UserModel');
        $result = $obj->UpdateUser($id, $user_name, $user_pass, $age, $edu, $xingqu, $from);
        echo "<font color=red>修改用户成功！</font>";
        echo "<a href='?'>返回</a>";
    }
}

$ctrl = new UserController();
$act = !empty($_GET['act']) ? $_GET['act'] : "Index";
$action = $act . "Action";
$ctrl->$action();//利用可变函数实现可变方法