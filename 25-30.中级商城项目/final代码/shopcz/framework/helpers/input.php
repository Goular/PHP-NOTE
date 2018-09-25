<?php
//html标签批量实体转义
function deepspecialchars($data)
{
    if (empty($data)) {
        return $data;
    }
    //中高级程序员的写法
    return is_array($data) ? array_map('deepspecialchars', $data) : htmlspecialchars($data);
}

//批量单引号转义
function deepslashes($data){
    if (empty($data)) {
        return $data;
    }
    return is_array($data) ? array_map('deepslashes', $data) : addslashes($data);
}