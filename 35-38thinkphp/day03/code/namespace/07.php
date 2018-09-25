<?php
namespace beijing\haidian\xisanqi;
const USER = "root";
function getInfo(){
    echo "bread";
}
const HOST = "localhost";

namespace liaoning\shenyang\tiexi;
const USER = "admin";

//项目需要频繁“访问其他空间”元素
//为了降低访问其他空间的复杂度，可以把频繁访问的空间给引入到当前空间
//进而可以通过“限定名称”方式访问元素
//“限定名称”：就是被引入空间的最后一级空间信息
use beijing\haidian\xisanqi;
echo xisanqi\USER,"<br/>";//root
xisanqi\getInfo();//bread
echo "<br/>";
echo xisanqi\HOST,"<br/>";//localhost

echo USER;//admin