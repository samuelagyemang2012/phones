<?php
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 4/13/2016
 * Time: 6:54 PM
 */

require 'fpdf.php';

$total = 0;
$date = date("d/m/y");

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('helvetica', 'b', 14);
$pdf->SetTextColor(0, 0, 0);

$pdf->Cell(80, 20, 'REPORT');
$pdf->Cell(100, 20, $date);
$pdf->Ln();

$pdf->Cell(80, 5, 'Order ID', 1, 0, 'C', 0);
$pdf->Cell(20, 5, 'Item', 1, 0, 'C', 0);
$pdf->Cell(20, 5, 'Qty', 1, 0, 'C', 0);
$pdf->Cell(40, 5, 'Date', 1, 0, 'C', 0);
$pdf->Ln(5);


//$pdf->Cell(30, 5, 'Sub Total', 1, 0, 'C', 0);


$pdf->Output();
