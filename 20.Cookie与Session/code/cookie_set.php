<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
/**
 * 设置cookie
 *
 * bool setcookie ( string $name [, string $value = "" [, int $expire = 0 [, string $path = "" [, string $domain = "" [, bool $secure = false [, bool $httponly = false ]]]]]] )
 * $name 键名
 * $value 键值 ""空字符串即为删除
 * $expire 有效期 有效期的默认值是0
 * $path 有效的路径
 * $domian 作用域的域名
 * $secure 是否是启动HTTPS才能读取的保密机制
 * $httponly 是否处HTTP操作外能读取该Cookie，其余状态是不能读取cookie的设置，即脚本JS是不能访问该cookie
 */

/**
 * 成功设置cookie返回true,注意设置好了cookie后，要第二次访问才能生效，因为生成和读取的操作，是两次访问的结果，一次访问时做不到既去设定又去读取的问题
 */
//设置
//会话结束后消失，即关闭浏览器后，就不见了
//$result = setcookie('is_login', 'yes');//没有设置超时时间的cookie的有效期是在关闭浏览器后就会消失,在会话结束时
//var_dump($result);


//属性1 $expire 有效期 ,有效期的判断总在浏览器去做，服务器是不会判断有效期，但服务器可以设置有效期
//$result = setcookie('long_time', 'after-3600s', time() + 3600);//没有设置超时时间的cookie的有效期是在关闭浏览器后就会消失,在会话结束时
//var_dump($result);

//设置有效期永久有效的设置(即设置一个PHP所能添加的最大整数),目前浏览器认为最大的是2038年，即unixtime的最大值
//$result = setcookie("long_long", "long_long", PHP_INT_MAX);
//var_dump($result);

//删除当前的cookie
//$result = setcookie('willBeDeleted', 'somevalue', time()-1);//当前时间-1即为删除时间，因为有效期已经过期了
//var_dump($result);

//但这种写法，仅限于PHP，是语法糖，所以，还是建议直接使用time()-1加键值为''空字符串的写法，这样写可以多重保证能都删除cookie的内容
//$result = setcookie('autoDelete', '');//即键值为空字符串的时候，那么在PHP也是一种删除
//var_dump($result);

//最标准的删除Cookie属性的写法
//$result = setcookie('autoDelete', '', time() - 1);
//var_dump($result);

//属性4，有效路径使用的较少(相关的代码，移到./sub/文件夹下)

//属性名:有效域名
//默认的：某个域名下设置的COOKIE，仅仅可以在当前域名下所使用！
//但是二级域名是不能够使用的
//凡是一级域名满足条件的cookie我都可以进行阅读
//$result = setcookie('domain_1', 'test.zhao.com', 0, '', '.zhao.com');
//var_dump($result);

//属性名:是否支持安全连接(HTTPS)的使用
//$result = setcookie("secure_no", 'no', 0, '', '', false);
//var_dump($result);

//调用此语句后，就会产生一个，该Cookie的属性仅支持在hTTPS上访问的光用传统
//setcookie("secure_yes", 'yes', 0, '', '', true);
//var_dump($result);

//属性名:HTTPONLY，该设置是表名相关的设置仅仅用于http请求的时候才能使用，别的地方(包含JavaScript的脚本等都是禁止调用的)
//setcookie('httponly_no', 'no', 0, '', '', false, false);// 不是httponly，除了http请求，其他地方（浏览器端脚本JavaScript）也可以用
//设置了true后，那么JavaScript脚本就不能顺利进行访问到此Cookie属性了
//setcookie('httponly_yes', 'yes', 0, '', '', false, true);// 是httponly，除了http请求，其他地方（浏览器端脚本JavaScript）不可以用

//todo：错误示范
//值得注意的是，Cookie
//仅仅支持字符串类型数据，只要基本类型可以直接转化为字符串的都是可以的，但是数组是不行的，有两个办法，一个是将数组进行序列化，另一个使用implode
//setcookie("int", 1);//这个是可以使用
//setcookie("boolean_false", false);//这个false是不行的，原因是是false转字符串会变成空字符串的代表，所以直接不写到cookie上，解决的办法使用settype，strval，和强转进行处理
//setcookie("boolena_true", true);//这个是可以使用
//setcookie("arrat", array("123", "234"));//这个setCookie的方法是存在错误

//todo:下面是正确处理各种类型的办法
//serialize($value) 方法是价格内容转化为字符流的字符串，通过unserialize()方法即可进行处理
//setcookie("int", serialize(1));
//setcookie("boolean_false", serialize(false));
//setcookie("boolena_true", serialize(true));
//setcookie("arrat", serialize(array("123", "234")));


//当前脚本周期setcookie所设置的COOKIE变量，是不会出现在$_COOKIE中！
echo date('Y-m-d H:i:s'), '<br/>';
setcookie("new_key", 'new_value' . date('H:i:s'));
var_dump($_COOKIE['new_key']);

//$_Cookie中的变量在当前脚本设置好之后，是不会直接能够访问的，必须等到下一次访问时，才能获取上一次设定的$_Cookie属性

?>
</body>
</html>