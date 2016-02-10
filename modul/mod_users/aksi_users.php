<?php
session_start();
include "../../Inc/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

//delete user
if ($module=='user' AND $act=='hapus'){
  mysql_query("DELETE FROM users WHERE username='$_GET[id]'");
  header ('location:../../admin/index.php?module='.$module);
}

// Input user
elseif ($module=='user' AND $act=='input'){
  $pass=md5($_POST[password]);
  mysql_query("INSERT INTO users(username,
                                 password,
                                 nama_lengkap,
                                 email, 
                                 no_telp,
                                 id_session) 
	                       VALUES('$_POST[username]',
                                '$pass',
                                '$_POST[nama_lengkap]',
                                '$_POST[email]',
                                '$_POST[no_telp]',
                                '$pass'
								)");
  header('location:../../admin/index.php?module='.$module);
}

// Update user
elseif ($module=='user' AND $act=='update'){
  if (empty($_POST['password'])) {
    mysql_query("UPDATE users SET username		 = '$_POST[username]',
								  level			 = '$_POST[level]',
								  nama_lengkap   = '$_POST[nama_lengkap]',
                                  email          = '$_POST[email]',
                                  blokir         = '$_POST[blokir]',  
                                  no_telp        = '$_POST[no_telp]'  
                           WHERE  id_session     = '$_POST[id]'");
  }
  // Apabila password diubah
  else{
    $pass=md5($_POST['password']);
    mysql_query("UPDATE users SET password        = '$pass',
								 level			 = '$_POST[level]',
                                 nama_lengkap    = '$_POST[nama_lengkap]',
                                 email           = '$_POST[email]',  
                                 blokir          = '$_POST[blokir]',  
                                 no_telp         = '$_POST[no_telp]'  
                           WHERE id_session      = '$_POST[id]'");
  }
  header('location:../../admin/index.php?module='.$module);
}
mysql_close();
?>