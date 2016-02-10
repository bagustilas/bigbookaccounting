<script>
/**
********************modul installer bigbook.v.12******************
** @Dibuat oleh :	Bagus T. Hidayatullah 				   	******
** @Tanggal 	:	7 april 2013 21:55 WIB					******
** @Model 	    :	CMS.Accounting for busines				******
** @Version	    :	bigbookaccounting.v.12					******
** @Call	    :	www.facebook.com/bagustilash			******
** @Project	    :	bigbookaccoungting						******
##################################################################	
	Discripsi:
 * ini adalah sebuah applikasi PHP diperuntukan untuk akuntansi.
 * di gunakan pada pembukuan akuntansi dan persediaan.
 * dengan pengontrolan penuh pada semua kegiatan transaksi.
 
****Copyright 2013 Bagus T.Hidayatullah, all rights reserved.*****
*/
</script>

<?php
switch($_GET[act]){
	default:
	
	$query_tanggal=mysql_fetch_array(mysql_query("select min(tanggal_transaksi) as tanggal_pertama from master_transaksi"));
	$tanggal_pertama=$query_tanggal['tanggal_pertama'];

			//untuk menyelesaikan transaksi
		
			if(isset($_POST['report'])){
				
				//tanggal periode laporan
				$tanggal1=$_POST[thn_1].'-'.$_POST[bln_1].'-'.$_POST[tgl_1];
				$tanggal2=$_POST[thn_2].'-'.$_POST[bln_2].'-'.$_POST[tgl_2];
				
				$query_transaksi=mysql_query("select * from master_transaksi where tanggal_transaksi between '$tanggal1' and '$tanggal2' ORDER BY id_transaksi desc ");
				$total=mysql_fetch_array(mysql_query("select sum(debet) as tot_debet, sum(kredit) as tot_kredit from master_transaksi where tanggal_transaksi between '$tanggal1' and '$tanggal2' order by kode_rekening asc"));
	
			}else{
			
				$query_transaksi=mysql_query("select * from master_transaksi where tanggal_transaksi between '$thn_sekarang-$bln_sekarang-1' and '$tgl_sekarang' ORDER BY id_transaksi desc ") or die (mysql_error());
				$total=mysql_fetch_array(mysql_query("select sum(debet) as tot_debet, sum(kredit) as tot_kredit from master_transaksi where tanggal_transaksi between '$thn_sekarang-$bln_sekarang-1' and '$tgl_sekarang' ORDER BY id_transaksi "));
			
				unset($_POST['report']);
			}
			?>
			<div class="row">
                <div class="col-md-12">
				 <div class="panel panel-default">
					 <div class="panel-body">
		<form action="jurnal" method="post" name="postform">
		 Periode <?php 
					if(isset($_POST['report'])){ 
						echo 	combotgl(1,31,'tgl_1',$_POST[tgl_1]);
								combonamabln(1,12,'bln_1',$_POST[bln_1]);
								combothn(2000,$thn_sekarang,'thn_1',$_POST[thn_1]); 
						
					}else{	
						echo 	combotgl(1,31,'tgl_1',1);
								combonamabln(1,12,'bln_1',$bln_sekarang);
								combothn(2000,$thn_sekarang,'thn_1',$thn_sekarang);
					}?>
			
			 S/D
			 <?php 
					if(empty($_POST['report'])){ 
						echo 	combotgl(1,31,'tgl_2',$_POST[tgl_2]);
								combonamabln(1,12,'bln_2',$_POST[bln_2]);
								combothn(2000,$thn_sekarang,'thn_2',$_POST[thn_2]);  
						
					}else{ 
						echo 	combotgl(1,31,'tgl_2',$tgl_skrg);
								combonamabln(1,12,'bln_2',$bln_sekarang);
								combothn(2000,$thn_sekarang,'thn_2',$thn_sekarang);
						}?>
			  
			  <input type="submit" name="report" class="btn btn-success" value="tampilkan" />
		</form>
                        </div>
                        </div>
		   </div>
        
                <div class="col-md-12">
		
									
					<!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Hover Rows
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
			<tr>
				<th>Tanggal</th><th>Nomor Bukti</th><th>Kode Rekening</th><th>Keterangan</th><th>Debet</th><th>Kredit</th>
			</tr>
			</thead>
			<?php
			
			while($row_tran=mysql_fetch_array($query_transaksi)){
				$debet=$row_tran['debet'];
				$kredit=$row_tran['kredit'];
				
				?>
				<tr class="body">
					<td><div align="center"><?php echo $row_tran['tanggal_transaksi'];?></div></td>
					<td><div align="center"><?php echo $row_tran['kode_transaksi'];?></div></td>
					<td><div align="center"><?php echo $row_tran['kode_rekening'];?></div></td>
					<td><?php echo $row_tran['keterangan_transaksi'];?></td>
					<td align="right"><?php echo number_format($debet,2,'.',','); ?></td>
					<td align="right"><?php echo number_format($kredit,2,'.',','); ?></td>
				</tr>
				<?php
			}
			?>
			<tr class="footer">
				<td colspan="4"><div align="center"><strong>TOTAL TRANSAKSI</strong></div></td>
				<td align="right"><strong><?php echo number_format($total['tot_debet'],2,'.',','); ?></strong></td>
				<td align="right"><strong><?php echo number_format($total['tot_kredit'],2,'.',','); ?></strong></td>
			</tr>
			</table>
		<?php 	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM master_transaksi where tanggal_transaksi between '$thn_sekarang-$bln_sekarang-1' and '$tgl_sekarang' order by tanggal_transaksi desc"));
				$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
				$linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

			echo "<div id=paging>Hal: $linkHalaman</div>";?>
					</div>
			</div>
     </div>
                        </div>
               </div>
		</div>
	</div>
<?php	
	break;
	case "jurnalpenjualan":
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
                        <div class="panel-heading">
                             Tabel Penjulan
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
									<tr><th>No.</th>
									<th>ID transaksi</th>
									<th>Waktu</th>
									<th>Total</th>
									<th>Cetak</th>
				</thead>
					<tbody>
<?php	
		$no=1;
		$tampil= mysql_query("SELECT * FROM kd_penj order by tanggal desc");
		while($r = mysql_fetch_array($tampil)){
		$total=number_format($r[total], 2,',','.');
		$grandtotal= $grandtotal+$total;
				echo"<tr class='odd gradeX'>
						<td>$no</td>
						<td>$r[kd_pjl]</td>
					<td>$r[tanggal]</td>
					<td>Rp&nbsp$total</td>
					<td>
				<a href=penjualan.$r[kd_pjl]><span><i class='icon-check'></i>Detail
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
<?php	
	break;
	case "jurnalpembelian":
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
                        <div class="panel-heading">
                             Tabel Pembelian
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>		
							<tr>
							<th>No.</th>
							<th>ID transaksi</th>
							<th>No. Faktur</th>
							<th>Supplier</th>
							<th>Pembayaran</th>
							<th>Waktu</th>
							<th>Total</th>
							<th>Cetak</th>
				</thead>
					<tbody>
<?php	
		$no=1;
		$tampil= mysql_query("SELECT * from kd_pemb, supplier where kd_pemb.id_supplier=supplier.id_supplier order by kd_pemb.tanggal DESC");
		while($r = mysql_fetch_array($tampil)){
		$total=number_format($r[total], 2,',','.');
		$grandtotal= $grandtotal+$total;
				echo"<tr class='odd gradeX'>
						<td>$no</td>
						<td>$r[kd_pmb]</td>
						<td>$r[nofaktur]</td>
						<td>$r[nm_supplier]</td>
						<td>$r[status]</td>
					<td>$r[tanggal]</td>
					<td>Rp&nbsp$total</td>
					<td>
				<a href=pembelian.$r[kd_pmb]><span><i class='icon-check'></i>Detail
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
	<?php
	break;
	case "jurnalPenyesuaian":
		
					//untuk menyelesaikan transaksi
			$p      = new Paging2;
			$batas  = 10;
			$posisi = $p->cariPosisi($batas);
			$sql = mysql_query("select * from rekening where kd_rek between '611' and '666'
					order by kd_rek asc limit $posisi,$batas") or die (mysql_error());
			$total=mysql_fetch_array(mysql_query("select sum(jumlah) as total from rekening where kd_rek between '611' and '666'")) or die (mysql_error());
			
			?>
		<div class="row">
                <div class="col-md-6">
				<div class="panel panel-default">
					 <div class="panel-body">
			<input class="btn btn-default" type="button" value='Tambah Biaya' onclick="window.location.href='tambahbiaya';">

                        </div>
                        </div>
                     <!--    Hover Rows  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tabel Penyesuaian
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
			<tr>
				<th>Kode Rekening</th><th>Keterangan</th><th>Masa</th><th>jumlah</th>
			</tr>
				</thead>
				<tbody>
				<?php
				while($r=mysql_fetch_array($sql)){
			echo"	<tr>
					<td><div align=\"center\">$r[kd_rek]</div></td>
					<td><div align=\"center\"></div>$r[nama_rekening]</td>
					<td><div align=\"center\">1 BULAN</div></td>
					<td><div align=\"right\">Rp.&nbsp".number_format($r[jumlah],2,'.',',');echo"</div></td>
				</tr>";
				}
			?>
			</tbody>
			<tr class="footer">
				<td colspan="3"><div align="center"><strong>TOTAL Penyesuaian</strong></div></td>
				<td align="right"><strong><?php echo number_format($total['total'],2,'.',','); ?></strong></td>
			</tr>
			</table>
			
		<?php 	$jmldata = mysql_num_rows(mysql_query("select * from rekening where kd_rek between '611' and '666'"));
				$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
				$linkHalaman = $p->navHalaman($_GET[adjs], $jmlhalaman);

			echo "<div id=paging>Hal: $linkHalaman</div><br></fieldset></div>";?>
			  </div>
                        </div>
                    </div>
                    <!-- End  Hover Rows  -->
                </div>
			<?php
 break;
	case "lihatpenjualan":
		 $query=mysql_query("select kd_penj.kd_pjl,penjualan.id_product,barang.nama,
                                           penjualan.harga,penjualan.jumlah,penjualan.subtotal
                                           from penjualan,kd_penj,barang
                                           where kd_penj.kd_pjl=penjualan.id_transaksi and barang.kode=penjualan.id_product
                                           and penjualan.id_transaksi='$_GET[id]'") or die (mysql_error());
		$sql = mysql_fetch_array(mysql_query("SELECT * FROM kd_penj WHERE kd_pjl='$_GET[id]'")) or die ("query gagal");
		$pemilik=mysql_fetch_array(mysql_query("select nm_perusahaan,alamat from bigbook_perusahaan")) or die ("gagal");
		?>
			    <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
						<a href="batalpnj.<?php echo"$_GET[id]";?>">Batal</a>
						<?php echo"<a style=\"float:right;\" 
				onclick=\"window.open('cetakpenjualan.$_GET[id]','Print','menubar=no,navigator=no,width=500,height=450,left=200,top=150,toolbar=no')\";><i class='fa fa-user fa-print'></i>Print</a>&nbsp
				";?>
                        </div>
                        <div class="panel-body">
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed">
											<?php echo"<p>$pemilik[nm_perusahaan]<br>
				$pemilik[alamat]</p>"; ?></a>
                                        </h4>
                                    </div>
                               
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
											<?php echo"Nota : $sql[kd_pjl]<br>$sql[tanggal]";?>
											</a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse in" style="height: auto;">
                                        <div class="panel-body">
											<div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                <thead>
                                    <tr>
										<th>No.</th>
                                        <th>Kode Barang</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
								<?php
								$no=1;
                                while($r=mysql_fetch_row($query)){
                                    echo "<tr class=body>
											<td align='center'>$no</td>
                                            <td align='center'>$r[1]</td>
                                            <td>$r[2]</td>
                                            <td>";echo"Rp&nbsp".number_format($r[3],2,',','.');echo"</td>
                                            <td align='center'>$r[4]</td>
                                            <td>";echo"Rp&nbsp".number_format($r[5],2,',','.');echo"</td>
                                        </tr>";
									$no++;
								}
                                ?>
								<tr class="footer">
										<td colspan="4"><div align="center"><strong>TOTAL Penyesuaian</strong></div></td>
										<td align="right"><strong><?php echo number_format($sql['total'],2,'.',','); ?></strong></td>
								</tr>
								</table>
												</div>
											</div>
									   </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed">* barang yang sudah dibeli tidak bisa dikembalikan |
												<i class="fa fa-user fa-fw"></i>Petugas :<?php echo"$sql[user]";?><p></a>
                                        </h4>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>		
				
					 <?php
	  break;
		case "tambahbiaya":
		
	?>
		<div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
						<div class="panel-heading">
                           Tambah Biaya
                        </div>
							
						
	<div class="panel-body">
			<div class="row">
                <div class="col-lg-12">
					<div id="pesan"></div>			
					<div id="data-rekening"></div>
               
					</div>
			</div>
	</div>
					</div>
			</div>
	</div>
	<?php	
	 break;
		case "lihatpembelian":
		$query=mysql_query("select kd_pemb.kd_pmb,pembelian.id_product,barang.nama,
                                           pembelian.harga,pembelian.jumlah,pembelian.subtotal,pembelian.ed
                                           from pembelian,kd_pemb,barang
                                           where kd_pemb.kd_pmb=pembelian.id_transaksi and barang.kode=pembelian.id_product
                                           and pembelian.id_transaksi='$_GET[id]'") or die (mysql_error());
		$sql = mysql_fetch_array(mysql_query("SELECT * FROM kd_pemb,supplier WHERE supplier.id_supplier=kd_pemb.id_supplier and kd_pemb.kd_pmb='$_GET[id]'")) or die ("query gagal");
		$rex = mysql_query("SELECT kd_retur.user,sum(kd_retur.total) as total,kd_retur.kd_ret FROM kd_retur,kd_pemb WHERE kd_retur.id_pemb=kd_pemb.kd_pmb and kd_pemb.kd_pmb='$_GET[id]' group by kd_retur.user ") or die (mysql_error());
		$cret = mysql_num_rows($rex);
		$ret = mysql_fetch_array($rex);
		$pemilik=mysql_fetch_array(mysql_query("select nm_perusahaan,alamat from bigbook_perusahaan")) or die ("gagal");
	
		 ?>
			    <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
						<?php 
				if($sql[status]=='Tempo'){
				echo"<input type=hidden id='kode' value='$sql[kd_pmb]'>
					<a href='?module=transaksi&act=detailpelunasan&id=$sql[kd_pmb]' style=\"float:right;\" id='lunas' >Pembayaran&nbsp<i class='icon-tags'></i></a>&nbsp";
				} else {
				echo"<a style=\"float:right;\"><i class='icon-ok'></i>Lunas&nbsp</a>&nbsp";	
				}echo"<a href='retur.$_GET[id]' id='retur'><i class='icon-refresh'></i>Retur</a>| ";
				echo"<a href='batalpmb.$_GET[id]' id='retur'><i class='icon-refresh'></i>Batal</a>";
						?>
                        </div>
                        <div class="panel-body">
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed">
											<?php echo"<p>$pemilik[nm_perusahaan]<br>
													$pemilik[alamat]</p>"; ?>
											</a>
                                        </h4>
                                    </div>
                               
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
										<div class="row">
											<div class="col-md-6">
                                           <?php echo"
											Supplier  <span style='margin-left:49px;'>:$sql[nm_supplier]<br>
											No.faktur  <span style='margin-left:42px;'>:$sql[nofaktur]<br>
											Tanggal Faktur <span style='margin-left:5px;'>:$sql[tgl_faktur]<br>";?>
											</div>
										
											<div class="col-md-6">
											<?php echo"Pembayaran : $sql[status]<span style='margin-left:10px;'></span><br>
											Nota : $sql[kd_pmb]<span style='margin-left:10px;'></span>
											<br>Tanggal Transaksi: $sql[tanggal]";?>
											</div>
										</div>	
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse in" style="height: auto;">
                                        <div class="panel-body">
											<div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                <thead>
                                    <tr>
										<th>No.</th>
                                        <th>Kode Barang</th>
                                        <th>Nama</th>
                                        <th>ED</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
								<?php
								$no=1;
                                while($r=mysql_fetch_row($query)){
                                    echo "<tr>
											<td align='center'>$no</td>
                                            <td align='center'>$r[1]</td>
                                            <td>$r[2]</td>
                                            <td>$r[6]</td>
                                            <td>";echo"Rp&nbsp".number_format($r[3],2,',','.');echo"</td>
                                            <td align='center'>$r[4]</td>
                                            <td>";echo"Rp&nbsp".number_format($r[5],2,',','.');echo"</td>
                                        </tr>";
									$no++;
								}
                                ?>
								
								<tr class="footer">
					
										<td colspan="6"><div align="right"><strong>Total</strong></div></td>
										<td><strong><?php echo"Rp&nbsp".number_format($sql['total'],2,'.',','); ?></strong></td>	
								</tr>
								<tr class="footer">
						
										<td colspan="6"><div align="right"><strong>Retur</strong></div></td>
										<td><strong>
											<?php
											if($cret > 0){
												$grand=$sql[total]-$ret[total];
												echo"Rp&nbsp".number_format($ret[total],2,',','.');echo"</h4>";
												}else{
												echo"Rp&nbsp".number_format($ret[total],2,',','.');echo"</h4>";
													$grand=$sql[total];
												}
										?>
										</strong></td>	
								</tr>
								<tr class="footer">
				
										<td colspan="6"><div align="right"><strong>Grand Total</strong></div></td>
										<td><strong><?php echo"Rp&nbsp".number_format($grand,2,'.',','); ?></strong></td>	
								</tr>
								</table>
												</div>
											</div>
									   </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                           <?php  echo"
											<p style='font-size:12pt;>* faktur pembelian<br><i class='icon-user'></i>Petugas :$sql[user] |<i class='icon-user'></i>Petugas Retur :$ret[user] |";if($cret>0){echo"<a href='dataretur.$ret[kd_ret]'>Detail Retur</a>";}else{echo"Detail Retur";}echo"<p>";
										?>
                              
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>		
	<?php	
	 break;
	 case "jurnalhutang":
		
					//untuk menyelesaikan transaksi
			$p      = new Paging3;
			$batas  = 10;
			$posisi = $p->cariPosisi($batas);
			
				$query=mysql_query("select * from kd_pemb where status='tempo' limit $posisi,$batas") or die (mysql_error());
				$total=mysql_fetch_array(mysql_query("select sum(total) as total from kd_pemb where status='tempo' order by tanggal asc"));
			?>
		<div class="row">
                <div class="col-md-12">
                     <!--    Hover Rows  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tabel Hutang
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
			<tr>
				<th>Tanggal</th><th>Nomor Transaksi</th><th>No. Faktur</th><th>Kode Rekening</th><th>Keterangan</th><th>Total</th>
				<th>Detail</th>
			</tr>
			<?php
			
			while($row_tran=mysql_fetch_array($query)){
				
				?>
				<tr class="body">
					<td><div align="center"><?php echo $row_tran['tanggal'];?></div></td>
					<td><div align="center"><?php echo $row_tran['kd_pmb'];?></div></td>
					<td><div align="center"><?php echo $row_tran['nofaktur'];?></div></td>
					<td>211</td>
					<td align="center">Hutang Dagang</td>
					<td align="right"><?php echo number_format($row_tran['total'],2,'.',','); ?></td>
					<td><?php echo"<a href=hutang.$row_tran[kd_pmb]><span>Detail</span>"?></td>
				</tr>
				<?php
			}
			?>
			<tr class="footer">
				<td colspan="5"><div align="center"><strong>TOTAL TRANSAKSI</strong></div></td>
				<td align="right"><strong><?php echo number_format($total['total'],2,'.',','); ?></strong></td>
			</tr>
			</table>
		<?php 	$jmldata = mysql_num_rows(mysql_query("SELECT * from kd_pemb where status='tempo'"));
				$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
				$linkHalaman = $p->navHalaman($_GET[hutang], $jmlhalaman);

			echo "<div id=paging>Hal: $linkHalaman</div>
			</div>
			</div>
			</div>
			</div>
			";
	break;
	
	case "jurnalretur":
	?>
	<div class="row">
                <div class="col-md-12">
                     <!--    Hover Rows  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tabel Retur
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
				<thead>
							<tr>
							<th>No.</th>
							<th>ID Retur</th>
							<th>ID Pembelian</th>
							<th>Waktu</th>
							<th>Total</th>
							<th>Cetak</th>
							</tr>
				</thead>
					<tbody>
<?php	
		$no=1;
		$tampil= mysql_query("SELECT * FROM kd_retur order by tanggal desc");
		while($r = mysql_fetch_array($tampil)){
		$total=number_format($r[total], 2,',','.');
		$grandtotal= $grandtotal+$total;
				echo"<tr class='odd gradeX'>
						<td>$no</td>
						<td>$r[kd_ret]</td>
						<td>$r[id_pemb]</td>
					<td>$r[tanggal]</td>
					<td>Rp&nbsp$total</td>
					<td>
				<a href=dataretur.$r[kd_ret]><span><i class='icon-check'></i>Detail
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
		</div>
	</div>
<?php	
	break;
	 case "retur":
?>
<script>	
var thoudelim = ".";
var decdelim = ",";
var curr = "Rp ";
var d=document;


function format(s,r) {
		s=Math.round(s*Math.pow(10,r))/Math.pow(10,r);
		s=String(s);s=s.split(".");var l=s[0].length;var t="";var c=0;
		while(l>0){t=s[0][l-1]+(c%3==0&&c!=0?thoudelim:"")+t;l--;c++;}
		s[1]=s[1]==undefined?"0":s[1];
		for(i=s[1].length;i<r;i++) {s[1]+="0";}
		return curr+t+decdelim+s[1];
	}

function calc(t,rel,price,ref) {
	if(t.value==""){t.value="0";}
		if(isNaN(t.value)){t.value=t.value.substr(0,t.value.length-1);}
			else {t.value=parseFloat(t.value);
			var ot=d.getElementById("total");
			var os=d.getElementById("sub"+rel);
			var old_total = ot.getAttribute("price")-os.getAttribute("price");
			var new_sub = parseFloat(t.value)*parseFloat(price);

			var y = d.getElementById("stok"+rel);
			var yp = parseFloat(y.getAttribute("rel"));//stok minim
			var pp = parseFloat(y.getAttribute("ref"));//stok
			var xp = parseInt(t.value);
			var x2p = pp - xp;
	if (xp > pp){
		alert("Retur melebihi stok");
		form.xp.focus();
		return false;
	}
		else if(xp < 1){
		alert("tidak boleh 0");
		return false;
	} 
		else if(x2p < yp){
		alert("Retur menyisakan kurang dari stok minim");
		return false;
		
	}  else if(x2p <= yp){
		alert("Retur akan menyisakan stok minim");
		return false;
	}

		os.setAttribute("price",new_sub);
		os.innerHTML=format(new_sub,2);
		ot.setAttribute("price",old_total+new_sub);
		ot.innerHTML=format(old_total+new_sub,2);
	}
}
</script>
<div class="row">
                <div class="col-lg-9">
                    <div class="panel panel-default">
						<div class="panel-heading">
		 <?php
			$query=mysql_query("select kd_pemb.kd_pmb,pembelian.id_product,barang.nama,
                                           pembelian.harga,pembelian.jumlah,pembelian.subtotal,barang.stok
                                           from pembelian,kd_pemb,barang
                                           where kd_pemb.kd_pmb=pembelian.id_transaksi and barang.kode=pembelian.id_product
                                           and pembelian.id_transaksi='$_GET[id]'") or die (mysql_error());
			$data = mysql_fetch_array(mysql_query("SELECT * FROM kd_pemb,supplier WHERE supplier.id_supplier=kd_pemb.id_supplier and kd_pemb.kd_pmb='$_GET[id]'")) or die (mysql_error());

			$tgl=date('d-m-Y');
			$date=date('Ymd');
			$initial="RTR";
			$auto=mysql_query("select * from retur order by id desc limit 1");
            $no=mysql_fetch_array($auto);
            $angka=$no['id']+1;
			
		 echo"
		 <form name='trans_pemb' method='POST' action='../apotek/modul/mod_jurnal/aksi_jurnal.php?module=transaksi&act=retur&input=simpan&kode=$initial$angka$date&id=$_GET[id]'>";?>			
	    <input type="button" class="btn" data-toggle="modal" data-target="#penjualan" value="Tambah"/>
	   <?php
			
		
					$s = session_id();
					$z=$sql=mysql_query("SELECT * FROM keranjang, barang WHERE id_session='$s' AND keranjang.id_product=barang.kode AND transaksi='retur' ORDER BY id_keranjang") or die(mysql_error());
					$cek = mysql_num_rows($z);
					
						if($cek > 0){ echo"
							<input class='btn'type='submit' value='Simpan'  Onclick=\"return confirm('Apakah Anda yakin akan menyimpan transaksi ini?')\" >";
						} else {
						echo "<input class='btn' type='button' value='Simpan' Onclick=\"alert('Tambahkan data barang dahulu')\" >";	
						} 
						if($cek > 0){
						echo" 
							<a href=\"../apotek/modul/mod_jurnal/aksi_jurnal.php?module=transaksi&act=retur&input=hapus&id=$_GET[id]\" Onclick=\"return confirm('Apakah Anda yakin akan membatalkan transaksi ini?')\">
						<input class='btn'type='button' value='Batal'></a>
						";
						} else {
						echo"
						
						";
						} 
							
	   ?>
                        </div>
						<div class="panel-heading">
					
                        </div>
	<div class="panel-body">
			<div class="row">
                <div class="col-lg-12">
		<div class="form-group">
          <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
											<th>No</th><th>Nama Barang</th><th>satuan</th><th>No. Bacth</th><th>Stok</th><th>Jumlah</th><th>Harga</th><th>Kadaluarsa</th><th>Subtotal</th><th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									
									<?php
			$sid = session_id();
			$no = 1;
			$x=mysql_query("SELECT keranjang.id_product,keranjang.qty,keranjang.id_keranjang,barang.kode,barang.nama,barang.satuan,pembelian.nobacth,barang.stok,barang.stok_minim,pembelian.harga,pembelian.ed
			FROM keranjang, pembelian, barang WHERE id_session='$sid' AND keranjang.id_product=barang.kode AND pembelian.id_product=barang.kode AND pembelian.id_transaksi='$_GET[id]' AND transaksi='retur' ORDER BY id_keranjang") or die(mysql_error());
			$cek = mysql_num_rows($x);
			while($q=mysql_fetch_array($x)){
			$hrg= $q[harga];
			$jml = $q[qty];
			$subtotal = $hrg * $jml;
			$total = $total+$subtotal;
									//start of isi
			echo"
			<td>$no</td>
			<td>$q[nama]</td>
			<td align='center'>$q[satuan]</td>
			<td align='center'><input type='text' name='bacth[$q[kode]]' value='$q[nobacth]' size='5'></td>
			<td  id=\"stok$no\"ref=\"$q[stok]\" rel=\"$q[stok_minim]\" >$q[stok]</td>
			<td><input class=\"jml\" style=\"background:#fff;\"  type=\"text\" name=\"qty[$q[kode]]\" size=\"1\" value=\"$jml\" onkeyup=\"calc(this,'$no',$hrg);\"></td>
			<td>".number_format($q[harga],2,',','.');echo"</td>
			<td align='center'><input type='text' name='ed[$q[kode]]' value='$q[ed]' size='8' ></td>
			<td style=\"background:rgb(221, 255, 221);\" id=\"sub$no\"  price=\"$hrg\">".number_format($subtotal,2,',','.');echo"</td>
			<td align='center'><a href=\"../apotek/modul/mod_jurnal/aksi_jurnal.php?module=transaksi&act=retur&input=delete&id=$_GET[id]&kd=$q[id_keranjang]&kode=$q[id_product]\" Onclick=\"return confirm('Apakah Anda yakin akan menghapus $q[nama]?')\">
					<span><i class='fa fa-pencil'></i></a></td><tr>
					</tr>";
				$no++;
			}	
										
									?>
                                        
                                    </tbody>
									<tfoot> 
									<tr> 
										<th style="text-align:right" colspan="8">Total</th> 
										<?php echo"<th id='total' price='$total' style=\"background:rgb(221, 255, 221);\">Rp&nbsp".number_format($total,2,',','.');echo"</th>";?>
									</tr> 
								</tfoot> 
                                </table>
                            </div>
                        </div>
					
		  </div>
	   </div>
			</div>
	</div>
					</div>
			</div>
			 <div class="col-lg-3">
                    <div class="panel panel-default">
						<div class="panel-heading">
                            Transaksi Retur
                        </div>
						<div class="panel-heading">
								
                        </div>
	<div class="panel-body">
			<div class="row">
                <div class="col-lg-12">
		
		<div class="form-group">	

		  <label>Supplier</label> <input type="text"   value="<?php echo"$data[nm_supplier]";?>" placeholder="Supplier" class="form-control" disabled>
		  <label>No. Faktur</label> <input type="text"   value="<?php echo"$data[nofaktur]";?>" placeholder="No. Faktur" class="form-control" disabled>
		  <label>Tanggal Faktur</label> <input type="text"  placeholder="YYYY-MM-DD" value="<?php echo"$data[tgl_faktur]";?>"  class="form-control" disabled>
          <label>No. Nota Retur</label> <input type="text" value="<?php echo"$initial$angka$date";?>"  class="form-control" disabled>
		  <label>Tanggal</label> <input type="text" value="<?php echo"$tgl";?>"  class="form-control" disabled>
		  <br>
		  <?php
				if($data['status']=='Tunai')
				{
					echo"
					<label class='checkbox-inline'>
					<input name='status' id='f' type='radio' value='Tunai' checked/>
					</label><label>Tunai</label>
					
					<label class='checkbox-inline'>			
					<input name='status' id='t' type='radio' value='Tempo' disabled/>
					</label><label>Tempo</label>
					";
				} 
					else
				{
					echo"
					<label class='checkbox-inline'>
					<input name='status' id='f' type='radio' value='Tunai' disabled/>
					</label><label>Tunai</label>
					
					<label class='checkbox-inline'>			
					<input name='status' id='t' type='radio' value='Tempo' checked/>
					</label><label>Tempo</label>";
				}
		  ?>
		  <label>Jatuh Tempo</label>
		  <input type="text" name="tgl_tempo" value="" class="form-control" disabled>
		 </div>
					</div>
			</div>
			</form>
				<div class="modal fade" id="penjualan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Tambahkan Item Barang</h4>
                                        </div>
                                        <div class="modal-body">
											<?php
												echo"
													<div class='table-responsive'>
                                <table class='table table-hover'>
			 <thead>
                   <tr>
						<th>Kode</th>
                        <th>Nama</th>
                        <th>Harga</th>
						<th>Stok</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
             </thead>";
			while($r=mysql_fetch_row($query)){
                                    echo "<tr class=body>
                                            <td align='center'>$r[1]</td>
                                            <td>$r[2]</td>
                                            <td>";echo"Rp&nbsp".number_format($r[3],2,',','.');echo"</td>
                                            <td align='center'>$r[6]</td>
   											<td align='center'>$r[4]</td>
                                            <td>";echo"Rp&nbsp".number_format($r[5],2,',','.');echo"</td>
                                            <td align='center'>
						<a href='../apotek/modul/mod_jurnal/aksi_jurnal.php?module=transaksi&act=retur&input=add&kode=$r[1]&id=$_GET[id]&harga=$r[3]'>
			<i class='fa fa-plus'></i></a></td>
                                        </tr>";
								}
		echo"</table>
											</div>	";
											?>		
										</div>
                                        <div class="modal-footer">
                                              </div>
                                    </div>
                                </div>
                         </div>
	</div>
					</div>
			</div>
	</div> 
<?php
	break;
	case "lihatretur":
		$query=mysql_query("select barang.kode,barang.nama,retur.nobacth,retur.ed,retur.jumlah,retur.harga 
					from barang,kd_retur,retur where barang.kode=retur.id_product and
					kd_retur.kd_ret=retur.id_transaksi and kd_retur.kd_ret='$_GET[id]'") or die (mysql_error());
		$sql = mysql_fetch_array(mysql_query("SELECT * FROM kd_retur,kd_pemb,supplier WHERE kd_pemb.id_supplier=supplier.id_supplier and kd_retur.id_pemb=kd_pemb.kd_pmb and 
						kd_ret='$_GET[id]'")) or die ("query gagal");
		$pemilik=mysql_fetch_array(mysql_query("select nm_perusahaan,alamat from bigbook_perusahaan")) or die ("gagal");

	?>
		 <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
						<?php
							echo"
								<a href=pembelian.$sql[id_pemb]>Detail Pembelian</a>
				<a style=\"float:right;\" 
				onclick=\"window.open('cetakretur.$_GET[id]','Print','menubar=no,navigator=no,width=700,height=450,left=200,top=150,toolbar=no')\";><i class='fa fa-print'></i></a>&nbsp

							";
						?>
                        </div>
                        <div class="panel-body">
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed">
											<?php echo"<p>$pemilik[nm_perusahaan]<br>
													$pemilik[alamat]</p>"; ?>
											</a>
                                        </h4>
                                    </div>
                               
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
										<div class="row">
											<div class="col-md-6">
                                           <?php echo"
											Nota : $sql[kd_ret]<span style='margin-left:10px;'></span>$sql[0]";
											?>
											</div>
										
											<div class="col-md-6">
											<?php echo"Pembayaran : $sql[status]<span style='margin-left:10px;'></span><br>
											Nota : $sql[kd_pmb]<span style='margin-left:10px;'></span>
											<br>Tanggal Transaksi: $sql[tanggal]";?>
											</div>
										</div>	
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse in" style="height: auto;">
                                        <div class="panel-body">
											<div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                <thead>
                                    <tr>
										<th>No.</th>
                                        <th>Kode Barang</th>
                                        <th>Nama</th>
                                        <th>NoBacth</th>
                                        <th>ED</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
								<?php
								$no=1;
                                while($r=mysql_fetch_row($query)){
								$h=$r[5]*$r[4];
                                    echo "<tr class=body>
											<td align='center'>$no</td>
                                            <td align='center'>$r[0]</td>
                                            <td>$r[1]</td>
											<td align='center'>$r[2]</td>
											<td align='center'>$r[3]</td>
											<td>";echo"Rp&nbsp".number_format($r[5],2,',','.');echo"</td>
                                            <td>";echo"Rp&nbsp".number_format($r[4],2,',','.');echo"</td>
                                            <td>";echo"Rp&nbsp".number_format($h,2,',','.');echo"</td>
                                        </tr>";
									$no++;
								}
                                ?>
								
								<tr class="footer">
					
										<td colspan="6"><div align="right"><strong>Total</strong></div></td>
										<td><strong><?php echo"Rp&nbsp".number_format($sql[3],2,'.',','); ?></strong></td>	
								</tr>
								
						
								</table>
												</div>
											</div>
									   </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                           <?php  echo"
											<p style='font-size:12pt;>* faktur pembelian<br><i class='icon-user'></i>Petugas :$sql[user] |<i class='icon-user'></i>Petugas Retur :$sql[user] |";if($cret>0){echo"<a href='dataretur.$ret[kd_ret]'>Detail Retur</a>";}else{echo"Detail Retur";}echo"<p>";
										?>
                              
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>		
	<?php
break;
	case"batalpnj":
	?>
	<script>	
var thoudelim = ".";
var decdelim = ",";
var curr = "Rp ";
var d = document;


function format(s,r) 
	{
		s = Math.round(s*Math.pow(10,r))/Math.pow(10,r);
		s = String(s);s=s.split(".");
		
		var l=s[0].length;
		var t="";
		var c=0;
		
		while(l>0)
			{
				t=s[0][l-1]+(c%3==0&&c!=0?thoudelim:"")+t;l--;c++;
			}
				s[1]=s[1]==undefined?"0":s[1];
				for(i=s[1].length;i<r;i++) 
					{
						s[1]+="0";
					}
		return curr+t+decdelim+s[1];
	}

function calc(t,rel,price,ref) 
	{
	if(t.value=="")
		{
			t.value="0";
		}
		if(isNaN(t.value))
		{
			t.value=t.value.substr(0,t.value.length-1);
		}
			else 
			{
				t.value=parseFloat(t.value);
				var ot = d.getElementById("total");
				var os = d.getElementById("sub"+rel);
				var old_total = ot.getAttribute("price")-os.getAttribute("price");
				var new_sub = parseFloat(t.value)*parseFloat(price);

				var y = d.getElementById("stok"+rel);
				var yp = parseFloat(y.getAttribute("rel"));
				var pp = parseFloat(y.getAttribute("ref"));
				var xp = parseInt(t.value);
				var x2p = pp - xp;
	if (xp > pp)
	{
		alert("Penjualan melebihi stok");
		return false;
	}
		else if(xp < 1)
		{
			alert("tidak boleh 0");
			return false;
		}   //else if(x2p < yp){
		// alert("penjualan menyisakan kurang dari stok minim");
		// return false;
	//}   else if(x2p <= yp){
		// alert("penjualan akan menyisakan stok minim");
		// return false;
	// }

		os.setAttribute("price",new_sub);
		os.innerHTML=format(new_sub,2);
		ot.setAttribute("price",old_total+new_sub);
		ot.innerHTML=format(old_total+new_sub,2);
	}
}

function hitung()
{
	var ttlbelanja=document.getElementById("totalbelanja").value;
	var tendered=document.getElementById("uang").value;
	var kembali=tendered-ttlbelanja;
	if(kembali < 0)
	{
		kembali = "Uang Belum Cukup";
	}
	var cash=document.getElementById("kembali").innerHTML=kembali;
}
function uangotomatis() 
{
	var ttlbelanja=document.getElementById("totalbelanja").value;
	var kembali=document.getElementById("uang").value=ttlbelanja;
	document.getElementById("kembali").innerHTML=format(kembali,2);
}
function beli()
{
	var hrg = parseInt(documen.getElementById("harga").value);
	var jml = parseInt(documen.getElementById("jml").value);
	var subtotal = hrg * jml;
	if( hrg < 0)
	{
		alert("tidak boleh nol");
		return false;
	}
	if(jml < 0)
	{
		alert("tidak boleh nol");
		return false;
	}
		var sub = document.getElementById("subtotal").innerHTML=subotal;
}


</script>
		
<div class="row">
                <div class="col-lg-9">
                    <div class="panel panel-default">
						<div class="panel-heading">
		 <?php
			$DataQuery = mysql_query("SELECT * FROM  kd_penj where kd_pjl = '$_GET[id]'") or die ("GAGAL Mengambil Data ID Transaksi");
			$DataField = mysql_fetch_array($DataQuery);
		echo"
		 <form name='trans_penj' method='POST' action=\"../apotek/modul/mod_jurnal/aksi_jurnal.php?module=transaksi&act=batalpnj&input=simpan&kode=$_GET[id]\";>";
		 ?>				
	    <!--<input type="button" class="btn" data-toggle="modal" data-target="#penjualan" value="Tambah"/>-->
	   <?php
			$no = 1;
			$x=$sql=mysql_query("SELECT * FROM penjualan, barang WHERE penjualan.id_product=barang.kode AND id_transaksi = '$_GET[id]'") or die(mysql_error());
		
			echo"			
			<input class='btn'type='submit' value='Simpan'  Onclick=\"return confirm('Apakah Anda yakin akan menyimpan transaksi ini?')\" >";
									
	   ?>
                        </div>
						<div class="panel-heading">
					
                        </div>
	<div class="panel-body">
			<div class="row">
                <div class="col-lg-12">
		<div class="form-group">
          <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Item</th>
                                            <th>Satuan</th>
                                            <th>Stok</th>
                                            <th>Jumlah</th>
                                            <th>Jumlah Baru</th>
                                            <th>Harga</th>
                                            <th>Subtotal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									
									<?php
										while($q=mysql_fetch_array($x)){
										$hrg = $q[harga];
										$jml = 1;
										$subtotal = $hrg * $jml;
										$total = $total+$subtotal;
									echo"
										<tr>
										<td>$no</td>
										<td>$q[nama]</td>
										<td align='center'>$q[satuan]</td>
										<td  id=\"stok$no\"ref=\"$q[stok]\" rel=\"$q[stok_minim]\" >$q[stok]</td>
										<td>$q[jumlah]</td>
										<td><input class=\"form-control\" class=\"jml\" style=\"background:#fff;\"  type=\"text\" name=\"qty[$q[kode]]\" size=\"1\"value=\"$jml\" onkeyup=\"calc(this,'$no',$hrg);\"></td>
										<td>".number_format($q[hrg_jual],2,',','.');echo"</td>
										<td style=\"background:rgb(221, 255, 221);\" id=\"sub$no\"  price=\"$hrg\">".number_format($subtotal,2,',','.');echo"</td>
										<td align='center'><a href=\"delp.$q[id_keranjang]&delp.$q[kode]\" Onclick=\"return confirm('Apakah Anda yakin akan menghapus $q[nama]?')\">
										<span><i class='fa fa-pencil'></i></a></td>
										</tr>";
											$no++;
									}
										
									?>
                                        
                                    </tbody>
									<?php
									echo"<tfooter>
										<td align='right' colspan='7' style=\"background:rgb(221, 255, 221); padding: 0.25em;\"><b>Total<b></td>
										<td id=\"total\" price=\"$total\" style=\"background:rgb(221, 255, 221);\">Rp&nbsp".number_format($total,2,',','.');echo"
										</td><td></td></tfoter>";
									?>
                                </table>
                            </div>
                        </div>
					
		  </div>
	   </div>
			</div>
	</div>
					</div>
			</div>
			
			
			 <div class="col-lg-3">
                    <div class="panel panel-default">
						<div class="panel-heading">
                            Transaksi Penjualan
                        </div>
						<div class="panel-heading">
								
                        </div>
	<div class="panel-body">
		<div class="row">
                <div class="col-lg-12">
		
		<div class="form-group">			
          <label>Dokter</label>
		  <select name="nm_dokter" class="form-control">
		  <?php
			$tampil=mysql_query("SELECT * FROM dokter ORDER BY nm_dokter") or die (mysql_error());
			if($DataField[dokter] == 0)
			{
				 echo "<option value=0 selected>- Pilih Dokter-</option>";
			}
            while($r=mysql_fetch_array($tampil)){
				if($DataField[dokter]==$r[id_dokter])
				{
					echo "<option value=$r[id_dokter] selected>$r[nm_dokter]</option>";
				} 
					else 
				{	
					echo "<option value=$r[id_dokter]>$r[nm_dokter]</option>";
				} 
			}	echo"</select>";?>
		 </div>
					</div>
			</div>
			</form>
			<div class="row">
                <div class="col-lg-12">
		
		<div class="form-group">			
          <label>No. Nota</label> <input type="text" value="<?php echo"$DataField[kd_pjl]";?>"  class="form-control" disabled>
		  <label>Tanggal</label> <input type="text" value="<?php echo"$DataField[tanggal]";?>"  class="form-control" disabled>
		 </div>
					</div>
			</div>
				<div class="modal fade" id="penjualan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Tambahkan Item Barang</h4>
                                        </div>
                                        <div class="modal-body">
													<?php
						$pg = '';
						if(!isset($_GET['pg'])) {
							include ('modul/mod_transaksi/form.php');
						}	else {
							$pg = $_GET['pg'];
							$mod = $_GET['mod'];
							include $mod . '/' . $pg . ".php";
						}		
							?>	
										</div>
                                        <div class="modal-footer">
                                              </div>
                                    </div>
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
