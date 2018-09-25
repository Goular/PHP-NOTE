<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>
</head>
<body>
{$smarty.now}
<br>
{$smarty.now|date_format:'%Y-%m-%d %H:%M:%S'}
<br>
{$smarty.now|date_format:'%Y-%m-%d %T'}
<hr/>

{$poem}
<br>
{$poem|truncate:15:'***'|upper}

<hr/>
{'hello'|str_repeat:$level}
</body>
</html>