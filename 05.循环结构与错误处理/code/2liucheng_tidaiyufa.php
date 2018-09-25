<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<!--流程控制，替代语法，但是是不推荐使用，只要看的懂就可以了-->
<?php
$v1 = 5;
if ($v1 > 0):
    echo "abcd<br/>";
    echo "123";
else:
    echo "XYZ";
endif;


$v2 = 5;
while ($v2 <= 10):
    echo "<br/>{$v1}";
    $v1++;
endwhile;


//for的使用方法
for ($i = 1; $i <= 20; ++$i):
endfor;


//if的替代用法
if ($v1 > 0):

elseif ($v1 < 10):

else:

endif;

//switch case的替代用法
switch ($v1):
    case 1:
        break;
    default:
        break;
endswitch;

?>

</body>
</html>