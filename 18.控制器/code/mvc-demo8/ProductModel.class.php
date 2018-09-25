<?php
require "./BaseModel.class.php";

class ProductModel extends BaseModel
{
    function GetAllProduct()
    {
        $sql = "select product.*, protype_name from product inner join product_type as t on t.protype_id=product.protype_id";
        return $this->_dao->getRows($sql);
    }
}