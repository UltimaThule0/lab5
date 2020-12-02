<?require_once 'excel_php/Classes/PHPExcel.php';?>
<?require_once 'excel_php/Classes/PHPExcel/Writer/Excel5.php';?>
<?require_once 'excel_php/Classes/PHPExcel/IOFactory.php';?>
<?
ob_end_clean();
$title = 'Таблица';

$xls = new PHPExcel();
$xls->getProperties()->setTitle("Games");
$xls->getProperties()->setSubject("laba5");
$xls->getProperties()->setCreator("Редин Максим");
$xls->getProperties()->setCompany("USATU");
$xls->getProperties()->setCategory("ПИ-320");
$xls->getProperties()->setKeywords("Games");
$xls->getProperties()->setCreated("02.12.2020");

$xls->setActiveSheetIndex(0);
$sheet = $xls->getActiveSheet();
$sheet->setTitle('Игры');
$sheet->getPageSetup()->SetPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
$sheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
$sheet->getPageMargins()->setTop(1);
$sheet->getPageMargins()->setRight(0.75);
$sheet->getPageMargins()->setLeft(0.75);
$sheet->getPageMargins()->setBottom(1);

$sheet->getDefaultStyle()->getFont()->setName('Century');
$sheet->getDefaultStyle()->getFont()->setSize(14);

$sheet->getColumnDimension("A")->setWidth(7);
$sheet->getColumnDimension("B")->setWidth(30);
$sheet->getColumnDimension("C")->setWidth(13);
$sheet->getColumnDimension("D")->setWidth(30);
$sheet->getColumnDimension("E")->setWidth(23);
$sheet->getColumnDimension("F")->setWidth(20);
$sheet->getColumnDimension("G")->setWidth(25);
$sheet->getColumnDimension("H")->setWidth(25);
$sheet->getColumnDimension("I")->setWidth(40);



$border = array(
	'borders'=>array(
		'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('rgb' => '000000')
		)
	)
);


$sheet->setCellValueExplicit('A1', 'Игры', PHPExcel_Cell_DataType::TYPE_STRING);
$sheet->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('A1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->mergeCells('A1:I1');
$sheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$sheet->getStyle('A2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->setCellValueExplicit('A2', '№ п/п', PHPExcel_Cell_DataType::TYPE_STRING);
$sheet->getStyle('A2')->getFill()->getStartColor()->setRGB('FFFFE0');
$sheet->getStyle("A2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$sheet->getStyle('B2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->setCellValueExplicit('B2', 'Название', PHPExcel_Cell_DataType::TYPE_STRING);
$sheet->getStyle('B2')->getFill()->getStartColor()->setRGB('FFFFE0');
$sheet->getStyle("B2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$sheet->getStyle('C2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->setCellValueExplicit('C2', 'Жанр', PHPExcel_Cell_DataType::TYPE_STRING);
$sheet->getStyle('C2')->getFill()->getStartColor()->setRGB('FFFFE0');
$sheet->getStyle("C2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$sheet->getStyle('D2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->setCellValueExplicit('D2', 'Разработчик', PHPExcel_Cell_DataType::TYPE_STRING);
$sheet->getStyle('D2')->getFill()->getStartColor()->setRGB('FFFFE0');
$sheet->getStyle("D2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$sheet->getStyle('E2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->setCellValueExplicit('E2', 'Издатель', PHPExcel_Cell_DataType::TYPE_STRING);
$sheet->getStyle('E2')->getFill()->getStartColor()->setRGB('FFFFE0');
$sheet->getStyle("E2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$sheet->getStyle('F2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->setCellValueExplicit('F2', 'Цифровой ключ', PHPExcel_Cell_DataType::TYPE_STRING);
$sheet->getStyle('F2')->getFill()->getStartColor()->setRGB('FFFFE0');
$sheet->getStyle("F2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$sheet->getStyle('G2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->setCellValueExplicit('G2', 'Дата приобретения', PHPExcel_Cell_DataType::TYPE_STRING);
$sheet->getStyle('G2')->getFill()->getStartColor()->setRGB('FFFFE0');
$sheet->getStyle("G2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$sheet->getStyle('H2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->setCellValueExplicit('H2', 'Дата окончания', PHPExcel_Cell_DataType::TYPE_STRING);
$sheet->getStyle('H2')->getFill()->getStartColor()->setRGB('FFFFE0');
$sheet->getStyle("H2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$sheet->getStyle('I2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->setCellValueExplicit('I2', 'URL магазина', PHPExcel_Cell_DataType::TYPE_STRING);
$sheet->getStyle('I2')->getFill()->getStartColor()->setRGB('FFFFE0');
$sheet->getStyle("I2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$db = mysqli_connect("localhost", "root", "root1", "maks")or die("Невозможно подключиться к серверу");
mysqli_query($db, "SET NAMES utf8");

$result = mysqli_query($db, 
  "SELECT g.g_name, g.g_janr, g.g_razrab, g.g_izdat, k.kluch, k.date_start, k.date_end, s.s_url 
  FROM games g 
  INNER JOIN k_ey k ON k.g_id = g.id 
  JOIN shop s ON k.s_id = s.id");

  $i = 0;
  while ($row = mysqli_fetch_array($result)){

    $npp[$i] = $i+1;
    $g_name[$i] = $row['g_name'];
    $g_janr[$i] = $row['g_janr'];
    $g_razrab[$i] = $row['g_razrab'];
    $g_izdat[$i] = $row['g_izdat'];
    $kluch[$i] = $row['kluch'];
    $date_start[$i] = date_format(date_create_from_format('Y-m-d', $row['date_start']),'d.m.Y');
    $date_end[$i] = date_format(date_create_from_format('Y-m-d', $row['date_end']),'d.m.Y');
    $s_url[$i] = $row['s_url'];
    $i++;
  }

$c = 3;
$check = true;

foreach($npp as $i)
  {

if ($check) {
	$color = 'FFDAB9';
}else {
	$color = 'FFEFD5';
}

$sheet->getStyle('A'.$c)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->setCellValue("A".$c, $npp[$i-1]);
$sheet->getStyle('A'.$c)->getFill()->getStartColor()->setRGB($color);
$sheet->getStyle("A".$c)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


$sheet->getStyle('B'.$c)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->setCellValueExplicit('B'.$c, $g_name[$i-1], PHPExcel_Cell_DataType::TYPE_STRING);
$sheet->getStyle('B'.$c)->getFill()->getStartColor()->setRGB($color);
$sheet->getStyle("B".$c)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


$sheet->getStyle('C'.$c)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->setCellValueExplicit('C'.$c, $g_janr[$i-1], PHPExcel_Cell_DataType::TYPE_STRING);
$sheet->getStyle('C'.$c)->getFill()->getStartColor()->setRGB($color);
$sheet->getStyle("C".$c)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


$sheet->getStyle('D'.$c)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->setCellValueExplicit('D'.$c, $g_razrab[$i-1], PHPExcel_Cell_DataType::TYPE_STRING);
$sheet->getStyle('D'.$c)->getFill()->getStartColor()->setRGB($color);
$sheet->getStyle("D".$c)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


$sheet->getStyle('E'.$c)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->setCellValueExplicit('E'.$c, $g_izdat[$i-1], PHPExcel_Cell_DataType::TYPE_STRING);
$sheet->getStyle('E'.$c)->getFill()->getStartColor()->setRGB($color);
$sheet->getStyle("E".$c)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

$sheet->getStyle('F'.$c)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->setCellValueExplicit('F'.$c, $kluch[$i-1], PHPExcel_Cell_DataType::TYPE_STRING);
$sheet->getStyle('F'.$c)->getFill()->getStartColor()->setRGB($color);
$sheet->getStyle("F".$c)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$sheet->getStyle('G'.$c)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->setCellValueExplicit('G'.$c, $date_start[$i-1], PHPExcel_Cell_DataType::TYPE_STRING);
$sheet->getStyle('G'.$c)->getFill()->getStartColor()->setRGB($color);
$sheet->getStyle("G".$c)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$sheet->getStyle('H'.$c)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->setCellValueExplicit('H'.$c, $date_end[$i-1], PHPExcel_Cell_DataType::TYPE_STRING);
$sheet->getStyle('H'.$c)->getFill()->getStartColor()->setRGB($color);
$sheet->getStyle("H".$c)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$sheet->getStyle('I'.$c)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->setCellValueExplicit('I'.$c, $s_url[$i-1], PHPExcel_Cell_DataType::TYPE_STRING);
$sheet->getStyle('I'.$c)->getFill()->getStartColor()->setRGB($color);
$sheet->getStyle("I".$c)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

	$check =! $check;
	$c++;
}


$sheet->getStyle("A1:I".($c-1))->applyFromArray($border);


ob_end_clean();
header("Expires: Mon, 1 Apr 1974 05:00:00 GMT");
header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
ob_end_clean();
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=House.xls");

$objWriter = PHPExcel_IOFactory::createWriter($xls, 'Excel2007');

$objWriter->save('php://output');
ob_end_clean();
?>