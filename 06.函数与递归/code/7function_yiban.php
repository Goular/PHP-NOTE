<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
//由于引用的时候会定义重名的定义方法
//为了不要重复定义相同名字的方法，所以我们会进行存在性判断
//同名方法已经存在的话，就不要进行定义了，直接调用，否在就进行定义
if (!function_exists('f1')) {
    //如果函数f1没有的定义
    function f1()
    {
        echo "<br/>function f1 already init..";
    }
}
//上面的写法保证function f1必须存在,下面运行f1不会报错

f1();

?>
</body>
</html>