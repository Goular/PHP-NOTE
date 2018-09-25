<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<p>{$love}</p>

<p>{$age}</p>


<ul>
    <li>{$star[0]}</li>
    <li>{$star[1]}</li>
    <li>{$star[2]}</li>
    <li>{$star[3]}</li>
</ul>
<hr/>

<ul>
    <li>{$star.0}</li>
    <li>{$star.1}</li>
    <li>{$star.2}</li>
    <li>{$star.3}</li>
</ul>
<hr/>
<ul>
    <li>{$user['id']}</li>
    <li>{$user['name']}</li>
    <li>{$user['nickname']}</li>
</ul>
<hr/>
<ul>
    <li>{$user.id}</li>
    <li>{$user.name}</li>
    <li>{$user.nickname}</li>
</ul>
<hr/>

{$smarty.now}
<br/>
{$smarty.version}
<br/>
{$smarty.server.SERVER_NAME}
<br/>
{$smarty.const.ROOT}

<hr/>
{config_load file = "site.conf" section='newyear'}
<br/>
{#copyright#}
<br/>
{$smarty.config.police}
<br/>
{#color#}
<br/>
{$smarty.config.color}
</body>
</html>