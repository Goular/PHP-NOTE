<?php
//1.引入smarty类
include "libs/Smarty.class.php";
//2.实例化对象
$smarty = new Smarty();
//3.设置相关属性，模板目录和编译后的目录
$smarty->setTemplateDir("templates");//模板目录
$smarty->setCompileDir("templates_c");//编译目录

//修改定界符
//修改左定界符
$smarty->left_delimiter = "<{";
//修改右定界符
$smarty->right_delimiter = "}>";

//4.调用assign分配数据
$smarty->assign("title", 'Smarty模板');
$smarty->assign('content', "Smarty模板是一个功能非常强大的模板引擎");
//调用display方法载入模板
$smarty->display("index.html");

//定界符冲突(与css javascript代码的冲突)的解决办法
//方法1.凡是css，javascript都使用外部链接的方法应用
//方法2.所有在模板文件使用的css和javascript文件在使用{之后都空一个格，这样就不会被smarty引擎所翻译，
//方法3.使用literal的内置函数解决内容
//方法4.修改定界符