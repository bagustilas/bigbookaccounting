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

$sum="SELECT sum(total) as total from kd_pemb where tanggal between '$tanggal1' and '$tanggal2' AND status='Tunai'";
$query=" SELECT kd_pemb.tanggal, kd_pemb.kd_pmb, kd_pemb.nofaktur,kd_pemb.tgl_faktur,supplier.nm_supplier, kd_pemb.total
			FROM kd_pemb, supplier		
WHERE supplier.id_supplier = kd_pemb.id_supplier
AND kd_pemb.tanggal
BETWEEN '$tanggal1'
AND '$tanggal2' AND status='Tunai'
ORDER BY kd_pemb.tanggal ASC";
$hasil = mysql_query($query);
$sql = mysql_query($sum);
 
// Set properties
$objPHPExcel->getProperties()->setCreator("Apotek Azka")
      ->setLastModifiedBy("Apotek Azka")
      ->setTitle("Office 2007 XLSX Test Document")
      ->setSubject("Office 2007 XLSX Test Document")
       ->setDescription("Laporan Pembelian .")
       ->setKeywords("office 2007 openxml php")
       ->setCategory("Laporan Pembelian");
 
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
       ->setCellValue('A1', 'No')
       ->setCellValue('B1', 'Tanggal')
       ->setCellValue('C1', 'Nomor Bukti')
       ->setCellValue('D1', 'Nomor Faktur')
       ->setCellValue('E1', 'Tanggal Faktur')
       ->setCellValue('F1', 'Supplier')
       ->setCellValue('G1', 'Total');
$tot = mysql_fetch_array($sql) or die (mysql_error());
	   
$baris = 2;
$no = 0;			
while($row=mysql_fetch_array($hasil)){
$no = $no +1;
$objPHPExcel->setActiveSheetIndex(0)
     ->setCellValue("A$baris", $no)
     ->setCellValue("B$baris", $row['tanggal'])
     ->setCellValue("C$baris", $row['kd_pmb'])
     ->setCellValue("D$baris", $row['nofaktur'])
     ->setCellValue("E$baris", $row['tgl_faktur'])
     ->setCellValue("F$baris", $row['nm_supplier'])
     ->setCellValue("G$baris", "Rp.".number_format($row['total'],2,'.',','));
$baris = $baris + 1;
}
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue("G$baris", "Rp.".number_format($tot['total'],2,'.',',')); 

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('transaksi pembelian');
 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
 
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Laporan_Pembelian_'.$tgl_sekarang.'.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>