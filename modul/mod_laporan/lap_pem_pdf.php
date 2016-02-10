<?php
error_reporting(0);

include ('class.ezpdf.php');
include "rupiah.php";
include "../../Inc/koneksi.php";
include "../../Inc/fungsi_indotgl.php";
include "../../Inc/library.php";
  
$pdf = new Cezpdf();
 
// Set margin dan font
$pdf->ezSetCmMargins(3, 3, 3, 3);
$pdf->selectFont('fonts/Courier.afm');

$all = $pdf->openObject();
$pemilik=mysql_fetch_array(mysql_query("select nm_perusahaan,alamat from bigbook_perusahaan")) or die ("gagal");

// Tampilkan logo
$pdf->setStrokeColor(0, 0, 0, 1);
$pdf->addJpegFromFile('logo.jpg',20,785,69);

// Teks di tengah atas untuk judul header
$pdf->addText(150, 820, 16,'<b>Laporan Pembelian Bulan'. tgl_indo(date("Ymd")) .'</b>');
$pdf->addText(200, 800, 14,'<b>'.$pemilik[nm_perusahaan].'</b>');
// Garis atas untuk header
$pdf->line(10, 780, 578, 780);

// Garis bawah untuk footer
$pdf->line(10, 50, 578, 50);
// Teks kiri bawah
$pdf->addText(30,34,8,'Dicetak tgl:' . date( 'd-m-Y, H:i:s'));

$pdf->closeObject();

// Tampilkan object di semua halaman
$pdf->addObject($all, 'all');

// Baca input tanggal yang dikirimkan user
$mulai=$_GET[tgl1];
$selesai=$_GET[tgl2];


// Query untuk merelasikan kedua tabel di filter berdasarkan tanggal
$sum=mysql_fetch_array(mysql_query("SELECT sum(total) as total from 
		kd_pemb where tanggal between '$mulai' and '$selesai' AND status='Tunai'"));
$sql = mysql_query("select kd_pemb.tanggal, kd_pemb.kd_pmb, kd_pemb.nofaktur,kd_pemb.tgl_faktur,supplier.nm_supplier,kd_pemb.total 
		from kd_pemb,supplier where supplier.id_supplier=kd_pemb.id_supplier and 
		kd_pemb.tanggal between '$mulai' and '$selesai' AND kd_pemb.status='Tunai' order by kd_pemb.tanggal asc");
$jml = mysql_num_rows($sql);

if ($jml > 0){
$i = 1;
while($r = mysql_fetch_array($sql)){
  $hargarp=rp($r[5]); 

  $data[$i]=array('<b>No</b>'=>$i, 
                  '<b>Tanggal</b>'=>$r[0], 
                  '<b>Nomor Bukti</b>'=>$r[1], 
                  '<b>Nomor Faktur</b>'=>$r[2], 
                  '<b>Tanggal Faktur</b>'=>$r[3], 
                  '<b>Supplier</b>'=>$r[4], 
                  '<b>Total</b>'=>$hargarp);
  $i++;
}

$pdf->ezTable($data, '', '', '');

$tot=rp($sum[total]);
$pdf->ezText("\n\nTotal keseluruhan : Rp. {$tot}");
$pdf->ezText("Pencarian dari Tanggal $mulai s/d $selesai");

// Penomoran halaman
$pdf->ezStartPageNumbers(320, 15, 8);
$pdf->ezStream();
}
else{
  $m=$_POST[tgl_1].'-'.$_POST[bln_1].'-'.$_POST[thn_1];
  $s=$_POST[tgl_2].'-'.$_POST[bln_2].'-'.$_POST[thn_2];
    echo"<script>window.alert('Tidak ada laporan Pembelian pada Tanggal $m s/d $s');
  window.location=('".$uri."/apotek/out.php')</script>";
}
?>
