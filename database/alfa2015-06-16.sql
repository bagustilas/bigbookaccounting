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

INSERT INTO barang VALUES("5215","Ondancentron 4 mg","Ampul","Generik","313213","2019-09-11","1200","2590","420","50");
INSERT INTO barang VALUES("8541","Furosemide 40 mg","Tablet","Generik","7676767","2018-06-01","100","327","550","50");
INSERT INTO barang VALUES("352","Vit A 6000","Tablet","Generik","65678","2018-07-24","2100","3709","60","100");
INSERT INTO barang VALUES("5321","Vit C ","Tablet","Generik","69946332","2015-03-16","100","210","180","100");
INSERT INTO barang VALUES("372","Zinc Kids","Tablet","Generik","654844","2019-05-03","1500","2187","30","50");
INSERT INTO barang VALUES("52312","Lantus 60ml syr","Fls","Generik","23231","2018-05-03","5200","10333","14","25");
INSERT INTO barang VALUES("8542","Betahistin","Tablet","Generik","97854456","2017-09-15","2300","2816","1980","50");
INSERT INTO barang VALUES("5323","Bisoprolol","Tablet","Generik","134323","2013-11-23","163","332","140","50");
INSERT INTO barang VALUES("531","Alprazolam 0,5 mg","Tablet","Narkotik","131312","2013-11-23","1253","2601","85","50");
INSERT INTO barang VALUES("362","Alprazolam 1 mg","Tablet","Narkotik","131231","2013-11-23","1653","3337","110","50");
INSERT INTO barang VALUES("1237","Cefixime 100 mg ","Capsul","Generik","2453435","2015-08-30","198","416","1000","50");
INSERT INTO barang VALUES("6231","Nutriflam","Tablet","Generik","48484841","2018-08-11","1250","853","400","50");
INSERT INTO barang VALUES("5313","Antalgin 500 mg","Tablet","Generik","2112121","2015-09-12","152","319","990","50");
INSERT INTO barang VALUES("89237","Clyndamicin","Tablet","Generik","3312223","2016-03-16","113","237","100","50");
INSERT INTO barang VALUES("8237","Masker Kertas Tali","Pcs","Alkes","33211","2016-07-17","1513","3177","0","50");
INSERT INTO barang VALUES("920","Kassa 5 cm","Pcs","Alkes","322163","2016-06-11","123","258","5","20");
INSERT INTO barang VALUES("5621","Gotropil inj","Ampul","Generik","312312","2013-11-23","8521","17808","100","50");
INSERT INTO barang VALUES("12","Betadine","Botol","Paten","876","2019-09-08","3500","7350","100","20");
INSERT INTO barang VALUES("81238","Paracetamol 500 mg","Tablet","Generik","2512112","2015-04-05","120","252","0","100");
INSERT INTO barang VALUES("1238","Paracetamol 60 ml","Fls","Generik","1233122","2015-05-14","142","365","1024","25");
INSERT INTO barang VALUES("344566","Piroxicam","Tablet","Generik","876879","2019-12-09","170","336","200","10");
INSERT INTO barang VALUES("undefined","undefined","undefi","1","0","0000-00-00","0","0","0","0");



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

INSERT INTO bigbook_perusahaan VALUES("APOTEK ALFA","jayabaya@gamil.com","Jl. A Yani No. 5B Comal","2147483647","85Koala.jpg");



DROP TABLE dokter;

CREATE TABLE `dokter` (
  `id_dokter` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `nm_dokter` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `kota` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `alamat` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `no_hp` varchar(15) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_dokter`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO dokter VALUES("3325","dr. Kukuh","Pemalang","Pemalang","02856352312");
INSERT INTO dokter VALUES("23","dr. Kun","Comal","Gintung","089977856389");



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

INSERT INTO kd_pemb VALUES("2015-05-14","0000-00-00","PMB6820150514","Tunai","0","300000","9331","BRN23232","2015-05-14","0000-00-00","Rizki Wijayanti");
INSERT INTO kd_pemb VALUES("2015-05-14","0000-00-00","PMB6920150514","Tunai","0","52000","45315","SHO3232","2015-05-14","0000-00-00","Rizki Wijayanti");
INSERT INTO kd_pemb VALUES("2015-06-02","0000-00-00","PMB7020150602","Tunai","0","2530000","5325","786453676897","2015-05-31","0000-00-00","Rizki Wijayanti");
INSERT INTO kd_pemb VALUES("2015-06-02","0000-00-00","PMB7120150602","Tunai","0","105000","12345","34254457876","2015-05-31","0000-00-00","Rizki Wijayanti");
INSERT INTO kd_pemb VALUES("2015-06-03","0000-00-00","PMB7220150603","","0","30000","0","","0000-00-00","0000-00-00","Rizki Wijayanti");
INSERT INTO kd_pemb VALUES("2015-06-04","0000-00-00","PMB7420150604","Tunai","0","10000","5325","BR213132","2015-05-31","0000-00-00","Rizki Wijayanti");
INSERT INTO kd_pemb VALUES("2015-06-04","0000-00-00","PMB7820150604","Tunai","0","123400","45315","SH99344","2015-05-31","0000-00-00","Rizki Wijayanti");
INSERT INTO kd_pemb VALUES("2015-06-04","0000-00-00","PMB7920150604","Tunai","0","125000","9331","BR48585","2015-06-04","2015-06-06","Rizki Wijayanti");
INSERT INTO kd_pemb VALUES("2015-06-04","0000-00-00","PMB8520150604","Tunai","0","12000","9331","BRN433533","2015-06-04","2015-06-11","Rizki Wijayanti");
INSERT INTO kd_pemb VALUES("2015-06-04","0000-00-00","PMB8720150604","Tunai","0","15000","9331","BR55545445","2015-06-04","0000-00-00","Rizki Wijayanti");
INSERT INTO kd_pemb VALUES("2015-06-06","0000-00-00","PMB8820150606","Tunai","0","17000","9331","546757887","2015-06-01","0000-00-00","Rizki Wijayanti");
INSERT INTO kd_pemb VALUES("2015-06-11","0000-00-00","PMB8920150611","Tempo","0","350000","12345","9876","2015-06-09","0000-00-00","Rizki Wijayanti");



DROP TABLE kd_penj;

CREATE TABLE `kd_penj` (
  `tanggal` date NOT NULL,
  `dokter` int(15) NOT NULL,
  `kd_pjl` varchar(15) NOT NULL,
  `total` int(11) NOT NULL,
  `user` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO kd_penj VALUES("2015-05-23","3325","PJL120150523","2980","Rizki Wijayanti");
INSERT INTO kd_penj VALUES("2015-05-31","0","PJL220150531","3190","Rizki Wijayanti");
INSERT INTO kd_penj VALUES("2015-06-02","0","PJL320150602","2100","Rizki Wijayanti");
INSERT INTO kd_penj VALUES("2015-06-04","0","PJL420150604","46720","Rizki Wijayanti");
INSERT INTO kd_penj VALUES("2015-06-09","0","PJL520150609","25900","Rizki Wijayanti");
INSERT INTO kd_penj VALUES("2015-06-09","3325","PJL620150609","25900","Rizki Wijayanti");



DROP TABLE kd_retur;

CREATE TABLE `kd_retur` (
  `tanggal` date NOT NULL,
  `id_pemb` varchar(15) NOT NULL,
  `kd_ret` varchar(15) NOT NULL,
  `total` int(11) NOT NULL,
  `user` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO kd_retur VALUES("2015-06-09","PMB6820150514","RTR120150609","25000","Rizki Wijayanti");
INSERT INTO kd_retur VALUES("2015-06-15","PMB6820150514","RTR620150615","25000","Rizki Wijayanti");



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
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

INSERT INTO master_transaksi VALUES("1","PMB6820150514","211","2015-05-14","Hutang Dagang","0","300000");
INSERT INTO master_transaksi VALUES("2","PMB6820150514","111","2015-05-14","Pembelian Barang","300000","0");
INSERT INTO master_transaksi VALUES("3","PMB6920150514","111","2015-05-14","Kas","0","52000");
INSERT INTO master_transaksi VALUES("4","PMB6920150514","411","2015-05-14","Pembelian Barang","52000","0");
INSERT INTO master_transaksi VALUES("5","PJL120150523","111","2015-05-23","Kas","2980","0");
INSERT INTO master_transaksi VALUES("6","PJL120150523","411","2015-05-23","Penjualan Barang","0","2980");
INSERT INTO master_transaksi VALUES("7","PJL220150531","111","2015-05-31","Kas","3190","0");
INSERT INTO master_transaksi VALUES("8","PJL220150531","411","2015-05-31","Penjualan Barang","0","3190");
INSERT INTO master_transaksi VALUES("9","PMB7020150602","111","2015-06-02","Kas","0","2530000");
INSERT INTO master_transaksi VALUES("10","PMB7020150602","411","2015-06-02","Pembelian Barang","2530000","0");
INSERT INTO master_transaksi VALUES("11","PJL320150602","111","2015-06-02","Kas","2100","0");
INSERT INTO master_transaksi VALUES("12","PJL320150602","411","2015-06-02","Penjualan Barang","0","2100");
INSERT INTO master_transaksi VALUES("13","PMB7120150602","111","2015-06-02","Kas","0","105000");
INSERT INTO master_transaksi VALUES("14","PMB7120150602","411","2015-06-02","Pembelian Barang","105000","0");
INSERT INTO master_transaksi VALUES("15","PMB7220150603","211","2015-06-03","Hutang Dagang","0","30000");
INSERT INTO master_transaksi VALUES("16","PMB7220150603","111","2015-06-03","Pembelian Barang","30000","0");
INSERT INTO master_transaksi VALUES("17","PMB7420150604","111","2015-06-04","Kas","0","10000");
INSERT INTO master_transaksi VALUES("18","PMB7420150604","411","2015-06-04","Pembelian Barang","10000","0");
INSERT INTO master_transaksi VALUES("19","PMB7820150604","111","2015-06-04","Kas","0","123400");
INSERT INTO master_transaksi VALUES("20","PMB7820150604","411","2015-06-04","Pembelian Barang","123400","0");
INSERT INTO master_transaksi VALUES("21","PMB7920150604","211","2015-06-04","Hutang Dagang","0","125000");
INSERT INTO master_transaksi VALUES("22","PMB7920150604","111","2015-06-04","Pembelian Barang","125000","0");
INSERT INTO master_transaksi VALUES("23","PJL420150604","111","2015-06-04","Kas","46720","0");
INSERT INTO master_transaksi VALUES("24","PJL420150604","411","2015-06-04","Penjualan Barang","0","46720");
INSERT INTO master_transaksi VALUES("25","PMB8520150604","211","2015-06-04","Hutang Dagang","0","12000");
INSERT INTO master_transaksi VALUES("26","PMB8520150604","111","2015-06-04","Pembelain","12000","0");
INSERT INTO master_transaksi VALUES("27","PMB8720150604","111","2015-06-04","Kas","0","15000");
INSERT INTO master_transaksi VALUES("28","PMB8720150604","411","2015-06-04","Pembelian Barang","15000","0");
INSERT INTO master_transaksi VALUES("29","PMB8820150606","211","2015-06-06","Hutang Dagang","0","17000");
INSERT INTO master_transaksi VALUES("30","PMB8820150606","111","2015-06-06","Pembelian Barang","17000","0");
INSERT INTO master_transaksi VALUES("31","PMB7920150604","411","2015-06-06","Pembelian Barang","125000","0");
INSERT INTO master_transaksi VALUES("32","PMB7920150604","111","2015-06-06","Hutang Dagang","0","125000");
INSERT INTO master_transaksi VALUES("33","PJL520150609","111","2015-06-09","Kas","25900","0");
INSERT INTO master_transaksi VALUES("34","PJL520150609","411","2015-06-09","Penjualan Barang","0","25900");
INSERT INTO master_transaksi VALUES("35","PJL620150609","111","2015-06-09","Kas","25900","0");
INSERT INTO master_transaksi VALUES("36","PJL620150609","411","2015-06-09","Penjualan Barang","0","25900");
INSERT INTO master_transaksi VALUES("37","RTR120150609","511","2015-06-09","Retur Pembelian","25000","0");
INSERT INTO master_transaksi VALUES("38","RTR120150609","111","2015-06-09","Kas","0","25000");
INSERT INTO master_transaksi VALUES("39","PMB8920150611","211","2015-06-11","Hutang Dagang","0","350000");
INSERT INTO master_transaksi VALUES("40","PMB8920150611","111","2015-06-11","Pembelian Barang","350000","0");
INSERT INTO master_transaksi VALUES("41","PMB8520150604","411","2015-06-11","Pembelian Barang","12000","0");
INSERT INTO master_transaksi VALUES("42","PMB8520150604","111","2015-06-11","Hutang Dagang","0","12000");
INSERT INTO master_transaksi VALUES("43","RTR620150615","511","2015-06-15","Retur Pembelian","25000","0");
INSERT INTO master_transaksi VALUES("44","RTR620150615","111","2015-06-15","Kas","0","25000");



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
) ENGINE=MyISAM AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;

INSERT INTO pembelian VALUES("69","52312","PMB6920150514","23231","2018-05-03","10","5200","52000","2015-05-14");
INSERT INTO pembelian VALUES("68","5215","PMB6820150514","33215","2018-05-18","120","2500","300000","2015-05-14");
INSERT INTO pembelian VALUES("70","8542","PMB7020150602","97854456","2017-09-15","1100","2300","2530000","2015-06-02");
INSERT INTO pembelian VALUES("71","352","PMB7120150602","65678","2018-07-24","50","2100","105000","2015-06-02");
INSERT INTO pembelian VALUES("72","372","PMB7220150603","654844","2019-05-03","20","1500","30000","2015-06-03");
INSERT INTO pembelian VALUES("73","5215","PMB7320150604","6371263712`","2018-09-12","100","1250","125000","2015-06-04");
INSERT INTO pembelian VALUES("74","5215","PMB7320150604","6371263712`","2018-09-12","100","1250","125000","2015-06-04");
INSERT INTO pembelian VALUES("75","5215","PMB7320150604","6371263712`","2018-09-12","100","1250","125000","2015-06-04");
INSERT INTO pembelian VALUES("76","5215","PMB7320150604","6371263712`","2018-09-12","100","1250","125000","2015-06-04");
INSERT INTO pembelian VALUES("77","8541","PMB7420150604","7676767","2018-06-01","100","100","10000","2015-06-04");
INSERT INTO pembelian VALUES("78","5215","PMB7820150604","64646464","2018-09-12","100","1234","123400","2015-06-04");
INSERT INTO pembelian VALUES("79","6231","PMB7920150604","48484841","2018-08-11","100","1250","125000","2015-06-04");
INSERT INTO pembelian VALUES("84","0","PMB8020150604","","0000-00-00","0","0","0","2015-06-04");
INSERT INTO pembelian VALUES("85","5215","PMB8520150604","313213","2019-09-11","10","1200","12000","2015-06-04");
INSERT INTO pembelian VALUES("86","0","PMB8620150604","","0000-00-00","0","0","0","2015-06-04");
INSERT INTO pembelian VALUES("87","344566","PMB8720150604","5464666","2019-07-11","100","150","15000","2015-06-04");
INSERT INTO pembelian VALUES("88","344566","PMB8820150606","876879","2019-12-09","100","170","17000","2015-06-06");
INSERT INTO pembelian VALUES("89","12","PMB8920150611","876","2019-09-08","100","3500","350000","2015-06-11");



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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO penjualan VALUES("1","8542","PJL120150523","10","298","2980","2015-05-23");
INSERT INTO penjualan VALUES("2","5313","PJL220150531","10","319","3190","2015-05-31");
INSERT INTO penjualan VALUES("3","5321","PJL320150602","10","210","2100","2015-06-02");
INSERT INTO penjualan VALUES("4","5215","PJL420150604","10","4672","46720","2015-06-04");
INSERT INTO penjualan VALUES("5","5215","PJL520150609","10","2590","25900","2015-06-09");
INSERT INTO penjualan VALUES("6","5215","PJL620150609","10","2590","25900","2015-06-09");



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

INSERT INTO rekening VALUES("111","Kas Apotek","1","26777965");
INSERT INTO rekening VALUES("211","Hutang Dagang","2","10585850");
INSERT INTO rekening VALUES("611","Biaya Listrik","2","75000");
INSERT INTO rekening VALUES("622","Biaya Gaji","2","1800000");
INSERT INTO rekening VALUES("911","Beban Sewa","2","0");
INSERT INTO rekening VALUES("612","Biaya air","2","50000");
INSERT INTO rekening VALUES("311","Modal Ibu Boergah","2","100000000");
INSERT INTO rekening VALUES("411","Pendapatan ","2","21167015");
INSERT INTO rekening VALUES("112","Pembelian","1","4289050");
INSERT INTO rekening VALUES("113","Persediaan Barang Dagang","1","2156512");
INSERT INTO rekening VALUES("312","Prive Ibu Boergah","1","0");
INSERT INTO rekening VALUES("511","Retur Pembelian","1","50000");
INSERT INTO rekening VALUES("114","Peralatan Toko","1","0");
INSERT INTO rekening VALUES("512","Retur Penjualan","1","0");
INSERT INTO rekening VALUES("422","Potongan Penjualan","2","0");
INSERT INTO rekening VALUES("115","Penyusutan Peralatan Kantor","1","0");
INSERT INTO rekening VALUES("116","Penyusutan Gedung","1","0");
INSERT INTO rekening VALUES("117","Pajak Penghasilan","1","0");
INSERT INTO rekening VALUES("423","Potongan Pembelian","1","0");
INSERT INTO rekening VALUES("0","undefined","0","0");



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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO retur VALUES("5","5215","RTR120150609","33215","2018-05-18","10","2500","25000","2015-06-09");
INSERT INTO retur VALUES("6","5215","RTR620150615","33215","2018-05-18","10","2500","25000","2015-06-15");



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
INSERT INTO supplier VALUES("12345","recom","bandung","bandung","09789876868");
INSERT INTO supplier VALUES("84h84","dian","Tegal","Tegal","5767 0987080");
INSERT INTO supplier VALUES("08989","Kupluk","Jakarta","Tanah Abang","087867891098");



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

INSERT INTO users VALUES("root","63a9f0ea7bb98050796b649e85481845","Rizki Wijayanti","","rizkiwijayanti7@gmail.com","083862098862","admin","N","16-06-2015","08:50:57","loggin","online","sqe4hfbdpjgmbm0d5tq4tht523");
INSERT INTO users VALUES("demo","fe01ce2a7fbac8fafaed7c982a04e229","demo","","demo@demo.com","0888888888","user","Y","13-04-2014","22:20:32","22:20:51","offline","ca8bb78fff7ffa15e41b94ad0bb16782");
INSERT INTO users VALUES("alis","20d5a950ad8d9a10ddb346d5312ff6e7","Sialis Poncowati","","alice.pesek@gmail.com","0856123456","user","N","","","","","20d5a950ad8d9a10ddb346d5312ff6e7");
INSERT INTO users VALUES("ggg","99a30df0f2488360cdd46b4b88e5f5f0","hgjii","","hgfhfj","gfshgfjhf","user","N","11-06-2015","06:10:20","06:11:47","offline","co5qd30g1cu4ou9vsu76bs3ab6");



