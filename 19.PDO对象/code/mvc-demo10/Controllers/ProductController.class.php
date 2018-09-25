<?php

class ProductController extends BaseController
{
    function ShowAllProductAction()
    {
        $obj = ModelFactory::M('ProductModel');
        $data = $obj->GetAllProduct();    //是一个二维数组
        include './Views/Product_list.html';
    }

    function DetailAction()
    {

    }

    function DelAction()
    {
        $id = $_GET['id'];
        echo "<script>alert('你他妈:{$id}')</script>";
        $this->GotoUrl('你老妹', "?");
    }
}
