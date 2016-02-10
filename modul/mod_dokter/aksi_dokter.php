<?php
include "../../Inc/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];


if ($module=='dokter' AND $act=='hapus'){
  mysql_query("DELETE FROM dokter WHERE id_dokter='$_GET[id]'");
  header('location:'.$uri.'/apotek/dokter');
}
elseif ($module=='dokter' AND $act=='input'){
  mysql_query("INSERT INTO dokter(id_dokter,nm_dokter,kota,alamat,no_hp)
							VALUES	
				('$_POST[id_dokter]','$_POST[nm_dokter]','$_POST[kota]','$_POST[alamat]','$_POST[no_hp]')");
  header('location:'.$uri.'/apotek/dokter');
}
elseif ($module=='dokter' AND $act=='update'){
  mysql_query("UPDATE dokter SET id_dokter = '$_POST[id_dokter]',
								 nm_dokter='$_POST[nm_dokter]',
								 kota='$_POST[kota]', 
					             alamat='$_POST[hrg_dokter]',
								 no_hp='$_POST[no_hp]'
					WHERE id_dokter = '$_POST[id]'");
  header('location:'.$uri.'/apotek/dokter');
}
mysql_close();
?>