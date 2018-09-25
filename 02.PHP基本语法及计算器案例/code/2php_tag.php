<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<!--作用：用于输出PHP的四种编写代码域的方法-->

<!--方法一：普通定界符-->
<?php
echo "<br/>abc11";
echo "<br/>abc12";
echo "<br/>abc13";
?>

<hr/>
<!--方法二:短标签 支持并不好，需要打开php的配置 short_open_tag=On-->
<?
echo "<br/>abc22";
echo "<br/>abc23";
echo "<br/>abc24";
?>

<hr/>
<!--方法三:ASP风格的短标签 asp_tags=On-->
<%
echo "<br/>abc33";
echo "<br/>abc34";
echo "<br/>abc35";
%>

<hr/>
<!--方法四：javascript定义法-->
<script language="php">
    echo "<br/>abc44";
    echo "<br/>abc45";
    echo "<br/>abc46";


</script>


</body>
</html>

<!--注意，若PHP标签后没有内容，最好不要写"?>",这样很容易造成在"?>"后面多了一样，形成编译报错的异常-->

<hr/>

<?php
echo "<br/>abc55";
echo "<br/>abc56";
echo "<br/>abc57";