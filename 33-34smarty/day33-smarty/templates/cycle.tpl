<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        {literal}
        .odd {
            background: #ddd;
        }

        {/literal}
    </style>
</head>
<body>
<table width="600" border="1">
    <tr>
        <th>编号</th>
        <th>姓名</th>
        <th>绰号</th>
        <th>武器</th>
    </tr>
    {foreach $user as $v}
        <tr
                {if $v@iteration is odd } class='odd' {/if}
        >
            <td>{$v.id}</td>
            <td>{$v.name}</td>
            <td>{$v.nickname}</td>
            <td>{$v.weapon}</td>
        </tr>
    {/foreach}
</table>

<hr>
<table width="600" border="1">
    <tr>
        <th>编号</th>
        <th>姓名</th>
        <th>绰号</th>
        <th>武器</th>
    </tr>
    {foreach $user as $v}
        <tr class="{cycle values="odd,even"}">
            <td>{$v.id}</td>
            <td>{$v.name}</td>
            <td>{$v.nickname}</td>
            <td>{$v.weapon}</td>
        </tr>
    {/foreach}
</table>

</body>
</html>