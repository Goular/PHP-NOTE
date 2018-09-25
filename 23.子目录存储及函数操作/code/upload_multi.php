<?php
header("Content-type:text/html;charset=utf-8");
echo "<pre>";
var_dump($_FILES);
echo "</pre>";
echo "<hr/>";

$result = uploadMulti($_FILES['goods_image']);

echo "各个文件上传的情况:", "<hr/>";
echo "<pre>";
var_dump($result);
echo "</pre>";

/**
 * [uploadMulti description]
 * @param  [type] $file_list [description]
 * @return array            每个上传文件的结果
 */
function uploadMulti($file_list)
{
    //遍历，其中的name元素，得到下标
    foreach ($file_list['name'] as $key => $value) {
        //利用下标，获得对应的5个元素值
        // $file_info每个文件的信息
        $file_info['name'] = $file_list['name'][$key];
        $file_info['type'] = $file_list['type'][$key];
        $file_info['tmp_name'] = $file_list['tmp_name'][$key];
        $file_info['error'] = $file_list['error'][$key];
        $file_info['size'] = $file_list['size'][$key];

        $result_list[$key] = uploadFile($file_info);
    }
    return $result_list;
}

/**
 * 文件上传（业务逻辑判断）函数
 * 一次上传（判断）一个文件
 * @param array $file_info 某个临时上传文件的5个信息，由$_FILES中获得！
 * @return string:成功，目标文件名；false: 失败
 */
function uploadFile($file_info)
{
    // 判断是否有错误
    if ($file_info['error'] != 0) {
        echo '上传文件存在错误,错误代号:' . $file_info['error'], "<hr/>";
        return false;
    }

    // 判断文件类型
    // 后缀名
    $ext_list = array('.jpg', '.png', '.gif', '.jpeg');
    $ext = strrchr($file_info['name'], '.');
    if (!in_array($ext, $ext_list)) {
        echo '类型，后缀不合法', "<hr/>";
        return false;
    }

    // MIME
    $mime_list = array('image/jpeg', 'image/png', 'image/gif');// 允许的mime列表！
    if (!in_array($file_info['type'], $mime_list)) {
        echo '类型，MIME不合法', "<hr/>";
        return false;
    }

    // PHP检测MIME
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    if (!in_array($finfo->file($file_info['tmp_name']), $mime_list)) {
        echo '类型,PHP检测MIME不合法', "<hr/>";
        return false;
    }

    // 判断大小
    $max_size = 700 * 1024;// 允许的最大尺寸
    if ($file_info['size'] > $max_size) {
        echo '文件过大', "<hr/>";
        return false;
    }

    // 设置目标文件地址
    // 上传目录
    $upload_path = './';

    // 采用子目录存储
    // 获取当前需要的子目录名（目录/小时）
    $sub_dir = date('YmdH') . "/";

    // 是否存在
    if (!is_dir($upload_path . $sub_dir)) {
        mkdir($upload_path . $sub_dir);
    }

    // 目标文件名
    $pre_fix = "";//文件名的前缀
    $dst_name = uniqid($pre_fix, true) . $ext;

    // 是否为HTTP上传文件的检测
    if (!is_uploaded_file($file_info['tmp_name'])) {
        echo '不是HTTP上传的临时文件', "<hr/>";
        return false;
    }

    // 移动！
    if (move_uploaded_file($file_info['tmp_name'], $upload_path . $sub_dir . $dst_name)) {
        //保存成功返回名字，用于数据库保存
        return $sub_dir . $dst_name;
    } else {
        echo '移动失败', "<hr/>";
        return false;
    }

}

