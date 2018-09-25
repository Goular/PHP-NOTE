<?php
/**
 * 用于PHP数据库表前缀的控制
 */
namespace Model;
use \Think\Model;

//父类Model
class EnglishModel extends Model{
    //实际的数据表的名字，这种写法不会添加前缀
    protected $trueTableName = "english";
}