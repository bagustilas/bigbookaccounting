<?php
define ("DB_HOST","localhost");
define ("DB_USER","root");
define ("DB_PASS","");
define ("DB_NAME","bigbook");

$koneksi = mysql_connect("DB_HOST,DB_USER,DB_PASS") or die ("koneksi gagal");
$pilihdb = mysql_select_db("DB_NAME") or die ("database tidak ada");
?>