# PHPExcel学习笔记 [本次使用放到ThinkPHP中使用，暂不使用原生代码]

### PHPExcel安装
<pre>
	安装方法一:
		官网安装
	安装方法二:
		composer require phpoffice/phpexcel 
</pre>

### 导出Excel步骤
<pre>
	新建一个excel表格             ----  实例PHPExcel类
	
	创建Sheet(内置表)			  ----	createSheet()方法    setActiveSheetIndex()方法	
	
	填充数据					  ----  setCellValue()方法

	保存文件					  ----	PHPExcel_IOFactory::createWriter()方法	
</pre>

### PHPExcel基本使用
<pre>
	public function exec()
    {
        require_once './vendor/autoload.php';
        //实例化PHPExcel类，等同于在桌面上新建的一个Excel表格
        $objPHPExcel = new \PHPExcel();
        //获取当前活动的sheet的操作对象
        $objSheet = $objPHPExcel->getActiveSheet();
        //设定当前sheet的名称
        $objSheet->setTitle('测试表格的Sheet01');

        //添加数据[方法有两种，建议使用方法一，原因是数组的方式，在excel对象太大时数组容易崩溃，执行时间过长30s左右时，会变为无数据返回的现象]

        //方法一: setValue(sheet的位置,显示的文本内容)
//        $objSheet->setCellValue('A1', '姓名')->setCellValue('B1', '分数');
//        $objSheet->setCellValue('A2', '张三')->setCellValue('B2', '61');
//        $objSheet->setCellValue('A3', '李四')->setCellValue('B3', '92');

        //方法二:数组添加daosheet中,每一行都是二维数组的内容
        $array = array(
            array(),//空出第一行的内容
            array('','姓名','分数'),//空出第一列
            array('','王维','87'),
            array('','赵申','63')
        );
        $objSheet->fromArray($array);

        //按照指定格式生成Excel文件 [第二个参数为excel格式:Excel5为excel2003，Excel2007为excel2007]
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
        $savePath = __DIR__.'/demo02.xlsx';
        $objWriter->save($savePath);
    }
</pre>

### 在浏览器中输出下载Excel的选项
<pre>
	/**
     * PHPExcel输出到浏览器内容
     * 在PHPExcel文件夹中含有
     * 01simple-download-xls.php 和
     * 01simple-download-xlsx.php
     * 来处理输出到EXCEL的内容
     */
    public function execBroswer()
    {
        //加载自动加载的对象
        require_once './vendor/autoload.php';
        $goodsModel = D('goods');
        $data = $goodsModel->select();
        //formatVarDump($data);
        //相当在桌面新建一个Excel
        $objPHPExcel = new \PHPExcel();
        for ($i = 1; $i <= 3; $i++) {
            if ($i > 1) {
                //创建新的内置表
                $objPHPExcel->createSheet();
            }
            //新建sheet并设定为当前文件为活动sheet
            $objPHPExcel->setActiveSheetIndex($i - 1);
            //获取当前活动sheet
            $objSheet = $objPHPExcel->getActiveSheet();
            $objSheet->setTitle("班级{$i}的表格");
            $objSheet->setCellValue('A1', '商品名称')->setCellValue('B1', '市场价格')->setCellValue('C1', '本店价格');
            $row = 2;//设定数据显示的首行，不然会错误，或者是覆盖
            foreach ($data as $key => $value) {
                $objSheet->setCellValue("A" . $row, $value['goods_name'])->setCellValue("B" . $row, $value['market_price'])->setCellValue('C' . $row, $value['show_price']);
                $row++;
            }
        }
        $type = 'Excel5';
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, $type);
        $this->broswer_export('62332.xls', $type);

        $type = 'Excel2007';
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, $type);
        $this->broswer_export('62339.xlsx', $type);

        $objWriter->save("php://output");
    }

    //输出Excel到浏览器需要的内容
    public function broswer_export($fileName, $type = 'Excel5')
    {
        //告诉浏览器即将输出的文件的类型
        if ($type == 'Excel5') {
            header('Content-Type: application/vnd.ms-excel');
        } else if ($type == 'Excel2007') {
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        }
        //告诉浏览器即将输出文件的名称
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        //禁止缓存
        header('Cache-Control: max-age=0');
    }
</pre>

### PHPExcel控制文件样式
<pre>

</pre>





### phpExcel中文帮助手册之常用功能指南
<pre>

下面是总结的几个使用方法
include 'PHPExcel.php';
include 'PHPExcel/Writer/Excel2007.php';
//或者include 'PHPExcel/Writer/Excel5.php'; 用于输出.xls的
创建一个excel
$objPHPExcel = new PHPExcel();
保存excel—2007格式
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
//或者$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); 非2007格式
$objWriter->save("xxx.xlsx");
直接输出到浏览器
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
header("Pragma: public");
header("Expires: 0″);
header("Cache-Control:must-revalidate, post-check=0, pre-check=0″);
header("Content-Type:application/force-download");
header("Content-Type:application/vnd.ms-execl");
header("Content-Type:application/octet-stream");
header("Content-Type:application/download");;
header('Content-Disposition:attachment;filename="resume.xls"');
header("Content-Transfer-Encoding:binary");
$objWriter->save('php://output');
——————————————————————————————————————–
设置excel的属性：
创建人
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw");
最后修改人
$objPHPExcel->getProperties()->setLastModifiedBy("Maarten Balliauw");
标题
$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
题目
$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
描述
$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");
关键字
$objPHPExcel->getProperties()->setKeywords("office 2007 openxml php");
种类
$objPHPExcel->getProperties()->setCategory("Test result file");
——————————————————————————————————————–
设置当前的sheet
$objPHPExcel->setActiveSheetIndex(0);
设置sheet的name
$objPHPExcel->getActiveSheet()->setTitle('Simple');
设置单元格的值
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'String');
$objPHPExcel->getActiveSheet()->setCellValue('A2', 12);
$objPHPExcel->getActiveSheet()->setCellValue('A3', true);
$objPHPExcel->getActiveSheet()->setCellValue('C5', '=SUM(C2:C4)');
$objPHPExcel->getActiveSheet()->setCellValue('B8', '=MIN(B2:C5)');
合并单元格
$objPHPExcel->getActiveSheet()->mergeCells('A18:E22');
分离单元格
$objPHPExcel->getActiveSheet()->unmergeCells('A28:B28');

保护cell
$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true); // Needs to be set to true in order to enable any worksheet protection!
$objPHPExcel->getActiveSheet()->protectCells('A3:E13', 'PHPExcel');
设置格式
// Set cell number formats
echo date('H:i:s') . " Set cell number formats\n";
$objPHPExcel->getActiveSheet()->getStyle('E4')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE);
$objPHPExcel->getActiveSheet()->duplicateStyle( $objPHPExcel->getActiveSheet()->getStyle('E4'), 'E5:E13' );
设置宽width
// Set column widths
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
设置font
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setName('Candara');
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setSize(20);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
$objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
$objPHPExcel->getActiveSheet()->getStyle('D13')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('E13')->getFont()->setBold(true);
设置align
$objPHPExcel->getActiveSheet()->getStyle('D11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->getStyle('D12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->getStyle('D13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->getStyle('A18')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);
//垂直居中
$objPHPExcel->getActiveSheet()->getStyle('A18')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
设置column的border
$objPHPExcel->getActiveSheet()->getStyle('A4')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle('B4')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle('C4')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle('D4')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle('E4')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
设置border的color
$objPHPExcel->getActiveSheet()->getStyle('D13')->getBorders()->getLeft()->getColor()->setARGB('FF993300');
$objPHPExcel->getActiveSheet()->getStyle('D13')->getBorders()->getTop()->getColor()->setARGB('FF993300');
$objPHPExcel->getActiveSheet()->getStyle('D13')->getBorders()->getBottom()->getColor()->setARGB('FF993300');
$objPHPExcel->getActiveSheet()->getStyle('E13')->getBorders()->getTop()->getColor()->setARGB('FF993300');
$objPHPExcel->getActiveSheet()->getStyle('E13')->getBorders()->getBottom()->getColor()->setARGB('FF993300');
$objPHPExcel->getActiveSheet()->getStyle('E13')->getBorders()->getRight()->getColor()->setARGB('FF993300');
设置填充颜色
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('FF808080');
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFill()->getStartColor()->setARGB('FF808080');
加图片
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('Logo');
$objDrawing->setDescription('Logo');
$objDrawing->setPath('./images/officelogo.jpg');
$objDrawing->setHeight(36);
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('Paid');
$objDrawing->setDescription('Paid');
$objDrawing->setPath('./images/paid.png');
$objDrawing->setCoordinates('B15');
$objDrawing->setOffsetX(110);
$objDrawing->setRotation(25);
$objDrawing->getShadow()->setVisible(true);
$objDrawing->getShadow()->setDirection(45);
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
//处理中文输出问题
需要将字符串转化为UTF-8编码，才能正常输出，否则中文字符将输出为空白，如下处理：
 $str  = iconv('gb2312', 'utf-8', $str);
或者你可以写一个函数专门处理中文字符串：
function convertUTF8($str)
{
   if(empty($str)) return '';
   return  iconv('gb2312', 'utf-8', $str);
}
//从数据库输出数据处理方式
从数据库读取数据如：
$db = new Mysql($dbconfig);
$sql = "SELECT * FROM  表名";
$row = $db->GetAll($sql);  // $row 为二维数组
$count = count($row);
for ($i = 2; $i <= $count+1; $i++) {
 $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, convertUTF8($row[$i-2][1]));
 $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, convertUTF8($row[$i-2][2]));
 $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, convertUTF8($row[$i-2][3]));
 $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, convertUTF8($row[$i-2][4]));
 $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, convertUTF8(date("Y-m-d", $row[$i-2][5])));
 $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, convertUTF8($row[$i-2][6]));
 $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, convertUTF8($row[$i-2][7]));
 $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, convertUTF8($row[$i-2][8]));
}
 
在默认sheet后，创建一个worksheet
echo date('H:i:s') . " Create new Worksheet object\n";
$objPHPExcel->createSheet();
$objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel5');
$objWriter-save('php://output');

</pre>