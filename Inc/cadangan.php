<?php
require_once "koneksi.php";
error_reporting(0);
function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}

$username = anti_injection($_POST[username]);
$pass     = anti_injection(md5($_POST[password]));


if (!ctype_alnum($username) OR !ctype_alnum($pass)){
	echo"<script>window.alert('isi username dan password anda');
        window.location=('index.php')</script>";
}
else{
$login=mysql_query("SELECT * FROM users WHERE username='$username' AND password='$pass' AND blokir='N'");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);
$tgl=date("d-m-Y");
$jam=date("H:i:s");

if ($ketemu > 0){
  session_start();

  $_SESSION[namauser] = $user = $r[username];
  $_SESSION[namalengkap]  = $r[nama_lengkap];
  $_SESSION[passuser] =  $pass   = $r[password];
  $_SESSION[leveluser]    = $r[level];
  $_SESSION[notelp]    	  = $r[no_telp];
  $_SESSION[tgl]    	  = $r[login];
  $_SESSION[jamin]        = $r[jamin];
  $_SESSION[status]    	  = online;

	$sid_lama = session_id();
	session_regenerate_id();
	$sid_baru = session_id();
	
	setcookie('username', $user, time()+60*60*24*COOKIE_TIME_OUT,"/");
	setcookie('password', $pass, time()+60*60*24*COOKIE_TIME_OUT,"/");
	
 
	/*$tgl_lama = tanggal();
	session_register
	$tgl_baru = tanggal();*/ 

  mysql_query("UPDATE users SET tanggal='$tgl',jamin='$jam',jamout='loggin',status='online',id_session='$sid_baru' 
				WHERE username='$username'");
	echo"<script>window.alert('anda berhasil login...');
        window.location=('admin/index.php?module=home')</script>";
}
else{
		echo"<script>window.alert('Username atau Password anda salah atau akun anda sedang di blokir');
        window.location=('index.php')</script>";
	}
}
	mysql_close();
?>
