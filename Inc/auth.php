<?php
error_reporting(0);
include "koneksi.php";
function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}

$username = anti_injection($_GET['user']);
$pass     = anti_injection(md5($_GET['pass']));


if (!ctype_alnum($username) OR !ctype_alnum($pass)){
	echo"<script>window.alert('Maaf Tindakan Seperti itu tidak di izinkan !');
        window.location=('".$uri."/index.php')</script>";
}
else{

	$login=mysql_query("select * from users where username='$username'") or die (mysql_error());
	$ketemu=mysql_num_rows($login);
	$r=mysql_fetch_assoc($login);
	$tgl=date("d-m-Y");
	$jam=date("H:i:s");
	
	if($ketemu==1){
		if($pass == $r['password']){
	session_start();
  $_SESSION[namauser] = $user = $r[username];
  $_SESSION[namalengkap]  = $r[nama_lengkap];
  $_SESSION[passuser] =  $pass   = $r[password];
  $_SESSION[leveluser]    = $r[level];
  $_SESSION[notelp]    	  = $r[no_telp];
  $_SESSION[jamin]        = $jam=date("H:i:s");
  $_SESSION[status]    	  = online;

	$sid_lama = session_id();
	session_regenerate_id();
	$sid_baru = session_id();
	
	setcookie('username', $user, time()+60*60*24*COOKIE_TIME_OUT,"/");
	setcookie('password', $pass, time()+60*60*24*COOKIE_TIME_OUT,"/");
	
		mysql_query(" TRUNCATE TABLE `keranjang`"); 
		mysql_query("UPDATE users SET tanggal='$tgl',jamin='$jam',jamout='loggin',status='online',id_session='$sid_baru' 
				WHERE username='$username'") or die (mysql_error());
	
        echo "sukses";
		}else{
			echo"password";
		}
    }else{
		echo"username";
    }
	mysql_close();
}

?>