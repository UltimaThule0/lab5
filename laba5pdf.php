<?php

require('TFPDF/tfpdf.php');

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
    $date_start[$i] = $row['date_start'];
    $date_end[$i] = $row['date_end'];
    $s_url[$i] = substr($row['s_url'], 0, 30);
    $i++;
  }

$pdf = new tFPDF('L');
$pdf->AddPage();

$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
$pdf->SetFont('DejaVu','',14);


$txt = "Игры";

$pdf->SetFont('DejaVu','','24');
$pdf->SetFillColor(255, 255, 255);
$pdf->SetDrawColor(255, 255, 255);
$pdf->SetTextColor(25, 25, 112);
$pdf->Cell(270, 10, $txt,1,0,'C', 15);
$pdf->Ln();
$pdf->Ln();
 
$pdf->SetFont('DejaVu','','8');
$pdf->SetFillColor(255, 255, 224);
$pdf->SetTextColor(25, 25, 112);
$pdf->SetDrawColor(0, 255, 127);
$pdf->SetLineWidth(.2);
 
$pdf->Cell(11,7,"№ п/п",1,0,'C',true);
$pdf->Cell(40,7,"Название",1,0,'C',true);
$pdf->Cell(25,7,"Жанр",1,0,'C',true);
$pdf->Cell(40,7,"Разработчик",1,0,'C',true);
$pdf->Cell(40,7,"Издатель",1,0,'C',true);
$pdf->Cell(25,7,"Цифровой ключ",1,0,'C',true);
$pdf->Cell(30,7,"Дата приобретения",1,0,'C',true);
$pdf->Cell(27,7,"Дата окончания",1,0,'C',true);
$pdf->Cell(45,7,"URL магазина",1,0,'C',true);
$pdf->Ln();
 
$pdf->SetFillColor(255, 218, 185);
$pdf->SetFont('');
 
$fill = true;

foreach($npp as $i)
  {
    $pdf->Cell(11,6, $i, 1, 0,'C',$fill);
    $pdf->Cell(40,6, $g_name[$i-1], 1, 0,'L',$fill);
    $pdf->Cell(25,6, $g_janr[$i-1], 1, 0,'C',$fill);
    $pdf->Cell(40,6, $g_razrab[$i-1], 1, 0,'L',$fill);
    $pdf->Cell(40,6, $g_izdat[$i-1], 1, 0,'L',$fill);
    $pdf->Cell(25,6, $kluch[$i-1], 1, 0,'C',$fill);
    $pdf->Cell(30,6, $date_start[$i-1], 1, 0,'C',$fill);
    $pdf->Cell(27,6, $date_end[$i-1], 1, 0,'C',$fill);
    $pdf->Cell(45,6, $s_url[$i-1], 1, 0,'L',$fill);
    $pdf->Ln();
    $fill =! $fill;
    }
    $pdf->Cell(180,0,'','T');

$pdf->Output();
?>