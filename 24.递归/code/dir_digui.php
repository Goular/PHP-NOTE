<?php
//Windows下是gbk模式，所以使用utf-8会乱码
header("Content-type:text/html;charset=gbk");
//$path = 'F:/easemob-sdk-3.1.5';
//readDirs($path);

/**
 * @param  [type]  $path [description]
 * @param  integer $deep 当前深度
 * @return [type]        [description]
 */
//先读取某个目录内容（不包含子目录的）：
//function readDirs($path, $deep = 0)
//{
//    $handle = opendir($path);
//    while (false !== ($filename = readdir($handle))) {
//        //若是'.','..'文件夹跳过
//        if ($filename == '.' || $filename == '..') continue;
//
//        echo $filename, "<br/>";
//    }
//    closedir($handle);
//}


/**
 * @param $path
 * @param int $deep
 * 判断每个读到的文件是否为目录：
 * 如果为目录，递归调用，将当前子目录作为参数传递。
 */
//function readDirs($path)
//{
//    $handle = opendir($path);
//    while (false !== ($filename = readdir($handle))) {
//        //若是'.','..'文件夹跳过
//        if ($filename == '.' || $filename == '..') continue;
//
//        echo $filename, "<br/>";
//
//        //判断当前读取到的是否是目录
//        if (is_dir($path . '/' . $filename)) {
//            readDirs($path . '/' . $filename);
//        }
//    }
//    closedir($handle);
//}


/**
 * @param $path
 * @param int $deep 当前传入的层级，默认不传层级的话为0
 *
 * 作用:形成树状的文件夹的形式
 */
//function readDirs($path, $deep = 0)
//{
//    $handle = opendir($path);
//    while (false !== ($filename = readdir($handle))) {
//        //若是'.','..'文件夹跳过
//        if ($filename == '.' || $filename == '..') continue;
//
//        //判断层级，输出相应的文件树状路径
//        echo str_repeat('&nbsp;', $deep * 4), $filename, '<br/>';
//
//        //判断当前读取到的是否是目录
//        if (is_dir($path . '/' . $filename)) {
//            readDirs($path . '/' . $filename, $deep + 1);
//        }
//    }
//    closedir($handle);
//}


//------------------------------------华丽的分割线--------------------------------------------------------------

$path = 'F:/easemob-sdk-3.1.5';
$result = readDirs_array($path);
echo "<pre>";
var_dump($result);
echo "</pre>";


/**
 * 返回数组版的内容
 */
function readDirs_array($path, $deep = 0)
{
    // static 保证在readDirs_array中，一直可以存在，为了保证每次递归调用，操作都是一同一个数据（数组）
    //在函数上使用static，作用域为函数内部，有效期为脚本周期结束
    static $file_list = array();// 存储所有的文件信息，二维数组！
    $handle = opendir($path);
    while (false !== ($filename = readdir($handle))) {
        // ., .. 直接跳过
        if ($filename == '.' || $filename == '..') continue;
        // 将当前文件信息，存储到数组中
        $fileinfo['filename'] = $filename;
        $fileinfo['deep'] = $deep;
        // 放入二维数组中！
        $file_list[] = $fileinfo;
        //判断当前读取到的是否为目录
        if (is_dir($path . '/' . $filename)) {
            readDirs_array($path . '/' . $filename, $deep + 1);
        }
    }
    closedir($handle);
    return $file_list;
}