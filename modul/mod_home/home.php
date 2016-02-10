          <div class="row">
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-green green">
                            <div class="panel-left pull-left green">
                                <i class="fa fa-bar-chart-o fa-5x"></i>
                                
                            </div>
                            <div class="panel-right pull-right">
								<a href="transaksi.penjualan"><h3>Trans</h3>	
                               <strong> Penjualan</strong></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-blue blue">
                              <div class="panel-left pull-left blue">
                                <i class="fa fa-shopping-cart fa-5x"></i>
								</div>
                                
                            <div class="panel-right pull-right">
							<a href="transaksi.pembelian"><h3>Trans</h3>	
                               <strong> Pembelian</strong></a>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-red red">
                            <div class="panel-left pull-left red">
                                <i class="fa fa fa-comments fa-5x"></i>
                               
                            </div>
                            <div class="panel-right pull-right">
							<a href="llb"><h3>Lap.</h3>	
                               <strong> Rugi/Laba</strong></a>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-brown brown">
                            <div class="panel-left pull-left brown">
                                <i class="fa fa-users fa-5x"></i>
                                
                            </div>
                            <div class="panel-right pull-right">
							<a href="grafik"><h3>Grafik</h3>
                             <strong>Keuangan</strong></a>

                            </div>
                        </div>
                    </div>
                </div>
				
				 <div class="row">
                    <div class="col-md-5 col-sm-12 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Biaya Operasional
                            </div>
                            <div class="panel-body">
							<div class="table-responsive">
							<table class="table table-striped">
                                    <thead>
                                        <tr>
											<th>Kode Rekening</th><th>Keterangan</th><th>Masa</th><th>jumlah</th>
										</tr>
                                    </thead>
									 <tbody>
                               <?php
									$p      = new Paging;
									$batas  = 5;
									$posisi = $p->cariPosisi($batas);
									$sql = mysql_query("select * from rekening where kd_rek between '611' and '666'
									order by kd_rek asc limit $posisi,$batas") or die (mysql_error());
									$total=mysql_fetch_array(mysql_query("select sum(jumlah) as total from rekening where kd_rek between '611' and '666'")) or die (mysql_error());
							 
								while($r=mysql_fetch_array($sql)){
				echo"	<tr class=\"body\">
					<td><div align=\"center\">$r[kd_rek]</div></td>
					<td><div align=\"center\"></div>$r[nama_rekening]</td>
					<td><div align=\"center\">1 BLN</div></td>
					<td><div align=\"left\">Rp.&nbsp".number_format($r[jumlah],2,'.',',');echo"</div></td>
				</tr>";
				}
			?>  
			</tbody>
			  <tr>
				<td colspan="3"><div align="center"><strong>TOTAL Penyesuaian</strong></div></td>
				<td><strong><?php echo number_format($total['total'],2,'.',','); ?></strong></td>
			</tr>    
               </table>
			     <?php
				$jmldata = mysql_num_rows(mysql_query("select * from rekening where kd_rek between '611' and '666'"));
				$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
				$linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

			echo "<div id=paging>Hal: $linkHalaman</div><br>";?>
                            </div>
                            </div>
                        </div>
                    </div>
                            <div class="col-md-7 col-sm-12 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Hutang Dagang
                            </div>
                            <div class="panel-body">
							<div class="table-responsive">
							<table class="table table-striped">
                                    <thead>
                                        <tr>
											<th>Tanggal</th><th>No. Faktur</th><th>Keterangan</th><th>Total</th>
				<th>Bayar</th>
										</tr>
                                    </thead>
									 <tbody>
                               <?php
									$p      = new Paging;
			$batas  = 5;
			$posisi = $p->cariPosisi($batas);
			
				$query=mysql_query("select * from kd_pemb where status='tempo' limit $posisi,$batas") or die (mysql_error());
				$total=mysql_fetch_array(mysql_query("select sum(total) as total from kd_pemb where status='tempo' order by tanggal asc"));
			 
							while($row_tran=mysql_fetch_array($query)){
			?>
			<tr>
					<td><div align="center"><?php echo $row_tran['tanggal'];?></div></td>
					<td><div align="center"><?php echo $row_tran['nofaktur'];?></div></td>
					<td align="center">Hutang Dagang</td>
					<td align="right"><?php echo number_format($row_tran['total'],2,'.',','); ?></td>
					<td><?php echo"<a href=hutang.$row_tran[kd_pmb]><span>Detail</span>"?></td>
			</tr>
			<?php
				}
			?>  
			</tbody>
			  <tr>
				<td colspan="3"><div align="center"><strong>TOTAL Hutang</strong></div></td>
				<td align="right"><strong><?php echo number_format($total['total'],2,'.',','); ?></strong></td>
			</tr>    
               </table>
			  <?php
				$jmldata = mysql_num_rows(mysql_query("SELECT * from kd_pemb where status='tempo'"));
				$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
				$linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

			echo "<div id=paging>Hal: $linkHalaman</div><br>";?>
                            </div>
                            </div>
                        </div>
                    </div>

                </div>

<?php				
echo"
	$hari_ini,";
	echo tgl_indo(date("Y m d")); 
	echo " | "; 
	echo date("H:i:s");
	echo " WIB";
?>