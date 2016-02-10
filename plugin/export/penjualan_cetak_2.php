<?php		
			require ('../../configurasi/koneksi.php');
			?>
<html>
	<head>
		<link href="../../css/cetak.css" rel="stylesheet">
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
   $.Shortcuts.add({
    type: 'down',
    mask: 'F4',
    handler: function() {
				$("#barang").slideDown();
				$("#col").show();
				$("#loading").show();	
    }
   }).start();
   
   </script>
	</head>
	<body>
		<div class='span8  offset2'>
			<div id='nota'><fieldset><div class='kepala-nota'>
				<p>APOTEK AZKA<br>
				Jl.Keradenan Besar Pekalongan Selatan No.26</p><hr><hr style='color:#000;'></div>
				<div class='kanan-nota'>
                        Nota :<?php echo"$sql[kd_pjl]<span style='margin-left:10px;'></span>$sql[tanggal]";?>
                      </div>
					  
					  <div id='scroll'><table class='nota'>
                                <thead>
                                    <tr>
										<th>No.</th>
                                        <th>Nama</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
				<?php	$query=mysql_query("select kd_penj.kd_pjl,penjualan.id_product,barang.nama,
                                           penjualan.harga,penjualan.jumlah,penjualan.subtotal
                                           from penjualan,kd_penj,barang
                                           where kd_penj.kd_pjl=penjualan.id_transaksi and barang.kode=penjualan.id_product
                                           and penjualan.id_transaksi='$_GET[id]'") or die (mysql_error());
								$no=1;
                                while($r=mysql_fetch_row($query)){
                                    echo "<tr class=body>
											<td align='center'>$no</td>
                                            <td>$r[2]</td>
                                            <td align='center'>$r[4]</td>
                                            <td>";echo"Rp&nbsp".number_format($r[5],2,',','.');echo"</td>
                                        </tr>";
									$no++;
								}
                                echo "<tr>
                                        <td colspan='5'><h4 align='right'></h4></td>
                                        <td colspan='5'><h4></h4></td>
                                    </tr>
                                    </table></div><hr><h3 style='float:right; margin-right:20px;'>Total&nbsp ";echo"Rp&nbsp".number_format($sql[total],2,',','.');echo"</h3>
									<p style='font-size:8pt;float:left; padding-top:35px;'>* barang yang sudah dibeli tidak bisa dikembalikan</br>
									<i class='icon-user'></i>Petugas :$sql[user]<p></fieldset></div>
									
									<div id='barang' style='display:none;'>
				<div id='col'>
		<a href='#' id='dob'><i class='icon-remove-circle'></i></a>
			<script src='$js'></script>
           <div id='tambahbarang'><fieldset><legend>Tambah Data Barang</legend>
		   <table><tr><td>
             Kode Barang<div id='status'></div></td><td><input type='text' id='kode2'> <span id='pesan'></span></td></tr>
                        <tr><td><label>Nama Barang</label></td><td><input type='text' id='nama' ></td></tr>
                        <tr><td><label>Jenis</label></td><td><select id='jenis' style='margin-left:10px;'>
													<option value='Alkes'>ALKES</option>
													<option value='Generik'>Generik</option>
													<option value='Paten'>Paten</option>
													<option value='Salep'>Salep</option>
													<option value='Oral'>Oral</option>
													<option value='Narkotik'>Narkotik</option>
													<option value='Pisikotropik'>Pisikotropik</option>
													<option value='' selected>-Pilih Jenis-</option>
														</select></td></tr>
                        <tr><td><label>Satuan</label></td><td><input type='text' id='satuan' ></td></tr>
                        <tr><td><label>No.Bacth</label></td><td><input type='text' id='bacth' ></td></tr>
                        <tr><td><label>Kadaluarsa</label></td><td><input type='text' id='kadaluarsa' ></td></tr>";
                        //<tr><td><label>Harga Beli</label></td><td><input type='text' id='beli' ></td></tr>//
                        //<tr><td><label>Stok</label></td><td><input type='text' id='stok' class='span1'></td></tr>//
                        echo"<tr><td><label>Stok Minim</label></td><td><input type='text' id='stok_m' class='span1'></td></tr>
                        <tr><td colspan='3'><label></label>
						<button id='batal' class='btn'>Batal</button>
						<button id='simpan' class='btn'>Simpan</button></td></tr></table>
                        </fieldset></div>
				</div>
				</div>";?>
			</fieldset></div>
	</body>
</html>