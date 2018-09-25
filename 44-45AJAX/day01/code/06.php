<?php
//服务端用户名的校验
$exists_name = array(
    'mary', 'jack', 'linken', 'bier'
);
//输出客户端传递过来的用户名信息($_POST)

$name = $_POST['name'];
//echo $name;
//print_r($_GET);

//判断用户输入的名字是否已经存在
if (in_array($name, $exists_name)) {
    echo "用户名已经占用";
} else {
    echo "恭喜,可以使用";
}
