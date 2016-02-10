<script type="text/javascript">
$(function(){
	$("#tmb_perkiraan").click(function(){$("#perkiraan").slideDown();
				$("#col").show();
				$("#loading").show();
			});
		$("#dob").click(function(){
			$("#perkiraan").slideUp();
			$("#loading").hide();
		});
		$("#batal").click(function(){
			$("#perkiraan").slideUp();
			$("#loading").hide();
		});
	});
</script>
<?php
$aksi="../modul/mod_setup/aksi_setup.php";
switch($_GET[act]){
  // Tampil barang
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
					<input class="btn btn-default" type="button" value='Tambah Akun' onclick="window.location.href='rekeningtambah';">

                        </div>
                        </div>
		  <div class="panel panel-default">
                        <div class="panel-heading">
                             Tabel Akun
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
									<th>No.</th>
							<th>Id Rekening</th>
							<th>Nama Rekening</th>
							<th>Jumlah</th>
							<th>Aksi</th>
				</thead>
					<tbody>
<?php		
		$tampil=mysql_query("SELECT * FROM rekening,jns_rek WHERE rekening.jenis=kd_jns ORDER BY rekening.kd_rek");
		$total_debit=mysql_fetch_array(mysql_query("SELECT sum(jumlah) as total FROM rekening WHERE jenis='1'")) or die (mysql_error());
		$total_kredit=mysql_fetch_array(mysql_query("SELECT sum(jumlah) as total FROM rekening WHERE jenis='2'"))or die (mysql_error());
		$no=1;
		$subtot_pel=0;
		while($r = mysql_fetch_array($tampil)){
		$pel = $no;
		$total_pel = $subtot_pel + pel;
				echo"<tr class='odd gradeX'>
						<td>$no</td>
						<td>$r[kd_rek]</td>
					<td>$r[nama_rekening]</td>";
						echo"<td>Rp.&nbsp".number_format($r[jumlah],2,',','.');echo"</td>
					<td><a href=rekeningedit.$r[kd_rek]><span><i class='fa fa-edit'></i></a> | 
	             <a href=rekeninghapus.$r[kd_rek] 
				 Onclick=\"return confirm('Apakah Anda yakin akan menghapus $r[nama_rekening] dari daftar Perkiraan?')\">
				 <span><i class='fa fa-pencil'></i></a>
             </td></tr>";
			$no++;
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
			    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Master Akun</h4>
                                        </div>
                                        <div class="modal-body">
											 <div class="form-group">
					<label>Kode Rekening</label>
					<input type="text" value="" id="id_rekening" size="3" class="form-control"><div id='pesan'></div>
					<label>Nama Rekening</label>
                    <input type="text" value="" id="nm_rekening" class="form-control">
					<label>Jenis</label>
							<select id='jenis' class='form-control'>";
									<option value='1'>Debit</option>
									<option value='2'>Kredit</option>
									<option value='' selected>Pilih</option>
						</select>
                    <label>Jumlah</label>
					  <input type="text" value="" id="jumlah" class="form-control">

                    </div>
										</div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button id='simpan' class='btn btn-default'>Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
<?php

} else{
			echo"<div id='peretas'><center><img src='../img/icons/32x32_0400/exclamation.png'><ss><p>$_SESSION[namalengkap]&nbspdilarang mengakses halaman ini.
			<br>TINDAKAN MERTAS SISTEM </p></ss></center></div>";
		}
	break;
	case "tambahrekening":
	?>
		<div class="row">
                <div class="col-lg-5">
                    <div class="panel panel-default">
						<div class="panel-heading">
                            Master Rekening
                        </div>
						<div class="panel-heading">
								
                        </div>
	<div class="panel-body">
			<div class="row">
                <div class="col-lg-12">
								
    		
				   <div class="modal-body">
											 <div class="form-group">
					<label>Kode Rekening</label>
					<input type="text" value="" id="id_rekening" size="3" class="form-control"><div id='pesan'></div>
					<label>Nama Rekening</label>
                    <input type="text" value="" id="nm_rekening" class="form-control">
					<label>Jenis</label>
							<select id='jenis' class='form-control'>";
									<option value='1'>Debit</option>
									<option value='2'>Kredit</option>
									<option value='' selected>Pilih</option>
						</select>
                    <label>Jumlah</label>
					  <input type="text" value="" id="jumlah" class="form-control">

                    </div>
					                                            <button id='simpan' class='btn btn-default'>Simpan</button>
										</div>              
					</div>
			</div>
	</div>
					</div>
			</div>
	</div>
   
	<?php
	break;
	case "editrekening":
	  if($_SESSION['leveluser']=='admin'){
	$edit=mysql_query("SELECT * FROM rekening WHERE kd_rek='$_GET[id]'");
    $r=mysql_fetch_array($edit);
   ?>
   
   	<div class="row">
                <div class="col-lg-5">
                    <div class="panel panel-default">
						<div class="panel-heading">
                            Master Rekening
                        </div>
						<div class="panel-heading">
								
                        </div>
	<div class="panel-body">
			<div class="row">
                <div class="col-lg-12">
								
    		
				  <div class="form-group">
					<label>Kode Rekening</label>
					<input type="text" value="<?php echo"$r[kd_rek]";?>" id="id_rekening" size="3" class="form-control" disabled="disabled">
					<label>Nama Rekening</label>
                    <input type="text" value="<?php echo"$r[nama_rekening]";?>" id="nm_rekening" class="form-control">
					<label>Jenis</label>
					<?php
						echo"
							<select id='jenis' class='form-control'>";
						if($r[jenis]==1){					
								echo"<option value='1' selected>Debit</option>
									<option value='2'>Kredit</option>";
						}else {	echo"<option value='1' >Debit</option>
									<option value='2' selected>Kredit</option>";
								}echo"</select>";
					?>
                    <label>Jumlah</label>
					  <input type="text" value="<?php echo"$r[jumlah]";?>" id="jumlah" class="form-control">

                    </div>
					<button id="update" class='btn'>Simpan</button>
               
					</div>
			</div>
	</div>
					</div>
			</div>
	</div>
   <?php
		  } else{
			echo"<div id='peretas'><center><img src='../img/icons/32x32_0400/exclamation.png'><ss><p>$_SESSION[namalengkap]&nbspdilarang mengakses halaman ini.
			<br>TINDAKAN MERTAS SISTEM </p></ss></center></div>";
		}
 
}
?>