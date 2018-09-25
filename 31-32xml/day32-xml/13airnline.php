<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title></title>
    <style>
        .airline {
            border: 1px solid #3195D3;
            border-collapse: collapse;
        }

        .airline th {
            height: 35px;
            line-height: 35px;
            border: 1px solid #e2e2e2;
            font-weight: bold;
            background: #3195D3;
            color: #fff;
        }

        .airline td {
            height: 28px;
            line-height: 28px;
            border: 1px solid #e2e2e2;
            text-align: center;
            background: #F5FCFF;
        }
    </style>
</head>
<body>
<?php
$client = new SoapClient("http://ws.webxml.com.cn/webservices/DomesticAirline.asmx?wsdl");
$cities = $client->getDomesticCity();
//var_dump($cities);
$city = $cities->getDomesticCityResult->any;
$sxe = new SimpleXMLElement($city);
//var_dump($sxe);
$cityarr = array();
foreach ($sxe->children()->children() as $child) {
    $cityarr[] = $child->cnCityName;
}
//查询航班
if (isset($_POST['Button2'])) {
    $startCity = $_POST['fromcity'];
    $lastCity = $_POST['tocity'];
    $theDate = $_POST['date'];
    //创建请求参数的数组
    $param = array(
        'startCity' => $startCity,
        'lastCity' => $lastCity,
        'theDate' => $theDate,
        'userID' => ''
    );
    $temp = $client->getDomesticAirlinesTime($param);

    $data = $temp->getDomesticAirlinesTimeResult->any;
    $sxe = new SimpleXMLElement($data);

    $airlinearr = array();
    foreach ($sxe->children()->children() as $child) {
        $airlinearr[] = $child;
    }
}
?>

<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>
            <a href="http://www.webxml.com.cn/">
                <img src="webxml_logo.gif" alt="WebXml Logo" width="250" height="50" border="0"/></a>
        </td>
    </tr>
    <tr>
        <td align="center">
            <a href="http://www.webxml.com.cn/" target="_blank"></a><strong>
                航班时刻表 Web Service 实例</strong>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>
            <form name="form1" method="post" action="" id="form1">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="width: 50%;">出发城市
                            <select name="fromcity">
                                <?php foreach ($cityarr as $city): ?>
                                    <option value="<?php echo $city; ?>"><?php echo $city; ?></option>
                                <?php endforeach; ?>
                            </select>
                            &nbsp;&nbsp;&nbsp;到达城市
                            <select name="tocity">
                                <?php foreach ($cityarr as $city): ?>
                                    <option value="<?php echo $city; ?>"><?php echo $city; ?></option>
                                <?php endforeach; ?>
                            </select>
                            &nbsp;&nbsp;&nbsp;
                            <label for="CheckBox1">切换城市</label>
                            &nbsp;&nbsp;&nbsp;
                        </td>
                        <td valign="middle">
                            日期
                            <input name="date" value="2016-10-18" type="text" maxlength="10" size="10" id="date"
                                   class="input1"/>
                            &nbsp;&nbsp;&nbsp;
                            <input type="submit" name="Button2" value="查询" id="Button2" class="input2"/></td>
                    </tr>
                </table>
            </form>
        </td>
    </tr>
    <tr>
        <td>&nbsp;
        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" border="0" cellpadding="2" cellspacing="1" class="airline">
                <tr>
                    <th>航空公司</th>
                    <th>航班编号</th>
                    <th>出发机场</th>
                    <th>出发时间</th>
                    <th>到达机场</th>
                    <th>到达时间</th>
                    <th>机型</th>
                    <th>中途是否停</th>
                </tr>
                <?php foreach ($airlinearr as $v): ?>
                <tr>
                    <td class="tdbg"><?php echo $v->Company; ?></td>
                    <td class="tdbg"><?php echo $v->AirlineCode; ?></td>
                    <td class="tdbg"><?php echo $v->StartDrome; ?></td>
                    <td class="tdbg"><?php echo $v->StartTime; ?></td>
                    <td class="tdbg"><?php echo $v->ArriveDrome; ?></td>
                    <td class="tdbg"><?php echo $v->ArriveTime; ?></td>
                    <td class="tdbg"><?php echo $v->Mode; ?></td>
                    <td class="tdbg"><?php echo $v->AirlineStop; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </td>
    </tr>

</table>
</body>
</html>