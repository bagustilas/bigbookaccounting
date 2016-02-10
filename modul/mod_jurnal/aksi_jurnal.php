<?php
session_start();
//error_reporting(0);
include "../../Inc/koneksi.php";
include "../../Inc/tanggal.php";
//print_r($_POST);
$act=$_GET[act];
$input=$_GET[input];
$module=$_GET[module];
$nota=$_GET[id];
$sid=session_id();
if($act=='retur'){  
if($module=='transaksi' AND $input=='add'){	
	$ql = mysql_fetch_array(mysql_query("SELECT * FROM keranjang order by id_keranjang desc limit 1"));
	$sql = mysql_query("SELECT id_product FROM keranjang WHERE id_session='$sid' AND id_product='$_GET[kode]'") or die (mysql_error());
	$num = mysql_num_rows($sql);
	$k= $ql[id_keranjang]+1;
	if ($num==0){
		$x=mysql_query("INSERT INTO `alfa`.`keranjang`(`id_keranjang`,`id_product`,`id_session`,`tgl_keranjang`,`qty`,`harga`,`transaksi`)
									VALUES	('$k','$_GET[kode]','$sid','$tgl_sekarang','1','$_GET[harga]','retur')") or die (mysql_error());
		//update barang ketika menambah baranga dan stok berkurang
	} elseif ($num){
		$x=mysql_query("INSERT INTO `alfa`.`keranjang`(`id_keranjang`,`id_product`,`id_session`,`tgl_keranjang`,`qty`,`harga`,`transaksi`)
									VALUES	('$k','$_GET[kode]','$sid','$tgl_sekarang','1','$_GET[harga]','retur')") or die (mysql_error());
		//update barang ketika menambah barang dan stok berkurang
	}
	else {
		mysql_query("UPDATE keranjang SET qty = qty + 1 WHERE id_product='$_GET[kode]' AND transaksi='retur'") or die (mysql_error());
	}
	 // header('location:../../admin/index.php?module=jurnal&act=lihatpembelian&act=retur&id=$_GET[id]');
	 echo "<script>window.alert('Berhasil ditambahkan');
        window.location=('".$uri."/apotek/retur.&id=$_GET[id]')</script>";	
	}			
elseif ($module=='transaksi' AND $input=='delete'){
	//update barang ketika di delet
	mysql_query("DELETE FROM keranjang WHERE id_keranjang='$_GET[kd]' AND transaksi='retur'") or die (mysql_error());
	echo "<script>window.alert('Berhasil diHapus');
         window.location=('".$uri."/apotek/retur.&id=$_GET[id]')</script>";	
}
elseif ($module=='transaksi' AND $input=='hapus'){
	$sql = mysql_query("SELECT * FROM keranjang") or die (mysql_error());
	while ($r=mysql_fetch_array($sql)) {
		$id=$r[id_product];
		$qty=$r[qty];
	if($sql){
		//update barang ketika transaksi penjuala di batalkan
		// mysql_query("UPDATE barang set stok=stok+$qty where kode='$id'") or die (mysql_error());
		//hapus kerangjang ketika di batalkan 
		mysql_query("DELETE FROM keranjang WHERE transaksi='retur'") or die (mysql_error());
	} else {
		echo"error";	
		}	
	}
	echo "<script>window.alert('Berhasil di Batalkan');
        window.location=('".$uri."/apotek/pembelian.&id=$_GET[id]')</script>";	
	}
elseif ($module=='transaksi' AND $input=='simpan'){
		$sql = mysql_query("SELECT * FROM keranjang WHERE transaksi='retur'") or die (mysql_error());
	while ($r=mysql_fetch_array($sql)) {
		$id=$r[id_product];
		$qty=$_POST['qty'][$r['id_product']];
		$ed=$_POST['ed'][$r['id_product']];
		$nobacth=$_POST['bacth'][$r['id_product']];
		$harga=$r[harga];
		$hasil=$harga*$qty;
		$kode= $_GET[kode];
	$simpan=mysql_query("INSERT INTO retur(id_product,id_transaksi,nobacth,ed,jumlah,harga,subtotal,tanggal) 
							VALUES ('$id','$kode','$nobacth','$ed','$qty','$harga','$hasil','$tgl_sekarang')");
	$to=mysql_fetch_array(mysql_query("select sum(subtotal) as total from retur where id_transaksi='$kode'")) or die (mysql_error());
			$tot=$to['total'];
	$up=mysql_query("UPDATE barang set stok=stok-$qty where kode=$id") or die (mysql_error()); 
}	
	if($simpan){
		mysql_query("INSERT INTO kd_retur set tanggal='$tgl_sekarang',kd_ret='$kode',total='$tot',id_pemb='$nota',user='$_SESSION[namalengkap]'") or die (mysql_error()); 		
		mysql_query("INSERT INTO tabel_berita set user_nomor='2',waktu=now(),berita='$tot',id_transaksi='$kode'"); 	
		$post=mysql_query("insert into master_transaksi set kode_transaksi='$kode', kode_rekening='511', tanggal_transaksi='$tgl_sekarang',
						keterangan_transaksi='Retur Pembelian',debet='$tot' ") or die ("master transaksi penjualan"); 
		$post=mysql_query("insert into master_transaksi set kode_transaksi='$kode', kode_rekening='111', tanggal_transaksi='$tgl_sekarang',
					 keterangan_transaksi='Kas',kredit='$tot' ") or die (mysql_error()); 
		 mysql_query("UPDATE rekening set jumlah=jumlah-$tot WHERE kd_rek='111'"); 
		 mysql_query("UPDATE rekening set jumlah=jumlah-$tot WHERE kd_rek='111'"); 
		 mysql_query("UPDATE rekening set jumlah=jumlah+$tot WHERE kd_rek='511'");
	// $uppem = mysql_query("UPDATE pembelian set jumlah=jumlah-$qty where id_transaksi='$idtrans' AND id_product='$id' ") or die (mysql_error());
	// $jum = mysql_query("select * from pembelian where id_transaksi='$idtrans' AND id_product='id'")or die (mysql_error()) ;
		// $has=$jum[harga]*$jum[jumlah];
	// $uppsub = mysql_query("UPDATE pembelian set subtotal=$has where id_transaksi='$idtrans' AND id_product='$id'") or die (mysql_error());
		mysql_query("DELETE FROM keranjang WHERE transaksi='retur'"); 
		echo "<script>window.alert('Transaksi Retur berhasil disimpan');
        window.location=('".$uri."/apotek/jurnal.pembelian')</script>";	
	} else {
		echo"error";	
		}	
	}
} 
	else if ($act=='batalpnj')
{
	if($module=='transaksi' AND $input=='add'){	
	$ql = mysql_fetch_array(mysql_query("SELECT * FROM keranjang order by id_keranjang desc limit 1"));
	$sql = mysql_query("SELECT id_product FROM keranjang WHERE id_session='$sid' AND id_product='$_GET[id]'") or die (mysql_error());
	$num = mysql_num_rows($sql);
	$k= $ql[id_keranjang]+1;
	if ($num==0){
		$x=mysql_query("INSERT INTO keranjang (`id_keranjang`,`id_product`,`id_session`,`tgl_keranjang`,`qty`,`harga`,`transaksi`)
									VALUES	('$k','$_GET[id]','$sid','$tgl_sekarang','1','$_GET[harga]','jual')") or die (mysql_error());
		//update barang ketika menambah baranga dan stok berkurang
	} elseif ($num){
		$x=mysql_query("INSERT INTO keranjang(`id_keranjang`,`id_product`,`id_session`,`tgl_keranjang`,`qty`,`harga`,`transaksi`)
									VALUES	('$k','$_GET[id]','$sid','$tgl_sekarang','1','$_GET[harga]','jual')") or die (mysql_error());
		//update barang ketika menambah baranga dan stok berkurang
	}
	else {
		mysql_query("UPDATE keranjang SET qty = qty + 1 WHERE id_product='$_GET[id]' AND transaksi='jual'") or die (mysql_error());
	}
	deletecart();
	header('location: '.$uri.'/apotek/transaksi.penjualan');
	}			
elseif ($module=='transaksi' AND $input=='delete'){
	//update barang ketika di delet
	mysql_query("DELETE FROM keranjang WHERE id_keranjang='$_GET[id]' AND transaksi='jual'") or die (mysql_error());
	header('location: '.$uri.'/apotek/transaksi.penjualan');
	}
elseif ($module=='transaksi' AND $input=='hapus'){
	$sql = mysql_query("SELECT * FROM keranjang") or die (mysql_error());
	while ($r=mysql_fetch_array($sql)) {
		$id=$r[id_product];
		$qty=$r[qty];
	if($sql){
		//update barang ketika transaksi penjuala di batalkan
		// mysql_query("UPDATE barang set stok=stok+$qty where kode='$id'") or die (mysql_error());
		//hapus kerangjang ketika di batalkan 
		mysql_query("DELETE FROM keranjang WHERE transaksi='jual'") or die (mysql_error());
	header('location: '.$uri.'/apotek/transaksi.penjualan');
	} else {
		echo"error";	
		}	
	}
	header('location: '.$uri.'/apotek/transaksi.penjualan');
	}
 elseif ($module=='transaksi' AND $input=='simpan'){
	//print_r($_POST);
	$sql = mysql_query("SELECT * FROM penjualan WHERE id_transaksi='$_GET[kode]'") or die (mysql_error());
	while ($r=mysql_fetch_array($sql)) {
		$id = $r[id_product];
		$qty = $_POST['qty'][$r['id_product']];
		$harga=$r[harga];
		$hasil=$harga*$qty;
		$kode= $_GET[kode];
	
	if($qty > $r[jumlah]){
		 //barang terupdate (-)
		$stokminus = $qty - $r[jumlah]; 
		$up=mysql_query("UPDATE barang set stok = stok - $stokminus where kode=$id") or die (mysql_error()); 
	} else if($qty < $r[jumlah]) {
		//barang terupdate (+)
		$stokplus = $r[jumlah] - $qty; 
		$up=mysql_query("UPDATE barang set stok = stok + $stokplus where kode=$id") or die (mysql_error()); 
	} else {
		echo"GAGAL UPDATE STOK BARANG";
	}
			
			$update = 	mysql_query("UPDATE penjualan set jumlah = $qty, subtotal = $hasil where id_transaksi='$kode' AND id_product='$id'");	
		
			$to = mysql_fetch_array(mysql_query("select sum(subtotal) as total from penjualan where id_transaksi='$kode'")) or die (mysql_error());
			$tot =$to['total'];		
		
	}
	if($update){
		
		//memanggil rekening kas dan penjualan dari database
		$sub_tot = mysql_query("SELECT total FROM kd_penj WHERE kd_pjl='$kode'");//total kd_penj transaksi lama
		$tot_b = mysql_query("SELECT * FROM rekening where kd_rek='111'");
		$tot_p = mysql_query("SELECT * FROM rekening where kd_rek='111'");
		$kas = $tot_b - $sub_tot;
		$pendapatan =  $tot_p - $sub_tot;
		
		//mengurangi jumlah kas dan pendatan pada rekening
		$update1 = mysql_query("UPDATE rekening set jumlah=jumlah-$kas WHERE kd_rek='111'"); 
				   mysql_query("UPDATE rekening set jumlah=jumlah-$pendapatan WHERE kd_rek='411'"); 
		 
		if($update1) { 
		
			//Update kd_penj dengan total transaksi baru
			mysql_query("UPDATE kd_penj set total='$tot',user='$_SESSION[namalengkap]',dokter='$_POST[nm_dokter]'
			where kd_pjl='$kode'") or die (mysql_error()); 		
		
			//update master transaksi
			$post=mysql_query("UPDATE master_transaksi set 
				keterangan_transaksi='Kas',debet='$tot' where kode_transaksi='$kode' AND kode_rekening='111'") or die ("master transaksi penjualan"); 
						
			$post=mysql_query("UPDATE master_transaksi set 
						keterangan_transaksi='Penjualan Barang',kredit='$tot' where kode_transaksi='$kode' AND kode_rekening='411'") or die (mysql_error()); 
			
			//update jumlah kas dan pendatan pada rekening
			mysql_query("UPDATE rekening set jumlah=jumlah+$tot WHERE kd_rek='111'"); 
			mysql_query("UPDATE rekening set jumlah=jumlah+$tot WHERE kd_rek='411'"); 
			
			
		}
		
			echo "<script>window.alert('Transaksi Penjualan berhasil di Update');
			window.location=('".$uri."/apotek/jurnal')</script>";	
	} 
		else 
			{
				echo"error";	
			}	
	}
} else if ($act=='batalpmb') {
	if($module=='transaksi' AND $input=='batalpmb'){	
		$kode= $_GET[id];
		//cari data pembelian
		$tot = mysql_fetch_array( mysql_query("SELECT * FROM kd_pemb where kd_pmb='$kode'") );
		$data_cb = mysql_query("SELECT * FROM pembelian where id_transaksi='$kode'");
		while($cb = mysql_fetch_array($data_cb)){
			//update stok barang
			mysql_query("UPDATE barang set stok = stok - $cb[jumlah] where kode= $cb[id_product] ") or die (mysql_error());
		}
		print_r($_GET);
		if($tot[status]=='Tunai'){
		//update jumlah kas dan pendatan pada rekening
			mysql_query("UPDATE rekening set jumlah= jumlah - $tot[total] WHERE kd_rek=111")or die (mysql_error()); 
			mysql_query("UPDATE rekening set jumlah= jumlah - $tot[total] WHERE kd_rek=411")or die (mysql_error()); 
		} else {
			mysql_query("UPDATE rekening set jumlah= jumlah - $tot[total] WHERE kd_rek=211")or die (mysql_error()); 
		}
		$ret = mysql_fetch_array( mysql_query("SELECT * FROM kd_retur WHERE id_pemb='$kode'"));
		$delret = mysql_query("DELETE FROM retur WHERE id_transaksi ='$ret[kd_ret]'") or die (mysql_error());
		
		if($delret){
			 mysql_query("DELETE FROM kd_retur WHERE id_pemb='$kode'") or die (mysql_error());
		} else {
			echo"gagal";
		}
		mysql_query("DELETE FROM kd_pemb WHERE kd_pmb='$kode'") or die (mysql_error());
		mysql_query("DELETE FROM pembelian WHERE id_transaksi='$kode'") or die (mysql_error());
		mysql_query("DELETE FROM master_transaksi WHERE kode_transaksi='$kode'") or die (mysql_error());
		
		echo "<script>window.alert('Pembatalan Transaksi Pembelian Berhasil');
			window.location=('".$uri."/apotek/jurnal.pembelian')</script>";
	} else {
		echo"error";
	}
}
?>