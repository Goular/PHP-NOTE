<?php
//引入机制-空间类元素引入
namespace beijing\haidian\xisanqi;
class Animal{
    static $name = "pig";
}

namespace liaoning\shenyang\tiexi;
const USER = "admin";

use beijing\haidian\xisanqi\Animal;

echo Animal::$name;