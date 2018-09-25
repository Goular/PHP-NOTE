<?php
namespace beijing\haidian\xisanqi;
const HOST = 'L1';

namespace beijing\haidian\qinghuadaxue;
const HOST = 'N2';

namespace beijing\haidian;
const HOST = 'P3';

//use beijing\haidian\xisanqi;
//echo HOST;

echo xisanqi\HOST;//使用限定名称是会自动添上当前的namespace名称
//所以当前的名称是: beijing\haidian\xisanqi\HOST