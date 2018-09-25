# PHPExcelѧϰ�ʼ� [����ʹ�÷ŵ�ThinkPHP��ʹ�ã��ݲ�ʹ��ԭ������]

### PHPExcel��װ
<pre>
	��װ����һ:
		������װ
	��װ������:
		composer require phpoffice/phpexcel 
</pre>

### ����Excel����
<pre>
	�½�һ��excel���             ----  ʵ��PHPExcel��
	
	����Sheet(���ñ�)			  ----	createSheet()����    setActiveSheetIndex()����	
	
	�������					  ----  setCellValue()����

	�����ļ�					  ----	PHPExcel_IOFactory::createWriter()����	
</pre>

### PHPExcel����ʹ��
<pre>
	public function exec()
    {
        require_once './vendor/autoload.php';
        //ʵ����PHPExcel�࣬��ͬ�����������½���һ��Excel���
        $objPHPExcel = new \PHPExcel();
        //��ȡ��ǰ���sheet�Ĳ�������
        $objSheet = $objPHPExcel->getActiveSheet();
        //�趨��ǰsheet������
        $objSheet->setTitle('���Ա���Sheet01');

        //�������[���������֣�����ʹ�÷���һ��ԭ��������ķ�ʽ����excel����̫��ʱ�������ױ�����ִ��ʱ�����30s����ʱ�����Ϊ�����ݷ��ص�����]

        //����һ: setValue(sheet��λ��,��ʾ���ı�����)
//        $objSheet->setCellValue('A1', '����')->setCellValue('B1', '����');
//        $objSheet->setCellValue('A2', '����')->setCellValue('B2', '61');
//        $objSheet->setCellValue('A3', '����')->setCellValue('B3', '92');

        //������:�������daosheet��,ÿһ�ж��Ƕ�ά���������
        $array = array(
            array(),//�ճ���һ�е�����
            array('','����','����'),//�ճ���һ��
            array('','��ά','87'),
            array('','����','63')
        );
        $objSheet->fromArray($array);

        //����ָ����ʽ����Excel�ļ� [�ڶ�������Ϊexcel��ʽ:Excel5Ϊexcel2003��Excel2007Ϊexcel2007]
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
        $savePath = __DIR__.'/demo02.xlsx';
        $objWriter->save($savePath);
    }
</pre>

### ����������������Excel��ѡ��
<pre>
	/**
     * PHPExcel��������������
     * ��PHPExcel�ļ����к���
     * 01simple-download-xls.php ��
     * 01simple-download-xlsx.php
     * �����������EXCEL������
     */
    public function execBroswer()
    {
        //�����Զ����صĶ���
        require_once './vendor/autoload.php';
        $goodsModel = D('goods');
        $data = $goodsModel->select();
        //formatVarDump($data);
        //�൱�������½�һ��Excel
        $objPHPExcel = new \PHPExcel();
        for ($i = 1; $i <= 3; $i++) {
            if ($i > 1) {
                //�����µ����ñ�
                $objPHPExcel->createSheet();
            }
            //�½�sheet���趨Ϊ��ǰ�ļ�Ϊ�sheet
            $objPHPExcel->setActiveSheetIndex($i - 1);
            //��ȡ��ǰ�sheet
            $objSheet = $objPHPExcel->getActiveSheet();
            $objSheet->setTitle("�༶{$i}�ı��");
            $objSheet->setCellValue('A1', '��Ʒ����')->setCellValue('B1', '�г��۸�')->setCellValue('C1', '����۸�');
            $row = 2;//�趨������ʾ�����У���Ȼ����󣬻����Ǹ���
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

    //���Excel���������Ҫ������
    public function broswer_export($fileName, $type = 'Excel5')
    {
        //�������������������ļ�������
        if ($type == 'Excel5') {
            header('Content-Type: application/vnd.ms-excel');
        } else if ($type == 'Excel2007') {
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        }
        //�����������������ļ�������
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        //��ֹ����
        header('Cache-Control: max-age=0');
    }
</pre>

### PHPExcel�����ļ���ʽ
<pre>

</pre>





### phpExcel���İ����ֲ�֮���ù���ָ��
<pre>

�������ܽ�ļ���ʹ�÷���
include 'PHPExcel.php';
include 'PHPExcel/Writer/Excel2007.php';
//����include 'PHPExcel/Writer/Excel5.php'; �������.xls��
����һ��excel
$objPHPExcel = new PHPExcel();
����excel��2007��ʽ
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
//����$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); ��2007��ʽ
$objWriter->save("xxx.xlsx");
ֱ������������
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
header("Pragma: public");
header("Expires: 0��);
header("Cache-Control:must-revalidate, post-check=0, pre-check=0��);
header("Content-Type:application/force-download");
header("Content-Type:application/vnd.ms-execl");
header("Content-Type:application/octet-stream");
header("Content-Type:application/download");;
header('Content-Disposition:attachment;filename="resume.xls"');
header("Content-Transfer-Encoding:binary");
$objWriter->save('php://output');
�����������������������������������������������������������������������������C
����excel�����ԣ�
������
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw");
����޸���
$objPHPExcel->getProperties()->setLastModifiedBy("Maarten Balliauw");
����
$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
��Ŀ
$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
����
$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");
�ؼ���
$objPHPExcel->getProperties()->setKeywords("office 2007 openxml php");
����
$objPHPExcel->getProperties()->setCategory("Test result file");
�����������������������������������������������������������������������������C
���õ�ǰ��sheet
$objPHPExcel->setActiveSheetIndex(0);
����sheet��name
$objPHPExcel->getActiveSheet()->setTitle('Simple');
���õ�Ԫ���ֵ
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'String');
$objPHPExcel->getActiveSheet()->setCellValue('A2', 12);
$objPHPExcel->getActiveSheet()->setCellValue('A3', true);
$objPHPExcel->getActiveSheet()->setCellValue('C5', '=SUM(C2:C4)');
$objPHPExcel->getActiveSheet()->setCellValue('B8', '=MIN(B2:C5)');
�ϲ���Ԫ��
$objPHPExcel->getActiveSheet()->mergeCells('A18:E22');
���뵥Ԫ��
$objPHPExcel->getActiveSheet()->unmergeCells('A28:B28');

����cell
$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true); // Needs to be set to true in order to enable any worksheet protection!
$objPHPExcel->getActiveSheet()->protectCells('A3:E13', 'PHPExcel');
���ø�ʽ
// Set cell number formats
echo date('H:i:s') . " Set cell number formats\n";
$objPHPExcel->getActiveSheet()->getStyle('E4')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE);
$objPHPExcel->getActiveSheet()->duplicateStyle( $objPHPExcel->getActiveSheet()->getStyle('E4'), 'E5:E13' );
���ÿ�width
// Set column widths
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
����font
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setName('Candara');
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setSize(20);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
$objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
$objPHPExcel->getActiveSheet()->getStyle('D13')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('E13')->getFont()->setBold(true);
����align
$objPHPExcel->getActiveSheet()->getStyle('D11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->getStyle('D12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->getStyle('D13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->getStyle('A18')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);
//��ֱ����
$objPHPExcel->getActiveSheet()->getStyle('A18')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
����column��border
$objPHPExcel->getActiveSheet()->getStyle('A4')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle('B4')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle('C4')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle('D4')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle('E4')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
����border��color
$objPHPExcel->getActiveSheet()->getStyle('D13')->getBorders()->getLeft()->getColor()->setARGB('FF993300');
$objPHPExcel->getActiveSheet()->getStyle('D13')->getBorders()->getTop()->getColor()->setARGB('FF993300');
$objPHPExcel->getActiveSheet()->getStyle('D13')->getBorders()->getBottom()->getColor()->setARGB('FF993300');
$objPHPExcel->getActiveSheet()->getStyle('E13')->getBorders()->getTop()->getColor()->setARGB('FF993300');
$objPHPExcel->getActiveSheet()->getStyle('E13')->getBorders()->getBottom()->getColor()->setARGB('FF993300');
$objPHPExcel->getActiveSheet()->getStyle('E13')->getBorders()->getRight()->getColor()->setARGB('FF993300');
���������ɫ
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('FF808080');
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFill()->getStartColor()->setARGB('FF808080');
��ͼƬ
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
//���������������
��Ҫ���ַ���ת��ΪUTF-8���룬����������������������ַ������Ϊ�հף����´���
 $str  = iconv('gb2312', 'utf-8', $str);
���������дһ������ר�Ŵ��������ַ�����
function convertUTF8($str)
{
   if(empty($str)) return '';
   return  iconv('gb2312', 'utf-8', $str);
}
//�����ݿ�������ݴ���ʽ
�����ݿ��ȡ�����磺
$db = new Mysql($dbconfig);
$sql = "SELECT * FROM  ����";
$row = $db->GetAll($sql);  // $row Ϊ��ά����
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
 
��Ĭ��sheet�󣬴���һ��worksheet
echo date('H:i:s') . " Create new Worksheet object\n";
$objPHPExcel->createSheet();
$objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel5');
$objWriter-save('php://output');

</pre>