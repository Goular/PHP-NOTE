<?php
header("content-type:text/html;charset-utf-8");
require "./ProductModel.class.php";
require "./ModelFactory.class.php";

class ProductController
{
    function ShowAllProductAction()
    {
        $obj = ModelFactory::M('ProductModel');
        $data = $obj->GetAllProduct();    //是一个二维数组
        include './Product_list.html';
    }

    function DetailAction()
    {

    }

    function DelAction()
    {

    }
}

$ctrl = new ProductController();
$act = !empty($_GET['act']) ? $_GET['act'] : "Index";
$act = $act . 'Action';
$ctrl->$act();
