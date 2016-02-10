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
$pdf->addText(150, 820, 16,'<b>Laporan Penjualan Bulan'. tgl_indo(date("Ymd")) .'</b>');
$pdf->addText(200, 800, 14,'<b>'.$pemilik[nm_perusahaan].'</b>');
// Garis atas untuk header
$pdf->line(10, 795, 578, 795);

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

// Koneksi ke database dan tampilkan datanya

// Query untuk merelasikan kedua tabel di filter berdasarkan tanggal
$sql = mysql_query("select kd_penj.tanggal,kd_penj.kd_pjl,penjualan.id_product,barang.nama,
                                           penjualan.harga,penjualan.jumlah,penjualan.subtotal
                                           from penjualan,kd_penj,barang
                                           where kd_penj.kd_pjl=penjualan.id_transaksi and barang.kode=penjualan.id_product and kd_penj.tanggal
										 between '$mulai' and '$selesai'
					");
$sum=mysql_fetch_array(mysql_query("SELECT sum(total) as total from 
		kd_penj where tanggal between '$mulai' and '$selesai'"));
$jml = mysql_num_rows($sql);

if ($jml > 0){
$i = 1;
while($r = mysql_fetch_array($sql)){
	$hargarp=rp($r[4]); $subrp=rp($r[6]); 
  $data[$i]=array('<b>No</b>'=>$i, 
                  '<b>Tanggal</b>'=>$r[0], 
                  '<b>Kode Transaksi</b>'=>$r[1], 
                  '<b>Nama Barang</b>'=>$r[3], 
                  '<b>Harga</b>'=>$hargarp, 
                  '<b>Jumlah</b>'=>$r[5], 
                  '<b>SubTotal</b>'=>$subrp);
				  
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
   echo"<script>window.alert('Tidak ada laporan Penjualan pada Tanggal $m s/d $s');
  window.location=('".$uri."/apotek/out.php')</script>";
}
?>
