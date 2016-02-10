<?php

error_reporting(E_ALL);

require_once '../../plugin/excel/PHPExcel.php';
require_once'../../configurasi/koneksi.php';
include "../../configurasi/library.php";
//print_r($_POST);
// Create new PHPExcel object
// $tanggal1=$_POST['thn_1'].'-'.$_POST['bln_1'].'-'.$_POST['tgl_1'];
// $tanggal2=$_POST['thn_2'].'-'.$_POST['bln_2'].'-'.$_POST['tgl_2'];

$objPHPExcel = new PHPExcel();
$qmin=mysql_fetch_array(mysql_query("select min(bulan) as bulan, min(tahun) as tahun from master_laporan"));
	$pertamax=$qmin['bulan'];
	$pertama2=$qmin['tahun'];
$query="SELECT b.kode ,b.jenis, b.nama , b.satuan , p.pembelian , j.penjualan , b.stok , b.hrg_beli 
FROM barang b

left join
(
select id_product ,SUM(jumlah) as pembelian
from pembelian
where tanggal BETWEEN '$pertama2-$pertamax-1' AND '$tgl_sekarang'
group by id_product 
) p on p.id_product = b.kode

left join
(
select id_product,SUM(jumlah) as penjualan
from penjualan
where tanggal BETWEEN '$pertama2-$pertamax-1' AND '$tgl_sekarang'
group by id_product 
) j on j.id_product = b.kode

ORDER BY b.nama ";
$hasil = mysql_query($query);
 
// Set properties
$objPHPExcel->getProperties()->setCreator("Apotek Azka")
      ->setLastModifiedBy("Apotek Azka")
      ->setTitle("Office 2007 XLSX Test Document")
      ->setSubject("Office 2007 XLSX Test Document")
       ->setDescription("Laporan Stok .")
       ->setKeywords("office 2007 openxml php")
       ->setCategory("Laporan Stok");
 
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
       ->setCellValue('A1', 'No')
       ->setCellValue('B1', 'Kode Barang')
       ->setCellValue('C1', 'Jenis')
       ->setCellValue('D1', 'Nama Barang')
       ->setCellValue('E1', 'Satuan')
	   ->setCellValue('F1', 'Masuk')
	   ->setCellValue('G1', 'Keluar')
       ->setCellValue('H1', 'Stok Barang')
       ->setCellValue('I1', 'Harga Beli');

	   
$baris = 2;
$no = 0;		
while($row=mysql_fetch_array($hasil)){
$no = $no +1;
$objPHPExcel->setActiveSheetIndex(0)	
     ->setCellValue("A$baris", $no)
     ->setCellValue("B$baris", $row['0'])
     ->setCellValue("C$baris", $row['1'])
     ->setCellValue("D$baris", $row['2'])
     ->setCellValue("E$baris", $row['3'])
	 ->setCellValue("F$baris", $row['4'])
	 ->setCellValue("G$baris", $row['5'])
     ->setCellValue("H$baris", $row['6'])
     ->setCellValue("I$baris", "Rp.".number_format($row['7'],2,'.',','));
$baris = $baris + 1;
}


// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Stok Apotek Azka '.$tgl_sekarang.'');
 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
 
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Laporan_Stok_'.$tgl_sekarang.'.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>