<?php
$aksi="../apotek/modul/mod_supplier/aksi_supplier.php";
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
			<input class="btn btn-default" type="button" value='Tambah Supplier' onclick="window.location.href='supplieradd';">

                        </div>
                        </div>
									
					<!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Tabel Supplier
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                      
		   <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                 <thead>
						<tr>	
							<th>No.</th>
							<th>Id Supplier</th>
							<th>Nama Supplier</th>
							<th>Kota</th>
							<th>Alamat</th>
							<th>No.Telp</th>
							<th>Aksi</th>
						 </tr>	
				</thead>
					<tbody>
<?php		
		$tampil=mysql_query("SELECT * FROM supplier ORDER BY nm_supplier");
		$no=1;
		while($r = mysql_fetch_array($tampil)){
				echo"<tr class='odd gradeX'>
						<td>$no</td>
						<td>$r[id_supplier]</td>
					<td>$r[nm_supplier]</td>
					<td>$r[kota]</td>
					<td>$r[alamat]</td>
					<td>$r[no_hp]</td>
					
					<td><a href=supplieredit.$r[id_supplier]><i class='fa fa-edit'></i></a> | 
	             <a href=$aksi?module=supplier&act=hapus&id=$r[id_supplier] Onclick=\"return confirm('Apakah Anda yakin akan menghapus $r[nm_supplier]?')\">
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
	//Tambah supplier (penyuplai obat-obtan)
	case "tambahsupplier":
    ?>
		<div class="row">
                <div class="col-lg-5">
                    <div class="panel panel-default">
						<div class="panel-heading">
                            Master Supplier
                        </div>
						<div class="panel-heading">
								
                        </div>
	<div class="panel-body">
			<div class="row">
                <div class="col-lg-12">
			
		<div class="form-group">			
          <label>Id Supplier</label> <input type="text" id="id_supplier" class="form-control" > <div id="pesan"> </div>
		  <label>Nama Supplier</label> <input type="text" id="nm_supplier" class="form-control">
		  <label>Kota</label> <input type="text" id="kota" class="form-control">
		  <label>Alamat</label> <input type="text"  id="alamat" class="form-control">
		  <label>No. Telp</label>  <input type="text" id="no_hp" class="form-control">
		 </div>
       
	   <button id="simpan_sp" class="btn">Simpan</button>
        <input class="btn" type="button" value="Batal" onClick="self.history.back()";>

					</div>
			</div>
	</div>
					</div>
			</div>
	</div> 
	<?php
break;
	//edit supplier (penyuplai obat-obtan)
	case "editsupplier":
	?>
				<div class="row">
                <div class="col-lg-5">
                    <div class="panel panel-default">
						<div class="panel-heading">
                            Master Supplier
                        </div>
						<div class="panel-heading">
								
                        </div>
	<div class="panel-body">
			<div class="row">
                <div class="col-lg-12">
				<div class="form-group">
	<?php
	$edit=mysql_query("SELECT * FROM supplier WHERE id_supplier='$_GET[id]'");
    $r=mysql_fetch_array($edit);
    echo "
         <label>Id Supplier </label>  <input type=text id='id_supplier' value='$r[id_supplier]' class='form-control'> <span id='pesan'> </span>
          <label>Nama Supplier </label>  <input type=text id='nm_supplier' value='$r[nm_supplier]' class='form-control'>
		  <label>Kota </label> <input type=text id='kota'  value='$r[kota]' class='form-control'>
		  <label>Alamat </label> <span style='margin-left:10px'></span> <textarea id='alamat' class='form-control'>$r[alamat]</textarea>
		  <label>No. Telp </label>  <input type=text id='no_hp' value='$r[no_hp]' class='form-control'>";
        							
	?>
		</div>
		  <button id='update_sp' class='btn'>Simpan</button>
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