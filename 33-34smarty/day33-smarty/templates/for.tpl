<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>
</head>
<body>
<ul>
    {foreach $star as $key => $value}
        <li>{$key} ---- {$value}</li>
    {/foreach}

    <hr/>

    {foreach $user as $key => $value}
        <li {if $key is even}style="color: tomato" {/if}>{$value['id']}---{$value.name}--{$value@index}--{$value@iteration}--{$value@first}--{$value@last}</li>
    {/foreach}
</ul>
</body>
</html>