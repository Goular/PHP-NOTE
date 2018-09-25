<?php
//mkdir
/**
 * pathname目录的路径。
 *
 * mode默认的 mode 是 0777，意味着最大可能的访问权。有关 mode 的更多信息请阅读 chmod() 页面。
 *
 * Note:
 *
 * mode 在 Windows 下被忽略。
 *
 * 注意也许想用八进制数指定模式，也就是说该数应以零打头。模式也会被当前的 umask 修改，可以用 umask() 来改变。
 *
 * recursiveAllows the creation of nested directories specified in the pathname.
 */
//$path = './where/to/some/path';
//$result = mkdir($path, 0777, true);//没有第三个参数，那么没有创建的二三级目录也不会进行创建，因为默认设置是没有循环创建文件夹
//var_dump($result);

//rmdir
/**
 * bool rmdir ( string $dirname [, resource $context ] )
 * 尝试删除 dirname 所指定的目录。 该目录必须是空的，而且要有相应的权限。 失败时会产生一个 E_WARNING 级别的错误。
 */
//$path = './where/to/some/path';
//$result = rmdir($path);//不会循环删除文件夹，只会删除一个文件夹，要循环删除文件夹，需要使用递归
//var_dump($result);


//opendir,readdir,closedir
$path = 'E:/webroot/www/PHP_Learning';

//获得文件夹资源
$handle = opendir($path);//打开句柄，这是一个资源的对象
//var_dump($handle);

/**
 * $filename = readdir($handle) 可能文件名为0时就会出现while(0) == while(false)(模糊比较)
 */
while (false !== ($filename = readdir($handle))) {
    //'.','..'文件夹应该忽略
    if ($filename == '.' || $filename == '..') continue;
    echo $filename, "<br>";
}


//$filename = readdir($handle);
//echo $filename, '<br>';
//$filename = readdir($handle);
//echo $filename, '<br>';
//$filename = readdir($handle);
//echo $filename, '<br>';
//$filename = readdir($handle);
//echo $filename, '<br>';
//$filename = readdir($handle);
//echo $filename, '<br>';

//关闭文件夹资源
closedir($handle);

//重命名,与移动其实很类似
$old_path = './where';
$new_path = './new_where';
//$new_path = './new_where';
$result = rename($old_path, $new_path);
var_dump($result);