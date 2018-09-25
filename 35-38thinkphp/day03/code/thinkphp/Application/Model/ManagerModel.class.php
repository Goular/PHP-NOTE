<?php
namespace Model;
use Think\Model;

class ManagerModel extends Model{

    /**
     * 验证账号密码,校验用户名和密码
     */
    function checkNamePwd($name,$pwd){
        //① 先根据$name查询是否存在指定名字的记录
        //   find()方法如果没有查询到结果要返回"null"，否则返回"整条记录"信息
        $z = $this->where("mg_name='$name'")->find();
        if($z){
            //② 把查询到的记录的密码 与 用户输入密码($pwd)做比较
            if($z['mg_pwd']==$pwd){
                return $z;
            }
        }
        return null;
    }
}