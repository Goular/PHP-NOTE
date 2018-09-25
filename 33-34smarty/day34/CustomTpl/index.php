<?php
/**
 * 启动页
 */
//1.载入模板类
include "libs/Template.class.php";
//2.实例化模板类对象
$tpl = new Template();
//3.设置模板和编译目录
$tpl->template_dir = "templates";
$tpl->compile_dir = "templates_c";
$tpl->cache_dir = "cache";
$tpl->caching = true;//开启缓存
//4.分配变量
$tpl->assign('title','自定义模板引擎');
$tpl->assign('content','通过自定义模板引擎彻底搞定smarty');
$tpl->assign('love',true);
$tpl->assign('star',array('那英','哈林','汪峰','周杰伦'));

//载入模板页面
$tpl->display('index.tpl');
