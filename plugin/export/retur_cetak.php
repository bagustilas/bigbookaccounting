<?php		
			require ('../../Inc/koneksi.php');
			$query=mysql_query("select barang.kode,barang.nama,retur.nobacth,retur.ed,retur.jumlah,retur.harga 
					from barang,kd_retur,retur where barang.kode=retur.id_product and
					kd_retur.kd_ret=retur.id_transaksi and kd_retur.kd_ret='$_GET[id]'") or die (mysql_error());
		$sql = mysql_fetch_array(mysql_query("SELECT * FROM kd_retur,kd_pemb,supplier WHERE kd_pemb.id_supplier=supplier.id_supplier and kd_retur.id_pemb=kd_pemb.kd_pmb and 
						kd_ret='$_GET[id]'")) or die ("query gagal");
					$no = 1;
					$pemilik=mysql_fetch_array(mysql_query("select nm_perusahaan,alamat from bigbook_perusahaan")) or die ("gagal");
					?>
<html>
	<head>
		<link href="../../css/cetak_r.css" rel="stylesheet">
		<script type="text/javascript" src="../../js/jquery-1.4.2.min.js"></script>
		<script type="text/javascript" src="../../js/jquery.shortcuts.min.js"></script>
		<script>
   $.Shortcuts.add({
    type: 'down',
    mask: 'p',
    handler: function() {
        window.print();
    }
   }).start();
   </script>
	</head>
	<body>
		<div class='span8  offset2'>
			<div id='nota'><fieldset><div class='kepala-nota'>
				<p><?php echo" $pemilik[nm_perusahaan] ";?><br>
				<?php echo" $pemilik[alamat]"; ?></p><hr><hr style='color:#000;'></div>
				<div class='kanan-nota'>
                        Nota :<?php echo"$sql[kd_ret]<span style='margin-left:10px;'></span>$sql[0]";?>
                      </div>
					  <div id='scroll'><table class='nota'>
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
				<?php	$query=mysql_query("select barang.kode,barang.nama,retur.nobacth,retur.ed,retur.jumlah,retur.harga 
					from barang,kd_retur,retur where barang.kode=retur.id_product and
					kd_retur.kd_ret=retur.id_transaksi and kd_retur.kd_ret='$_GET[id]'") or die (mysql_error());
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
                                echo "<tr>
                                        <td colspan='5'><h4 align='right'></h4></td>
                                        <td colspan='5'><h4></h4></td>
                                    </tr>
                                    </table></div><hr><h3 style='float:right; margin-right:20px;'>Total&nbsp ";echo"Rp&nbsp".number_format($sql[3],2,',','.');echo"</h3>
									<p style='font-size:8pt;float:left; padding-top:35px;'>* Nota Retur</br>
									<i class='icon-user'></i>Petugas :$sql[4]<p></fieldset></div>";?>
			</fieldset></div>
	</body>
</html>