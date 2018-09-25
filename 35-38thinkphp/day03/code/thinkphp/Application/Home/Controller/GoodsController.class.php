<?php
/**
 * 商品控制器
 */
namespace Home\Controller;
use Think\Controller;

class GoodsController extends Controller{
    //列表展示
    function showList(){
        //echo "商品列表展示...";
        $this->display();
        //$this->display('detail');
        //$this->display('User/Manager');
    }

    //商品详情查看
    function detail(){
        $this->display();
    }
}
