<?php
$aksi="../modul/mod_barang/proses.php";
$js="";
$p=isset($_GET['act'])?$_GET['act']:null;
switch($p){
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
			<input class="btn btn-default" type="button" value='Tambah Barang' onclick="window.location.href='barangtambah';">

                        </div>
                        </div>
									
					<!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Tabel Barang
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
											<th>No.</th>
                                            <th>Nama Barang</th>
                                            <th>Jenis</th>
                                            <th>Satuan</th>
                                            <th>No Batch</th>
                                            <th>Harga Beli</th>
                                            <th>Harga Jual</th>
                                            <th>Stok</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
		<?php		
		$tampil=mysql_query("SELECT * FROM barang ORDER BY nama");
		$no=1;
		while($r = mysql_fetch_array($tampil)){
		$jml=$r[stok];
		$hrg=$r[hrg_beli];
		$subtotal= $jml * $hrg;
		$total= $total + $subtotal;
				echo"<tr class='odd gradeX'>
					<td>$no</td>
					<td>$r[nama]</td>
					<td>$r[jenis]</td>
					<td>$r[satuan]</td>
					<td>$r[nobacth]</td>";
					echo"<td>Rp&nbsp".number_format($r[hrg_beli], 2 , ',' , '.' );
					echo"</td>";
					echo"<td>Rp&nbsp".number_format($r[hrg_jual], 2 , ',' , '.' );
					echo"</td>
					<td align='right'>$r[stok]</td>";echo"
					<td><a href=barangedit.$r[kode]><i class='fa fa-edit'></i></a> | 
	             <a href=$aksi?op=delete&kode=$r[kode] 
					Onclick=\"return confirm('Apakah Anda yakin akan menghapus $r[nama] dari daftar barang?')\">
					<i class='fa fa-pencil'></i></a>
             ";
			$no++;
			}
				?>  
                                    </tbody>
									<tfoot> 
		<tr> 
			<th style="'text'-align:right" colspan="5">Total persediaan:</th> 
			<th id="tot_bar" colspan="2"><?php echo"Rp&nbsp".number_format($total,2,',','.');?></th>
			<th id="tot_bar" ></th>
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
	break;
	  // Form tambah barang
	case "tambahbarang":
	?>
	<div class="row">
                <div class="col-lg-5">
                    <div class="panel panel-default">
						<div class="panel-heading">
                            Master Barang
                        </div>
						<div class="panel-heading">
								
                        </div>
	<div class="panel-body">
			<div class="row">
                <div class="col-lg-12">
								
    		
				  <div class="form-group">
					<label>Kode Barang</label>
                    <input type="text" name="kode2" id='kode2' class="form-control">
					<label>Nama Barang</label>
					<input type='text' id='nama' class="form-control">
                    <label>Jenis</label>
								<select id='jenis' class="form-control">
													<option value='Alkes'>Alkes</option>
													<option value='Generik'>Generik</option>
													<option value='Paten'>Paten</option>
													<option value='Salep'>Salep</option>
													<option value='Oral'>Oral</option>
													<option value='Narkotik'>Narkotik</option>
													<option value='Pisikotropik'>Psikotropik</option>
													<option value='' selected>-Pilih Jenis-</option>
								</select>
                        <label>Satuan</label>
								<select id='satuan' class="form-control">
													<option value='PCS'>PCS</option>
													<option value='Tablet'>Tablet</option>
													<option value='Ampul'>Ampul</option>
													<option value='Tube'>Tube</option>
													<option value='Flabot'>Flabot</option>
													<option value='Botol'>Botol</option>
													<option value='BOX'>BOX</option>
													<option value='' selected>-Pilih Satuan-</option>
								</select>
                        <label>No.Batch</label><input type='text' id='bacth' class="form-control">
                        <label>Kadaluarsa</label><input type='text' id='kadaluarsa' class="form-control">
						<label>Stok Minim</label><input type='text' id='stok_m' class="form-control">
                 </div>
				<button id='simpan' class='btn'>Simpan</button>
				<input class="btn" type="button" value="Batal" onClick="self.history.back()";>
					</div>
			</div>
	</div>
					</div>
			</div>
	</div>
	<?php	
     break;
  // Form Edit barang
  case "editbarang":
    $edit=mysql_query("SELECT * FROM barang WHERE kode='$_GET[id]'");
    $r=mysql_fetch_array($edit);
	$hb=$r[hrg_beli];$hj=$r[hrg_jual];
	$q=$hj-$hb;$x=$q*100;$z=$x/$hb;
    ?>
		<div class="row">
                <div class="col-lg-5">
                    <div class="panel panel-default">
						<div class="panel-heading">
                            Master Barang
                        </div>
						<div class="panel-heading">
								
                        </div>
	<div class="panel-body">
			<div class="row">
                <div class="col-lg-12">
								
    		
				  <div class="form-group">
			   <?php
				echo"
						<div id='status'></div><input type='hidden' id='kode' value='$r[kode]'> <span id='pesan'></span>
                        <label>Nama Barang</label><input type='text' id='nama' value='$r[nama]' class='form-control'>
						<label>Jenis</label><select id='jenis' class='form-control'>";
			
				$jns = $r[jenis];	
				if($jns=='Generik'){$gen="selected";}elseif($jns=='Paten'){$pat="selected";}elseif($jns=='Salep'){$sal="selected";}
				elseif($jns=='Oral'){$or="selected";}elseif($jns=='Narkotik'){$nar="selected";}elseif($jns=='Pisikotropik'){$pis="selected";}
				elseif($jns=='Alkes'){$alkes="selected";}else{ $selected="selected";}
												echo"<option value='Alkes' $alkes>Alkes</option>
													<option value='Generik' $gen>Generik</option>
													<option value='Paten' $pat>Paten</option>
													<option value='Salep' $sal>Salep</option>
													<option value='Oral' $or>Oral</option>
													<option value='Narkotik' $nar>Narkotik</option>
													<option value='Pisikotropik' $pis>Pisikotropik</option>
													<option value='0' $selected>-Pilih Jenis-</option>
														</select>";
                $stn = $r[satuan];	
				if($stn=='PCS'){$PCS="selected";}elseif($stn=='Tablet'){$tablet="selected";}elseif($stn=='Ampul'){$ampul="selected";}
				elseif($stn=='Tube'){$tube="selected";}elseif($stn=='Flabot'){$flabot="selected";}elseif($stn=='Botol'){$botol="selected";}
				elseif($stn=='BOX'){$box="selected";}else{ $selected1="selected";}
				echo"
						<label>Satuan</label>
								<select id='satuan' class='form-control'>
													<option value='PCS' $PCS>PCS</option>
													<option value='Tablet'$tablet>Tablet</option>
													<option value='Ampul' $ampul>Ampul</option>
													<option value='Tube' $tube>Tube</option>
													<option value='Flabot' $flabot>Flabot</option>
													<option value='Botol' $botol>Botol</option>
													<option value='BOX' $box>BOX</option>
													<option value='0' $selected1>-Pilih Satuan-</option>
								</select>
                        
						<label>Harga Beli</label><input type='text' id='beli' value=$r[hrg_beli] class='form-control'>
						<label>Presentase</label><input type='text' id='persen'  value='$z' onkeyup='persen()' class='form-control'>%
						<label>Harga Jual</label><input type='text' id='jual' value=$r[hrg_jual] disabled=readonly class='form-control'>
                        <label>Stok</label><input type='text' id='stok' value='$r[stok]' disabled=readonly class='form-control'>
                        <label>Stok Minim</label><input type='text' id='stok_m' value='$r[stok_minim]' class='form-control'>
                        <tr><td colspan='3'><label></label>
                        ";
                   ?>     
                 </div>
				 <button id='update_barang' class='btn'>Simpan</button>
                 <button onClick="window.location.href='barang';" class='btn'>Kembali</button>
				</div>
			</div>
	</div>
					</div>
			</div>
	</div>
	
						
<?php

  break;
  case "pengeluaran":
  echo"<h2><img src='../img/icons/16x16_0320/database.png'>&nbspPengeluaran Data Barang</h2><hr>
  <span style='margin-left:10px'></span><button onClick=\"window.location.href='barang';\" class='btn'>Kembali</button><br><br><br>";
$query_tanggal=mysql_fetch_array(mysql_query("select min(tanggal_transaksi) as tanggal_pertama from master_transaksi"));
	$tanggal_pertama=$query_tanggal['tanggal_pertama'];

			//untuk menyelesaikan transaksi
			$p      = new Paging5;
			$batas  = 20;
			$posisi = $p->cariPosisi($batas);
			if(isset($_POST['report'])){
				
				//tanggal periode laporan
				$tanggal1=$_POST[thn_1].'-'.$_POST[bln_1].'-'.$_POST[tgl_1];
				$tanggal2=$_POST[thn_2].'-'.$_POST[bln_2].'-'.$_POST[tgl_2];
				
				$sql=mysql_query("select barang.nama, sum(penjualan.jumlah) from penjualan, barang where
											penjualan.id_product=barang.kode and penjualan.tanggal between '$tanggal1' and '$tanggal2' 
											group by barang.nama order by barang.nama asc limit $posisi,$batas");
				
			}else{
			
				$sql=mysql_query("select barang.nama, sum(penjualan.jumlah) from penjualan, barang where
											penjualan.id_product=barang.kode and penjualan.tanggal between '$thn_sekarang-$bln_sekarang-1' and '$tgl_sekarang'
											group by barang.nama order by barang.nama asc  limit $posisi,$batas") or die (mysql_error());
				
				unset($_POST['report']);
			}
			?>
		<div id="jurnal">
		<fieldset><legend style='float:right'><form action="barang.keluar" method="post" name="postform">
		 Periode<span style='margin-left:10px'></span><?php 
					if(empty($_POST['tanggal1'])){ 
						echo 	combotgl(1,31,'tgl_1',1);
								combonamabln(1,12,'bln_1',$bln_sekarang);
								combothn(2000,$thn_sekarang,'thn_1',$thn_sekarang);
					}else{	
						echo 	combotgl(1,31,'tgl_1',$_POST[tgl_1]);
								combonamabln(1,12,'bln_1',$_POST[bln_1]);
								combothn(2000,$thn_sekarang,'thn_1',$_POST[thn_1]); 
					}?>
			
			 S/D
			 <?php 
					if(empty($_POST['tanggal2'])){ 
						echo 	combotgl(1,31,'tgl_2',$tgl_skrg);
								combonamabln(1,12,'bln_2',$bln_sekarang);
								combothn(2000,$thn_sekarang,'thn_2',$thn_sekarang);
					}else{ 
						echo 	combotgl(1,31,'tgl_2',$_POST[tgl_2]);
								combonamabln(1,12,'bln_2',$_POST[bln_2]);
								combothn(2000,$thn_sekarang,'thn_2',$_POST[thn_2]);  }?>
			  
			  <input type="submit" name="report" class="btn-success" value="tampilkan" />
		</form></legend>
		<table class="jurnal">
			<tr>
				<th>No.</th><th>Nama Obat</th><th>Jumlah</th>
			</tr>
			<?php $no=1;
				while($r=mysql_fetch_array($sql)){?>
				<tr class="body">
					<td><div align="center"><?php echo $no?></div></td>
					<td><div align="left"><?php echo $r[0]?></div></td>
					<td><div align="center"><?php echo $r[1]?></div></td>
				</tr>
				<?php
				$no++;
			}
			?>
			
			</table>
		<?php 	$jmldata = mysql_num_rows(mysql_query("select barang.nama, sum(penjualan.jumlah) from penjualan, barang where
											penjualan.id_product=barang.kode and penjualan.tanggal between '$thn_sekarang-$bln_sekarang-1' and '$tgl_sekarang' group by barang.nama order by barang.nama asc"));
				$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
				$linkHalaman = $p->navHalaman($_GET[bacth], $jmlhalaman);

			echo "<div id=paging>Hal: $linkHalaman</div><br></fieldset></div>"; 
break;			
	case "trackbarang":
  echo"<h2><img src='../img/icons/16x16_0320/database.png'>&nbspPengeluaran Data Barang</h2><hr>
  <input class='btn'type=button value='Kembali' onClick=\"window.location.href='barang';\"></br></br>";
		 $query=mysql_query("select penjualan.tanggal,penjualan.id_transaksi,barang.nama,penjualan.jumlah from barang, penjualan
							where barang.kode=penjualan.id_product and barang.kode='$_GET[id]'") or die (mysql_error());
			echo "<div id='nota'><fieldset>
				<div class='kepala-nota'>
				<p>APOTEK AZKA Pekalongan<br>
				Jl.Keradenan Besar Pekalongan Selatan No.26</p><hr><hr style='color:#000;'></div>
				<div class='kanan-nota'>
                            </div>";
                        echo "<div id='scroll'><table class='nota'>
                                <thead>
                                    <tr>
										<th>No.</th>
                                        <th>Tanggal</th>
										<th>Kode transaksi</th>
                                        <th>Nama</th>
                                        <th>Jumlah</th>
                                         </tr>
                                </thead>";
								$no=1;
                                while($r=mysql_fetch_row($query)){
                                    echo "<tr class=body>
											<td align='center'>$no</td>
                                            <td align='center'>$r[0]</td>
                                            <td align='center'>$r[1]</td>
                                            <td align='center'>$r[2]</td>
                                            <td align='center'>$r[3]</td>
                                            <td align='center'>$r[4]</td>
                                             </tr>";
									$no++;
								}
                                echo "<tr>
                                        <td colspan='5'><h4 align='right'></h4></td>
                                        <td colspan='5'><h4></h4></td>
                                    </tr>
                                    </table></div><h4 style='float:right; margin-right:20px;'></h4>
									<p style='font-size:8pt;float:left; padding-top:15px;'>*tracking barang <p></fieldset></div>";              

}
?>
