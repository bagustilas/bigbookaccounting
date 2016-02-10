<?php

require('../../plugin/fpdf17/fpdf.php');
require('../../configurasi/koneksi.php');
include ("../../configurasi/library.php");

class PDF extends FPDF
{
// Load data
function LoadData($file)
{
	// Read file lines
	$lines = file($file);
	$data = array();
	foreach($lines as $line)
		$data[] = explode(';',trim($line));
	return $data;
}
function LoadDataFromSQL($sql)
{
	$hasil=mysql_query($sql) or die(mysql_error());

	$data = array();
	while($rows=mysql_fetch_array($hasil)){
		$data[] = $rows;

}
	return $data;
}


// Colored table
function FancyTable($header, $data)
{
	// Colors, line width and bold font
	$this->SetFillColor(255,165,74);
	$this->SetTextColor(255);
	$this->SetDrawColor(128,0,0);
	$this->SetLineWidth(.3);
	$this->SetFont('','B');
	// Header
	$w = array(30,35,35,35,30,30);
	for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
	$this->Ln();
	// Color and font restoration
	$this->SetFillColor(224,235,255);
	$this->SetTextColor(0);
	$this->SetFont('');
	// Data
	$fill = false;
	$no=1;
	foreach($data as $row)
	{
		$this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
		$this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
		$this->Cell($w[1],6,$row[2],'LR',0,'L',$fill);
		$this->Cell($w[1],6,$row[3],'LR',0,'L',$fill);
		$this->Cell($w[0],6,$row[4],'LR',0,'L',$fill);
		$this->Cell($w[0],6,"Rp".number_format($row[5]),'LR',0,'R',$fill);
		$this->Ln();
		$fill = !$fill;
	}
	// Closing line
	$this->Cell(array_sum($w),10,'Copyright (c) 2013 BigbookAccounting','T');
}
}

$pdf = new PDF();
// Column headings
$titel='Laporan Pembelian Apotek Azka';
$pdf->SetTitle($title);
$pdf->SetAuthor('Bagus Tilas Hidayatullah');

$tgl1=$_GET['tgl1'];
$tgl2=$_GET['tgl2'];
$tgl3=$_POST['thn_1'].'-'.$_POST['bln_1'].'-'.$_POST['tgl_1'];
$tgl4=$_POST['thn_2'].'-'.$_POST['bln_2'].'-'.$_POST['tgl_2'];
$header = array('Tanggal','Nomor Bukti',
			'Nomor Faktur','Tanggal Faktur','Supplier','Total');
// Data loading

$query="select kd_pemb.tanggal, kd_pemb.kd_pmb, kd_pemb.nofaktur,kd_pemb.tgl_faktur,supplier.nm_supplier,kd_pemb.total 
		from kd_pemb,supplier where supplier.id_supplier=kd_pemb.id_supplier and 
		kd_pemb.tanggal between '$tgl1' and '$tgl2' order by kd_pemb.tanggal asc";
 
$data = $pdf->LoadDataFromSQL($query);
$pdf->SetFont('Arial','',11);
$pdf->AddPage();

$pdf->FancyTable($header,$data);
$pdf->Output();
?>