<?php

class GoodsModel extends Model
{
    //获取推荐商品
    public function getBestGoods()
    {
        $sql = "SELECT goods_id,goods_name,shop_price,goods_img FROM {$this->table}
		        WHERE is_best = 1 AND is_onsale = 1
		        ORDER BY goods_id DESC
		        LIMIT 4";
        return $this->db->getAll($sql);
    }
}