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
$pdf->addJpegFromFile('$pemilik[logo]',20,785,69);

// Teks di tengah atas untuk judul header
$pdf->addText(150, 820, 16,'<b>Laporan Stok Bulan'. tgl_indo(date("Ymd")) .'</b>');
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
$qmin=mysql_fetch_array(mysql_query("select min(bulan) as bulan, min(tahun) as tahun from master_laporan"));
	$pertamax=$qmin['bulan'];
	$pertama2=$qmin['tahun'];


// Query untuk merelasikan kedua tabel di filter berdasarkan tanggal
$sql = mysql_query("SELECT b.kode ,b.jenis, b.nama , b.satuan , p.pembelian , j.penjualan , b.stok , b.hrg_beli 
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

ORDER BY b.nama");
$jml = mysql_num_rows($sql);

if ($jml > 0){
$i = 1;
while($r = mysql_fetch_array($sql)){
 
  $data[$i]=array('<b>No</b>'=>$i, 
                  '<b>Kode Barang</b>'=>$r[0], 
                  '<b>Nama Barang</b>'=>$r[2], 
                  '<b>Satuan</b>'=>$r[3], 
                  '<b>Masuk</b>'=>$r[4], 
                  '<b>Keluar</b>'=>$r[5], 
                  '<b>Stok Barang</b>'=>$r[6], 
                  '<b>Harga Beli</b>'=>$r[7],
				  '<b>Subtotal</b>'=>$r[3]);
  $i++;
}


$pdf->ezTable($data, '', '', '');




// Penomoran halaman
$pdf->ezStartPageNumbers(320, 15, 8);
$pdf->ezStream();
}
else{
  $m=$_POST[tgl_1].'-'.$_POST[bln_1].'-'.$_POST[thn_1];
  $s=$_POST[tgl_2].'-'.$_POST[bln_2].'-'.$_POST[thn_2];
  echo"<script>window.alert('Tidak ada laporan Stok');
  window.location=('".$uri."/apotek/out.php')</script>";
}
?>
