<?php
session_start();  
include "Inc/koneksi.php";
	$jam = date("H:i:s");  
    mysql_query(" TRUNCATE TABLE `keranjang`"); 
	mysql_query("UPDATE users SET jamout='$jam', status='offline'
								WHERE username = '$_SESSION[namauser]' AND jamout='loggin' AND status='online'") or die (mysql_error());
	
	unset ($_SESSION['username']);
	unset ($_SESSION['password']);
	unset ($_SESSION['session']);
	unset ($_SESSION['namauser']); 
    unset ($_SESSION['namalengkap']); 
    unset ($_SESSION['passuser']); 
    unset ($_SESSION['leveluser']);   
    unset ($_SESSION['notelp']);   
    unset ($_SESSION['jamin']);      
    unset ($_SESSION['status']);    	 

  
   setcookie('username','', time()-60*60*24*COOKIE_TIME_OUT,"/");
   setcookie('password','', time()-60*60*24*COOKIE_TIME_OUT,"/");

   
   session_unset(); 
   session_destroy();
   
   header('Location: '.$uri.'/apotek');
?>