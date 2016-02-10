<?php
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