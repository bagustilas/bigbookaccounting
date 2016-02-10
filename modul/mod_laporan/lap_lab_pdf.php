<?php
//error_reporting(0);

include ('class.ezpdf.php');
include "rupiah.php";
include "../../Inc/koneksi.php";
//print_r($_POST); 
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
$pdf->addText(190, 820, 16,'<b>Laporan Laba Rugi</b>');
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
				$tgl1 = $_POST[thn_1].'-'.$_POST[bln_1];  
				$pecah1 = explode("-", $tgl1);
				$month1 = $pecah1[1];
				$year1 = $pecah1[0];

// Query untuk merelasikan kedua tabel di filter berdasarkan tanggal
$sum=mysql_fetch_array(mysql_query("SELECT * FROM master_laporan WHERE bulan='$month1' AND tahun='$year1'"));
$sql = mysql_query("select * from master_laporan where tahun='$year1' and bulan='$month1'");
$jml = mysql_num_rows($sql);

if ($jml > 0){
$i = 1;
while($r = mysql_fetch_array($sql)){
  $n3=rp($r[3]); $n2=rp($r[2]);$n7=rp($r[7]);  
	$n4=rp($r[4]); $n5=rp($r[5]); $n6=rp($r[6]); 
  $data[$i]=array('<b>No</b>'=>$i, 
                  '<b>Tahun</b>'=>$r[0], 
                  '<b>Bulan</b>'=>$r[1], 
                  '<b>Penjualan</b>'=>$n2, 
                  '<b>Pembelian</b>'=>$n3, 
                  '<b>Hpp</b>'=>$n4, 
                  '<b>Biaya</b>'=>$n5, 
                  '<b>Persd.Akhir</b>'=>$n7,
				  '<b>Laba</b>'=>$n6);
  $i++;
}

$pdf->ezTable($data, '', '', '');



// Penomoran halaman
$pdf->ezStartPageNumbers(320, 15, 8);
$pdf->ezStream();
}
else{
  $m=$_POST[bln_1];
  $s=$_POST[thn_1];
    echo"<script>window.alert('Tidak ada laporan laba rugi pada Bulan $m Tahun $s');
  window.location=('".$uri."/apotek/out.php')</script>";
}
?>
