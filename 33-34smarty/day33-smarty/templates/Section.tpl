<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>
</head>
<body>
{section name='index' loop='4'}
    <li>{$star[index]}</li>
{/section}

<hr/>

{section name='index2' loop='4'}
    <li>{$user[index2]}</li>
{/section}

<hr/>
{section name='index' loop=$star}
    <li>{$star[index]}</li>
{/section}


</body>
</html>