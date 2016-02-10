<?php
error_reporting(0);
//memulai session
session_start();
//membuat session user dan password
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='css/style.css' rel='stylesheet' type='text/css'><peringatan>
 <center><i class='icon-warning-sign '></i><br><br><br>Untuk mengakses sistem ini,<br> Anda harus login <br><br>";
  echo "<input type='button' class='btn' value='Klik disini' title='klik disini' onclick=\"window.location.href='index.php';\"></center></peringatan>";
}
else{
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Aplikasi Apotek</title>
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
	<link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
	 <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/jquery.ui.datepicker.js"></script>
    <script src="assets/js/app-apotek.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>  
	 <script src="assets/js/jquery.metisMenu.js"></script>
    <script src="assets/js/custom-scripts.js"></script>
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home"><b>Apotek</b>Alfa</a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
             
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="akun"><i class="fa fa-user fa-fw"></i> User Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="keluar.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a class="" href="grafik"><i class="fa fa-bar-chart-o"></i> Grafik</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap"></i> Master<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="barang">Barang</a>
                            </li>
                            <li>
                                <a href="supplier">Supplier</a>
                            </li>
							<li>
                                <a href="dokter">Dokter</a>
                            </li>
							<li>
                                <a href="rekening">Akun</a>
                            </li>
                        </ul>
                    </li>
					<li>
                        <a href="#"><i class="fa fa-sitemap"></i> Transaksi<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="transaksi.penjualan">Penjualan</a>
                            </li>
                            <li>
                                <a href="transaksi.pembelian">Pembelian</a>
                            </li>
                        </ul>
                    </li>
					<li>
                        <a href="#"><i class="fa fa-fw fa-file"></i> Jurnal<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="jurnal">Jurnal Umum</a>
                            </li>
                            <li>
                                <a href="jurnal.penjualan">Jurnal Penjualan</a>
                            </li>
							<li>
                                <a href="jurnal.pembelian">Jurnal Pembelian</a>
                            </li>
							<li>
                                <a href="jurnal.penyesuaian">Jurnal Penyesuaian</a>
                            </li>
                        </ul>
                    </li>
					<li>
                        <a href="#"><i class="fa fa-fw fa-file"></i> Laporan<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="llb">Laporan Rugi/Laba</a>
                            </li>
							<li>
                                <a href="neraca">Laporan Neraca</a>
                            </li>
							<li>
                                <a href="perubahanmodal">Laporan Perubahan Modal</a>
                            </li>
                            <li>
                                <a href="lpj">Laporan Penjualan</a>
                            </li>
							<li>
                                <a href="lpb">Laporan Pembelian</a>
                            </li>							
							<li>
                                <a href="laporan.retur">Laporan Retur Pembelian</a>
                            </li>
							<li>
                                <a href="laporan.hutang">Laporan Hutang</a>
                            </li>
							<li>
                                <a href="lps">Laporan Persediaan</a>
                            </li>
							
                        </ul>
                    </li>
					<li>
                        <a href="#"><i class="fa fa-fw fa-file"></i> Pengaturan<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="pengaturan">Plugin</a>
                            </li>
							 <li>
                                <a href="bantuan">Penutupan</a>
                            </li>
							<li>
								<a href="pemulihan"> Backup </a>
							</li>
                        </ul>
                    </li>
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
				
				
                <?php include"halaman.php";?>

        
                </div>
                
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->

</body>

</html>
<?php
}
?>