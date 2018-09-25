<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>
</head>
<body>
<h2>你的智商指数是:{$iq}</h2>

<p>

    根据智商，最适合联系的武功是
    {if $iq<=100&&$iq>90}
        功夫1
    {elseif $iq<=90 &&$iq>80}
        功夫2
    {elseif $iq<=80 &&$iq>70}
        功夫3
    {elseif $iq<=70 &&$iq>60}
        功夫4
    {else}
        功夫5
    {/if}


</p>
</body>
</html>