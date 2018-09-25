<?php
require './UserModel.class.php';

class ModelFactory
{
    //用于存储各个模型类的唯一实例（单例）
    private static $all_model = array();

    //$model_name是一个模型类的类名
    static function M($model_name)
    {
        //如果不存在或者是类对象为空
        if (!isset(static:: $all_model[$model_name]) || !(static::$all_model[$model_name] instanceof $model_name)) {
            static:: $all_model[$model_name] = new $model_name();
        }
        return static::$all_model[$model_name];
    }
}