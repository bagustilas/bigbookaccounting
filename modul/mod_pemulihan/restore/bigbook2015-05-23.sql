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
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO barang VALUES("5215","Ondancentron 4 mg","Ampul","Generik","33215","2018-05-18","2500","5250","360","50");
INSERT INTO barang VALUES("8541","Furosemide 40 mg","Tablet","Generik","85785345","2015-05-11","168","353","450","50");
INSERT INTO barang VALUES("352","Vit A 6000","Tablet","Generik","51212223","2015-06-06","98","206","10","100");
INSERT INTO barang VALUES("5321","Vit C ","Tablet","Generik","69946332","2015-03-16","100","210","190","100");
INSERT INTO barang VALUES("372","Zinc Kids","Tablet","Generik","33995","2016-01-07","124","260","10","50");
INSERT INTO barang VALUES("52312","Lantus 60ml syr","Fls","Generik","23231","2018-05-03","5200","10333","14","25");
INSERT INTO barang VALUES("8542","Betahistin","Tablet","Generik","21314312","2015-12-15","142","298","890","50");
INSERT INTO barang VALUES("5323","Bisoprolol","Tablet","Generik","134323","2013-11-23","163","332","140","50");
INSERT INTO barang VALUES("531","Alprazolam 0,5 mg","Tablet","Narkotik","131312","2013-11-23","1253","2601","85","50");
INSERT INTO barang VALUES("362","Alprazolam 1 mg","Tablet","Narkotik","131231","2013-11-23","1653","3337","110","50");
INSERT INTO barang VALUES("1237","Cefixime 100 mg ","Capsul","Generik","2453435","2015-08-30","198","416","1000","50");
INSERT INTO barang VALUES("6231","Nutriflam","Tablet","Generik","633122","2015-03-05","125","263","300","50");
INSERT INTO barang VALUES("5313","Antalgin 500 mg","Tablet","Generik","2112121","2015-09-12","152","319","1000","50");
INSERT INTO barang VALUES("89237","Clyndamicin","Tablet","Generik","3312223","2016-03-16","113","237","100","50");
INSERT INTO barang VALUES("8237","Masker Kertas Tali","Pcs","Alkes","33211","2016-07-17","1513","3177","0","50");
INSERT INTO barang VALUES("920","Kassa 5 cm","Pcs","Alkes","322163","2016-06-11","123","258","5","20");
INSERT INTO barang VALUES("5621","Gotropil inj","Ampul","Generik","312312","2013-11-23","8521","17808","100","50");
INSERT INTO barang VALUES("231","Dmp syr","Fls","Generik","6953122","2015-10-15","1296","2722","150","15");
INSERT INTO barang VALUES("81238","Paracetamol 500 mg","Tablet","Generik","2512112","2015-04-05","120","252","0","100");
INSERT INTO barang VALUES("1238","Paracetamol 60 ml","Fls","Generik","1233122","2015-05-14","142","365","1024","25");
INSERT INTO barang VALUES("undefined","undefined","undefi","undefined","0","0000-00-00","0","0","0","0");



DROP TABLE biaya;

CREATE TABLE `biaya` (
  `id_biaya` int(5) NOT NULL,
  `kd_biaya` int(5) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` enum('Tagihan','Lunas') NOT NULL DEFAULT 'Tagihan',
  PRIMARY KEY (`id_biaya`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE bigbook_perusahaan;

CREATE TABLE `bigbook_perusahaan` (
  `nm_perusahaan` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `alamat` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `telp` int(15) NOT NULL,
  `logo` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO bigbook_perusahaan VALUES("Toko Baru Jaya","jayabaya@gamil.com","jl. merapi no 34 pekalongan","2147483647","85Koala.jpg");



DROP TABLE dokter;

CREATE TABLE `dokter` (
  `id_dokter` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `nm_dokter` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `kota` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `alamat` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `no_hp` varchar(15) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_dokter`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO dokter VALUES("3325","dr. Kukuh","Palembang","Palembang","02856352312");



DROP TABLE jns_rek;

CREATE TABLE `jns_rek` (
  `kd_jns` int(5) NOT NULL,
  `nm_jenis` varchar(15) COLLATE latin1_general_ci NOT NULL
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

INSERT INTO kd_pemb VALUES("2015-05-14","0000-00-00","PMB6820150514","Tunai","0","300000","9331","BRN23232","2015-05-14","0000-00-00","Bagus Tilas H");
INSERT INTO kd_pemb VALUES("2015-05-14","0000-00-00","PMB6920150514","Tunai","0","52000","45315","SHO3232","2015-05-14","0000-00-00","Bagus Tilas H");



DROP TABLE kd_penj;

CREATE TABLE `kd_penj` (
  `tanggal` date NOT NULL,
  `dokter` int(15) NOT NULL,
  `kd_pjl` varchar(15) NOT NULL,
  `total` int(11) NOT NULL,
  `user` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




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
  `id_keranjang` int(5) NOT NULL AUTO_INCREMENT,
  `id_product` int(5) NOT NULL,
  `id_session` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `tgl_keranjang` date NOT NULL,
  `qty` int(4) NOT NULL,
  `harga` int(12) NOT NULL,
  `transaksi` varchar(10) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_keranjang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;




DROP TABLE kode_perilaku;

CREATE TABLE `kode_perilaku` (
  `nomor` int(5) NOT NULL AUTO_INCREMENT,
  `userid` varchar(30) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `photo` varchar(50) NOT NULL,
  PRIMARY KEY (`nomor`)
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

INSERT INTO master_laporan VALUES("2015","1","0","0","0","0","0","0","0");



DROP TABLE master_transaksi;

CREATE TABLE `master_transaksi` (
  `id_transaksi` int(15) NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(15) NOT NULL,
  `kode_rekening` varchar(10) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `keterangan_transaksi` text NOT NULL,
  `debet` int(15) NOT NULL,
  `kredit` int(15) NOT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO master_transaksi VALUES("1","PMB6820150514","211","2015-05-14","Hutang Dagang","0","300000");
INSERT INTO master_transaksi VALUES("2","PMB6820150514","111","2015-05-14","Pembelain","300000","0");
INSERT INTO master_transaksi VALUES("3","PMB6920150514","111","2015-05-14","Kas","0","52000");
INSERT INTO master_transaksi VALUES("4","PMB6920150514","411","2015-05-14","Pembelian Barang","52000","0");



DROP TABLE modul;

CREATE TABLE `modul` (
  `id_modul` int(5) NOT NULL AUTO_INCREMENT,
  `nama_modul` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `link` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `publish` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `status` enum('user','admin') COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `urutan` int(5) NOT NULL,
  `tgl` varchar(20) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_modul`)
) ENGINE=MyISAM AUTO_INCREMENT=117 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO modul VALUES("1","Transaksi","transaksi","Y","user","Y","1","29-10-2013 18:47:15");
INSERT INTO modul VALUES("2","Jurnal","jurnal","Y","user","Y","2","29-10-2013 18:47:15");
INSERT INTO modul VALUES("4","Grafik","grafik","Y","user","Y","3","02-12-2013 13:49:06");
INSERT INTO modul VALUES("91","bantuan","bantuan","N","admin","N","11","29-10-2013 18:47:15");
INSERT INTO modul VALUES("5","Laporan ","laporan","N","admin","Y","13","02-12-2013 12:42:07");
INSERT INTO modul VALUES("6","Users","user","N","admin","N","8","29-10-2013 18:47:15");
INSERT INTO modul VALUES("7","Modul","modul","N","admin","N","9","29-10-2013 18:47:15");
INSERT INTO modul VALUES("3","Barang","barang","Y","user","Y","4","25-11-2013 09:26:05");
INSERT INTO modul VALUES("11","Supplier","supplier","Y","user","Y","6","25-11-2013 09:26:33");
INSERT INTO modul VALUES("12","Perkiraan","setup","N","admin","N","5","29-10-2013 18:47:15");
INSERT INTO modul VALUES("95","Pemulihan","pemulihan","N","admin","N","10","29-10-2013 18:47:15");
INSERT INTO modul VALUES("96","Tentang","about","N","admin","N","12","25-11-2013 09:29:26");
INSERT INTO modul VALUES("98","Neraca","neraca","N","admin","N","14","25-11-2013 09:28:16");



DROP TABLE pembelian;

CREATE TABLE `pembelian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `id_transaksi` varchar(100) NOT NULL,
  `nobacth` varchar(11) NOT NULL,
  `ed` date NOT NULL,
  `jumlah` int(12) NOT NULL,
  `harga` int(12) NOT NULL,
  `subtotal` int(12) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;

INSERT INTO pembelian VALUES("69","52312","PMB6920150514","23231","2018-05-03","10","5200","52000","2015-05-14");
INSERT INTO pembelian VALUES("68","5215","PMB6820150514","33215","2018-05-18","120","2500","300000","2015-05-14");



DROP TABLE penjualan;

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `id_transaksi` varchar(100) NOT NULL,
  `jumlah` int(12) NOT NULL,
  `harga` int(12) NOT NULL,
  `subtotal` int(12) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE penutup;

CREATE TABLE `penutup` (
  `tanggal` varchar(2) NOT NULL,
  `tahun` int(4) NOT NULL,
  `bulan` varchar(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO penutup VALUES("1","2015","6");



DROP TABLE rekening;

CREATE TABLE `rekening` (
  `kd_rek` int(5) NOT NULL,
  `nama_rekening` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `jenis` int(11) NOT NULL,
  `jumlah` int(12) NOT NULL,
  PRIMARY KEY (`kd_rek`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO rekening VALUES("111","kas Apotek AZka","1","29691575");
INSERT INTO rekening VALUES("211","Hutang Dagang","2","10188850");
INSERT INTO rekening VALUES("611","Biaya Listrik","2","75000");
INSERT INTO rekening VALUES("622","Biaya Gaji","2","1800000");
INSERT INTO rekening VALUES("911","Beban Sewa","2","0");
INSERT INTO rekening VALUES("612","Biaya air","2","50000");
INSERT INTO rekening VALUES("311","Modal Tn Wasisi","2","0");
INSERT INTO rekening VALUES("411","Pendapatan ","2","21060225");
INSERT INTO rekening VALUES("112","Pembelian","1","1368650");
INSERT INTO rekening VALUES("113","Persediaan Barang Dagang","1","2156512");
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `id_transaksi` varchar(100) NOT NULL,
  `nobacth` varchar(11) NOT NULL,
  `ed` date NOT NULL,
  `jumlah` int(12) NOT NULL,
  `harga` int(12) NOT NULL,
  `subtotal` int(12) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;




DROP TABLE supplier;

CREATE TABLE `supplier` (
  `id_supplier` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `nm_supplier` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `kota` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `alamat` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `no_hp` varchar(15) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO supplier VALUES("5325","BINSARAYA","PEKALONGAN","PEKALONGAN","02858556422");
INSERT INTO supplier VALUES("6984","Almedika","Pekalongan","Pekalongan","028596314755");
INSERT INTO supplier VALUES("45315","SOHO","SEMARANG","SEMARANG","028494335763");
INSERT INTO supplier VALUES("93182","MST","SEMARANG","SEMARANG","02849343343");
INSERT INTO supplier VALUES("9331","BERNO","SEMARANG","SEMARANG","02849336411");



DROP TABLE tabel_berita;

CREATE TABLE `tabel_berita` (
  `nomor` int(5) NOT NULL AUTO_INCREMENT,
  `user_nomor` int(5) NOT NULL,
  `waktu` datetime NOT NULL,
  `berita` int(11) NOT NULL,
  `id_transaksi` varchar(30) NOT NULL,
  PRIMARY KEY (`nomor`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO tabel_berita VALUES("1","1","2015-05-14 10:20:50","52000","PMB6920150514");



DROP TABLE users;

CREATE TABLE `users` (
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `photo` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'user',
  `blokir` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `tanggal` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `jamin` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `jamout` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `id_session` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO users VALUES("root","63a9f0ea7bb98050796b649e85481845","Bagus Tilas H","","bagustilas@ymail.com","087711972921","admin","N","23-05-2015","16:45:24","loggin","online","u3j9l75of22qmv87nk5b9913g1");
INSERT INTO users VALUES("demo","fe01ce2a7fbac8fafaed7c982a04e229","demo","","demo@demo.com","0888888888","user","N","13-04-2014","22:20:32","22:20:51","offline","ca8bb78fff7ffa15e41b94ad0bb16782");



