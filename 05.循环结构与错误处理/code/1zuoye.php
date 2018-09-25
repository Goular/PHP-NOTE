<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>


<!--第四天的作业-->

<?php
$n = 7;
define("KONGGE", "&ensp;");

echo "<p>图形A：<br/>";
for ($i = 1; $i <= $n; ++$i) {
    for ($j = 1; $j <= $n; ++$j) {
        echo "*";
    }
    echo "<br />";
}

echo "<p>图形B：<br/>";
for ($i = 1; $i <= $n; ++$i) {
    for ($j = 1; $j <= $i; ++$j) {
        echo "*";
    }
    echo "<br />";
}

echo "<p>图形C：<br/>";
for ($i = 1; $i <= $n; ++$i) {
    for ($j = 1; $j <= 2 * $i - 1; ++$j) {
        echo "*";
    }
    echo "<br />";
}


echo "<p>图形D：<br/>";
for ($i = 1; $i <= $n; ++$i) {
    for ($k = 1; $k <= $n - $i; ++$k) {
        echo KONGGE;
    }
    for ($j = 1; $j <= 2 * $i - 1; ++$j) {
        echo "*";
    }
    echo "<br />";
}


echo "<p>图形E：<br />";
for ($i = 1; $i <= $n; ++$i) {
    for ($k = 1; $k <= $n - $i; ++$k) {
        echo KONGGE;
    }
    for ($j = 1; $j <= 2 * $i - 1; ++$j) {
        if ($j == 1 || $j == 2 * $i - 1) {//是第一个或最后一个
            echo "*";
        } else {
            echo KONGGE;
        }
    }
    echo "<br />";
}

echo "<p>图形F：<br />";
for ($i = 1; $i <= $n; ++$i) {
    for ($k = 1; $k <= $n - $i; ++$k) {
        echo KONGGE;
    }
    for ($j = 1; $j <= 2 * $i - 1; ++$j) {
        if ($i == $n) {//是最后一行
            echo "*";
        } else {
            if ($j == 1 || $j == 2 * $i - 1) {//是第一个或最后一个
                echo "*";
            } else {
                echo KONGGE;
            }
        }
    }
    echo "<br />";
}


echo "<p>图形G：<br />";
for ($i = 1; $i <= $n; ++$i) {
    for ($k = 1; $k <= $n - $i; ++$k) {
        echo KONGGE;
    }
    for ($j = 1; $j <= 2 * $i - 1; ++$j) {
        if ($j == 1 || $j == 2 * $i - 1) {//是第一个或最后一个
            echo "*";
        } else {
            echo KONGGE;
        }
    }
    echo "<br />";
}
for ($i = $n - 1; $i >= 1; --$i) {
    for ($k = 1; $k <= $n - $i; ++$k) {
        echo KONGGE;
    }
    for ($j = 1; $j <= 2 * $i - 1; ++$j) {
        if ($j == 1 || $j == 2 * $i - 1) {//是第一个或最后一个
            echo "*";
        } else {
            echo KONGGE;
        }
    }
    echo "<br />";
}


/*
百钱百鸡问题：
已知：公鸡5元一只，母鸡3元一只，小鸡一元3只。现用100元钱买了100只鸡，
问：公鸡母鸡小鸡各几只？——请考虑尽可能高效的方法。
*/
/*
分析：
	假设1只公鸡，1只母鸡，1只小鸡，算算：总数和总价，发现不对！
	假设1只公鸡，1只母鸡，2只小鸡，算算：总数和总价，发现不对！
	假设1只公鸡，1只母鸡，3只小鸡，算算：总数和总价，发现不对！
	.........
	假设1只公鸡，2只母鸡，1只小鸡，算算：总数和总价，发现不对！
	假设1只公鸡，2只母鸡，2只小鸡，算算：总数和总价，发现不对！
	................
	假设2只公鸡，1只母鸡，1只小鸡，算算：总数和总价，发现不对！
	假设2只公鸡，1只母鸡，2只小鸡，算算：总数和总价，发现不对！
	.......................
	假设100只公鸡，100只母鸡，100只小鸡，算算：总数和总价，发现不对！
	这种思路，就称为：穷举思路，穷举思想，它适合于这种场合的问题：
		问题的答案可能没有很直接的逻辑推理结论，但可以将所有“可能答案”
		都罗列出来，并且具有一定的规律！
*/
//原始思路：（穷举的演示）：
$c = 0;
for ($gongji = 0; $gongji <= 100; ++$gongji) {
    for ($muji = 0; $muji <= 100; ++$muji) {
        for ($xiaoji = 0; $xiaoji <= 100; ++$xiaoji) {

            $shuliang = $gongji + $muji + $xiaoji;    //计算总数
            $zongjia = $gongji * 5 + $muji * 3 + $xiaoji / 3;//计算总价
            if ($shuliang == 100 && $zongjia == 100) {
                echo "<br />公鸡为：$gongji, 母鸡为：$muji, 小鸡为：$xiaoji";
            }
            ++$c;    //代表进行计算的次数
        }
    }
}
echo "<br />总计算次数：$c";


//优化1：
$c = 0;
for ($gongji = 0; $gongji <= 100 / 5; ++$gongji) {//考虑公鸡的价格
    for ($muji = 0; $muji <= 100 / 3; ++$muji) {//考虑母鸡鸡的价格
        //for($xiaoji = 0; $xiaoji<=100; ++$xiaoji){
        $xiaoji = 100 - $gongji - $muji;//一旦确定公鸡母鸡数量，小鸡数量也可以确定了！

        //$shuliang = $gongji + $muji + $xiaoji;	//计算总数
        $zongjia = $gongji * 5 + $muji * 3 + $xiaoji / 3;//计算总价
        if ($zongjia == 100) {
            echo "<br />公鸡为：$gongji, 母鸡为：$muji, 小鸡为：$xiaoji";
        }
        ++$c;    //代表进行计算的次数
        //}
    }
}
echo "<br />总计算次数：$c";

//优化2：
$c = 0;
for ($gongji = 0; $gongji <= 100 / 5; ++$gongji) {//考虑公鸡的价格
    for ($muji = 0; $muji <= (100 - $gongji * 5) / 3; ++$muji) {//考虑母鸡鸡的价格，以及公鸡所花掉的钱
        //for($xiaoji = 0; $xiaoji<=100; ++$xiaoji){
        $xiaoji = 100 - $gongji - $muji;//一旦确定公鸡母鸡数量，小鸡数量也可以确定了！

        //$shuliang = $gongji + $muji + $xiaoji;	//计算总数
        $zongjia = $gongji * 5 + $muji * 3 + $xiaoji / 3;//计算总价
        if ($zongjia == 100) {
            echo "<br />公鸡为：$gongji, 母鸡为：$muji, 小鸡为：$xiaoji";
        }
        ++$c;    //代表进行计算的次数
        //}
    }
}
echo "<br />总计算次数：$c";

//优化3：
$c = 0;
for ($gongji = 0; $gongji <= 100 / 5; ++$gongji) {//考虑公鸡的价格
    for ($muji = 0; $muji <= (100 - $gongji * 5) / 3; ++$muji) {//考虑母鸡鸡的价格，以及公鸡所花掉的钱
        //for($xiaoji = 0; $xiaoji<=100; ++$xiaoji){
        $xiaoji = 100 - $gongji - $muji;//一旦确定公鸡母鸡数量，小鸡数量也可以确定了！
        if ($xiaoji % 3 != 0) {
            continue;    //考虑小鸡的数量应该是3的倍数，价钱才能“取整”
        }

        //$shuliang = $gongji + $muji + $xiaoji;	//计算总数
        $zongjia = $gongji * 5 + $muji * 3 + $xiaoji / 3;//计算总价
        if ($zongjia == 100) {
            echo "<br />公鸡为：$gongji, 母鸡为：$muji, 小鸡为：$xiaoji";
        }
        ++$c;    //代表进行计算的次数
        //}
    }
}
echo "<br />总计算次数：$c";

?>

</body>
</html>