<?php
session_start();
//error_reporting(0);
include "../../Inc/koneksi.php";
include "../../Inc/tanggal.php";
//print_r($_POST);
$act=$_GET[act];
$input=$_GET[input];
$module=$_GET[module];
$sid=session_id();
if($act=='trans_penj'){  
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
	
		$cek = mysql_fetch_array(mysql_query("SELECT * FROM keranjang WHERE transaksi='jual'")) or die (mysql_error());
		$qty_pos = $_POST['qty'][$cek['id_product']];
		if($qty_pos == ""){
			echo "<script>window.alert('Transaksi Penjualan gagal di simpan');
				window.location=('".$uri."/apotek/transaksi.penjualan')</script>";		
		}
		else{
		
		$sql = mysql_query("SELECT * FROM keranjang WHERE transaksi='jual'") or die (mysql_error());
	while ($r=mysql_fetch_array($sql)) {
		$id=$r[id_product];
		$qty=$_POST['qty'][$r['id_product']];
		$harga=$r[harga];
		$hasil=$harga*$qty;
		$kode= $_GET[kode];
	$simpan=mysql_query("INSERT INTO penjualan(id_product,jumlah,harga,subtotal,tanggal,id_transaksi) 
							VALUES ('$id','$qty','$harga','$hasil','$tgl_sekarang','$kode')");
			

	$to=mysql_fetch_array(mysql_query("select sum(subtotal) as total from penjualan where id_transaksi='$kode'")) or die (mysql_error());
			$tot=$to['total'];
	$up=mysql_query("UPDATE barang set stok=stok-$qty where kode=$id") or die (mysql_error()); 
	}
	if($simpan){
		mysql_query("INSERT INTO kd_penj set tanggal='$tgl_sekarang',kd_pjl='$kode',total='$tot',user='$_SESSION[namalengkap]',dokter='$_POST[nm_dokter]'") or die ("kode penjulanan"); 		
		mysql_query("INSERT INTO tabel_berita set user_nomor='5',waktu=now(),berita='$tot',id_transaksi='$kode'"); 	
		$post=mysql_query("insert into master_transaksi set kode_transaksi='$kode', kode_rekening='111', tanggal_transaksi='$tgl_sekarang',
						keterangan_transaksi='Kas',debet='$tot' ") or die ("master transaksi penjualan"); 
		$post=mysql_query("insert into master_transaksi set kode_transaksi='$kode', kode_rekening='411', tanggal_transaksi='$tgl_sekarang',
						keterangan_transaksi='Penjualan Barang',kredit='$tot' ") or die (mysql_error()); 
		mysql_query("UPDATE rekening set jumlah=jumlah+$tot WHERE kd_rek='111'"); 
		mysql_query("UPDATE rekening set jumlah=jumlah+$tot WHERE kd_rek='411'"); 
		mysql_query("DELETE FROM keranjang WHERE transaksi='jual'"); 
		echo "<script>window.alert('Transaksi Penjualan berhasil disimpan');
        window.location=('".$uri."/apotek/transaksi.penjualan')</script>";	
	} else {
		echo"error";	
		}	
	}
		}
}
 else if ($act=='trans_pemb'){
	//untuk tambah barang ke keranjang
	if($module=='transaksi' AND $input=='add'){	
	$ql = mysql_fetch_array(mysql_query("SELECT * FROM keranjang order by id_keranjang desc limit 1"));
	$sql = mysql_query("SELECT id_product FROM keranjang WHERE id_session='$sid' AND id_product='$_GET[id]'") or die (mysql_error());
	$num = mysql_num_rows($sql);
	$k= $ql[id_keranjang]+1;
	if ($num==0){
		$x=mysql_query("INSERT INTO `alfa`.`keranjang`(`id_keranjang`,`id_product`,`id_session`,`tgl_keranjang`,`qty`,`harga`,`transaksi`)
									VALUES	('$k','$_GET[id]','$sid','$tgl_sekarang','1','$_GET[harga]','beli')") or die (mysql_error());
		//update barang ketika menambah baranga dan stok berkurang
	} elseif ($num){
		$x=mysql_query("INSERT INTO `alfa`.`keranjang`(`id_keranjang`,`id_product`,`id_session`,`tgl_keranjang`,`qty`,`harga`,`transaksi`)
									VALUES	('$k','$_GET[id]','$sid','$tgl_sekarang','1','$_GET[harga]','beli')") or die (mysql_error());
		//update barang ketika menambah baranga dan stok berkurang
	}
	else {
		mysql_query("UPDATE keranjang SET qty = qty + 1 WHERE id_product='$_GET[id]' AND transaksi='beli'") or die (mysql_error());
	}
	deletecart();
	header('location:'.$uri.'/apotek/transaksi.pembelian');
	}		
elseif ($module=='transaksi' AND $input=='delete'){
	//update barang ketika di delet
	mysql_query("DELETE FROM keranjang WHERE id_keranjang='$_GET[id]' AND transaksi='beli'") or die (mysql_error());
	header('location: '.$uri.'/apotek/transaksi.pembelian');
	}
elseif ($module=='transaksi' AND $input=='hapus'){
	//membatalkan transaksi
	mysql_query("DELETE FROM keranjang WHERE transaksi='beli'") or die (mysql_error());
	header('location: '.$uri.'/apotek/transaksi.pembelian');
	}
elseif ($module=='transaksi' AND $input=='simpan'){
	//print_r($_POST);
	$sql = mysql_query("SELECT * FROM keranjang WHERE transaksi='beli'") or die ("keranjang error");
	while ($r=mysql_fetch_array($sql)) {
	//membaca post dari form pembelian
		$id=$r[id_product];
		$faktur=$_POST['no_fak_sup'];
		$tgl_fak=$_POST['tgl_fak'];
		$status=$_POST['status'];
		if($status=='tempo'){
			$tgl_tempo=$_POST['tgl_tempo'];
		}else{
			$tgl_tempo='0000-00-00';
		}
		$sup=$_POST['nm_supplier'];
		$qty=$_POST['qty'][$r['id_product']];
		$bacth=$_POST['bacth'][$r['id_product']];
		$ed=$_POST['tgl_kd'][$r['id_product']];
		$harga=$_POST['harga'][$r['id_product']];
		$pot=$_POST['potongan'];
		$hasil=$harga*$qty;
		$hb=$harga* 110/100;
		$hj=$harga+$hb;
		$kode= $_GET[kode];
	
	$simpan=mysql_query("INSERT INTO pembelian(id_product,jumlah,harga,subtotal,tanggal,id_transaksi,ed,nobacth) 
							VALUES ('$id','$qty','$harga','$hasil',now(),'$kode','$ed','$bacth')") or die ("1"); 
				
	//total pembelian 
	$to=mysql_fetch_array(mysql_query("select sum(subtotal) as total from pembelian where id_transaksi='$kode'"))or die ("2"); 
	$tot=$to['total'];
	
	//hitung psd
	$psd=mysql_fetch_array(mysql_query("select hrg_beli as total from barang where kode='$id'"))or die (mysql_error());  
	$cond=mysql_fetch_array(mysql_query("select stok as total from barang where kode='$id'"))or die ("4"); 
	
	//hitung beli
	$hrg=mysql_fetch_array(mysql_query("select subtotal as total from pembelian where id_product='$id' and id_transaksi='$kode'"))or die ("5");  
	$jml=mysql_fetch_array(mysql_query("select jumlah as total from pembelian where id_product='$id' and id_transaksi='$kode'"))or die ("6"); 
	
	//penghitungan dengan stok tersisa
	$sub=$psd['total']*$cond['total'];
	$tot_hrg=$hrg['total']+$sub;
	$tot_brg=$jml['total']+$cond['total'];
	$o=$tot_hrg/$tot_brg;
	$q=$o*110/100;
	$grnd=$o+$q;
	
	$h=$harga;
	$hja=$h*110/100;
	$grand2=$hja+$h;
	//update stok barang
	$up=mysql_query("UPDATE barang set ed='$ed' where kode=$id") or die ("7"); 	
	$up=mysql_query("UPDATE barang set stok=stok+$qty,hrg_beli=$harga,nobacth=$bacth where kode=$id") or die (mysql_error()); 
	if($cond['total']==0){
		$up=mysql_query("UPDATE barang set hrg_jual=$grand2 where kode=$id") or die ("error update hja/stok");
	 } else {
		$up=mysql_query("UPDATE barang set hrg_jual=$grnd where kode=$id") or die ("error update hja");
	 }
	}
	if($simpan){
	//memasukan detail pembelian
		if($status=='Tunai'){
	mysql_query("INSERT INTO kd_pemb set tanggal='$tgl_sekarang',
					kd_pmb='$kode',status='$status',tgl_tempo='0000-00-00',
					total='$tot',disc='$pot',id_supplier='$sup',nofaktur='$faktur',tgl_faktur='$tgl_fak',user='$_SESSION[namalengkap]'") or die ("7"); 
			} else {
	mysql_query("INSERT INTO kd_pemb set tanggal='$tgl_sekarang',
					kd_pmb='$kode',status='$status',tgl_tempo='$tgl_tempo',
					total='$tot',disc='$pot',id_supplier='$sup',nofaktur='$faktur',tgl_faktur='$tgl_fak',user='$_SESSION[namalengkap]'") or die (mysql_error()); 				
			}
	//cek status pembelian
	if($status=='Tunai'){
		//jika status tunai
		$post=mysql_query("insert into master_transaksi set kode_transaksi='$kode', kode_rekening='111', tanggal_transaksi='$tgl_sekarang',
						keterangan_transaksi='Kas',kredit='$tot' ") or die ("9"); 
		$post=mysql_query("insert into master_transaksi set kode_transaksi='$kode', kode_rekening='411', tanggal_transaksi='$tgl_sekarang',
						keterangan_transaksi='Pembelian Barang',debet='$tot' ") or die ("10"); 
						
		mysql_query("UPDATE rekening set jumlah=jumlah-$tot WHERE kd_rek='111'")or die ("11"); 
		mysql_query("UPDATE rekening set jumlah=jumlah+$tot WHERE kd_rek='112'")or die ("12"); 
		mysql_query("INSERT INTO tabel_berita set user_nomor='1',waktu=now(),berita='$tot',id_transaksi='$kode'");

		} else {
		//jika status kredit
		$post=mysql_query("insert into master_transaksi set kode_transaksi='$kode', kode_rekening='211', tanggal_transaksi='$tgl_sekarang',
						keterangan_transaksi='Hutang Dagang',kredit='$tot' ") or die ("13"); 
		$post=mysql_query("insert into master_transaksi set kode_transaksi='$kode', kode_rekening='111', tanggal_transaksi='$tgl_sekarang',
						keterangan_transaksi='Pembelian Barang',debet='$tot' ") or die ("14");  
		//mysql_query("UPDATE rekening set jumlah=jumlah+$tot WHERE kd_rek='111'")or die (mysql_error()); 
		mysql_query("UPDATE rekening set jumlah=jumlah+$tot WHERE kd_rek='211'")or die ("15"); 				
		//mysql_query("INSERT INTO tabel_berita set user_nomor='7',waktu=now(),berita='$tot',id_transaksi='$kode'");
	} 				
	mysql_query("DELETE FROM keranjang WHERE transaksi='beli'"); 	
	echo "<script>window.alert('Transaksi Pembelian berhasil disimpan');
      window.location=('".$uri."/apotek/transaksi.pembelian')</script>";	
		} 

	}												
}
function deletecart(){
	$del = date('Y-m-d', mktime(0,0,0, date('m'), date('d') - 1, date('Y')));
	mysql_query("DELETE FROM keranjang WHERE tgl_keranjang < '$del'");
}