<?php

class BrandModel extends Model
{
    //获取所有品牌的信息
    public function getBrands()
    {
        $sql = "select * from {$this->table}";
        return $this->db->getAll($sql);
    }

    //分页获取品牌信息
    public function getPageBrands($offset, $limit)
    {
        $sql = "select * from {$this->table} limit $offset,$limit";
        return $this->db->getAll($sql);
    }
}