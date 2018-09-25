<?php

//拓展属性模型
class AttributeModel extends Model
{
    //获取指定类型下的属性
//    public function getAttrs($type_id)
//    {
//        $sql = "select * from {$this->table} where type_id = $type_id";
//        $this->db->getAll($sql);
//    }

    //第二版，获取指定类型下的属性
    public function getAttrs($type_id, $offset, $limit)
    {
        $type_table = $GLOBALS['config']['prefix'] . "goods_type";
        $sql = "select * from {$this->table} as a INNER JOIN {$type_table} as b on a.type_id = b.type_id where a.type_id = {$type_id} limit $offset,$limit";
        return $this->db->getAll($sql);
    }

    //获取指定类型下所有属性，并形成表单返回
    public function getAttrsForm($type_id){
        $sql = "SELECT * FROM {$this->table} WHERE type_id = $type_id";
        $attrs = $this->db->getAll($sql);
        $res = "<table width='100%' id='attrTable'>";
        foreach ($attrs as $attr) {
            $res .= "<tr>";
            $res .= "<td class='label'>{$attr['attr_name']}</td>";
            $res .= "<td>";
            $res .= "<input type='hidden' name='attr_id_list[]' value='{$attr['attr_id']}'>";
            switch ($attr['attr_input_type']) {
                case 0: #文本框
                    $res .= "<input name='attr_value_list[]' type='text' size='40'>";
                    break;
                case 1: #下拉列表
                    $res .= "<select name='attr_value_list[]'>";
                    $res .= "<option value=''>请选择...</option>";
                    $opts = explode(PHP_EOL, $attr['attr_value']);
                    foreach ($opts as $opt) {
                        $res .= "<option value='$opt'>$opt</option>";
                    }
                    $res .= "</select>";
                    break;
                case 2: #文本域
                    $res .= "<textarea name='attr_value_list[]'></textarea>";
                    break;
            }
            $res .= "<input type='hidden' name='attr_price_list[]' value='0'>";
            $res .= "</td>";
            $res .= "</tr>";
        }
        $res .= "</table>";
        return $res;


        /*
        <table width='100%' id='attrTable'>
            <tr>
                <td class='label'>上市日期</td>
                <td>
                    <input type='hidden' name='attr_id_list[]' value='172'>
                        <select name='attr_value_list[]'>
                            <option value=''>请选择...</option>
                            <option value='2008年01月'>2008年01月</option>
                            <option value='2008年02月'>2008年02月</option>
                        </select>
                    <input type='hidden' name='attr_price_list[]' value='0'>
                </td>
            </tr>
            <tr>
                <td class='label'>存储卡格式</td>
                <td>
                    <input type='hidden' name='attr_id_list[]' value='180'>
                    <input name='attr_value_list[]' type='text' value='MicroSD' size='40'>
                    <input type='hidden' name='attr_price_list[]' value='0'>
                </td>
            </tr>
        </table>
        */
    }
}