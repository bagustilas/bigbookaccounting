<?php
$aksi="../apotek/modul/mod_dokter/aksi_dokter.php";
switch($_GET[act]){
  // Tampil suppllier
  default:
   	?>
 <!-- DATA TABLE SCRIPTS -->
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
			<input class="btn btn-default" type="button" value='Tambah Dokter' onclick="window.location.href='dokteradd';">

                        </div>
                        </div>
									
					<!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Tabel Dokter
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                      
		   <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                 <thead>
						<tr>	
							<th>No.</th>
							<th>Id Dokter</th>
							<th>Nama Dokter</th>
							<th>Kota</th>
							<th>Alamat</th>
							<th>No.telp</th>
							<th>Aksi</th>
						 </tr>	
				</thead>
					<tbody>
<?php		
		$tampil=mysql_query("SELECT * FROM dokter ORDER BY nm_dokter");
		$no=1;
		while($r = mysql_fetch_array($tampil)){
				echo"<tr class='odd gradeX'>
						<td>$no</td>
						<td>$r[id_dokter]</td>
					<td>$r[nm_dokter]</td>
					<td>$r[kota]</td>
					<td>$r[alamat]</td>
					<td>$r[no_hp]</td>
					
					<td><a href=dokteredit.$r[id_dokter]><i class='fa fa-edit'></i></a> | 
	             <a href=$aksi?module=dokter&act=hapus&id=$r[id_dokter] Onclick=\"return confirm('Apakah Anda yakin akan menghapus $r[nm_dokter]?')\">
				 <i class='fa fa-pencil'></i></a>
             ";
			$no++;
			}
				?>
			</tbody>
	</table>
	</div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>	
<?php

break;
	//Tambah dokter (penyuplai obat-obtan)
	case "tambahdokter":
    ?>
		<div class="row">
                <div class="col-lg-5">
                    <div class="panel panel-default">
						<div class="panel-heading">
                            Master Dokter
                        </div>
						<div class="panel-heading">
								
                        </div>
	<div class="panel-body">
			<div class="row">
                <div class="col-lg-12">
			
		<div class="form-group">			
          <label>Id dokter</label> <input type="text" id="id_dokter" class="form-control"> <div id="pesan"> </div>
		  <label>Nama dokter</label> <input type="text" id="nm_dokter" class="form-control">
		  <label>Kota</label> <input type="text" id="kota" class="form-control">
		  <label>Alamat</label> <input type="text"  id="alamat" class="form-control">
		  <label>No. Telp</label>  <input type="text" id="no_hp" class="form-control">
		 </div>
       
	   <button id="simpan_dokter" class="btn">Simpan</button>
          <input class="btn" type="button" value="Batal" onClick="self.history.back()";>

					</div>
			</div>
	</div>
					</div>
			</div>
	</div> 
	<?php
break;
	//edit dokter (penyuplai obat-obtan)
	case "editdokter":
	?>
				<div class="row">
                <div class="col-lg-5">
                    <div class="panel panel-default">
						<div class="panel-heading">
                            Master Dokter
                        </div>
						<div class="panel-heading">
								
                        </div>
	<div class="panel-body">
			<div class="row">
                <div class="col-lg-12">
				<div class="form-group">
	<?php
	$edit=mysql_query("SELECT * FROM dokter WHERE id_dokter='$_GET[id]'");
    $r=mysql_fetch_array($edit);
    echo "
         <label>Id dokter </label>  <input type=text id='id_dokter' value='$r[id_dokter]' class='form-control'> 
          <label>Nama dokter </label>  <input type=text id='nm_dokter' value='$r[nm_dokter]' class='form-control'>
		  <label>Kota </label> <input type=text id='kota'  value='$r[kota]' class='form-control'>
		  <label>Alamat </label> <span style='margin-left:10px'></span> <textarea id='alamat' class='form-control'>$r[alamat]</textarea>
		  <label>No. Telp </label>  <input type=text id='no_hp' value='$r[no_hp]' class='form-control'>";
        							
	?>
		</div>
		  <button id='update_dokter' class='btn'>Simpan</button>
                            <input class='btn' type="button" value="Batal" onClick="self.history.back()";>

		</div>
			</div>
	</div>
					</div>
			</div>
	</div> 
<?php	
break;
  
}
?>