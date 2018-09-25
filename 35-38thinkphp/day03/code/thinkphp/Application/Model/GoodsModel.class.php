<?php
/**
 * 用于商品模型的显示
 */
namespace Model;
use \Think\Model;

class GoodsModel extends Model{
    // 是否批处理验证
    // 批量获得全部的错误验证信息
    protected $patchValidate    =   true;
    //通过定义$_validate成员，设置表单验证的规则
    // 自动验证定义
    protected $_validate        =   array();
}