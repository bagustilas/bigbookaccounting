<?php
<<<<<<< HEAD
/**
********************modul installer bigbook.v.13.1****************
** @Dibuat oleh :	Bagus T. Hidayatullah 				   	******
** @Tanggal 	:	7 april 2013 21:55 WIB					******
** @Model 	    :	CMS.Accounting for busines				******
** @Version	    :	bigbookaccounting.v.13.1				******
** @Call	    :	www.facebook.com/bagustilash			******
** @Project	    :	bigbookaccoungting						******
##################################################################	
	Discripsi:
 * ini adalah sebuah applikasi PHP diperuntukan untuk akuntansi.
 * di gunakan pada pembukuan akuntansi dan persediaan.
 * dengan pengontrolan penuh pada semua kegiatan transaksi.
 
****Copyright 2013 Bagus T.Hidayatullah, all rights reserved.*****
*/
error_reporting(0);
$server		= "localhost";
$username	= "root";
$password	= "";

mysql_connect($server, $username, $password) or die 
("<span style='float: right; margin-top:195px;border-radius: 10px;padding: 2em;
		border-width: 1px;margin-right:350px;background: #E5E5E5;box-shadow: 0 0 5px #000;'>
		<div class='head' style='margin:0;width:auto; margin-top:0px; padding-top:0px; border:1px solid #ccc; background:url(../img/head.gif) 0 100% repeat-x;
		font-weight:bold; font-size:10pt; color:#333; text-align:center; '>Error Intallasi</div>
		silahkan menuju direktori bigbook anda dan masuk ke intall -> pilih index.php -> kemudian<br>
				pada password isikan dengan password sesuai di server anda, kemudian reload ulang browser anda.<br>
				bagustilas@ymail.com | copyright 2013</span>");
?>
<html>
<title>install Bigbook</title>
<link rel="shourcut icon" href="../img/icon/bestseller.ico" type="img/vnd.microsoft.icon"/>
<link href="../install/main.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript">
function theChecker() { 
	if(document.getElementById("stj").checked==false) {
		document.getElementById("nex1").disabled=true;
	} else {
		document.getElementById("nex1").disabled=false;
	}
}
</script>
<body>
<?php
$step = $_GET['s'];

if ($step == "2") {

if (mysql_select_db("bigbook")) {
   mysql_query("CREATE TABLE `barang` (
  `kode` varchar(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `satuan` varchar(6) NOT NULL,
  `jenis` varchar(10) NOT NULL,
  `nobacth` int(12) NOT NULL,
  `ed` date NOT NULL,
  `hrg_beli` int(10) NOT NULL,
  `hrg_jual` int(10) NOT NULL,
  `stok` int(5) NOT NULL,
  `stok_minim` int(8) NOT NULL,
  PRIMARY KEY  (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;") or die (mysql_error());
	
mysql_query("CREATE TABLE `biaya` (
  `id_biaya` int(5) NOT NULL,
  `kd_biaya` int(5) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` enum('Tagihan','Lunas') NOT NULL default 'Tagihan',
  PRIMARY KEY  (`id_biaya`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;") or die (mysql_error());


mysql_query("CREATE TABLE `jns_rek` (
  `kd_jns` int(5) NOT NULL,
  `nm_jenis` varchar(15) collate latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;") or die (mysql_error());

mysql_query("CREATE TABLE `kd_pemb` (
  `tanggal` date NOT NULL,
  `tgl_tempo` date NOT NULL,
  `kd_pmb` varchar(15) NOT NULL,
  `status` varchar(5) NOT NULL,
  `disc` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `id_supplier` int(5) NOT NULL,
  `nofaktur` varchar(12) NOT NULL,
  `tgl_faktur` date NOT NULL,
  `tgl_lunas` date NOT NULL,
  `user` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;") or die (mysql_error());

mysql_query("CREATE TABLE `kd_penj` (
  `tanggal` date NOT NULL,
  `kd_pjl` varchar(15) NOT NULL,
  `total` int(11) NOT NULL,
  `user` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;") or die (mysql_error());

mysql_query("CREATE TABLE `kd_retur` (
  `tanggal` date NOT NULL,
  `id_pemb` varchar(15) NOT NULL,
  `kd_ret` varchar(15) NOT NULL,
  `total` int(11) NOT NULL,
  `user` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;")  or die (mysql_error());

mysql_query("CREATE TABLE `keranjang` (
  `id_keranjang` int(5) NOT NULL auto_increment,
  `id_product` int(5) NOT NULL,
  `id_session` varchar(50) collate latin1_general_ci NOT NULL,
  `tgl_keranjang` date NOT NULL,
  `qty` int(4) NOT NULL,
  `harga` int(12) NOT NULL,
  `transaksi` varchar(10) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id_keranjang`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;") or die (mysql_error());

mysql_query("CREATE TABLE `kode_perilaku` (
  `nomor` int(5) NOT NULL auto_increment,
  `userid` varchar(30) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `photo` varchar(50) NOT NULL,
  PRIMARY KEY  (`nomor`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;") or die (mysql_error());

mysql_query("CREATE TABLE `master_laporan` (
  `tahun` int(4) NOT NULL,
  `bulan` int(2) NOT NULL,
  `penjualan` int(11) NOT NULL,
  `pembelian` int(11) NOT NULL,
  `hpp` int(11) NOT NULL,
  `biaya` int(11) NOT NULL,
  `laba` int(11) NOT NULL,
  `hutang` int(10) NOT NULL,
  `persediaan_akhir` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;") or die (mysql_error());

mysql_query("CREATE TABLE `master_transaksi` (
  `id_transaksi` int(15) NOT NULL auto_increment,
  `kode_transaksi` varchar(15) NOT NULL,
  `kode_rekening` varchar(10) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `keterangan_transaksi` text NOT NULL,
  `debet` int(15) NOT NULL,
  `kredit` int(15) NOT NULL,
  PRIMARY KEY  (`id_transaksi`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=105 ;") or die (mysql_error());

mysql_query("CREATE TABLE `modul` (
  `id_modul` int(5) NOT NULL auto_increment,
  `nama_modul` varchar(50) collate latin1_general_ci NOT NULL,
  `link` varchar(100) collate latin1_general_ci NOT NULL,
  `publish` enum('Y','N') collate latin1_general_ci NOT NULL default 'Y',
  `status` enum('user','admin') collate latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') collate latin1_general_ci NOT NULL default 'Y',
  `urutan` int(5) NOT NULL,
  `tgl` varchar(20) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id_modul`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=99 ;") or die (mysql_error());

mysql_query("CREATE TABLE `pembelian` (
  `id` int(11) NOT NULL auto_increment,
  `id_product` int(11) NOT NULL,
  `id_transaksi` varchar(100) NOT NULL,
  `nobacth` varchar(11) NOT NULL,
  `ed` date NOT NULL,
  `jumlah` int(12) NOT NULL,
  `harga` int(12) NOT NULL,
  `subtotal` int(12) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;") or die (mysql_error());

mysql_query("CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL auto_increment,
  `id_product` int(11) NOT NULL,
  `id_transaksi` varchar(100) NOT NULL,
  `jumlah` int(12) NOT NULL,
  `harga` int(12) NOT NULL,
  `subtotal` int(12) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=84 ;") or die (mysql_error());

mysql_query("CREATE TABLE `penutup` (
  `tanggal` int(2) NOT NULL,
  `bulan` int(2) NOT NULL,
  `tahun` int(4) NOT NULL
  
) ENGINE=MyISAM DEFAULT CHARSET=utf8;") or die (mysql_error());

mysql_query("CREATE TABLE `rekening` (
  `kd_rek` int(5) NOT NULL,
  `nama_rekening` varchar(30) collate latin1_general_ci NOT NULL,
  `jenis` int(11) NOT NULL,
  `jumlah` int(12) NOT NULL,
  PRIMARY KEY  (`kd_rek`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;")or die (mysql_error());

mysql_query("CREATE TABLE `retur` (
  `id` int(11) NOT NULL auto_increment,
  `id_product` int(11) NOT NULL,
  `id_transaksi` varchar(100) NOT NULL,
  `nobacth` varchar(11) NOT NULL,
  `ed` date NOT NULL,
  `jumlah` int(12) NOT NULL,
  `harga` int(12) NOT NULL,
  `subtotal` int(12) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;") or die (mysql_error());

mysql_query("CREATE TABLE `supplier` (
  `id_supplier` varchar(5) collate latin1_general_ci NOT NULL,
  `nm_supplier` varchar(25) collate latin1_general_ci NOT NULL,
  `kota` varchar(15) collate latin1_general_ci NOT NULL,
  `alamat` varchar(50) collate latin1_general_ci NOT NULL,
  `no_hp` varchar(15) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id_supplier`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;") or die (mysql_error());

mysql_query("CREATE TABLE `tabel_berita` (
  `nomor` int(5) NOT NULL auto_increment,
  `user_nomor` int(5) NOT NULL,
  `waktu` datetime NOT NULL,
  `berita` int(11) NOT NULL,
  `id_transaksi` varchar(30) NOT NULL,
  PRIMARY KEY  (`nomor`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;")or die (mysql_error());

mysql_query("CREATE TABLE `users` (
  `username` varchar(50) collate latin1_general_ci NOT NULL,
  `password` varchar(50) collate latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) collate latin1_general_ci NOT NULL,
  `photo` varchar(200) collate latin1_general_ci NOT NULL,
  `email` varchar(100) collate latin1_general_ci NOT NULL,
  `no_telp` varchar(20) collate latin1_general_ci NOT NULL,
  `level` varchar(20) collate latin1_general_ci NOT NULL default 'user',
  `blokir` enum('Y','N') collate latin1_general_ci NOT NULL default 'N',
  `tanggal` varchar(100) collate latin1_general_ci NOT NULL,
  `jamin` varchar(100) collate latin1_general_ci NOT NULL,
  `jamout` varchar(100) collate latin1_general_ci NOT NULL,
  `status` varchar(100) collate latin1_general_ci NOT NULL,
  `id_session` varchar(100) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;")or die (mysql_error());

mysql_query("CREATE TABLE `bigbook_perusahaan` (
  `nm_perusahaan` varchar(25) collate latin1_general_ci NOT NULL,
  `email` varchar(25) collate latin1_general_ci NOT NULL,
  `alamat` varchar(50) collate latin1_general_ci NOT NULL,
  `telp` int(15) NOT NULL,
  `logo` varchar(100) collate latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;") or die (mysql_error());

} else {
	mysql_query("CREATE DATABASE `bigbook` DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci;") or die (mysql_error());
	mysql_select_db("bigbook"); 
  mysql_query("CREATE TABLE `barang` (
  `kode` varchar(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `satuan` varchar(6) NOT NULL,
  `jenis` varchar(10) NOT NULL,
  `nobacth` int(12) NOT NULL,
  `ed` date NOT NULL,
  `hrg_beli` int(10) NOT NULL,
  `hrg_jual` int(10) NOT NULL,
  `stok` int(5) NOT NULL,
  `stok_minim` int(8) NOT NULL,
  PRIMARY KEY  (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;") or die (mysql_error());
	
mysql_query("CREATE TABLE `biaya` (
  `id_biaya` int(5) NOT NULL,
  `kd_biaya` int(5) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` enum('Tagihan','Lunas') NOT NULL default 'Tagihan',
  PRIMARY KEY  (`id_biaya`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;") or die (mysql_error());


mysql_query("CREATE TABLE `jns_rek` (
  `kd_jns` int(5) NOT NULL,
  `nm_jenis` varchar(15) collate latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;") or die (mysql_error());

mysql_query("CREATE TABLE `kd_pemb` (
  `tanggal` date NOT NULL,
  `tgl_tempo` date NOT NULL,
  `kd_pmb` varchar(15) NOT NULL,
  `status` varchar(5) NOT NULL,
  `disc` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `id_supplier` int(5) NOT NULL,
  `nofaktur` varchar(12) NOT NULL,
  `tgl_faktur` date NOT NULL,
  `tgl_lunas` date NOT NULL,
  `user` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;") or die (mysql_error());

mysql_query("CREATE TABLE `kd_penj` (
  `tanggal` date NOT NULL,
  `kd_pjl` varchar(15) NOT NULL,
  `total` int(11) NOT NULL,
  `user` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;") or die (mysql_error());

mysql_query("CREATE TABLE `kd_retur` (
  `tanggal` date NOT NULL,
  `id_pemb` varchar(15) NOT NULL,
  `kd_ret` varchar(15) NOT NULL,
  `total` int(11) NOT NULL,
  `user` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;")  or die (mysql_error());

mysql_query("CREATE TABLE `keranjang` (
  `id_keranjang` int(5) NOT NULL auto_increment,
  `id_product` int(5) NOT NULL,
  `id_session` varchar(50) collate latin1_general_ci NOT NULL,
  `tgl_keranjang` date NOT NULL,
  `qty` int(4) NOT NULL,
  `harga` int(12) NOT NULL,
  `transaksi` varchar(10) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id_keranjang`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;") or die (mysql_error());

mysql_query("CREATE TABLE `kode_perilaku` (
  `nomor` int(5) NOT NULL auto_increment,
  `userid` varchar(30) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `photo` varchar(50) NOT NULL,
  PRIMARY KEY  (`nomor`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;") or die (mysql_error());

mysql_query("CREATE TABLE `master_laporan` (
  `tahun` int(4) NOT NULL,
  `bulan` int(2) NOT NULL,
  `penjualan` int(11) NOT NULL,
  `pembelian` int(11) NOT NULL,
  `hpp` int(11) NOT NULL,
  `biaya` int(11) NOT NULL,
  `laba` int(11) NOT NULL,
  `hutang` int(10) NOT NULL,
  `persediaan_akhir` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;") or die (mysql_error());

mysql_query("CREATE TABLE `master_transaksi` (
  `id_transaksi` int(15) NOT NULL auto_increment,
  `kode_transaksi` varchar(15) NOT NULL,
  `kode_rekening` varchar(10) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `keterangan_transaksi` text NOT NULL,
  `debet` int(15) NOT NULL,
  `kredit` int(15) NOT NULL,
  PRIMARY KEY  (`id_transaksi`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=105 ;") or die (mysql_error());

mysql_query("CREATE TABLE `modul` (
  `id_modul` int(5) NOT NULL auto_increment,
  `nama_modul` varchar(50) collate latin1_general_ci NOT NULL,
  `link` varchar(100) collate latin1_general_ci NOT NULL,
  `publish` enum('Y','N') collate latin1_general_ci NOT NULL default 'Y',
  `status` enum('user','admin') collate latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') collate latin1_general_ci NOT NULL default 'Y',
  `urutan` int(5) NOT NULL,
  `tgl` varchar(20) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id_modul`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=99 ;") or die (mysql_error());

mysql_query("CREATE TABLE `pembelian` (
  `id` int(11) NOT NULL auto_increment,
  `id_product` int(11) NOT NULL,
  `id_transaksi` varchar(100) NOT NULL,
  `nobacth` varchar(11) NOT NULL,
  `ed` date NOT NULL,
  `jumlah` int(12) NOT NULL,
  `harga` int(12) NOT NULL,
  `subtotal` int(12) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;") or die (mysql_error());

mysql_query("CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL auto_increment,
  `id_product` int(11) NOT NULL,
  `id_transaksi` varchar(100) NOT NULL,
  `jumlah` int(12) NOT NULL,
  `harga` int(12) NOT NULL,
  `subtotal` int(12) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=84 ;") or die (mysql_error());

mysql_query("CREATE TABLE `penutup` (
  `tanggal` int(2) NOT NULL,
  `bulan` int(2) NOT NULL,
  `tahun` int(4) NOT NULL
  
) ENGINE=MyISAM DEFAULT CHARSET=utf8;") or die (mysql_error());

mysql_query("CREATE TABLE `rekening` (
  `kd_rek` int(5) NOT NULL,
  `nama_rekening` varchar(30) collate latin1_general_ci NOT NULL,
  `jenis` int(11) NOT NULL,
  `jumlah` int(12) NOT NULL,
  PRIMARY KEY  (`kd_rek`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;")or die (mysql_error());

mysql_query("CREATE TABLE `retur` (
  `id` int(11) NOT NULL auto_increment,
  `id_product` int(11) NOT NULL,
  `id_transaksi` varchar(100) NOT NULL,
  `nobacth` varchar(11) NOT NULL,
  `ed` date NOT NULL,
  `jumlah` int(12) NOT NULL,
  `harga` int(12) NOT NULL,
  `subtotal` int(12) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;") or die (mysql_error());

mysql_query("CREATE TABLE `supplier` (
  `id_supplier` varchar(5) collate latin1_general_ci NOT NULL,
  `nm_supplier` varchar(25) collate latin1_general_ci NOT NULL,
  `kota` varchar(15) collate latin1_general_ci NOT NULL,
  `alamat` varchar(50) collate latin1_general_ci NOT NULL,
  `no_hp` varchar(15) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id_supplier`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;") or die (mysql_error());

mysql_query("CREATE TABLE `tabel_berita` (
  `nomor` int(5) NOT NULL auto_increment,
  `user_nomor` int(5) NOT NULL,
  `waktu` datetime NOT NULL,
  `berita` int(11) NOT NULL,
  `id_transaksi` varchar(30) NOT NULL,
  PRIMARY KEY  (`nomor`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;")or die (mysql_error());

mysql_query("CREATE TABLE `users` (
  `username` varchar(50) collate latin1_general_ci NOT NULL,
  `password` varchar(50) collate latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) collate latin1_general_ci NOT NULL,
  `photo` varchar(200) collate latin1_general_ci NOT NULL,
  `email` varchar(100) collate latin1_general_ci NOT NULL,
  `no_telp` varchar(20) collate latin1_general_ci NOT NULL,
  `level` varchar(20) collate latin1_general_ci NOT NULL default 'user',
  `blokir` enum('Y','N') collate latin1_general_ci NOT NULL default 'N',
  `tanggal` varchar(100) collate latin1_general_ci NOT NULL,
  `jamin` varchar(100) collate latin1_general_ci NOT NULL,
  `jamout` varchar(100) collate latin1_general_ci NOT NULL,
  `status` varchar(100) collate latin1_general_ci NOT NULL,
  `id_session` varchar(100) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;")or die (mysql_error());

mysql_query("CREATE TABLE `bigbook_perusahaan` (
  `nm_perusahaan` varchar(25) collate latin1_general_ci NOT NULL,
  `email` varchar(25) collate latin1_general_ci NOT NULL,
  `alamat` varchar(50) collate latin1_general_ci NOT NULL,
  `telp` int(15) NOT NULL,
  `logo` varchar(100) collate latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;") or die (mysql_error());

}
?>
<div class="main">
<h2>Tahap 2 : Install Database</h1>
	<div class="tengah">
	<div id="data">
		<fieldset>
		<legend>Peting</legend>
		ketika anda sudah pada tahap ini, pastikan anda tidak berpindah dari halaman ini.
		Install Database sudah selesai dan setatus ok, klik continue untuk impor data
		</fieldset>
	</div>
	<div id="status">
<?php
echo "<p align=\"center\">";
//this is the connection file for the database....
$dbname = 'bigbook';
$result = mysql_list_tables($dbname);

echo "<table width=\"65%\" border=\"0\">";
echo  "<tr bgcolor=\"*993333\"> ";
echo    "<td><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"-1\" color=\"*FFFFFF\">No.</font></td>";
echo    "<td><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"-1\" color=\"*FFFFFF\">Table name</font></td>";
echo    "<td><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"-1\" color=\"*FFFFFF\">Status</font></td>";
echo    "<td><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"-1\" color=\"*FFFFFF\">light</font></td>";
echo  "</tr>";
  
    if (!$result) {
        print "DB Error, could not list tables\n";
        print 'MySQL Error: ' . mysql_error();
        exit;
    }
    $no=1;
    while ($row = mysql_fetch_row($result)) {
        echo "<tr bgcolor=\"*CCCCCC\">";
echo    "<td>";
           print "$no\n";
echo    "</td>";
echo    "<td>";
           print "$row[0]\n";
echo    "</td>";
echo    "<td>";
			print "install complet";
echo    "</td>";
echo    "<td>";
			print "<img src='../img/on.gif'>";
echo    "</td>";
$no++;
}
echo "</tr></table>";
    mysql_free_result($result);                  
 ?>
		</div>
	</div>
	<div class="bawah">
	Web Intaller for BigbookAaccounting. &copy By : Bagus Tilas Hidayatullah
	<div class="tombol_kanan"><input type="button" id="next3" value="Continue" onclick="window.location.href = '?s=3';"></div>
	</div>
	</div>	
<?php
} elseif ($step == "3") {
mysql_select_db('bigbook') or die (mysql_error("error 3"));
include "../configurasi/library.php";
$waktu=date("d-m-Y H:i:s");
$tgl=date("d");
$thn=date("Y");
$q=mysql_query("INSERT INTO `modul` (`id_modul`, `nama_modul`, `link`, `publish`, `status`, `aktif`, `urutan`, `tgl`) VALUES
(1, 'Transaksi', 'transaksi', 'Y', 'user', 'Y', 1, '$waktu'),
(2, 'Jurnal', 'jurnal', 'Y', 'user', 'Y', 2, '$waktu'),
(4, 'Grafik', 'grafik', 'Y', 'user', 'Y', 3, '$waktu'),
(91, 'bantuan', 'bantuan', 'N', 'admin', 'N', 11, '$waktu'),
(5, 'Laporan ', 'laporan', 'N', 'admin', 'N', 13, '$waktu'),
(6, 'Users', 'user', 'N', 'admin', 'N', 8, '$waktu'),
(7, 'Modul', 'modul', 'N', 'admin', 'N', 9, '$waktu'),
(3, 'Barang', 'barang', 'Y', 'user', 'Y', 4, '$waktu'),
(11, 'Supplier', 'supplier', 'Y', 'user', 'Y', 6, '$waktu'),
(12, 'Perkiraan', 'setup', 'N', 'admin', 'N', 5, '$waktu'),
(95, 'Pemulihan', 'pemulihan', 'N', 'admin', 'N', 10, '$waktu'),
(96, 'Tentang', 'about', 'N', 'user', 'N', 12, '$waktu'),
(98, 'Neraca', 'neraca', 'N', 'admin', 'N', 14, '$waktu');") or die (mysql_error());

mysql_query("INSERT INTO `kode_perilaku` (`nomor`, `userid`, `nama`, `photo`) VALUES
(1, 'Pembelian', 'pembelian', 'photo/2.PNG'),
(2, 'Retur', 'retur', 'photo/3.PNG'),
(3, 'Hapus', 'hapus', 'photo/4.PNG'),
(4, 'Edit', 'edit', 'photo/5.PNG'),
(5, 'Penjualan', 'penjualan','photo/6.PNG'),
(7, 'Hutang', 'Hutang', 'photo/7.PNG');") or die (mysql_error());

mysql_query("INSERT INTO `rekening` (`kd_rek`, `nama_rekening`, `jenis`, `jumlah`) VALUES
 (111, 'kas Apotek AZka', 1, 0),
 (211, 'Hutang Dagang', 2, 0),
 (611, 'Biaya Listrik', 2, 0),
 (622, 'Biaya Gaji', 2, 0),
 (911, 'Beban Sewa', 2, 0),
 (612, 'Biaya air', 2, 0),
 (311, 'Modal Tn Wasisi', 2, 0),
 (411, 'Pendapatan ', 2, 0),
 (112, 'Pembelian', 1, 0),
 (113, 'Persediaan Barang Dagang', 1, 0),
 (312, 'Prive Tn. Wasis', 1, 0),
 (511, 'Retur Pembelian', 1, 0),
 (114, 'Peralatan Toko', 1, 0),
 (512, 'Retur Penjualan', 1, 0),
 (422, 'Potongan Penjualan', 2, 0),
 (115, 'Penyusutan Peralatan Kantor', 1, 0),
 (116, 'Penyusutan Gedung', 1, 0),
 (117, 'Pajak Penghasilan', 1, 0),
 (423, 'Potongan Pembelian', 1, 0);") or die (mysql_error());

mysql_query("INSERT INTO `jns_rek` (`kd_jns`, `nm_jenis`) VALUES
(1, 'Debit'),
(2, 'Kredit');") or die (mysql_error());

//penutup pergantian tahun
if($bln_sekarang=='12'){
$thn1=$thn_sekarang+1;
mysql_query("INSERT INTO `penutup` (`tanggal`, `bulan`,`tahun`) VALUES
('01', '01','$thn1');") or die (mysql_error());
} else {
$bulan=$bln_sekarang+1;$kemarin=$bln_sekarang-1;
mysql_query("INSERT INTO `penutup` (`tanggal`, `bulan`,`tahun`) VALUES
('01', '$bulan','$thn_sekarang');") or die (mysql_error());
}

//master laporan pergantian tahun
if($bulan=='1'){
mysql_query("INSERT INTO `master_laporan` (`tahun`,`bulan`,`penjualan`,`pembelian`,`hpp`,`biaya`,`laba`,`persediaan_akhir`,`hutang`)
 VALUES ($thn, 12, 0, 0, 0, 0, 0, 0, 0);") or die (mysql_error());
} else{
$kemarin=$bln_sekarang-1;
mysql_query("INSERT INTO `master_laporan` (`tahun`,`bulan`,`penjualan`,`pembelian`,`hpp`,`biaya`,`laba`,`persediaan_akhir`,`hutang`)
 VALUES ($thn, $kemarin, 0, 0, 0, 0, 0, 0, 0);") or die (mysql_error());
 }
 
?>
<div class="main">
	<h2>Tahap 3 : INSTALL MODUL</h1>
	<div class="tengah">
	<div id="data">
		<fieldset>
		<legend>Peting</legend>
		ketika anda sudah pada tahap ini, pastikan anda tidak berpindah dari halaman ini.
		Install Database sudah selesai dan setatus ok, klik continue untuk impor data
		</fieldset>
	</div>
	<div id="status">
<?php
echo "<p align=\"center\">";
//this is the connection file for the database....
mysql_select_db('bigbook') or die (mysql_error("error menampilkan modul"));
$result = mysql_query("SELECT * FROM modul ORDER BY urutan") or die (mysql_error("error menampilkan modul"));;
echo "<table width=\"60%\" border=\"0\">";
echo  "<tr bgcolor=\"*993333\"> ";
echo    "<td><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"-1\" color=\"*FFFFFF\">Module name</font></td>";
echo    "<td><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"-1\" color=\"*FFFFFF\">Status</font></td>";
echo    "<td><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"-1\" color=\"*FFFFFF\">light</font></td>";
echo  "</tr>";
  
    if (!$result) {
        print "DB Error, could not list tables\n";
        print 'MySQL Error: ' . mysql_error();
        exit;
    }
    $no=1;
    while ($row = mysql_fetch_array($result)) {
        echo "<tr bgcolor=\"*CCCCCC\">";
echo    "<td>";
echo     "$row[nama_modul]\n";
echo    "</td>";
echo    "<td>";
			print "install complet";
echo    "</td>";
echo    "<td>";
			print "<img src='../img/on.gif'>";
echo    "</td>";
$no++;
}
echo "</tr></table>";
    mysql_free_result($result);                  
 ?>	
	</div></div>
	<div class="bawah">
	Web Intaller for BigbookAaccounting. &copy By : Bagus Tilas Hidayatullah
	<div class="tombol_kanan"><input type="submit" id="next3" value="Continue" onclick="window.location.href = '?s=4';"></div>
	</div>
	</div>
	
<?php
} elseif ($step == "4") {
?>
<div class="main">
	<h2>Tahap 4 : Setting Perusahaan</h1>
	<div class="tengah">
		<div id="data">
		<fieldset>
		<legend>Prosedur</legend>
		isikan from ini dengan benar dan pastikan anda sudah mengisi 
		semuanya dan untuk mempermudah gunakan default user terlebih dahulu, klik continue untuk konfrimasi.
		</fieldset>
	</div>
		<form action="?s=5" method="POST" enctype='multipart/form-data'>
		  <div id='tambahuser'>
		  <fieldset>
		  <legend>Registration Perusahaan </legend>
          <table>
          <tr><td>Nama Perusahaan</td> <td>  <input type="text" name='nama_perusahaan' size=30></td></tr>  
		  <tr><td>E-mail</td>       <td>  <input type="text" name='email' size=30></td></tr>
          <tr><td>Alamat</td>   	<td>  <textarea name='alamat' width='70' height='50'></textarea></td></tr>
          <tr><td>No.Telp/HP</td>   <td>  <input type="text" name='no_telp' size=20></td></tr>
		  <tr><td>logo</td>    	   <td>  <input type='file' name='fupload' size='40'> </td></tr>
          </table>
		  </fieldset>
		  </div>
	</div>
	<div class="bawah">
	Web Intaller for BigbookAaccounting. &copy By : Bagus Tilas Hidayatullah
	<div class="tombol_kanan"><input type="submit" id="next3" value="Continue"></div>
	</form>
	</div>
	</div>
<?php } elseif ($step == "5") {
  mysql_select_db('bigbook') or die (mysql_error());
  include "../inc/fungsi_thumb.php";
  
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
  
  UploadImage($nama_file_unik); 
  mysql_query("INSERT INTO bigbook_perusahaan(
								 nm_perusahaan,
                                 email,
                                 alamat,
                                 telp, 
                                 logo
								 ) 
	                       VALUES('$_POST[nama_perusahaan]',
                                '$_POST[email]',
                                '$_POST[alamat]',
                                '$_POST[no_telp]',
                                '$nama_file_unik'
								)") or die (mysql_error());

?>
<div class="main">
	<h2>Tahap 5 : Setting User</h1>
	<div class="tengah">
		<div id="data">
		<fieldset>
		<legend>Prosedur</legend>
		isikan from ini dengan benar dan pastikan anda sudah mengisi 
		semuanya dan untuk mempermudah gunakan default user terlebih dahulu, klik continue untuk konfrimasi.
		</fieldset>
	</div>
		<form action="?s=6" method="POST" >
		  <div id='tambahuser'>
		  <fieldset>
		  <legend>Registration User </legend>
          <table>
          <tr><td>Nama Lengkap</td> <td> : <input type="text" name='nama_lengkap' size=30></td></tr>  
		  <tr><td>E-mail</td>       <td> : <input type="text" name='email' size=30></td></tr>
          <tr><td>No.Telp/HP</td>   <td> : <input type="text" name='no_telp' size=20></td></tr>
		  </table>
		  </fieldset>
		  <fieldset>
		  <legend>Sing Up</legend>
          <table>
		  <tr><td>Username</td>     <td> : <input type="text" name='username'></td></tr>
          <tr><td>Password</td>     <td> : <input type="password" name='password'></td></tr>
          </table>
		  </fieldset>
		  </div>
	</div>
	<div class="bawah">
	Web Intaller for BigbookAaccounting. &copy By : Bagus Tilas Hidayatullah
	<div class="tombol_kanan"><input type="submit" id="next3" value="Continue"></div>
	</form>
	</div>
	</div>
<?php } elseif ($step == "6"){
  mysql_select_db('bigbook') or die (mysql_error(""));
  $pass=md5($_POST['password']);
  mysql_query("INSERT INTO users(username,
                                 password,
                                 nama_lengkap,
                                 email, 
                                 no_telp,
								 level,
                                 id_session) 
	                       VALUES('$_POST[username]',
                                '$pass',
                                '$_POST[nama_lengkap]',
                                '$_POST[email]',
                                '$_POST[no_telp]',
								'admin',
								'$pass'
								)") or die (mysql_error());

?>
<div class="main">
	<h2>Tahap 6 : Konfirmasi User Finis</h1>
	<div class="tengah">
		<div id="finis">
		<fieldset>
		<table border="0">
		<msg><p><b><img src="../img/icon/bestseller.ico">Bigbook</b>Acoungting</p></msg>
			<legend>instalasi sudah selesai</legend>
		<tr><td>Username:</td><td><?php echo $_POST['username']; ?></td></tr>
		<tr><td>Password:</td><td><?php echo $_POST['password']; ?></td></tr>
		</table>
		</fieldset>
		</div>
	
	</div>
	<div class="bawah">
	Web Intaller for BigbookAaccounting. &copy By : Bagus Tilas Hidayatullah
	<div class="tombol_kanan"><input type="button" id="next4" value="Finis" onclick="window.location.href = '../index.php';"></div>
	</div>
	</div>
<?php
} else {

?>
	<div class="main">
	<h2>Tahap 1 : Selamat Datang di Menu Install Aplikasi BigbookAcoungting Versi 1.15.0</h1>
	<div class="tengah">
	Selamat datang di menu install aplikasi BigbookAcounting.v.13 Bacalah dengan teliti ketentuan di bawah ini :
	</br><p style="text-align:justify"><textarea>

              -*** KETENTUAN BIGBOOKACOUNTING VERSI 1.15.0 ***-                 
--------------------------------------------------------------------------- 
Bebas disebarluaskan kepada siapapun, asalkan tetap mencantumkan pembuat program,Dilarang secara
KERAS memperjual belikan program ini dengan cara apapun, diizin superuser menambahi atau mengedit 
file kode program di aplikasi ini, Bila mengalami kesulitan penggunaan program, baca petunjuk yang 
disertakan di program ini atau hubungi denbagustilas@gmail.com .
		</textarea></p>
<input type="checkbox" onclick="theChecker()" id="stj" name="setuju" value="1"/> <label for="stj">Saya menyetujui ketentuan Aplikasi BigbookAcoungting.v.13</label>	
	</div>
	<div class="bawah">	
	Web Intaller for BigbookAaccounting. &copy By : Bagus Tilas Hidayatullah
	<div class="tombol_kanan"><input type="button" id="nex1" value="Continue" onclick="window.location.href = '?s=2';" disabled></div>
	</div>
	</div>
<?php
}
?>
</body>
</html>
=======
//include koneksi
require_once"Inc/koneksi.php";
//memulai session
session_start();
//off error
error_reporting(0);
//membuat log session user dan password
     $log =(isset($_SESSION['username'])||isset($_SESSION['passuser']));
	 	if($log){
				header("location:home");
			} else { 
?>
<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" data-useragent="Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Akuntansi Apotek</title>
	<!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
     <!-- Google Fonts-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
<!--
    you can substitue the span of reauth email for a input with the email and
    include the remember me checkbox
    -->
    <div class="container">
        <div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="assets/img/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
			<div class="panel-body"> 
					<div id="status"></div>
			</div>
            <form class="form-signin" method="GET">
               <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
                <input type="password" name="password" class="form-control" placeholder="Password" required>               
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="button" id="masuk">Sign in</button>
            </form><!-- /form -->

        </div><!-- /card-container -->
    </div><!-- /container -->
	     
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/app-apotek.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
	
    
</body>
</html>
<?php
		exit;
		}
?>
>>>>>>> b232cc1cf4b5471bc2f1edf8db1bf8bc212638fd
