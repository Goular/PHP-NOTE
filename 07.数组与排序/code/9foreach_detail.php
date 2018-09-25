<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
//演示foreach值变量的“值传递”含义：
//遍历过程中值变量默认的传值方式是值传递。
$arr4 = array(1 => 3, 'a1' => 11, 3 => 5, "mn" => 18, 88 => 2);
foreach ($arr4 as $key => $value) {
    $value = $value * 2;//原数据乘以3
    echo "<br />$key ：$value";
}
//虽然foreach中，修改了value的值，但是数组本身是没变的：
echo "<pre>";
echo "<br /> 结果为：";
print_r($arr4);
echo "</pre>";

echo "<hr/>";

//演示foreach值变量的“引用传递”含义：
//遍历过程中值变量使用“引用传递”(&)方式：
$arr5 = array(1 => 3, 'a1' => 11, 3 => 5, "mn" => 18, 88 => 2);
foreach ($arr5 as $k => $v) {
    echo "<br/>$k => $v ";
    if ($k == 1) {
        break;
    }
}
$r1 = current($arr5);
$r2 = key($arr5);
echo "<br/>此时数组指针指向的单元为: $r2=>$r1";

echo "<hr/>";

//演示：当在foreach循环过程中，“修改数组”，则我们可以观察到：
//此修改不影响遍历的“本来”过程：即虽然修改了，但遍历不受影响
//好像似乎还按照“既定方针”进行下去
$arr6 = array(1 => 3, 'a1' => 11, 3 => 5, "mn" => 18, 88 => 2);
foreach ($arr6 as $k2 => $v2) {
    echo "<br/>$k2 ：$v2";
    if ($k2 === 3) {
        $arr6[99] = "此处为新添加数据项";//自执行了这句话后，会将当前的$arr6复制一份(预定义为$a6,foreach继续执行这个复制备份，所以一直遍历到最后，都不会看到最新添加的内容，但是新添加的内容已经添加到原数组$arr6上，所以遍历完后，再一次输出$arr6，就会看到新添加的内容，就是因为foreach读取的是，$arr6在执行CRUD操作前的复制拷贝，这样才能保证数据的显示稳定，不然就会报bug)
    }
}
echo "<br/>但此时，该项的内容已经添加进去了:<br/>";
echo "<pre>";
print_r($arr6);
echo "</pre>";


echo "<hr/>";
//演示：当在foreach循环过程中，值变量使用“引用传递”，
//则无论如何，都是在原数组中进行,而不会出现数组的拷贝显示：
$arr7 = array(1 => 3, 'a1' => 11, 3 => 5, "mn" => 18, 88 => 2);
foreach ($arr7 as $k3 => &$v3) {
    $v3 *= 2;
    echo "<br/>$k3 => $v3";
    if ($k3 == 3) {
        $arr7[99] = "新的数据即将添加";
        //而且，是添加到数组末尾。
        //这里因为用的引用传递，新项到最后也会取得
        //因为使用引用传递的操作，不会拷贝原来的数组给foreach继续往下走，而是用用原数组，这样，在当前项后面添加的内容也会在遍历的过程中显示出来
    }
}
echo "<br />遍历后，也能看出来：<br />";
echo "<pre>";
print_r($arr7);
echo "</pre>";
?>
</body>
</html>