<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

<?php
if (!empty($_POST)) {
    $num1 = $_POST['data1'];
    $num2 = $_POST['data2'];

    $fuhao = $_POST['yunsuanfu'];

    if ($fuhao == "+") {
        $jieguo = $num1 + $num2;
    } else if ($fuhao == "-") {
        $jieguo = $num1 - $num2;
    } else if ($fuhao == "*") {
        $jieguo = $num1 * $num2;
    } else if ($fuhao == "/") {
        $jieguo = $num1 / $num2;
    }
} else {
    $jieguo = "";
    $num1 = "";
    $num2 = "";
    $fuhao = "";
}

?>
<!--当action为空字符串的时候，是提交到本页面！
	表单中的所有数据，要想提交，都必须有name
-->

<form action="" method="post">
    <input type="text" name="data1" value="<?php if (!empty($num1)) echo "{$num1}" ?>"/>

    <select name="yunsuanfu">
        <option value="+" <?php if ($fuhao == "+") {
            echo 'selected="selected"';
        } ?>/>
        +</option>
        <option value="-" <?php if ($fuhao == "-") {
            echo 'selected="selected"';
        } ?>/>
        -</option>
        <option value="*" <?php if ($fuhao == "*") {
            echo 'selected="selected"';
        } ?>/>
        *</option>
        <option value="/" <?php if ($fuhao == "/") {
            echo 'selected="selected"';
        } ?>/>
        /</option>
    </select>

    <input type="text" name="data2" value="<?php if (!empty($num2)) echo "{$num2}" ?>"/>

    <input type="submit" value="提交"/>

    <input type="text" name="result" value="<?php if (!empty($jieguo)) echo "{$jieguo}" ?>"/>

    <br/>

    <input type="reset" value="重置"/>

    <br/>


</form>
</body>
</html>