<?php
switch ($_GET[act]){
	default:
	if($_SESSION['leveluser']=='admin'){
	?>
<div class="row">
				<div class="col-md-12 col-sm-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
							<p align="center"><em>Aplikasi ini digunakan untuk <strong><a href="#">backup</a></strong> dan <strong><a href="restore">restore</a></strong> semua data yang ada didalam database &quot;<strong><?php echo"$db";?></strong>&quot;.</em></p>	
                        </div>
                        <div class="panel-body">      
	<?php
    echo "
		  <form action=\"pemulihan\" method=\"post\" name=\"postform\">
	<div align=\"center\">
	   <p>
	    <input type=\"submit\" class='btn btn-danger btn-lg' name=\"backup\"  onClick=\"return confirm('Apakah Anda yakin?')\"value=\"Proses Backup\" />
	  </p>
  </div>
</form>";
?>
				</div>
                        <div class="panel-footer">
                           *perhatian berhati-hati dalam membackup database
                        </div>
                    </div>
                </div>

			</div>  
<?php
if(isset($_POST['backup'])){
	
	//membuat nama file
	$file='alfa'.$tgl_sekarang.'.sql';
	
	//panggil fungsi dengan memberi parameter untuk koneksi dan nama file untuk backup
	backup_tables($server,$users,$password,$db,$file);
	
	?>
	<div id="download"><p align="center"><a style="cursor:pointer" onclick="location.href='download.<?php echo $file;?>'" title="Download">
	Backup database telah selesai. <font color="#0066FF">Download file database</font></a>
	</p></div><?php
}else{
	unset($_POST['backup']);
}
echo"
		  </fieldset>";
} else{
			echo"<div id='peretas'><center><img src='../img/icons/32x32_0400/exclamation.png'><ss><p>$_SESSION[namalengkap]&nbspdilarang mengakses halaman ini.
			<br>TINDAKAN MERTAS SISTEM </p></ss></center></div>";
		}
break;

	case"restore":
	if($_SESSION['leveluser']=='admin'){
?>

<div class="row">
				<div class="col-md-12 col-sm-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
							<p align="center"><em>Aplikasi ini digunakan untuk <strong><a href="pemulihan">backup</a></strong> dan <strong><a href="#">restore</a></strong> semua data yang ada didalam database &quot;<strong><?php echo"$db";?></strong>&quot;.</em></p>	
                        </div>
                        <div class="panel-body">
							<?php
	echo"	

<form enctype=\"multipart/form-data\" action=\"restore\" method=\"post\" role=\"form\">
	 <div class=\"form-group\">
		<label>File Backup Database (*.sql)</label>
		<input  type=\"file\"  name=\"datafile\" size=\"30\" id=\"gambar\" />
      </div>
	 
	<input type=\"submit\"  class='btn' onclick=\"return confirm('Apakah Anda yakin akan restore database?')\" name=\"restore\" value=\"Restore Database\" />
	
</form>";
?>
						</div>
                        <div class="panel-footer">
                           *perhatian berhati-hati dalam merestore database
                        </div>
                    </div>
                </div>

			</div>  

<?php
if(isset($_POST['restore'])){
	
	$nama_file=$_FILES['datafile']['name'];
	$ukuran=$_FILES['datafile']['size'];
	
	//periksa jika data yang dimasukan belum lengkap
	if ($nama_file=="")
	{
		echo "Fatal Error";
	}else{
		//definisikan variabel file dan alamat file
		$uploaddir='modul/mod_pemulihan/restore/';
		$alamatfile=$uploaddir.$nama_file;

		//periksa jika proses upload berjalan sukses
		if (move_uploaded_file($_FILES['datafile']['tmp_name'],$alamatfile))
		{
			
			$filename = 'modul/mod_pemulihan/restore/'.$nama_file.'';
			
			// Temporary variable, used to store current query
			$templine = '';
			// Read in entire file
			$lines = file($filename);
			// Loop through each line
			foreach ($lines as $line)
			{
				// Skip it if it's a comment
				if (substr($line, 0, 2) == '--' || $line == '')
					continue;
			 
				// Add this line to the current segment
				$templine .= $line;
				// If it has a semicolon at the end, it's the end of the query
				if (substr(trim($line), -1, 1) == ';')
				{
					// Perform the query
					mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
					// Reset temp variable to empty
					$templine = '';
				}
			}
			echo "<center>Berhasil Restore Database, silahkan di cek.</center>";
		
		}else{
			//jika gagal
			echo "Proses upload gagal, kode error = " . $_FILES['location']['error'];
		}	
	}

}else{
	unset($_POST['restore']);
	}
echo"</fieldset>";
} else{
			echo"<div id='peretas'><br><center><img src='../img/icons/32x32_0400/exclamation.png'><ss><p>$_SESSION[namalengkap]&nbspdilarang mengakses halaman ini.
			<br>TINDAKAN MERTAS SISTEM </p></ss></center></div>";
		}
}
?>
