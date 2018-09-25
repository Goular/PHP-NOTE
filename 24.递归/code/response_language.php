<?php
/**
 * i18N的国际化的处理
 */
header('Content-Type: text/html; charset=utf-8');

//项目中的语言支持
$support_list = getSupportLang();

//获取浏览器的语言支持保存
$browser_list = getBrowserLang();

//获取当前的语言
$curr_lang = getLang($support_list, $browser_list);


require './language/' . $curr_lang . '.php';
echo $lang['HELLO'], '', $_GET['name'];


// 获得项目中支持的语言！
function getSupportLang()
{
    $path = './language/';
    $handle = opendir($path);
    while ($filename = readdir($handle)) {
        if ($filename == '.' || $filename == '..') continue;
        $lang_list[] = substr($filename, 0, strpos($filename, '.'));
    }

    return $lang_list;
}

//获得浏览器所支持的语言
function getBrowserLang()
{
    $accept_language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
    // en,zh-CN;q=0.7,ar-EG;q=0.3
    // 分析上面的字符串，获取数组array('en', 'zh_cn', 'ar_eg')
    $lang_list = explode(',', $accept_language);
    foreach ($lang_list as $lang) {//$lang = zh-CN;q=0.7
        $tmp_arr = explode(';', $lang);
        $tmp_lang = $tmp_arr[0];//zh-CN
        $browser_list[] = str_replace('-', '_', strtolower($tmp_lang));
    }
    return $browser_list;
}


//找到浏览器最希望的。
function getLang($s_l, $b_l)
{
    //设定默认的语言
    $lang = 'zh_cn';
    foreach ($b_l as $l) {
        if (in_array($l, $s_l)) {
            //如果浏览器最想要的语言，与服务器支持的语言匹配的上，就停止
            $lang = $l;
            break;
        }
    }
    return $lang;
}
