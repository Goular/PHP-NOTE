<?php
/**
 * Created by PhpStorm.
 * User: lotus
 * Date: 2016/9/27
 * Time: 21:26
 */

/**
 * 插入商品
 */
class GoodsModel extends BaseModel
{
    public function insertGoods($data)
    {

        $sql = "INSERT INTO `goods` VALUES (null, '{$data['goods_name']}', '{$data['shop_price']}', '{$data['goods_number']}', '{$data['is_best']}', '{$data['is_new']}', '{$data['is_hot']}', '{$data['is_on_sale']}', '{$data['image_ori']}', '{$data['admin_id']}','{$data['create_time']}', '{$data['goods_desc']}')";
        return $this->_dao->exec($sql);
    }
}