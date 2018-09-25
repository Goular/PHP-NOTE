<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>{$title}</h1>
    <p>{$content}</p>

    <p>
        {if $love}
            真爱
        {else}
            骗子
        {/if}
        <h2></h2>
    </p>

    <ul>
        {foreach $star as $k => $v}
            <li>{@k}---{@v}</li>
        {/foreach}
    </ul>
</body>
</html>