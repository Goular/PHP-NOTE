<?php
namespace Admin\Controller;
use Think\Controller;

class IndexController extends Controller{

    function index(){
        $this->display();
    }

    function head(){
        C('SHOW_PAGE_TRACE',false);
        $this->display();
    }

    function left(){
        C('SHOW_PAGE_TRACE',false);
        $this->display();
    }

    function right(){
        //$this->display();
        //dump()方法是TP专用函数
        dump(get_defined_constants(true));
    }
}