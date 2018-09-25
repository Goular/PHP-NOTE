<?php
header('Content-type:text/html;charset=utf-8');

echo '<pre>';
var_dump($_POST);
echo "<hr/>";
var_dump($_FILES);
echo "<hr/>";

/**
 * 每一个文件的上传的内容有以下的key--value
 * name ：文件名
 * type : MINE类型
 * tmp_name : 临时存放位置
 * error : 当前的错误代码，0为没有错误
 * size : 当前文件的大小，需要注意的是，一般错误为5的时候，size一般为0，所以我们一般可以这样认为，就是我们的error等于5的时候，是当前文件大小为0
 */

$result = uploadFile($_FILES['goods_image']);
var_dump($result);
echo "<hr/>";

/**
 * 文件上传（业务逻辑判断）函数
 * 一次上传（判断）一个文件
 * @param array $file_info 某个临时上传文件的5个信息，由$_FILES中获得！
 * @return string:成功，目标文件名；false: 失败
 */
function uploadFile($file_info)
{
    //依据上传文件的资料，判断上传的我那件是否存在错误
    if ($file_info['error'] != 0) {
        echo '上传文件存在错误!';
        return false;
    }

    //根据上传文件的资料，判断上传文件的类型
    //定义能够接受的后缀名
    $ext_list = array('.jpg', '.png', '.gif', '.jpeg');//允许的后缀名列表
    $ext = strrchr($file_info['name'], '.');//查找某个子字符串在字符串中最后一次出现的位置，并返回从该位置到字符串结尾的全部内容！
    if (!in_array($ext, $ext_list)) {
        echo '类型，后缀名不合法!';
        return false;
    }

    //根据上传文件的资料，判断上传文件的类型
    //定义能够接受的MIME类型
    //MINE方法一(这个类型是浏览器上传过来的，可能具有欺骗性):
    $mine_list = array('image/jpeg', 'image/png', 'image/gif');///允许的mime列表！
    if (!in_array($file_info['type'], $mine_list)) {
        echo '类型，MINE类型不合法!';
        return false;
    }

    //MINE方法二:
    $finfo = new Finfo(FILEINFO_MIME_TYPE);
    $mine_type = $finfo->file($file_info['tmp_name']);
    if (!in_array($mine_type, $mine_list)) {
        echo '类型，MINE类型不合法!';
        return false;
    }


    //判断文件的大小支持800Kb图片
    $max_size = 8 * 100 * 1024;
    if ($file_info['size'] > $max_size) {
        echo '文件过大!';
        return false;
    }

    //设置目标文件的目录
    //上传目录
    $upload_path = './';//创建的目录在根文件夹
    // 采用子目录存储
    // 获取当前需要的子目录名（目录/小时）
    $sub_dir = date('YmdH') . '/';//当前的时间
    //判断当前的文件夹是否存在
    if (!is_dir($upload_path . $sub_dir)) {
        //若不存在当前的文件夹
        mkdir($upload_path . $sub_dir);
    }

    //目标文件名
    $prefix = '';//文件的前缀
    $dst_name = uniqid($prefix, true) . $ext;
    //echo '当前的文件名:' . $dst_name;

    //判断是否为HTTP上传文件的检测
    //is_uploaded_file — 判断文件是否是通过 HTTP POST 上传的
    if (!is_uploaded_file($file_info['tmp_name'])) {
        echo '不是HTTP上传过来的临时文件!';
        return false;
    }

    //进行临时文件的移动
    if (move_uploaded_file($file_info['tmp_name'], $upload_path . $sub_dir . $dst_name)) {
        //移动成功，上传目录之后的地址
        return $sub_dir . $dst_name;
    } else {
        echo '移动失败';
        return false;
    }

}
