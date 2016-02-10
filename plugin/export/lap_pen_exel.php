<?php

error_reporting(E_ALL);

require_once '../../plugin/excel/PHPExcel.php';
require_once'../../configurasi/koneksi.php';
include "../../configurasi/library.php";
//print_r($_POST);
// Create new PHPExcel object
$tanggal1=$_POST['thn_1'].'-'.$_POST['bln_1'].'-'.$_POST['tgl_1'];
$tanggal2=$_POST['thn_2'].'-'.$_POST['bln_2'].'-'.$_POST['tgl_2'];

$objPHPExcel = new PHPExcel();

$sum="SELECT sum(total) as total from kd_penj where tanggal between '$tanggal1' and '$tanggal2'";
$query="SELECT * FROM kd_penj WHERE tanggal BETWEEN '$tanggal1' AND '$tanggal2' ORDER BY tanggal ASC";
$hasil = mysql_query($query);
$sql = mysql_query($sum);
 
// Set properties
$objPHPExcel->getProperties()->setCreator("Apotek Azka")
      ->setLastModifiedBy("Apotek Azka")
      ->setTitle("Office 2007 XLSX Test Document")
      ->setSubject("Office 2007 XLSX Test Document")
       ->setDescription("Laporan Penjualan .")
       ->setKeywords("office 2007 openxml php")
       ->setCategory("Laporan Pembelian");
 
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
       ->setCellValue('A1', 'No')
       ->setCellValue('B1', 'Tanggal')
       ->setCellValue('C1', 'Nomor Bukti')
       ->setCellValue('D1', 'Total');
$tot = mysql_fetch_array($sql) or die (mysql_error());
	   
$baris = 2;
$no = 0;			
while($row=mysql_fetch_array($hasil)){
$no = $no +1;
$objPHPExcel->setActiveSheetIndex(0)
     ->setCellValue("A$baris", $no)
     ->setCellValue("B$baris", $row['tanggal'])
     ->setCellValue("C$baris", $row['kd_pjl'])
     ->setCellValue("D$baris", "Rp.".number_format($row['total'],2,'.',','));
$baris = $baris + 1;
}
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue("D$baris", "Rp.".number_format($tot['total'],2,'.',',')); 

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('transaksi penjualan');
 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
 
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Laporan_Penjualan_'.$tgl_sekarang.'.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>