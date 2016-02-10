<?php		
			require ('../../configurasi/koneksi.php');
			require ('../../configurasi/library.php');
			require ('../../configurasi/fungsi_indotgl.php');
			require ('../../configurasi/fungsi_autolink.php');
			require ('../../configurasi/fungsi_combobox.php');
			require ('../../configurasi/fungsi_kalender.php');
			require ('../../configurasi/class_paging.php');
			require ('../../configurasi/fungsi_rupiah.php');
			
			$pjl=mysql_fetch_array(mysql_query("select sum(total) as total from kd_penj where tanggal between '$thn_sekarang-$bln_sekarang-1' and '$tgl_sekarang' ")) or die (mysql_error());
				$pbl=mysql_fetch_array(mysql_query("select sum(total) as total from kd_pemb where tanggal between '$thn_sekarang-$bln_sekarang-1' and '$tgl_sekarang' ")) or die (mysql_error());
				$psd=mysql_fetch_array(mysql_query("select jumlah from rekening where kd_rek='113'"));
				$ret=mysql_fetch_array(mysql_query("select jumlah from rekening where kd_rek='511'"));
				$biaya=mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from rekening where kd_rek between '611' and '699'"));
				$pot=mysql_fetch_array(mysql_query("select sum(disc) as pot from kd_pemb where tanggal between '$thn_sekarang-$bln_sekarang-1' and '$tgl_sekarang'"));
			
		$tampil=mysql_query("SELECT * FROM barang ORDER BY nama");
		while($r = mysql_fetch_array($tampil)){
		$jml=$r[stok];
		$hrg=$r[hrg_beli];
		$subtotal= $jml * $hrg;
		$total1= $total1 + $subtotal;} //persediaan akhir
		$jmlretpo = $ret[jumlah]+$pot[pot];
		$pblbersih = $pbl[total]- $jmlretpo; //pembelian bersih
		$x2 = $pblbersih + $psd[jumlah]; //barang siap jual
		$hpp = $x2 - $total1; //barang siap jual di kurangi persediaan akhir
		$kotor = $pjl[total]-$hpp;
		$pajak= $kotor * 10/100;
		$beban= $biaya[jumlah]+$pajak;
		$laba = $kotor-$beban;
		$pemilik=mysql_fetch_array(mysql_query("select nm_perusahaan,alamat from bigbook_perusahaan")) or die ("gagal");

			$no = 1;?>
<html>
	<head>
		<link href="../../css/cetak_l.css" rel="stylesheet">
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
		<div class='span8  offset3'>
	<div id="jurnal">
		<fieldset><legend style='float:right'><b style='font-size:28pt'><?php echo"$pemilik[nm_perusahaan]";?></b><br><?php echo"$pemilik[alamat]";?><br>Laporan Rugi Laba Periode <?php echo tgl_indo($tgl_sekarang);?><hr></legend>
		
			<table class="informasi" style='width:465px;'>
			<tr>
				<th colspan='9' style='text-align:left'>Keterangan</th><th></th><th></th>
			</tr>
				<tr class="body">
					<td colspan='10'><div align="left">Penjualan</div></td>
					<td align="right"><?php  echo "Rp.".number_format($pjl[total],2,'.',','); ?></td>
					<td align="right"><?php  ?></td>
				</tr>
				<tr class="body">
					<td colspan='7'><div align="left">Persedian Awal</div></td>
					<td align="right"><?php  echo "Rp.".number_format($psd[jumlah],2,'.',','); ?></td>
					<td align="right"><?php  ?></td>
				</tr><tr class="body">
				<tr class="body">
					<td colspan='6'><div align="left">Pembelian</div></td>
					<td align="right"><?php  echo "Rp.".number_format($pbl[total],2,'.',','); ?></td>
					<td align="right"><?php  ?></td>
				</tr><tr class="body">
					<td colspan='5'><div align="left">Potongan Pembelian</div></td>
					<td align="right"><?php  echo "Rp.".number_format($pot[pot],2,'.',','); ?></td>
					<td align="right"><?php  ?></td>
				</tr><tr class="body">
					<td colspan='5'><div align="left">Retur Pembelian</div></td>
					<td align="right"><?php  echo "Rp.".number_format($ret[jumlah],2,'.',','); ?>+<hr></td>
					<td align="right"><?php  ?></td>
				</tr><tr class="body">
					<td colspan='6'><div align="left"></div></td>
					<td align="right"><?php  echo "Rp.".number_format($jmlretpo,2,'.',','); ?>+<hr></td>
					<td align="right"><?php  ?></td>
					<td align="right"><?php  ?></td><td align="right"><?php  ?></td>
				</tr><tr class="body">
					<td colspan='7'><div align="left">Pembelian Bersih</div></td>
					<td align="right"><?php  echo "Rp.".number_format($pblbersih,2,'.',','); ?><hr></td>
					<td align="right"><?php echo"+"; ?></td>
				</tr></tr><tr class="body">
					<td colspan='7'><div align="left">Barang Siap Jual</div></td>
					<td align="right"><?php  echo "Rp.".number_format($x2,2,'.',','); ?></td>
					<td align="right"><?php  ?></td>
					<td align="right"><?php  ?></td>
				</tr></tr><tr class="body">
					<td colspan='7'><div align="left">Persediaan Akhir</div></td>
					<td align="right"><?php  echo "Rp.".number_format($total1,2,'.',','); ?><hr></td>
					<td align="right"><?php echo"-"; ?></td>
					<td align="right"><?php  ?></td>
				</tr>
				<tr class="body">
					<td colspan='9'><div align="left">Harga Pokok Penjualan</div></td>
					<td align="right"><?php  echo "Rp.".number_format($hpp,2,'.',','); ?></td>
					<td align="right"><?php  ?></td>
				</tr>
				<tr class="body">
					<td colspan='9'><div align="right">laba Kotor</div></td>
					<td align="right"><?php  ?></td>
					<td align="right"><?php  echo "Rp.".number_format($kotor,2,'.',','); ?></td>
				</tr>
				<tr class="body">
					<td colspan='9'><div align="left">Biaya</div></td>
					<td align="right"><?php  echo "Rp.".number_format($biaya[jumlah],2,'.',','); ?></td>
					<td align="right"><?php  ?></td>
				</tr>
				<tr class="body">
					<td colspan='9'><div align="left">Pajak</div></td>
					<td align="right"><?php  echo "Rp.".number_format($pajak,2,'.',','); ?></td>
					<td align="right"><?php  ?></td>
				</tr>
				<tr class="body">
					<td colspan='9'><div align="right">Jumlah Beban</div></td>
					<td align="right"><?php  ?></td>
					<td align="right"><?php  echo "Rp.".number_format($beban,2,'.',','); ?></td>
				</tr>
			<tr class="footer">
				<td colspan="10"><div align="center"><strong>Total Laba</strong></div></td>
				<td align="right"><strong><?php echo"Rp.".number_format($laba,2,'.',','); ?></strong></td>
			</tr>
			</table>
			</fieldset></div>
			</div>
	</body>
</html>