<?php

include "Inc/koneksi.php";
include "Inc/library.php";
include "Inc/fungsi_indotgl.php";
include "Inc/fungsi_autolink.php";
include "Inc/fungsi_combobox.php";
include "Inc/fungsi_kalender.php";
include "Inc/class_paging.php";
include "Inc/fungsi_rupiah.php";
include"Inc/backup.php";



if ($_GET['module']=='home'){
	include "modul/mod_home/home.php";
	}
	elseif ($_GET['module']=='transaksi'){
	include "modul/mod_transaksi/transaksi.php";
	}
	elseif ($_GET['module']=='jurnal'){
	include "modul/mod_jurnal/jurnal.php";
	}
	elseif ($_GET['module']=='laporan'){
	include "modul/mod_laporan/laporan.php";
	}
	elseif ($_GET['module']=='grafik'){
	include "modul/mod_grafik/grafik.php";
	}
	elseif ($_GET['module']=='bantuan'){
	include "modul/mod_bantuan/bantuan.php";
	}
	elseif ($_GET['module']=='user'){
	include "modul/mod_users/users.php";
	}
	elseif ($_GET['module']=='barang'){
	include "modul/mod_barang/barang.php";
	}
	elseif ($_GET['module']=='modul'){
	include "modul/mod_modul/modul.php";
	}
	elseif ($_GET['module']=='manajement'){
	include "modul/mod_manajement/manajement.php";
	}
	elseif ($_GET['module']=='setup'){
	include "modul/mod_setup/setup.php";
	}
	elseif ($_GET['module']=='supplier'){
	include "modul/mod_supplier/supplier.php";
	}
	elseif ($_GET['module']=='dokter'){
	include "modul/mod_dokter/dokter.php";
	}
	elseif ($_GET['module']=='about'){
	include "modul/mod_about/about.php";
	}
	elseif ($_GET['module']=='pemulihan'){
	include "modul/mod_pemulihan/pemulihan.php";
	}
	elseif ($_GET['module']=='neraca'){
	include "modul/mod_neraca/neraca.php";
	}
	else{
	echo "<h2><img src='../img/icon/config.png'>&nbspRecountrucsi</h2><hr>
	 <center><p>Pengguna terhormat,<br>modul Belum di instal, untuk informasi lebih lanjut bisa ke <a href='?module=bantuan'> menghubungi ke<br>
	 <a href=mailto:bagustilas@ymail.com<span>bagustilas@ymail.com </span></a>|| +6287711972921</br>terima kasih<img src=../img/icon/heart.png></p> </center> </br></br></br></br>";
}
mysql_close()
?>