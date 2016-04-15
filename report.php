<?php
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 4/13/2016
 * Time: 6:54 PM
 */

require 'fpdf.php';
include_once 'Item.php';
include_once 'Administrator.php';

$a = new Administrator();
$item = new Item();

$total = 0;
$revenue = 0;
$sub_total = 0;

date_default_timezone_set('UTC');
$date = date('Y-m-d');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('helvetica', 'b', 14);
$pdf->SetTextColor(0, 0, 0);

$pdf->Cell(80, 20, 'DAILY REPORT');
$pdf->Cell(100, 20, $date);
$pdf->Ln();

//$pdf->Cell(80, 5, 'Order ID', 1, 0, 'C', 0);
$pdf->Cell(60, 5, 'Item', 1, 0, 'C', 0);
$pdf->Cell(40, 5, 'Quantity Bought', 1, 0, 'C', 0);
$pdf->Cell(60, 5, 'Date', 1, 0, 'C', 0);

$pdf->Ln(5);

$data = $a->generateReport($date);
$row = $data->fetch_array(MYSQLI_ASSOC);
$len = mysqli_num_rows($data);

for ($i = 0; $i < $len; $i++) {
    $pdf->Cell(60, 5, $row['item_name'], 1, 0, 'C', 0);
    $pdf->Cell(40, 5, $row['sum(i.num_bought)'], 1, 0, 'C', 0);
    $pdf->Cell(60, 5, $row['time'], 1, 0, 'C', 0);

    $d = $item->getItemDetails($row['item_id']);
    $r = $d->fetch_array(MYSQLI_ASSOC);
    $sub_total = $r['price'] * $row['sum(i.num_bought)'];
    $revenue += $sub_total;
    $total += $row['sum(i.num_bought)'];
    $pdf->Ln(5);
    $row = $data->fetch_array(MYSQLI_ASSOC);
}

$pdf->Cell(40, 20, 'Sales: ');
$pdf->Cell(120, 20, $total);
$pdf->Ln(5);
$pdf->Cell(40, 20, 'Total Reveue: $ ');
$pdf->Cell(40, 20, $revenue);

$pdf->Output();
