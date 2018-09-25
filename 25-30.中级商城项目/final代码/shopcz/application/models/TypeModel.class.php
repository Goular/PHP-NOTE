<?php

//商品类型控制器
class TypeModel extends Model
{
    //获取所有的商品类型
    public function getTypes()
    {
        $sql = "select * from {$this->table}";
        return $this->db->getAll($sql);
    }

    //分页获取商品的类型
//    public function getPageTypes($offset, $limit)
//    {
//        $sql = "select * from {$this->table} order by type_id desc limit $offset,$limit;";
//        return $this->db->getAll($sql);
//    }

    //分页获取商品类型数量
    public function getPageTypes($offset, $limit)
    {
        $sql = "select a.*,count(attr_name) as num from cz_goods_type as a left join cz_attribute as b on a.type_id = b.type_id group by a.type_id order by a.type_id desc limit $offset,$limit";
        return $this->db->getAll($sql);
    }
}