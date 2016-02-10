<?php
switch($_GET['act']){
	default:
	if($_SESSION['leveluser']=='admin'){
?>
<script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
	<div class="row">
                <div class="col-md-12">
			<div class="panel panel-default">
					 <div class="panel-body">
			<input class="btn btn-default" type="button" value='Tambah Modul' onclick="window.location.href='tambahmodul';">

                        </div>
                        </div>
		  <div class="panel panel-default">
                        <div class="panel-heading">
                             Tabel Modul
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
									<th>No.</th>
							<th>Nama modul</th>
							<th>link modul</th>
							<th>Publis</th>
							<th>Aktif</th>
							<th>Status</th>
							<th>Instal|update</th>
							<th>Aksi</th>
				</thead>
					<tbody>
<?php		
		$tampil=mysql_query("SELECT * FROM modul ORDER BY urutan");
		while($r = mysql_fetch_array($tampil)){
						echo"<tr><td>$r[urutan]</td>
					<td>$r[nama_modul]</td>
					<td>$r[link]</td>
					<td>$r[publish]</td>
					<td>$r[aktif]</td>
					<td>$r[status]</td>
					<td>$r[tgl]</td>
					<td><a href=editmodul.$r[id_modul]><span><i class='fa fa-edit'></i></span></a>|
	              <a href=hapusmodul.$r[id_modul]  
				  Onclick=\"return confirm('Apakah Anda yakin akan menghapus modul $r[nama_modul] dari daftar?')\">
				  <span><i class='fa fa-pencil'></i></span></a>
					</td></tr>";
			
			}
				?>
			</tbody>
			<tfoot> 
		<tr> 
				</tr> 
	</tfoot> 
	</table>
	 </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>	
<?php
	}else{
			echo"<div id='peretas'><br><center><img src='../img/icons/32x32_0400/exclamation.png'><ss><p>$_SESSION[namalengkap]&nbspdilarang mengakses halaman ini.
			<br>TINDAKAN MERTAS SISTEM </p></ss></center></div>";
		}
	break;
	case "tambahmodul":
	if($_SESSION['leveluser']=='admin'){
    ?>
	
		<div class="row">
                <div class="col-lg-5">
                    <div class="panel panel-default">
						<div class="panel-heading">
                            Master Modul
                        </div>
						<div class="panel-heading">
								
                        </div>
	<div class="panel-body">
			<div class="row">
                <div class="col-lg-12">
								
    		
				  <div class="form-group">
					<label>Nama Modul</label>
                    <input type="text" id="nama_modul" placeholder="nama modul" class="form-control">
					<label>Link</label>
					<input type="text" id="link" placeholder="nama link sesuai modul" size=30 class="form-control">
                    <label>Status</label>
					   <select id="akses" class="form-control">
							<option value="user">User</option>
							<option value="admin">Admin</option>
							<option selected>-Pilih-</option>
					   </select>			
                    </div>
				<button id="simpan_modul" class="btn">Simpan</button>
               
					</div>
			</div>
	</div>
					</div>
			</div>
	</div>
	<?php		
		 }
		 else { 	
			echo"<div id='peretas'><center><img src='../img/icons/32x32_0400/exclamation.png'><ss><p>$_SESSION[namalengkap]&nbspdilarang mengakses halaman ini.
			<br>TINDAKAN MERTAS SISTEM </p></ss></center></div>";
		}
     break;
	 case "editmodul":	
    $edit = mysql_query("SELECT * FROM modul WHERE id_modul='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
	if($_SESSION[leveluser]=='admin'){
		?>
			<div class="row">
                <div class="col-lg-5">
                    <div class="panel panel-default">
						<div class="panel-heading">
                            Edit Master Modul
                        </div>
						<div class="panel-heading">
								
                        </div>
	<div class="panel-body">
			<div class="row">
                <div class="col-lg-12">
								
    		
				  <div class="form-group">
				  <input type="hidden" id="kode" value='<?php echo"$r[id_modul]";?>'>
					<label>Nama Modul</label>
                    <input type="text" id="nama_modul" placeholder="nama modul" <?php echo"value=$r[nama_modul]";?> class="form-control">
					<label>Link</label>
					<input type="text" id="link" placeholder="nama link sesuai modul" <?php echo"value=$r[link]";?> size=30 class="form-control">
                    <label>Urutan</label>
                    <input type="text" id="urutan" placeholder="Urutan" <?php echo"value=$r[urutan]";?> class="form-control">
					
					 <label>Status</label>
					 <?php
						 if ($r[status]=='user'){
							 $user = "selected";
						 } elseif ($r[status]=='admin') {
							 $admin = "selected";
						 } else {
							 $status = "selected";
						 }
					 ?>
					   <select id="akses" class="form-control">
							<option value="user" <?php echo"$user";?>>User</option>
							<option value="admin" <?php echo"$admin";?>>Admin</option>
							<option <?php echo"$status ";?>>-Pilih-</option>
					   </select>	
					  
					  <label>Aktif</label>
					  	 <?php
						 if ($r[aktif]=='Y'){
							 $aktif = "selected";
						 } elseif ($r[aktif]=='T') {
							 $nonaktif = "selected";
						 } else {
							 $akses = "selected";
						 }
					 ?>
					   <select id="aktif" class="form-control">
							<option value="Y" <?php echo"$aktif ";?>>Aktif</option>
							<option value="T" <?php echo"$nonaktif ";?>>Non Aktif</option>
							<option <?php echo"$akses ";?>>-Pilih-</option>
					   </select>
					   
                     <label>Publish</label>
					 <?php
						if ($r[publish]=='Y'){
							 $publish = "selected";
						 } elseif ($r[publish]=='T') {
							 $nonpublish = "selected";
						 } else {
							 $publis = "selected";
						 }
					 ?>
					   <select id="publis" class="form-control">
							<option value="Y" <?php echo"$publish";?>>Aktif</option>
							<option value="T" <?php echo"$nonpublish";?>>Non Aktif</option>
							<option <?php echo"$publis ";?>>-Pilih-</option>
					   </select>
					   
				   </div>
					<button id="update_modul" class="btn">Simpan</button>
               
					</div>
			</div>
	</div>
					</div>
			</div>
	</div>
		
		<?php
	}
	 else { 	
			echo"<br><center><img src='../img/64/25.png'><ss><p>$_SESSION[namalengkap]&nbspdilarang mengakses halaman ini.
			<br>TINDAKAN MERTAS SISTEM </p></ss></center>";
		}
    break; 
}
?>