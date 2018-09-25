<?php

/**
 * 商品分类的模型
 */
class CategoryModel extends Model
{

    //获取当前的所有分类
    public function getCats()
    {
//        旧版内容
//        $sql = "select * from {$this->table};";
//        return $this->db->getAll($sql);
//        新版内容
        $sql = "select * from {$this->table};";
        $cats = $this->db->getAll($sql);
        return $this->tree($cats);
    }

    //对给定的数组进行重新的排序
    private function tree($arr, $pid = 0, $level = 0)
    {
        static $res = array();
        foreach ($arr as $cat) {
            if ($cat['parent_id'] == $pid) {
                $cat['level'] = $level;
                $res[] = $cat;
                $this->tree($arr, $cat['cat_id'], $level + 1);
            }
        }
        return $res;
    }

    //指定了一个cat_id,获取其后代所有分类的cat_id
    public function getSubIds($cat_id)
    {
        $sql = "select * from {$this->table}";
        $cats = $this->db->getAll($sql);
        $cats = $this->tree($cats, $cat_id);
        $ids = array();
        foreach ($cats as $cat) {
            $ids[] = $cat['cat_id'];
        }
        //将自己也追加进来
        $ids[] = $cat_id;
        return $ids;
    }

    //将平行的二维数组，转成包含关系的多维数组
    public function child($arr, $pid = 0)
    {
        $res = array();
        foreach ($arr as $v) {
            if ($v['parent_id'] == $pid) {
                //找到了，继续查找其后代节点
                //$temp = $this->child($arr,$v['cat_id']);
                //将找到的结果作为当前数组的一个元素来保存，其下标是child
                //$v['child'] = $temp;
                $v['child'] = $this->child($arr, $v['cat_id']);
                $res[] = $v;
            }
        }
        return $res;
    }

    //获取前台的分类
    public function frontCats()
    {
        $sql = "select * from {$this->table}";
        $cats = $this->db->getAll($sql);
        return $this->child($cats);
    }

}