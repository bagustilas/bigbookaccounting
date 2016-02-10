<?php
include "../../Inc/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];


if ($module=='supplier' AND $act=='hapus'){
  mysql_query("DELETE FROM supplier WHERE id_supplier='$_GET[id]'");
  header('location:'.$uri.'/apotek/supplier');
}
elseif ($module=='supplier' AND $act=='input'){
  mysql_query("INSERT INTO supplier(id_supplier,nm_supplier,kota,alamat,no_hp)
							VALUES	
				('$_POST[id_supplier]','$_POST[nm_supplier]','$_POST[kota]','$_POST[alamat]','$_POST[no_hp]')");
  header('location:'.$uri.'/apotek/supplier');
}
elseif ($module=='supplier' AND $act=='update'){
  mysql_query("UPDATE supplier SET id_supplier = '$_POST[id_supplier]',
								 nm_supplier='$_POST[nm_supplier]',
								 kota='$_POST[kota]', 
					             alamat='$_POST[hrg_supplier]',
								 no_hp='$_POST[no_hp]'
					WHERE id_supplier = '$_POST[id]'");
  header('location:'.$uri.'/apotek/supplier');
}
mysql_close();
?>