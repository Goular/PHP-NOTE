<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>单词查询</title>
</head>
<body>
<?php
$res = "";
if (isset($_POST['btn'])) {
    //获取单词
    $word = trim($_POST['word']);
    //开始查询
    $dom = new DOMDocument('1.0', 'utf-8');
    $dom->load('dic.xml');
    $names = $dom->getElementsByTagName('name');
    $means = $dom->getElementsByTagName('mean');
    foreach ($names as $key => $name) {
        if ($name->nodeValue == $word) {
            $res = $means->item($key)->nodeValue;
            break;
        } else {
            $res = "没有该词条";
        }
    }
}
?>
<form action="" method="post">
    <label>请输入要查询的单词:</label>
    <input type="text" name="word"/>
    <input type="submit" value="查询" name="btn"/>
</form>
<div>
    <?php echo $res ?>
</div>
</body>
</html>