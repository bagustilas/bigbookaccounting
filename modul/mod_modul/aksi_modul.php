<?php
/**
********************modul installer bigbook.v.12******************
** @Dibuat oleh :	Bagus T. Hidayatullah 				   	W******
** @Tanggal 	:	7 april 2013 21:55 WIB					******
** @Model 	    :	CMS.Accounting for busines				******
** @Version	    :	bigbookaccounting.v.12					******
** @Call	    :	www.facebook.com/bagustilash			******
** @Project	    :	bigbookaccoungting						******
##################################################################	
	Discripsi:
 * ini adalah sebuah applikasi PHP diperuntukan untuk akuntansi.
 * di gunakan pada pembukuan akuntansi dan persediaan.
 * dengan pengontrolan penuh pada semua kegiatan transaksi.
 
****Copyright 2013 Bagus T.Hidayatullah, all rights reserved.*****
*/
include "../../Inc/koneksi.php";

$module=$_GET['module'];
$act=$_GET['act'];
 $date = date("d-m-Y");
 
// Hapus modul
if ($module=='modul' AND $act=='hapus'){
  mysql_query("DELETE FROM modul WHERE id_modul='$_GET[id]'");
  header('location:'.$uri.'/apotek/pengaturan');
}

// Input modul
elseif ($module=='modul' AND $act=='input'){
  // Cari angka urutan terakhir
  $u=mysql_query("SELECT urutan FROM modul ORDER by urutan DESC");
  $d=mysql_fetch_array($u);
  $urutan=$d[urutan]+1;
  $waktu=date("d-m-Y H:i:s");
  // Input data modul
  mysql_query("INSERT INTO modul(nama_modul,
                                 link,
                                 publish,
                                 aktif,
                                 status,
                                 urutan,
								 tgl
								 ) 
	                       VALUES('$_POST[nama_modul]',
                                '$_POST[link]',
                                '$_POST[publish]',
                                '$_POST[aktif]',
                                '$_POST[status]',
                                '$urutan',
								'$waktu')");
  header('location:'.$uri.'/pengaturan');
}
// Update modul
elseif ($module=='modul' AND $act=='update'){ 
  $waktu=date("d-m-Y H:i:s");
  mysql_query("UPDATE modul SET id_modul   = '$_POST[id]',
								nama_modul = '$_POST[nama_modul]',
                                link       = '$_POST[link]',
                                publish    = '$_POST[publish]',
                                aktif      = '$_POST[aktif]',
                                status     = '$_POST[status]',
                                urutan     = '$_POST[urutan]',
								tgl        = '$waktu'
                          WHERE id_modul   = '$_POST[id]'") or die (mysql_error());
  header('location:'.$uri.'/pengaturan');
}
?>
