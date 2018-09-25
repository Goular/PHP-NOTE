<?php
//header("content-type:text/html;charset-utf-8");
require "./ProductModel.class.php";
require "./ModelFactory.class.php";
require "./BaseController.class.php";

class ProductController extends BaseController
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
$act = !empty($_GET['a']) ? $_GET['a'] : "Index";
$action = $act . 'Action';
$ctrl->$action();
