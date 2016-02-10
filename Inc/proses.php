<?php
include "koneksi.php";
include "../Inc/library.php";
$op=isset($_GET['op'])?$_GET['op']:null;
$sql=mysql_fetch_array(mysql_query("select * from users where level='admin'")) or die (mysql_error());
$nm=$sql[username];
	
if($op=='tutup'){
    $a=$_GET['pass'];$pass=md5($a);
	$login=mysql_query("select * from users where username='$nm' AND password='$pass'") or die (mysql_error());
	$ketemu=mysql_num_rows($login);
	if($ketemu > 0){
	$bln=$bln_sekarang+1;$bln1=$bln_sekarang-1;
	mysql_query("update penutup set tanggal='1',bulan='$bln'");
				$pjl=mysql_fetch_array(mysql_query("select sum(total) as total from kd_penj where tanggal between '$thn_sekarang-$bln1-1' and '$tgl_sekarang' ")) or die (mysql_error());
				$pbl=mysql_fetch_array(mysql_query("select sum(total) as total from kd_pemb where tanggal between '$thn_sekarang-$bln1_sekarang-1' and '$tgl_sekarang' and status='Tunai' ")) or die (mysql_error());
				$hut=mysql_fetch_array(mysql_query("select sum(total) as total from kd_pemb where tanggal between '$thn_sekarang-$bln1_sekarang-1' and '$tgl_sekarang' and status='Tempo' ")) or die (mysql_error());
				$psd=mysql_fetch_array(mysql_query("select jumlah from rekening where kd_rek='113'"));
				$ret=mysql_fetch_array(mysql_query("select jumlah from rekening where kd_rek='511'"));
				$biaya=mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from rekening where kd_rek between '611' and '699'"));
				$pot=mysql_fetch_array(mysql_query("select sum(disc) as pot from kd_pemb where tanggal between '$thn_sekarang-$bln1-1' and '$tgl_sekarang' and status='Tunai'"));
			
		$tampil=mysql_query("SELECT * FROM barang ORDER BY nama");
		while($r = mysql_fetch_array($tampil)){
		$jml=$r[stok];
		$hrg=$r[hrg_beli];
		$subtotal= $jml * $hrg;
		$total= $total + $subtotal;}
		$x = $pbl[total]-$ret[jumlah]-$pot[pot];
		$x2 = $x + $psd[jumlah];
		$hpp = $x2 - $total;
		$kotor = $pjl[total]-$hpp;
		$pajak= $kotor * 10/100;
		$beban= $biaya[jumlah]+$pajak;
		$laba = $kotor-$beban;
				//inser ke table master laporan
				mysql_query("INSERT INTO master_laporan (tahun,bulan,penjualan,pembelian,hpp,biaya,laba,persediaan_akhir,hutang)
							VALUES ('$thn_sekarang','$bln1','$pjl[total]','$pbl[total]','$hpp','$biaya[jumlah]','$laba','$total','$hut[total]')")
							or die (mysql_error());
				//update persediaan akhir/awal
				mysql_query("UPDATE rekening set jumlah='$total' WHERE kd_rek='113' ") 
							or die (mysql_error());
	
        echo "sukses";
    }else{
        echo "error";
    }
	
}

?>