DROP TABLE barang;

CREATE TABLE `barang` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO barang VALUES("5215","Ondancentron 4 mg","Ampul","Generik","2331332","2015-06-18","1235","3172","125","50");
INSERT INTO barang VALUES("8541","Furosemide 40 mg","Tablet","Generik","661332","2015-07-16","450","945","100","50");
INSERT INTO barang VALUES("352","Vit A 6000","Tablet","Generik","51212223","2015-06-06","98","206","190","100");
INSERT INTO barang VALUES("5321","Vit C ","Tablet","Generik","69946332","2015-03-16","100","210","490","100");
INSERT INTO barang VALUES("372","Zinc Kids","Tablet","Generik","33995","2016-01-07","124","260","50","50");
INSERT INTO barang VALUES("52312","Lantus 60ml syr","Fls","Generik","36622","2015-03-18","4221","8864","24","25");
INSERT INTO barang VALUES("8542","Betahistin","Tablet","Generik","63121","2015-08-11","165","347","100","50");
INSERT INTO barang VALUES("5323","Bisoprolol","Tablet","Generik","62312","2016-03-16","145","305","50","50");
INSERT INTO barang VALUES("531","Alprazolam 0,5 mg","Tablet","Narkotik","9631221","2015-05-04","950","1995","40","50");
INSERT INTO barang VALUES("362","Alprazolam 1 mg","Tablet","Narkotik","6632112","2015-02-15","950","1995","100","50");
INSERT INTO barang VALUES("1237","Cefixime 100 mg ","Capsul","Generik","33212","2016-03-12","210","441","400","50");
INSERT INTO barang VALUES("6231","Nutriflam","Tablet","Generik","633122","2015-03-05","125","263","300","50");
INSERT INTO barang VALUES("5313","Antalgin 500 mg","Tablet","Generik","3612212","2015-02-18","110","231","200","50");
INSERT INTO barang VALUES("89237","Clyndamicin","Tablet","Generik","3312223","2016-03-16","113","237","150","50");
INSERT INTO barang VALUES("8237","Masker Kertas Tali","Pcs","Alkes","33211","2016-07-17","1513","3177","400","50");
INSERT INTO barang VALUES("920","Kassa 5 cm","Pcs","Alkes","322163","2016-06-11","123","258","30","20");
INSERT INTO barang VALUES("5621","Gotropil inj","Ampul","Generik","633122","2015-04-05","1236","2596","50","50");
INSERT INTO barang VALUES("231","Dmp syr","Fls","Generik","6953122","2015-10-15","1296","2722","150","15");
INSERT INTO barang VALUES("81238","Paracetamol 500 mg","Tablet","Generik","2512112","2015-04-05","120","252","300","100");
INSERT INTO barang VALUES("1238","Paracetamol 60 ml","Fls","Generik","1233122","2015-05-14","142","365","1024","25");



DROP TABLE biaya;

CREATE TABLE `biaya` (
  `id_biaya` int(5) NOT NULL,
  `kd_biaya` int(5) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` enum('Tagihan','Lunas') NOT NULL default 'Tagihan',
  PRIMARY KEY  (`id_biaya`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE bigbook_perusahaan;

CREATE TABLE `bigbook_perusahaan` (
  `nm_perusahaan` varchar(25) collate latin1_general_ci NOT NULL,
  `email` varchar(25) collate latin1_general_ci NOT NULL,
  `alamat` varchar(50) collate latin1_general_ci NOT NULL,
  `telp` int(15) NOT NULL,
  `logo` varchar(100) collate latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO bigbook_perusahaan VALUES("Toko Baru Jaya","jayabaya@gamil.com","jl. merapi no 34 pekalongan","2147483647","85Koala.jpg");



DROP TABLE jns_rek;

CREATE TABLE `jns_rek` (
  `kd_jns` int(5) NOT NULL,
  `nm_jenis` varchar(15) collate latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO jns_rek VALUES("1","Debit");
INSERT INTO jns_rek VALUES("2","Kredit");



DROP TABLE kd_pemb;

CREATE TABLE `kd_pemb` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO kd_pemb VALUES("2013-10-12","2013-10-22","PMB120131012","Tempo","0","198000","45315","FGS2213","2013-10-05","0000-00-00","Bagus Tilas H");
INSERT INTO kd_pemb VALUES("2013-10-12","0000-00-00","PMB2920131012","Tunai","50000","490700","9331","BRN54313","2013-10-06","0000-00-00","Bagus Tilas H");
INSERT INTO kd_pemb VALUES("2013-10-12","0000-00-00","PMB3120131012","Tunai","15000","950000","6984","ALM52133","2013-10-07","0000-00-00","Bagus Tilas H");
INSERT INTO kd_pemb VALUES("2013-10-12","0000-00-00","PMB3520131012","Tunai","0","420500","9331","BRN9631","2013-10-12","0000-00-00","Bagus Tilas H");
INSERT INTO kd_pemb VALUES("2013-10-12","0000-00-00","PMB4020131012","Tunai","0","303825","93182","MST6321","2013-10-04","0000-00-00","Bagus Tilas H");
INSERT INTO kd_pemb VALUES("2013-10-12","0000-00-00","PMB4420131012","Tunai","0","762650","5325","BIN63213","2013-10-08","0000-00-00","Bagus Tilas H");
INSERT INTO kd_pemb VALUES("2013-10-12","2013-10-22","PMB4620131012","Tempo","0","193150","9331","BRN1292","2013-10-03","0000-00-00","Bagus Tilas H");
INSERT INTO kd_pemb VALUES("2013-11-09","2013-11-19","PMB4820131109","Tempo","0","265500","45315","SO233JS","2013-11-06","0000-00-00","Bagus Tilas H");



DROP TABLE kd_penj;

CREATE TABLE `kd_penj` (
  `tanggal` date NOT NULL,
  `kd_pjl` varchar(15) NOT NULL,
  `total` int(11) NOT NULL,
  `user` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO kd_penj VALUES("2013-10-12","PJL120131012","241725","Bagus Tilas H");
INSERT INTO kd_penj VALUES("2013-10-12","PJL8720131012","106060","Bagus Tilas H");
INSERT INTO kd_penj VALUES("2013-10-12","PJL8920131012","325250","Bagus Tilas H");
INSERT INTO kd_penj VALUES("2013-10-12","PJL9120131012","320280","Bagus Tilas H");
INSERT INTO kd_penj VALUES("2013-10-12","PJL9320131012","133350","Bagus Tilas H");
INSERT INTO kd_penj VALUES("2013-10-12","PJL9520131012","310800","Bagus Tilas H");
INSERT INTO kd_penj VALUES("2013-10-12","PJL9720131012","102450","Bagus Tilas H");
INSERT INTO kd_penj VALUES("2013-10-12","PJL9920131012","194350","Bagus Tilas H");
INSERT INTO kd_penj VALUES("2013-10-12","PJL10120131012","368100","Bagus Tilas H");
INSERT INTO kd_penj VALUES("2013-10-12","PJL10420131012","118200","Bagus Tilas H");
INSERT INTO kd_penj VALUES("2013-10-12","PJL10620131012","158790","Bagus Tilas H");
INSERT INTO kd_penj VALUES("2013-10-12","PJL10920131012","698250","Bagus Tilas H");
INSERT INTO kd_penj VALUES("2013-10-12","PJL11120131012","106664","Bagus Tilas H");
INSERT INTO kd_penj VALUES("2013-10-12","PJL11420131012","3150","Bagus Tilas H");
INSERT INTO kd_penj VALUES("2013-10-12","PJL11520131012","136100","Bagus Tilas H");
INSERT INTO kd_penj VALUES("2013-10-12","PJL11620131012","129800","Bagus Tilas H");
INSERT INTO kd_penj VALUES("2013-10-12","PJL11720131012","125750","Bagus Tilas H");
INSERT INTO kd_penj VALUES("2013-10-12","PJL11920131012","53050","Bagus Tilas H");
INSERT INTO kd_penj VALUES("2013-11-02","PJL12120131102","9450","Bagus Tilas H");
INSERT INTO kd_penj VALUES("2013-11-05","PJL12220131105","1290","Bagus Tilas H");
INSERT INTO kd_penj VALUES("2013-11-09","PJL12320131109","31640","Bagus Tilas H");
INSERT INTO kd_penj VALUES("2013-11-09","PJL12620131109","57750","Bagus Tilas H");
INSERT INTO kd_penj VALUES("2013-11-09","PJL12820131109","4160","Bagus Tilas H");



DROP TABLE kd_retur;

CREATE TABLE `kd_retur` (
  `tanggal` date NOT NULL,
  `id_pemb` varchar(15) NOT NULL,
  `kd_ret` varchar(15) NOT NULL,
  `total` int(11) NOT NULL,
  `user` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE keranjang;

CREATE TABLE `keranjang` (
  `id_keranjang` int(5) NOT NULL auto_increment,
  `id_product` int(5) NOT NULL,
  `id_session` varchar(50) collate latin1_general_ci NOT NULL,
  `tgl_keranjang` date NOT NULL,
  `qty` int(4) NOT NULL,
  `harga` int(12) NOT NULL,
  `transaksi` varchar(10) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id_keranjang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;




DROP TABLE kode_perilaku;

CREATE TABLE `kode_perilaku` (
  `nomor` int(5) NOT NULL auto_increment,
  `userid` varchar(30) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `photo` varchar(50) NOT NULL,
  PRIMARY KEY  (`nomor`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO kode_perilaku VALUES("1","Pembelian","pembelian","photo/2.PNG");
INSERT INTO kode_perilaku VALUES("2","Retur","retur","photo/3.PNG");
INSERT INTO kode_perilaku VALUES("3","Hapus","hapus","photo/4.PNG");
INSERT INTO kode_perilaku VALUES("4","Edit","edit","photo/5.PNG");
INSERT INTO kode_perilaku VALUES("5","Penjualan","penjualan","photo/6.png");
INSERT INTO kode_perilaku VALUES("7","Hutang","Hutang","photo/7.PNG");



DROP TABLE master_laporan;

CREATE TABLE `master_laporan` (
  `tahun` int(4) NOT NULL,
  `bulan` int(2) NOT NULL,
  `penjualan` int(11) NOT NULL,
  `pembelian` int(11) NOT NULL,
  `hpp` int(11) NOT NULL,
  `biaya` int(11) NOT NULL,
  `laba` int(11) NOT NULL,
  `hutang` int(10) NOT NULL,
  `persediaan_akhir` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO master_laporan VALUES("2013","9","0","0","0","0","0","0","0");
INSERT INTO master_laporan VALUES("2013","10","3632119","2927675","1273276","0","2122959","391150","1589399");



DROP TABLE master_transaksi;

CREATE TABLE `master_transaksi` (
  `id_transaksi` int(15) NOT NULL auto_increment,
  `kode_transaksi` varchar(15) NOT NULL,
  `kode_rekening` varchar(10) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `keterangan_transaksi` text NOT NULL,
  `debet` int(15) NOT NULL,
  `kredit` int(15) NOT NULL,
  PRIMARY KEY  (`id_transaksi`)
) ENGINE=MyISAM AUTO_INCREMENT=167 DEFAULT CHARSET=latin1;

INSERT INTO master_transaksi VALUES("105","PMB120131012","211","2013-10-12","Hutang Dagang","0","198000");
INSERT INTO master_transaksi VALUES("106","PMB120131012","111","2013-10-12","Pembelain","198000","0");
INSERT INTO master_transaksi VALUES("107","PMB2920131012","111","2013-10-12","Kas","0","490700");
INSERT INTO master_transaksi VALUES("108","PMB2920131012","411","2013-10-12","Pembelian Barang","490700","0");
INSERT INTO master_transaksi VALUES("109","PMB3120131012","111","2013-10-12","Kas","0","950000");
INSERT INTO master_transaksi VALUES("110","PMB3120131012","411","2013-10-12","Pembelian Barang","950000","0");
INSERT INTO master_transaksi VALUES("111","PMB3520131012","111","2013-10-12","Kas","0","420500");
INSERT INTO master_transaksi VALUES("112","PMB3520131012","411","2013-10-12","Pembelian Barang","420500","0");
INSERT INTO master_transaksi VALUES("113","PMB4020131012","111","2013-10-12","Kas","0","303825");
INSERT INTO master_transaksi VALUES("114","PMB4020131012","411","2013-10-12","Pembelian Barang","303825","0");
INSERT INTO master_transaksi VALUES("115","PMB4420131012","111","2013-10-12","Kas","0","762650");
INSERT INTO master_transaksi VALUES("116","PMB4420131012","411","2013-10-12","Pembelian Barang","762650","0");
INSERT INTO master_transaksi VALUES("117","PMB4620131012","211","2013-10-12","Hutang Dagang","0","193150");
INSERT INTO master_transaksi VALUES("118","PMB4620131012","111","2013-10-12","Pembelain","193150","0");
INSERT INTO master_transaksi VALUES("119","PJL120131012","111","2013-10-12","Kas","241725","0");
INSERT INTO master_transaksi VALUES("120","PJL120131012","411","2013-10-12","Penjualan Barang","0","241725");
INSERT INTO master_transaksi VALUES("121","PJL8720131012","111","2013-10-12","Kas","106060","0");
INSERT INTO master_transaksi VALUES("122","PJL8720131012","411","2013-10-12","Penjualan Barang","0","106060");
INSERT INTO master_transaksi VALUES("123","PJL8920131012","111","2013-10-12","Kas","325250","0");
INSERT INTO master_transaksi VALUES("124","PJL8920131012","411","2013-10-12","Penjualan Barang","0","325250");
INSERT INTO master_transaksi VALUES("125","PJL9120131012","111","2013-10-12","Kas","320280","0");
INSERT INTO master_transaksi VALUES("126","PJL9120131012","411","2013-10-12","Penjualan Barang","0","320280");
INSERT INTO master_transaksi VALUES("127","PJL9320131012","111","2013-10-12","Kas","133350","0");
INSERT INTO master_transaksi VALUES("128","PJL9320131012","411","2013-10-12","Penjualan Barang","0","133350");
INSERT INTO master_transaksi VALUES("129","PJL9520131012","111","2013-10-12","Kas","310800","0");
INSERT INTO master_transaksi VALUES("130","PJL9520131012","411","2013-10-12","Penjualan Barang","0","310800");
INSERT INTO master_transaksi VALUES("131","PJL9720131012","111","2013-10-12","Kas","102450","0");
INSERT INTO master_transaksi VALUES("132","PJL9720131012","411","2013-10-12","Penjualan Barang","0","102450");
INSERT INTO master_transaksi VALUES("133","PJL9920131012","111","2013-10-12","Kas","194350","0");
INSERT INTO master_transaksi VALUES("134","PJL9920131012","411","2013-10-12","Penjualan Barang","0","194350");
INSERT INTO master_transaksi VALUES("135","PJL10120131012","111","2013-10-12","Kas","368100","0");
INSERT INTO master_transaksi VALUES("136","PJL10120131012","411","2013-10-12","Penjualan Barang","0","368100");
INSERT INTO master_transaksi VALUES("137","PJL10420131012","111","2013-10-12","Kas","118200","0");
INSERT INTO master_transaksi VALUES("138","PJL10420131012","411","2013-10-12","Penjualan Barang","0","118200");
INSERT INTO master_transaksi VALUES("139","PJL10620131012","111","2013-10-12","Kas","158790","0");
INSERT INTO master_transaksi VALUES("140","PJL10620131012","411","2013-10-12","Penjualan Barang","0","158790");
INSERT INTO master_transaksi VALUES("141","PJL10920131012","111","2013-10-12","Kas","698250","0");
INSERT INTO master_transaksi VALUES("142","PJL10920131012","411","2013-10-12","Penjualan Barang","0","698250");
INSERT INTO master_transaksi VALUES("143","PJL11120131012","111","2013-10-12","Kas","106664","0");
INSERT INTO master_transaksi VALUES("144","PJL11120131012","411","2013-10-12","Penjualan Barang","0","106664");
INSERT INTO master_transaksi VALUES("145","PJL11420131012","111","2013-10-12","Kas","3150","0");
INSERT INTO master_transaksi VALUES("146","PJL11420131012","411","2013-10-12","Penjualan Barang","0","3150");
INSERT INTO master_transaksi VALUES("147","PJL11520131012","111","2013-10-12","Kas","136100","0");
INSERT INTO master_transaksi VALUES("148","PJL11520131012","411","2013-10-12","Penjualan Barang","0","136100");
INSERT INTO master_transaksi VALUES("149","PJL11620131012","111","2013-10-12","Kas","129800","0");
INSERT INTO master_transaksi VALUES("150","PJL11620131012","411","2013-10-12","Penjualan Barang","0","129800");
INSERT INTO master_transaksi VALUES("151","PJL11720131012","111","2013-10-12","Kas","125750","0");
INSERT INTO master_transaksi VALUES("152","PJL11720131012","411","2013-10-12","Penjualan Barang","0","125750");
INSERT INTO master_transaksi VALUES("153","PJL11920131012","111","2013-10-12","Kas","53050","0");
INSERT INTO master_transaksi VALUES("154","PJL11920131012","411","2013-10-12","Penjualan Barang","0","53050");
INSERT INTO master_transaksi VALUES("155","PJL12120131102","111","2013-11-02","Kas","9450","0");
INSERT INTO master_transaksi VALUES("156","PJL12120131102","411","2013-11-02","Penjualan Barang","0","9450");
INSERT INTO master_transaksi VALUES("157","PJL12220131105","111","2013-11-05","Kas","1290","0");
INSERT INTO master_transaksi VALUES("158","PJL12220131105","411","2013-11-05","Penjualan Barang","0","1290");
INSERT INTO master_transaksi VALUES("159","PJL12320131109","111","2013-11-09","Kas","31640","0");
INSERT INTO master_transaksi VALUES("160","PJL12320131109","411","2013-11-09","Penjualan Barang","0","31640");
INSERT INTO master_transaksi VALUES("161","PJL12620131109","111","2013-11-09","Kas","57750","0");
INSERT INTO master_transaksi VALUES("162","PJL12620131109","411","2013-11-09","Penjualan Barang","0","57750");
INSERT INTO master_transaksi VALUES("163","PJL12820131109","111","2013-11-09","Kas","4160","0");
INSERT INTO master_transaksi VALUES("164","PJL12820131109","411","2013-11-09","Penjualan Barang","0","4160");
INSERT INTO master_transaksi VALUES("165","PMB4820131109","211","2013-11-09","Hutang Dagang","0","265500");
INSERT INTO master_transaksi VALUES("166","PMB4820131109","111","2013-11-09","Pembelain","265500","0");



DROP TABLE modul;

CREATE TABLE `modul` (
  `id_modul` int(5) NOT NULL auto_increment,
  `nama_modul` varchar(50) collate latin1_general_ci NOT NULL,
  `link` varchar(100) collate latin1_general_ci NOT NULL,
  `publish` enum('Y','N') collate latin1_general_ci NOT NULL default 'Y',
  `status` enum('user','admin') collate latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') collate latin1_general_ci NOT NULL default 'Y',
  `urutan` int(5) NOT NULL,
  `tgl` varchar(20) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id_modul`)
) ENGINE=MyISAM AUTO_INCREMENT=99 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO modul VALUES("1","Transaksi","transaksi","Y","user","Y","1","29-10-2013 18:47:15");
INSERT INTO modul VALUES("2","Jurnal","jurnal","Y","user","Y","2","29-10-2013 18:47:15");
INSERT INTO modul VALUES("4","Grafik","grafik","Y","user","Y","3","29-10-2013 18:47:15");
INSERT INTO modul VALUES("91","bantuan","bantuan","N","admin","N","11","29-10-2013 18:47:15");
INSERT INTO modul VALUES("5","Laporan ","laporan","N","admin","N","13","29-10-2013 18:47:15");
INSERT INTO modul VALUES("6","Users","user","N","admin","N","8","29-10-2013 18:47:15");
INSERT INTO modul VALUES("7","Modul","modul","N","admin","N","9","29-10-2013 18:47:15");
INSERT INTO modul VALUES("3","Barang","barang","Y","user","Y","4","29-10-2013 18:47:15");
INSERT INTO modul VALUES("11","Supplier","supplier","Y","user","Y","6","29-10-2013 18:47:15");
INSERT INTO modul VALUES("12","Perkiraan","setup","N","admin","N","5","29-10-2013 18:47:15");
INSERT INTO modul VALUES("95","Pemulihan","pemulihan","N","admin","N","10","29-10-2013 18:47:15");
INSERT INTO modul VALUES("96","Tentang","about","N","user","N","12","29-10-2013 18:47:15");
INSERT INTO modul VALUES("98","Neraca","neraca","N","admin","N","14","29-10-2013 18:47:15");



DROP TABLE pembelian;

CREATE TABLE `pembelian` (
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
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

INSERT INTO pembelian VALUES("28","352","PMB120131012","51212223","2015-06-06","1000","98","98000","2013-10-12");
INSERT INTO pembelian VALUES("29","5321","PMB120131012","69946332","2015-03-16","1000","100","100000","2013-10-12");
INSERT INTO pembelian VALUES("30","5313","PMB2920131012","3612212","2015-02-18","500","110","55000","2013-10-12");
INSERT INTO pembelian VALUES("31","81238","PMB2920131012","2512112","2015-04-05","1000","120","120000","2013-10-12");
INSERT INTO pembelian VALUES("32","89237","PMB2920131012","3312223","2016-03-16","500","113","56500","2013-10-12");
INSERT INTO pembelian VALUES("33","231","PMB2920131012","6953122","2015-10-15","200","1296","259200","2013-10-12");
INSERT INTO pembelian VALUES("34","362","PMB3120131012","6632112","2015-02-15","500","950","475000","2013-10-12");
INSERT INTO pembelian VALUES("35","531","PMB3120131012","9631221","2015-05-04","500","950","475000","2013-10-12");
INSERT INTO pembelian VALUES("36","8541","PMB3520131012","661332","2015-07-16","500","450","225000","2013-10-12");
INSERT INTO pembelian VALUES("37","1237","PMB3520131012","33212","2016-03-12","400","210","84000","2013-10-12");
INSERT INTO pembelian VALUES("38","5323","PMB3520131012","62312","2016-03-16","200","145","29000","2013-10-12");
INSERT INTO pembelian VALUES("39","8542","PMB3520131012","63121","2015-08-11","500","165","82500","2013-10-12");
INSERT INTO pembelian VALUES("40","1238","PMB4020131012","695212","2015-08-16","25","1500","37500","2013-10-12");
INSERT INTO pembelian VALUES("41","52312","PMB4020131012","36622","2015-03-18","25","4221","105525","2013-10-12");
INSERT INTO pembelian VALUES("42","5621","PMB4020131012","633122","2015-04-05","100","1236","123600","2013-10-12");
INSERT INTO pembelian VALUES("43","372","PMB4020131012","33995","2016-01-07","300","124","37200","2013-10-12");
INSERT INTO pembelian VALUES("44","8237","PMB4420131012","33211","2016-07-17","500","1513","756500","2013-10-12");
INSERT INTO pembelian VALUES("45","920","PMB4420131012","322163","2016-06-11","50","123","6150","2013-10-12");
INSERT INTO pembelian VALUES("46","5215","PMB4620131012","965221","2015-07-16","50","2613","130650","2013-10-12");
INSERT INTO pembelian VALUES("47","6231","PMB4620131012","633122","2015-03-05","500","125","62500","2013-10-12");
INSERT INTO pembelian VALUES("48","5215","PMB4820131109","2331332","2015-06-18","100","1235","123500","2013-11-09");
INSERT INTO pembelian VALUES("49","1238","PMB4820131109","1233122","2015-05-14","1000","142","142000","2013-11-09");



DROP TABLE penjualan;

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL auto_increment,
  `id_product` int(11) NOT NULL,
  `id_transaksi` varchar(100) NOT NULL,
  `jumlah` int(12) NOT NULL,
  `harga` int(12) NOT NULL,
  `subtotal` int(12) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=130 DEFAULT CHARSET=latin1;

INSERT INTO penjualan VALUES("84","8542","PJL120131012","150","347","52050","2013-10-12");
INSERT INTO penjualan VALUES("85","5321","PJL120131012","250","210","52500","2013-10-12");
INSERT INTO penjualan VALUES("86","5215","PJL120131012","25","5487","137175","2013-10-12");
INSERT INTO penjualan VALUES("87","352","PJL8720131012","260","206","53560","2013-10-12");
INSERT INTO penjualan VALUES("88","5321","PJL8720131012","250","210","52500","2013-10-12");
INSERT INTO penjualan VALUES("89","372","PJL8920131012","100","260","26000","2013-10-12");
INSERT INTO penjualan VALUES("90","531","PJL8920131012","150","1995","299250","2013-10-12");
INSERT INTO penjualan VALUES("91","920","PJL9120131012","10","258","2580","2013-10-12");
INSERT INTO penjualan VALUES("92","8237","PJL9120131012","100","3177","317700","2013-10-12");
INSERT INTO penjualan VALUES("93","81238","PJL9320131012","300","252","75600","2013-10-12");
INSERT INTO penjualan VALUES("94","5313","PJL9320131012","250","231","57750","2013-10-12");
INSERT INTO penjualan VALUES("95","5313","PJL9520131012","50","231","11550","2013-10-12");
INSERT INTO penjualan VALUES("96","362","PJL9520131012","150","1995","299250","2013-10-12");
INSERT INTO penjualan VALUES("97","81238","PJL9720131012","200","252","50400","2013-10-12");
INSERT INTO penjualan VALUES("98","8542","PJL9720131012","150","347","52050","2013-10-12");
INSERT INTO penjualan VALUES("99","6231","PJL9920131012","200","263","52600","2013-10-12");
INSERT INTO penjualan VALUES("100","8541","PJL9920131012","150","945","141750","2013-10-12");
INSERT INTO penjualan VALUES("101","352","PJL10120131012","250","206","51500","2013-10-12");
INSERT INTO penjualan VALUES("102","531","PJL10120131012","150","1995","299250","2013-10-12");
INSERT INTO penjualan VALUES("103","8542","PJL10120131012","50","347","17350","2013-10-12");
INSERT INTO penjualan VALUES("104","89237","PJL10420131012","100","237","23700","2013-10-12");
INSERT INTO penjualan VALUES("105","8541","PJL10420131012","100","945","94500","2013-10-12");
INSERT INTO penjualan VALUES("106","8541","PJL10620131012","100","945","94500","2013-10-12");
INSERT INTO penjualan VALUES("107","5323","PJL10620131012","150","305","45750","2013-10-12");
INSERT INTO penjualan VALUES("108","352","PJL10620131012","90","206","18540","2013-10-12");
INSERT INTO penjualan VALUES("109","362","PJL10920131012","250","1995","498750","2013-10-12");
INSERT INTO penjualan VALUES("110","531","PJL10920131012","100","1995","199500","2013-10-12");
INSERT INTO penjualan VALUES("111","81238","PJL11120131012","200","252","50400","2013-10-12");
INSERT INTO penjualan VALUES("112","89237","PJL11120131012","200","237","47400","2013-10-12");
INSERT INTO penjualan VALUES("113","52312","PJL11120131012","1","8864","8864","2013-10-12");
INSERT INTO penjualan VALUES("114","1238","PJL11420131012","1","3150","3150","2013-10-12");
INSERT INTO penjualan VALUES("115","231","PJL11520131012","50","2722","136100","2013-10-12");
INSERT INTO penjualan VALUES("116","5621","PJL11620131012","50","2596","129800","2013-10-12");
INSERT INTO penjualan VALUES("117","531","PJL11720131012","50","1995","99750","2013-10-12");
INSERT INTO penjualan VALUES("118","372","PJL11720131012","100","260","26000","2013-10-12");
INSERT INTO penjualan VALUES("119","89237","PJL11920131012","50","237","11850","2013-10-12");
INSERT INTO penjualan VALUES("120","352","PJL11920131012","200","206","41200","2013-10-12");
INSERT INTO penjualan VALUES("121","8541","PJL12120131102","10","945","9450","2013-11-02");
INSERT INTO penjualan VALUES("122","920","PJL12220131105","5","258","1290","2013-11-05");
INSERT INTO penjualan VALUES("123","8542","PJL12320131109","50","347","17350","2013-11-09");
INSERT INTO penjualan VALUES("124","372","PJL12320131109","50","260","13000","2013-11-09");
INSERT INTO penjualan VALUES("125","920","PJL12320131109","5","258","1290","2013-11-09");
INSERT INTO penjualan VALUES("126","531","PJL12620131109","10","1995","19950","2013-11-09");
INSERT INTO penjualan VALUES("127","8541","PJL12620131109","40","945","37800","2013-11-09");
INSERT INTO penjualan VALUES("128","5321","PJL12820131109","10","210","2100","2013-11-09");
INSERT INTO penjualan VALUES("129","352","PJL12820131109","10","206","2060","2013-11-09");



DROP TABLE penutup;

CREATE TABLE `penutup` (
  `tanggal` varchar(2) NOT NULL,
  `Bulan` varchar(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO penutup VALUES("1","12");
INSERT INTO penutup VALUES("1","12");



DROP TABLE rekening;

CREATE TABLE `rekening` (
  `kd_rek` int(5) NOT NULL,
  `nama_rekening` varchar(30) collate latin1_general_ci NOT NULL,
  `jenis` int(11) NOT NULL,
  `jumlah` int(12) NOT NULL,
  PRIMARY KEY  (`kd_rek`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO rekening VALUES("111","kas Apotek AZka","1","10004290");
INSERT INTO rekening VALUES("211","Hutang Dagang","2","265500");
INSERT INTO rekening VALUES("611","Biaya Listrik","2","0");
INSERT INTO rekening VALUES("622","Biaya Gaji","2","0");
INSERT INTO rekening VALUES("911","Beban Sewa","2","0");
INSERT INTO rekening VALUES("612","Biaya air","2","0");
INSERT INTO rekening VALUES("311","Modal Tn Wasisi","2","0");
INSERT INTO rekening VALUES("411","Pendapatan ","2","104290");
INSERT INTO rekening VALUES("112","Pembelian","1","0");
INSERT INTO rekening VALUES("113","Persediaan Barang Dagang","1","1589399");
INSERT INTO rekening VALUES("312","Prive Tn. Wasis","1","0");
INSERT INTO rekening VALUES("511","Retur Pembelian","1","0");
INSERT INTO rekening VALUES("114","Peralatan Toko","1","0");
INSERT INTO rekening VALUES("512","Retur Penjualan","1","0");
INSERT INTO rekening VALUES("422","Potongan Penjualan","2","0");
INSERT INTO rekening VALUES("115","Penyusutan Peralatan Kantor","1","0");
INSERT INTO rekening VALUES("116","Penyusutan Gedung","1","0");
INSERT INTO rekening VALUES("117","Pajak Penghasilan","1","0");
INSERT INTO rekening VALUES("423","Potongan Pembelian","1","0");



DROP TABLE retur;

CREATE TABLE `retur` (
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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;




DROP TABLE supplier;

CREATE TABLE `supplier` (
  `id_supplier` varchar(5) collate latin1_general_ci NOT NULL,
  `nm_supplier` varchar(25) collate latin1_general_ci NOT NULL,
  `kota` varchar(15) collate latin1_general_ci NOT NULL,
  `alamat` varchar(50) collate latin1_general_ci NOT NULL,
  `no_hp` varchar(15) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id_supplier`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO supplier VALUES("5325","BINSARAYA","PEKALONGAN","PEKALONGAN","02858556422");
INSERT INTO supplier VALUES("6984","Almedika","Pekalongan","jl.patriot no 35","028596314755");
INSERT INTO supplier VALUES("45315","SOHO","SEMARANG","SEMARANG","028494335763");
INSERT INTO supplier VALUES("93182","MST","SEMARANG","SEMARANG","02849343343");
INSERT INTO supplier VALUES("9331","BERNO","SEMARANG","SEMARANG","02849336411");



DROP TABLE tabel_berita;

CREATE TABLE `tabel_berita` (
  `nomor` int(5) NOT NULL auto_increment,
  `user_nomor` int(5) NOT NULL,
  `waktu` datetime NOT NULL,
  `berita` int(11) NOT NULL,
  `id_transaksi` varchar(30) NOT NULL,
  PRIMARY KEY  (`nomor`)
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

INSERT INTO tabel_berita VALUES("58","7","2013-10-12 10:00:52","198000","PMB120131012");
INSERT INTO tabel_berita VALUES("59","1","2013-10-12 10:03:08","490700","PMB2920131012");
INSERT INTO tabel_berita VALUES("60","1","2013-10-12 10:07:27","950000","PMB3120131012");
INSERT INTO tabel_berita VALUES("61","1","2013-10-12 10:10:55","420500","PMB3520131012");
INSERT INTO tabel_berita VALUES("62","1","2013-10-12 10:12:58","303825","PMB4020131012");
INSERT INTO tabel_berita VALUES("63","1","2013-10-12 10:14:22","762650","PMB4420131012");
INSERT INTO tabel_berita VALUES("64","7","2013-10-12 10:15:34","193150","PMB4620131012");
INSERT INTO tabel_berita VALUES("65","5","2013-10-12 10:16:45","241725","PJL120131012");
INSERT INTO tabel_berita VALUES("66","5","2013-10-12 10:17:55","106060","PJL8720131012");
INSERT INTO tabel_berita VALUES("67","5","2013-10-12 10:18:36","325250","PJL8920131012");
INSERT INTO tabel_berita VALUES("68","5","2013-10-12 10:18:59","320280","PJL9120131012");
INSERT INTO tabel_berita VALUES("69","5","2013-10-12 10:19:15","133350","PJL9320131012");
INSERT INTO tabel_berita VALUES("70","5","2013-10-12 10:19:40","310800","PJL9520131012");
INSERT INTO tabel_berita VALUES("71","5","2013-10-12 10:21:37","102450","PJL9720131012");
INSERT INTO tabel_berita VALUES("72","5","2013-10-12 10:21:55","194350","PJL9920131012");
INSERT INTO tabel_berita VALUES("73","5","2013-10-12 10:22:19","368100","PJL10120131012");
INSERT INTO tabel_berita VALUES("74","5","2013-10-12 10:37:45","118200","PJL10420131012");
INSERT INTO tabel_berita VALUES("75","5","2013-10-12 10:38:15","158790","PJL10620131012");
INSERT INTO tabel_berita VALUES("76","5","2013-10-12 10:39:59","698250","PJL10920131012");
INSERT INTO tabel_berita VALUES("77","5","2013-10-12 10:41:09","106664","PJL11120131012");
INSERT INTO tabel_berita VALUES("78","5","2013-10-12 10:41:17","3150","PJL11420131012");
INSERT INTO tabel_berita VALUES("79","5","2013-10-12 10:41:27","136100","PJL11520131012");
INSERT INTO tabel_berita VALUES("80","5","2013-10-12 10:42:05","129800","PJL11620131012");
INSERT INTO tabel_berita VALUES("81","5","2013-10-12 10:42:39","125750","PJL11720131012");
INSERT INTO tabel_berita VALUES("82","5","2013-10-12 10:43:18","53050","PJL11920131012");
INSERT INTO tabel_berita VALUES("83","5","2013-11-02 07:05:04","9450","PJL12120131102");
INSERT INTO tabel_berita VALUES("84","5","2013-11-05 18:50:45","1290","PJL12220131105");
INSERT INTO tabel_berita VALUES("85","5","2013-11-09 20:06:38","31640","PJL12320131109");
INSERT INTO tabel_berita VALUES("86","5","2013-11-09 20:07:18","57750","PJL12620131109");
INSERT INTO tabel_berita VALUES("87","5","2013-11-09 20:10:15","4160","PJL12820131109");
INSERT INTO tabel_berita VALUES("88","7","2013-11-09 20:12:05","265500","PMB4820131109");



DROP TABLE users;

CREATE TABLE `users` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO users VALUES("root","63a9f0ea7bb98050796b649e85481845","Bagus Tilas H","","bagustilas@ymail.com","087711972921","admin","N","16-11-2013","12:24:43","loggin","online","24e83f29d795ab7306b69cd3fbf5ec35");
INSERT INTO users VALUES("demo","fe01ce2a7fbac8fafaed7c982a04e229","demo","","demo@demo.com","0888888888","user","N","15-11-2013","17:34:10","17:35:00","offline","bdd991abebe162c16b8262c54f8075dd");



